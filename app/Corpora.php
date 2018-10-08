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

  private function getAllCorpusTokens(){
    return (new RegexTokenizer('/([A-ZÁ-Ú]+[\S]?[A-ZÁ-Ú]+)+|[A-ZÁ-Ú]+/i'))->tokenize($this->getAllCorpus());
  }

  public function getTokensFrequency()
  {
    return freq_dist($this->getAllCorpusTokens())->getKeyValuesByFrequency();
  }

  public function getTokensCount()
  {
    return freq_dist($this->getAllCorpusTokens())->getTotalTokens();
  }

  public function getTypesCount()
  {
    return freq_dist($this->getAllCorpusTokens())->getTotalUniqueTokens();
  }

  public function ngrams(){
    return array_count_values(ngrams($this->getAllCorpusTokens()));
  }

}
