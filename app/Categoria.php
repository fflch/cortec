<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\CategoriaChanged;

class Categoria extends Model
{
    public function corpuses()
    {
        return $this->hasMany('App\Corpus');
    }
}
