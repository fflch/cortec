<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TextAnalysis\Tokenizers\RegexTokenizer;

class Corpora extends Model
{

  protected $all_corpus = '';
  protected $analysis = array();

  public function corpuses()
  {
    return $this->hasMany('App\Corpus');
  }

  public function categoria()
  {
    return $this->belongsTo('App\Categoria');
  }

  public function getAllCorpus()
  {
    if(empty($this->all_corpus) && !empty($this->corpuses))
    {
      foreach ($this->corpuses as $corpus)
      {
        $this->all_corpus .= $corpus->conteudo . ' ';
      }
    }

    return $this->all_corpus;
  }

  public function getAnalysis(String $type)
  {
    $all_corpus = $this->getAllCorpus();

    $tokens = (!empty($all_corpus)) ? (new RegexTokenizer('/([A-ZÁ-Ú]+[\S]?[A-ZÁ-Ú]+)+|[A-ZÁ-Ú]+/i'))->tokenize($all_corpus) : null;
    if(empty($tokens)){
      $this->analysis = array();
      return null;
    }

    switch ($type) {
      case 'frequency-tokens':
        $this->analysis['tokens'] = (!isset($this->analysis['tokens'])) ? freq_dist($tokens)->getKeyValuesByFrequency() : $this->analysis['tokens'];
        return $this->analysis['tokens'];
        break;

      case 'count-tokens':
        $this->analysis['count-tokens'] = (!isset($this->analysis['count-tokens'])) ? freq_dist($tokens)->getTotalTokens() : $this->analysis['count-tokens'];
        return $this->analysis['count-tokens'];
        break;

      case 'count-types':
        $this->analysis['count-types'] = (!isset($this->analysis['count-types'])) ? freq_dist($tokens)->getTotalUniqueTokens() : $this->analysis['count-types'];
        return $this->analysis['count-types'];
        break;

      case 'ratio':
        $this->analysis['ratio'] = (!isset($this->analysis['ratio'])) ? ($this->getAnalysis('count-types')/$this->getAnalysis('count-tokens')) : $this->analysis['ratio'];
        return $this->analysis['ratio'];
        break;

      case 'ngrams':
        $this->analysis['ngrams'] = (!isset($this->analysis['ngrams'])) ? array_count_values(freq_dist($all_corpus)->getAllCorpusTokens()) : $this->analysis['ngrams'];
        return $this->analysis['ngrams'];
        break;

      default:
        return null;
        break;
    }
  }

}
