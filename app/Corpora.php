<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TextAnalysis\Tokenizers\RegexTokenizer;

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
      $t_corpus .= $corpus->conteudo . ' ';
    }

    return $t_corpus;
  }

  private function tokenizer(){
    return new RegexTokenizer('/([a-zà-ú]+[\S]?[a-zà-ú]+)+|[a-zà-ú]+/');
  }

  public function getTokensFrequency()
  {
    return freq_dist($this->tokenizer()->tokenize($this->getAllCorpus()))->getKeyValuesByFrequency();
  }

  public function getTokensCount()
  {
    return freq_dist($this->tokenizer()->tokenize($this->getAllCorpus()))->getTotalTokens();
  }

  public function getTypesCount()
  {
    return freq_dist($this->tokenizer()->tokenize($this->getAllCorpus()))->getTotalUniqueTokens();
  }

}
