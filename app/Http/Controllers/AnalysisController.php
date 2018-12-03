<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corpora;
use App\Utils;
use App\Concordanciador;
use TextAnalysis\Corpus\TextCorpus;

class AnalysisController extends Controller
{
  /**
   * Verifies the entry and display the second step for corpora analysis, the selection of tool.
   *
   * @return \Illuminate\Http\Response
   */
  public function toolSelection(Request $request)
  {
    $validatedData = $request->validate([
        'language' => 'required',
        'corporas' => 'required',
    ]);

    $corporas_ids = collect($request->corporas);
    $request->session()->put('form_analysis.corporas_ids', $corporas_ids);
    $language = $request->language;
    $request->session()->put('form_analysis.language', $language);

    //verifica se todos os corpora estão disponíveis no idioma selecionado
    $has_language = $corporas_ids->every(function ($corpora_id) use ($language){
        $corpora = Corpora::find($corpora_id);
        return $corpora->hasCorpusLang($language);
    });

    if(!$has_language)
    {
      return redirect("/");
    }

    return view('analysis.toolSelection', compact('language'));
  }

  /**
   * Redirect to the selected tool.
   *
   * @return \Illuminate\Http\Response
   */
  public function step3(Request $request)
  {
    $tool = $request->tool;

    //gather all corpus in one string and put in the session
    $corpora_ids = collect($request->session()->get('form_analysis.corporas_ids'));
    $language = $request->session()->get('form_analysis.language');
    $all_corpus = $corpora_ids->reduce(function ($carry, $id) use ($language) {
        $corpora_corpus = Corpora::find($id)->getAllCorpus($language);
        return $carry . ' ' . $corpora_corpus;
    });
    $request->session()->put('form_analysis.all_corpus', $all_corpus);

    switch ($tool) {
      case 'concordanciador':
        return view('analysis.conc_form', compact('analysis'));
        break;
      case 'lista_palavras':
        return $this->listaPalavras($request);
        break;
      case 'n_grams':
        // code...
        break;
      default:
        return redirect("/");
        break;
    }

    return redirect("/");
  }

  public function concordanciador(Request $request)
  {
    $validatedData = $request->validate([
        'termo' => 'required',
    ]);

    $all_corpus = $request->session()->get('form_analysis.all_corpus');
    $posicao =  $request->posicao;
    $termo =  $request->termo;
    $contexto =  $request->contexto;
    $case =  boolval($request->case);
    $concordanciador = new Concordanciador($all_corpus, $posicao, $termo, $contexto, $case);

    $ocorrencias = $concordanciador->concordance();

    //expandido
    $concordanciador->setContextLength(160);
    $ocorrencias_exp = $concordanciador->concordance();
    $request->session()->put('form_analysis.concord', $ocorrencias);

    return view('analysis.concord', compact('ocorrencias', 'ocorrencias_exp'));
  }

  /**
   * Process the analysis, store it in the session and display it.
   *
   * @return \Illuminate\Http\Response
   */
  public function listaPalavras(Request $request)
  {
    $all_corpus = $request->session()->get('form_analysis.all_corpus');

    $utils = new Utils($all_corpus);
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
    fputcsv($csv_temp, array('Tabela de Frequência'));
    fputcsv($csv_temp, array('Posição', 'Palavra', 'Frequência'));
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
    $findings = $request->session()->get('form_analysis.concord');
    $csv_temp = fopen('php://temp', 'rw');

    # insere tabela de ocorrências encontradas
    fputcsv($csv_temp, array('#', 'Ocorrência'));
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
            ->header('Content-disposition', 'attachment; filename = teste.csv');
  }

}
