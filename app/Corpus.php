<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corpus extends Model
{
  /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
   protected $casts = [
       'created_at' => 'date:Y-m-d',
   ];

  public function corpora()
  {
    return $this->belongsTo('App\Corpora');
  }
}
