<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    public function corpora()
    {
        return $this->belongsTo('App\Corpus');
    }
}
