<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corpus;
use App\Categoria;

class IndexController extends Controller
{
  /**
   * Display the first step for corpus analysis, the selection of languange and corpuses.
   *
   * @return \Illuminate\Http\Response
   */
    public function step1()
    {
        $categorias = Categoria::whereHas('corpuses.texts')
                                    ->orderBy('nome')
                                    ->get();

        return view('index', compact('categorias'));
    }
}
