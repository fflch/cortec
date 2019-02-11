<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corpus;
use App\Categoria;
use App\Text;

use App\Utils;
use TextAnalysis\NGrams\NGramFactory;
use TextAnalysis\NGrams\Statistic;
use TextAnalysis\Tokenizers\RegexTokenizer;

class IndexController extends Controller
{
  /**
   * Display the first step for corpus analysis, the selection of languange and corpuses.
   *
   * @return \Illuminate\Http\Response
   */
    public function step1()
    {
        $text = Text::find(1)->conteudo;
        $analysis = new Utils($text);
        $bigrams = NGramFactory::create($analysis->getTokens(), 2);
        $statistic = new Statistic($bigrams);
        $stats = $statistic->calculate('rightFisher');
        arsort($stats);
        dd($stats);

        $categorias = Categoria::whereHas('corpuses.texts')->get();

        return view('index', compact('categorias'));
    }
}
