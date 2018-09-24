<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corpus extends Model
{
  public function corpora()
  {
    return $this->belongsTo('App\Corpora');
  }
}
