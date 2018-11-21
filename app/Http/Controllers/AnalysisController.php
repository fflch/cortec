<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corpora;
use App\Utils;

class AnalysisController extends Controller
{
  /**
   * Verifies the entry and display the second step for corpora analysis, the selection of tool.
   *
   * @return \Illuminate\Http\Response
   */
  public function step2(Request $request)
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

    return view('analysis.step2', compact('language'));
  }

  /**
   * Redirect to the selected tool.
   *
   * @return \Illuminate\Http\Response
   */
  public function step3(Request $request)
  {
    $tool = $request->tool;

    switch ($tool) {
      case 'concordanciador':
        // code...
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

  /**
   * Process the analysis and display it.
   *
   * @return \Illuminate\Http\Response
   */
  public function listaPalavras(Request $request)
  {
    $corpora_ids = collect($request->session()->get('form_analysis.corporas_ids'));
    $language = $request->session()->get('form_analysis.language');

    //gather all corpus in one string
    $all_corpus = $corpora_ids->reduce(function ($carry, $id) use ($language) {
        $corpora_corpus = Corpora::find($id)->getAllCorpus($language);
        return $carry . ' ' . $corpora_corpus;
    });

    $utils = new Utils($all_corpus);
    $analysis = $utils->getAnalysis();

    $request->session()->put('form_analysis.frequency_tokens', $analysis['frequency-tokens']);

    return view('analysis.lista_palavras', compact('analysis'));
  }

  public function downloadTable(Request $request)
  {

    $freq_array = $request->session()->get('form_analysis.frequency_tokens');
    $csv_temp = fopen('php://temp', 'rw');

    # write out the data
    foreach ($freq_array as $key => $value) {
      $line = array($key,$value);
      fputcsv($csv_temp, $line);
    }

    rewind($csv_temp);
    $csv = stream_get_contents($csv_temp);
    fclose($csv_temp);

    return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-disposition', 'attachment; filename = frequencia.csv');
  }

}
