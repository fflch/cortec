<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    public function corpus()
    {
        return $this->belongsTo('App\Corpus');
    }
}
