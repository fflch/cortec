<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Corpus;
use App\Utils;
use TextAnalysis\Corpus\TextCorpus;

class AnalysisController extends Controller
{
    /**
    * Verifies the entry and display the second step for corpus analysis, the selection of tool.
    *
    * @return \Illuminate\Http\Response
    */
    public function toolSelection(Request $request)
    {
        $validatedData = $request->validate([
            'language' => 'required',
            'corpuses' => 'required',
        ]);

        $corpuses_ids = collect($request->corpuses);
        $request->session()->put('form_analysis.corpuses_ids', $corpuses_ids);
        $language = $request->language;
        $request->session()->put('form_analysis.language', $language);

        //verifica se todos os corpuses estão disponíveis no idioma selecionado
        $has_language = $corpuses_ids->every(function ($corpus_id) use ($language) {
            $corpus = Corpus::find($corpus_id);
            return $corpus->hasTextLang($language);
        });

        if(!$has_language) {
            return redirect("/")
                ->withErrors(__('messages.validacao.modal_step1.body'))
                ->withInput();
        }

        return view('analysis.tool_selection', compact('language'));
    }

    /**
    * Redirect to the selected tool.
    *
    * @return \Illuminate\Http\Response
    */
    public function process(Request $request)
    {
        $tool = isset($request->tool) ? $request->tool : $request->old('tool');

        //gather all corpus in one string and put in the session
        $corpus_ids = collect($request->session()->get('form_analysis.corpuses_ids'));
        $language = $request->session()->get('form_analysis.language');
        $all_texts = $corpus_ids->reduce(function ($carry, $id) use ($language) {
            $corpus_text = Corpus::find($id)->getAllTexts($language);
            return $carry . ' ' . $corpus_text;
        });
        $request->session()->put('form_analysis.all_texts', $all_texts);

        switch ($tool) {
            case 'concordanciador':
                return view('analysis.conc_form', compact('analysis'));
                break;
            case 'lista_palavras':
                return $this->listaPalavras($request);
                break;
            case 'n_grams':
                break;
            default:
                redirect("/");
                break;
        }

        return redirect("/");
    }

    public function concordanciador(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'termo' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/analysis/process')
                ->withErrors(__('messages.validacao.modal_concord.error1'))
                ->withInput();
        }

        $all_texts = $request->session()->get('form_analysis.all_texts');
        $posicao =  $request->posicao;
        $termo =  $request->termo;
        $contexto =  $request->contexto;
        $case =  boolval($request->case);
        //$concordanciador = new Concordanciador($all_corpus, $posicao, $termo, $contexto, $case);
        $conc = new TextCorpus($all_texts);

        //reduzido
        $ocorrencias_red = collect($conc->concordance($termo, $contexto, !$case, $posicao, true));
        if ($ocorrencias_red->isEmpty()) {
            return redirect('/analysis/process')
                ->withErrors(__('messages.validacao.modal_concord.error2'))
                ->withInput();
        }

        //expandido
        // $concordanciador->setContextLength(150);
        $ocorrencias_exp = collect($conc->concordance($termo, 150, !$case, $posicao, true));

        $ocorrencias = $ocorrencias_red->zip($ocorrencias_exp);

        $request->session()->put('form_analysis.concord', $ocorrencias_red);
        $request->session()->put('form_analysis.concord_exp', $ocorrencias_exp);

        return view('analysis.concord', compact('ocorrencias'));
    }

    /**
    * Process the analysis, store it in the session and display it.
    *
    * @return \Illuminate\Http\Response
    */
    public function listaPalavras(Request $request)
    {
        $all_texts = $request->session()->get('form_analysis.all_texts');
        $utils = new Utils($all_texts);
        $analysis = $utils->getAnalysis();
        $request->session()->put('form_analysis.analysis', $analysis);

        return view('analysis.lista_palavras', compact('analysis'));
    }

    /**
    * Process the analysis, store it in the session and display it.
    *
    * @return \Illuminate\Http\Response
    */
    public function freqTable(Request $request)
    {
        $analysis = $request->session()->get('form_analysis.analysis');
        $csv_temp = fopen('php://temp', 'rw');

        $count_more_once_tokens = $analysis['count-tokens'] - $analysis['count-once-tokens'];
        $count_more_once_types = $analysis['count-types'] - $analysis['count-once-tokens'];

        # insere no CSV Header Tokens
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.tokens')));
        # insere no CSV Total de Ocorrências
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.total1'), $analysis['count-tokens']));
        # insere no CSV Total de Ocorrências que aparecem uma vez
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.tokens') . ' '. __('texts.lista_palavras.tabela.header1'), $analysis['count-once-tokens']));
        # insere no CSV Total de Ocorrências que aparecem mais de uma vez
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.tokens') . ' '. __('texts.lista_palavras.tabela.header2'), $count_more_once_tokens));
        # insere no CSV Header Palavras
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.types')));
        # insere no CSV Total de Palavras
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.total2'), $analysis['count-types']));
        # insere no CSV Total de Palavras que aparecem uma vez
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.types') . ' ' . __('texts.lista_palavras.tabela.header1'), $analysis['count-once-tokens']));
        # insere no CSV Total de Palavras que aparecem mais de uma vez
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.types') . ' ' . __('texts.lista_palavras.tabela.header2'), $count_more_once_types));
        # insere no CSV Índice Vocabular (Token/Type)
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.ratio'), $analysis['ratio']));

        # insere tabela de frequência
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.header3')));
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.header2_1'), __('texts.lista_palavras.tabela.header2_2'), __('texts.lista_palavras.tabela.header2_3')));
        $i = 0;
        foreach ($analysis['frequency-tokens'] as $key => $value) {
            $i++;
            $line = array($i,$key,$value);
            fputcsv($csv_temp, $line);
        }

        rewind($csv_temp);
        $csv = stream_get_contents($csv_temp);
        fclose($csv_temp);

        return response($csv)
                ->header('Content-Type', 'text/csv')
                ->header('Content-disposition', 'attachment; filename = '.__('texts.lista_palavras.tabela.header2_3').'.csv');
    }

    public function concordTable(Request $request)
    {
        $exp = $request->exp;
        $findings = (!$exp) ? $request->session()->get('form_analysis.concord') : $request->session()->get('form_analysis.concord_exp');
        $csv_temp = fopen('php://temp', 'rw');

        # insere tabela de ocorrências encontradas
        fputcsv($csv_temp, array('#', __('texts.concord.thead1')));
        $i = 0;
        foreach ($findings as $finding) {
            $i++;
            $line = array($i,strip_tags($finding));
            fputcsv($csv_temp, $line);
        }

        rewind($csv_temp);
        $csv = stream_get_contents($csv_temp);
        fclose($csv_temp);

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-disposition', 'attachment; filename = '.__('texts.concord.ferramenta').'.csv');
    }

}
