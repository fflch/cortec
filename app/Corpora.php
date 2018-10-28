<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TextAnalysis\Tokenizers\RegexTokenizer;

class Corpora extends Model
{

  protected $all_corpus= array('pt' => '', 'en' => '');
  protected $analysis = array('pt' => array(), 'en' => array());

  public function corpuses()
  {
    return $this->hasMany('App\Corpus');
  }

  public function categoria()
  {
    return $this->belongsTo('App\Categoria');
  }

  /**
   * Set and return the compilation of corpus of a corpora
   *
   * @param  String  $lang
   * @return String
   */
  public function getAllCorpus(String $lang = "pt")
  {
    //verifica se o atributo já não foi setado e carrega os corpus caso não e o seta
    if(empty($this->all_corpus[$lang]))
    {
      $corpuses = $this->corpuses->filter(function ($value, $key) use ($lang){
          return $value->idioma == $lang;
      });

      if(!empty($corpuses))
      {
        foreach ($corpuses as $corpus)
        {
          $this->all_corpus[$lang] .= $corpus->conteudo;
        }
      }
    }

    return $this->all_corpus[$lang];
  }

  /**
   * Set and return a specific analysis of a corpora of a specific language
   *
   * @param  String  $type
   * @param  String  $lang
   * @return float|array|null
   */
  public function getAnalysis(String $type, String $lang = 'pt')
  {
    $all_corpus = $this->getAllCorpus($lang);
    $tokens = (!empty($all_corpus)) ? (new RegexTokenizer('/([A-ZÁ-Ú]+[\S]?[A-ZÁ-Ú]+)+|[A-ZÁ-Ú]+/i'))->tokenize($all_corpus) : null;
    if(empty($tokens)){
      return null;
    }

    //normalize
    $tokens = normalize_tokens($tokens);

    switch ($type) {
      case 'frequency-tokens':
        $this->analysis[$lang]['tokens'] = (!isset($this->analysis[$lang]['tokens'])) ? freq_dist($tokens)->getKeyValuesByFrequency() : $this->analysis[$lang]['tokens'];
        return $this->analysis[$lang]['tokens'];
        break;

      case 'count-tokens':
        $this->analysis[$lang]['count-tokens'] = (!isset($this->analysis[$lang]['count-tokens'])) ? freq_dist($tokens)->getTotalTokens() : $this->analysis[$lang]['count-tokens'];
        return $this->analysis[$lang]['count-tokens'];
        break;

      case 'count-types':
        $this->analysis[$lang]['count-types'] = (!isset($this->analysis[$lang]['count-types'])) ? freq_dist($tokens)->getTotalUniqueTokens() : $this->analysis[$lang]['count-types'];
        return $this->analysis[$lang]['count-types'];
        break;

      case 'ratio':
        $this->analysis[$lang]['ratio'] = (!isset($this->analysis[$lang]['ratio'])) ? ($this->getAnalysis('count-types', $lang)/$this->getAnalysis('count-tokens', $lang)) : $this->analysis[$lang]['ratio'];
        return $this->analysis[$lang]['ratio'];
        break;

      case 'ngrams':
        $this->analysis[$lang]['ngrams'] = (!isset($this->analysis[$lang]['ngrams'])) ? array_count_values(freq_dist($all_corpus)->getAllCorpusTokens()) : $this->analysis[$lang]['ngrams'];
        return $this->analysis[$lang]['ngrams'];
        break;

      default:
        return null;
        break;
    }
  }

}
