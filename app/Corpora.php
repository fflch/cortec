<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TextAnalysis\Tokenizers\RegexTokenizer;
use App\Utils;

class Corpora extends Model
{

    protected $all_corpus= array('pt' => '', 'en' => '');
    protected $analysis = array('pt' => array(), 'en' => array());
    protected $idiomas = array();

    public function corpuses()
    {
        return $this->hasMany('App\Corpus');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    /**
    * Set the corpus for the corpora by text.
    *
    * @param  String  $corpus
    * @param  String  $lang
    * @return String
    */
    public function setAllCorpus(String $corpus, String $lang)
    {
        $this->all_corpus[$lang] = $corpus;
    }

    /**
    * Set and return the compilation of corpus of a corpora by the registered corpus.
    *
    * @param  String  $lang
    * @return String
    */
    public function getAllCorpus(String $lang = "pt")
    {
        //verifica se o atributo já não foi setado e carrega os corpus caso não e o seta
        if(empty($this->all_corpus[$lang])) {
            $corpuses = $this->corpuses->filter(function ($value, $key) use ($lang) {
                return $value->idioma == $lang;
            });

            if(!empty($corpuses)) {
                foreach ($corpuses as $corpus) {
                    $this->all_corpus[$lang] .= $corpus->conteudo;
                }
            }
        }

        return $this->all_corpus[$lang];
    }

    /**
    * Set and return a specific analysis of a corpora of a specific language.
    *
    * @param  String  $type
    * @param  String  $lang
    * @return float|array|null
    */
    public function getAnalysis(String $type, String $lang = 'pt')
    {
        $all_corpus = $this->getAllCorpus($lang);

        if(empty($all_corpus)) {
            return null;
        }

        if(empty($this->analysis[$lang])) {
            $analysis = new Utils($all_corpus);
            $this->analysis[$lang] = $analysis->getAnalysis();
        }

        return $this->analysis[$lang][$type];
    }

    /**
    * Verifies if the specified corpora has corpus of a certain language.
    *
    * @param  String  $lang
    * @return boolean
    */
    public function hasCorpusLang($lang = 'pt')
    {
        return $this->corpuses->contains(function ($corpus, $key) use ($lang) {
            return $corpus->idioma == $lang;
        });
    }

    /**
    * Returns an array of languages of a specified corpora by its corpus.
    *
    * @param  String  $lang
    * @return array
    */
    public function getLanguages()
    {
        if(empty($this->idiomas)) {
            $unique = $this->corpuses->unique(function ($corpus) {
                return $corpus->idioma;
            });
            $this->idiomas = $unique->values()->pluck('idioma');
        }

        return $this->idiomas;
    }

}
