<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\Corpus;
use App\Utils;
use App\Models\Stopword;
use TextAnalysis\Corpus\TextCorpus;
use TextAnalysis\NGrams\NGramFactory;
use TextAnalysis\NGrams\StatisticFacade;

class AnalysisController extends Controller
{
    /**
    * Redirect to the selected tool.
    *
    * @return \Illuminate\Http\Response
    */
    public function process(Request $request)
    {

        //verifica se é um retorno de validação
        if ($request->old('tool')) {
            return $this->showForm($request);
        }

        Validator::make($request->all(), [
            'language' => 'required',
            'corpuses' => 'required',
            'tool'     => 'required',
        ])->validate();

        $corpuses_ids = collect($request->corpuses);
        $language     = $request->language;
        $tool         = $request->tool;

        //verifica se todos os corpuses estão disponíveis no idioma selecionado
        $has_language = $corpuses_ids->every(function ($corpus_id) use ($language) {
            $corpus = Corpus::find($corpus_id);
            return $corpus->hasTextLang($language);
        });
        if (!$has_language) {
            return redirect("/")
                ->withErrors(__('messages.validacao.modal_step1.body'))
                ->withInput();
        }

        //gather all corpus in one string and put in the session
        $all_texts = $corpuses_ids->reduce(function ($carry, $id) use ($language) {
            $corpus_text = Corpus::find($id)->getAllTexts($language);
            return $carry . ' ' . $corpus_text;
        });

        //armazena a compilação de textos na sessão
        $request->session()->put('form_analysis.all_texts', $all_texts);
        
        //retorna o formulário de acordo
        return $this->showForm($request);
    }

    private function showForm(Request $request) {
        //carrega as variáveis

        $tool     = $request->old('tool') ?? $request->tool;
        $language = $request->old('language') ?? $request->language;

        switch ($tool) {
            case 'concordanciador':
                return view('analysis.conc_form');
                break;
            case 'lista_palavras':
                return $this->listaPalavras($request);
                break;
            case 'n_grams':
                $stopwords = Stopword::getStoplist($request->language);
                return view('analysis.ngrams_form', compact('stopwords'));
                break;
            default:
                redirect("/");
                break;
        }
    }

    public function concordanciador(Request $request)
    {
        $token = $request->input('g-recaptcha-response');
        $ip    = $request->ip();

        $validator = Validator::make($request->all(), [
            'termo' => 'required',
        ]);

        if ($validator->fails()) {
        //if ($validator->fails() || !$this->verifyReCaptcha($token, $ip)) {
            return redirect('/analysis/process')
                ->withErrors(__('messages.validacao.modal_concord.error1'))
                ->withInput();
        }

        $all_texts = $request->session()->get('form_analysis.all_texts');
        //dd(strlen($all_texts));

        // essa análise fica muito lenta com texto muito grande
        $validator = Validator::make(['all_texts' => $all_texts], [
            'all_texts' => 'string|min:1|max:1000000',
        ]);
        
        if ($validator->fails()) {
            //if ($validator->fails() || !$this->verifyReCaptcha($token, $ip)) {
            return redirect('/')
                ->withErrors(__('messages.validacao.limite_digitos'))
                ->withInput();
        }

        $posicao =  $request->posicao;
        $termo =  $request->termo;
        $contexto = $request->contexto;
        $case =  boolval($request->case);
        
        $conc = new TextCorpus($all_texts);       

        $ocorrencias_red = collect($conc->concordance($termo, $contexto, !$case, $posicao, true));

        if ($ocorrencias_red->isEmpty()) {
            return redirect('/analysis/process')
                ->withErrors(__('messages.validacao.modal_concord.error2'))
                ->withInput();
        }
        
        $ocorrencias_exp = collect($conc->concordance($termo, 150, !$case, $posicao, true));
        

        $ocorrencias = $ocorrencias_red->zip($ocorrencias_exp);

        $request->session()->put('form_analysis.concord', $ocorrencias_red);
        $request->session()->put('form_analysis.concord_exp', $ocorrencias_exp);

        return view('analysis.concord', compact('ocorrencias'));
    }

