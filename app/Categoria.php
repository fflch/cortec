<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
  public function corporas()
  {
    return $this->hasMany('App\Corpora');
  }
}
