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

  public function countTokens()
  {
    //inserir remover acentos

    $palavras = preg_replace('/(\\[a-z])/i', '', $this->getAllCorpus());

    preg_match_all('/([A-Z|-])+/i', $this->getAllCorpus(), $matches);

    $palavras_count = array_count_values($matches[0]);

    return $palavras_count;
  }

}
