<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corpus;
use App\Models\Categoria;
use App\Models\Text;
use App\Models\Aviso;

class IndexController extends Controller
{
    public function index()
    {
        $aviso = Aviso::all()->first(); // what a hell?
        $categorias = Categoria::whereHas('corpuses.texts')->orderBy('nome')->get();
        return view('index', compact('categorias', 'aviso'));
    }
}
