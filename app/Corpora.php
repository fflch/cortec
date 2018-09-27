<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corpora extends Model
{
  public function corpuses()
  {
    return $this->hasMany('App\Corpus');
  }

  public function getAllCorpus()
  {
    $t_corpus = '';
    foreach ($this->corpuses as $corpus)
    {
      $t_corpus .= $corpus->conteudo;
    }

    return $t_corpus;
  }
}
