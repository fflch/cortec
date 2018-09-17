<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corpora;

class IndexController extends Controller
{
    public function index()
    {
        $corporas = Corpora::all();
        return view('index', compact('corporas'));
    }
}