    public function ngramas(Request $request)
    {
        $token = $request->input('g-recaptcha-response');
        $ip    = $request->ip();

        $validator = Validator::make($request->all(), [
            'ngram_size'    => 'required|integer|max:4|min:2',
            'stoplist'      => 'required',
            'stopwords'     => 'required_if:stoplist,yes',
            'min_freq'      => 'nullable|integer|min:0',
        ]);

        //if ($validator->fails() || !$this->verifyReCaptcha($token, $ip)) {
        if ($validator->fails() ) {
            return redirect('/analysis/process')
                ->withErrors($validator)
                ->withInput();
        }

        $all_texts      =  $request->session()->get('form_analysis.all_texts');

        $validator = Validator::make(['all_texts' => $all_texts], [
            'all_texts' => 'string|min:1|max:1000000',
        ]);
        
        if ($validator->fails()) {
            //if ($validator->fails() || !$this->verifyReCaptcha($token, $ip)) {
            return redirect('/')
                ->withErrors(__('messages.validacao.limite_digitos'))
                ->withInput();
        }

        $ngram_size     =  $request->ngram_size;
        $stats          =  $request->stats;
        $stoplist       =  $request->stoplist;
        $min_freq       =  $request->min_freq;
        $language       =  $request->session()->get('form_analysis.language');

        //Gera os Tokens
        $analysis   = new Utils($all_texts);
        $tokens     = $analysis->getTokens();

        //Remove as stopwords
        if ($stoplist == 'yes') {
            $stopwords = explode("\r\n", $request->stopwords);
            $stopwords = array_filter($stopwords);

            filter_stopwords($tokens, $stopwords);
            $tokens = array_values(array_filter($tokens));
        }

        //Gera os N-gramas
        $ngrams = NGramFactory::create($tokens, $ngram_size, ' ');
        $ngrams = NGramFactory::getFreq($ngrams, ' ');

        //Calcula ou não as estatísticas e ordena o array
        if (!is_null($stats)) {
            $ngrams_stats = StatisticFacade::calculate($ngrams, $stats, $ngram_size);
            arsort($ngrams_stats, SORT_NUMERIC);

            $ngrams = array_merge_recursive($ngrams_stats, $ngrams);

            //armazena o tipo de estatística na sessão
            $request->session()->put('form_analysis.ngrams.stats', $stats);
        } else {
            array_multisort(array_map(function($element) {
                return $element[0];
            }, $ngrams), SORT_DESC, $ngrams);
            $request->session()->forget('form_analysis.ngrams.stats');
        }

        //Remove conforme a frequência mínima inserida
        if ($min_freq > 1) {
            $ngrams = array_filter($ngrams, function($n) use ($min_freq, $stats) {
                $freq = ($stats) ? $n[1] : $n[0];
                return ($freq >= $min_freq);
            });
        }

        //armazena os n-gramas na sessão
        $request->session()->put('form_analysis.ngrams.values', $ngrams);

        return view('analysis.ngrams', compact('ngrams', 'stats'));
    }

    /**
    * Process the analysis, store it in the session and display it.
    *
    * @return \Illuminate\Http\Response
    */
    private function listaPalavras(Request $request)
    {
        $all_texts = $request->session()->get('form_analysis.all_texts');

        $validator = Validator::make(['all_texts' => $all_texts], [
            'all_texts' => 'string|min:1|max:1000000',
        ]);
        
        if ($validator->fails()) {
            //if ($validator->fails() || !$this->verifyReCaptcha($token, $ip)) {
            return redirect('/')
                ->withErrors(__('messages.validacao.limite_digitos'))
                ->withInput();
        }

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

        $count_more_once_types = $analysis['count-types'] - $analysis['count-once-tokens'];

        # insere no CSV Header Tokens
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.head1')));
        # insere no CSV Total de Ocorrências
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.total1'), $analysis['count-tokens'] ?? 0));
        # insere no CSV Total de Palavras
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.total2'), $analysis['count-types'] ?? 0));
        # insere no CSV Total de Palavras que aparecem uma vez
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.types') . ' ' . __('texts.lista_palavras.tabela.header1'), $analysis['count-once-tokens'] ?? 0));
        # insere no CSV Total de Palavras que aparecem mais de uma vez
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.types') . ' ' . __('texts.lista_palavras.tabela.header2'), $count_more_once_types ?? 0));
        # insere no CSV Índice Vocabular (Token/Type)
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.ratio'), $analysis['ratio'] ?? 0));

        # insere tabela de frequência
        fputcsv($csv_temp, array(__('texts.lista_palavras.tabela.head3')));
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



    /**
    * Generates the table for n-grams
    *
    * @return \Illuminate\Http\Response
    */
    public function ngramsTable(Request $request)
    {
        $ngrams = $request->session()->get('form_analysis.ngrams.values');
        $stats = $request->session()->get('form_analysis.ngrams.stats', null);

        $csv_temp = fopen('php://temp', 'rw');

        # insere no CSV Header Tokens
        fputcsv($csv_temp, array(__('texts.ngrams.tabela.title')));

        # insere tabela de n-gramas
        $value_header = ($stats) ? __('texts.ngrams.tabela.header3_2.'.$stats) : __('texts.ngrams.tabela.header3_1');
        fputcsv($csv_temp, array(__('texts.ngrams.tabela.header1'), __('texts.ngrams.tabela.header2'), $value_header));

        $i = 1;
        $old_value = 0;
        foreach ($ngrams as $ngram => $raw_value) {
            $value = ($stats) ? round($raw_value[0], 4) : $raw_value[0];
            ($old_value > $value) ? $i++ : $i;
            $old_value = $value;

            $line = array($i,$ngram,$value);
            fputcsv($csv_temp, $line);
        }

        rewind($csv_temp);
        $csv = stream_get_contents($csv_temp);
        fclose($csv_temp);

        return response($csv)
                ->header('Content-Type', 'text/csv')
                ->header('Content-disposition', 'attachment; filename = '.__('texts.ngrams.tabela.title').'.csv');
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

    private function verifyReCaptcha(string $token, string $ip_adress) : bool
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPCHA_SECRET'),
                'response' => $token,
                'remoteip' => $ip_adress
            ]
        ]);

        $status = $response->getStatusCode(); # 200
        $header = $response->getHeaderLine('content-type'); # 'application/json; charset=utf8'
        $result   = json_decode($response->getBody()->getContents());

        return $result->success;

    }

}
