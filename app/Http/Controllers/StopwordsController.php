<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StopwordsController extends Controller
{
    public function edit ()
    {
        return view('stopwords.edit');
    }
}
