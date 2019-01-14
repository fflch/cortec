<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function corpuses()
    {
        return $this->hasMany('App\Corpus');
    }
}
