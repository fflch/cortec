<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corpora extends Model
{
  public function corpuses()
  {
    return $this->hasMany('App\Corpus');
  }
}
