<?php

namespace App;

use TextAnalysis\Tokenizers\RegexTokenizer;

class Utils
{
    private $text = array();
    private $analysis = array(
        'frequency-tokens' => null,
        'count-tokens'=> null,
        'count-once-tokens'=> null,
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

    /**
    * Sets analysis for a specified text.
    *
    * @return void
    */
    private function setAnalysis()
    {
        $this->analysis['frequency-tokens'] = freq_dist($this->tokens)->getKeyValuesByFrequency();
        $this->analysis['count-tokens'] = freq_dist($this->tokens)->getTotalTokens();
        $this->analysis['count-once-tokens'] = $this->getCountedOnce();
        $this->analysis['count-types'] = freq_dist($this->tokens)->getTotalUniqueTokens();
        $ratio = $this->analysis['count-types'] / $this->analysis['count-tokens'];
        $this->analysis['ratio'] = ($ratio > 0) ? round($ratio, 2) : null;
        //$this->analysis['ngrams'] = array_count_values(freq_dist($all_corpus)->getAllCorpusTokens());
    }

    /**
    * Returns the count pf tokens which appers only once.
    *
    * @return int
    */

    public function getCountedOnce()
    {
        $f_tokens = collect($this->analysis['frequency-tokens']);

        //Unique
        $countMore = $f_tokens->reduce(function ($carry, $item) {
            return ($item == 1) ? ($carry+1) : ($carry);
        });

        return $countMore;
    }

    /**
    * Return an Array of analysis of a specified text.
    *
    * @return array
    */
    public function getAnalysis()
    {
        return $this->analysis;
    }
}
