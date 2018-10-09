<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corpora;
use App\Categoria;

class IndexController extends Controller
{
    public function index()
    {
      $categorias = Categoria::all();
      return view('index', compact('categorias'));
    }
}
