<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stopword;

class StopwordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit(string $idioma)
    {
        $stopwords = Stopword::getStoplist($idioma);

        return view('stopwords.edit', compact('idioma', 'stopwords'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'idioma' => 'required|string',
            'conteudo' => 'required|string'
        ]);

        $idioma = $request->idioma;

        $stopwords = explode("\r\n", $request->conteudo);
        $stopwords = array_filter($stopwords);

        //delete all stopwords of the language
        Stopword::where('idioma', '=', $idioma)->delete();

        $stoplist = array();
        foreach ($stopwords as $stopword) {
            $stopword_model['idioma'] = $idioma;
            $stopword_model['palavra'] = $stopword;
            $stoplist[] = $stopword_model;
        }
        Stopword::insert($stoplist);

        return back();
    }
}
