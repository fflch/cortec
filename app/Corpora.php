<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use TextAnalysis\Tokenizers\RegexTokenizer;
use TextAnalysis\Tokenizers\GeneralTokenizer;
use TextAnalysis\Analysis\FreqDist;

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
    //return Counts::tokens($this->getAllCorpus());
    //$token = new RegexTokenizer;
    //dd($token->tokenize($this->getAllCorpus()));

    $tokenizer = new GeneralTokenizer();
    $tokens = $tokenizer->tokenize($this->getAllCorpus());
    $freqDist = new FreqDist($tokens);
    dd($freqDist);
    //return $freqDist;

    //return $token->tokenize($this->getAllCorpus());
  }

}
