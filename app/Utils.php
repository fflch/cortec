<?php

namespace App;

use TextAnalysis\Tokenizers\RegexTokenizer;

class Utils
{
  private $text = array();
  private $analysis = array(
    'frequency-tokens' => null,
    'count-tokens'=> null,
    'count-types'=> null,
    'ratio'=> null,
    'ngrams'=> null
    );
  private $tokenizer;
  private $tokens;

  public function __construct(String $text)
  {
    $this->text = $text;
    $this->tokenizer = new RegexTokenizer('/([A-ZÁ-Ú]+[\\/\-_\']?[A-ZÁ-Ú]+)+|[A-ZÁ-Ú]+/iu');
    $this->tokens = normalize_tokens($this->tokenizer->tokenize($this->text));
    $this->setAnalysis();
  }

  private function setAnalysis()
  {
    $this->analysis['frequency-tokens'] = freq_dist($this->tokens)->getKeyValuesByFrequency();
    $this->analysis['count-tokens'] = freq_dist($this->tokens)->getTotalTokens();
    $this->analysis['count-types'] = freq_dist($this->tokens)->getTotalUniqueTokens();
    $ratio = $this->analysis['count-types'] / $this->analysis['count-tokens'];
    $this->analysis['ratio'] = ($ratio > 0) ? round($ratio, 2) : null;
    //$this->analysis['ngrams'] = array_count_values(freq_dist($all_corpus)->getAllCorpusTokens());
  }

  public function getAnalysis()
  {
    return $this->analysis;
  }
}
