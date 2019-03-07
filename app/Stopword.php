<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stopword extends Model
{
    static public function getStoplist(string $lang = 'pt') : string
    {
        $stopwords = Stopword::where('idioma', '=', $lang)->get();

        return $stopwords->implode('palavra', "\r\n");
    }
}
