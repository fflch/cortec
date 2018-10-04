<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TextAnalysis\Tokenizers\GeneralTokenizer;
use TextAnalysis\Tokenizers\PennTreeBankTokenizer;

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

  public function getTokensFrequency()
  {
    $tokenizer = new PennTreeBankTokenizer();
    return freq_dist(tokenize($this->getAllCorpus()))->getKeyValuesByFrequency();
  }

  public function getTokensCount()
  {
    $tokenizer = new GeneralTokenizer();
    return freq_dist(tokenize($this->getAllCorpus()))->getTotalTokens();
  }

  public function getTypesCount()
  {
    $tokenizer = new GeneralTokenizer();
    return freq_dist(tokenize($this->getAllCorpus()))->getTotalUniqueTokens();
  }

}
