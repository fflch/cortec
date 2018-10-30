<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corpora;
use App\Categoria;

class IndexController extends Controller
{
    public function step1()
    {
      $categorias = Categoria::whereHas('corporas.corpuses')->get();

      return view('index', compact('categorias'));
    }
}
