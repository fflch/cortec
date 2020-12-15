<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stopword extends Model
{
    use HasFactory;
    
    static public function getStoplist(string $lang = 'pt') : string
    {
        $stopwords = Stopword::where('idioma', '=', $lang)->get();

        return $stopwords->implode('palavra', "\r\n");
    }
}
