<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TextAnalysis\Tokenizers\RegexTokenizer;
use App\Utils;
use App\Observers\CorpusObserver;

class Corpus extends Model
{
    protected $table = 'corpuses';

    protected $all_texts  = array('pt' => '', 'en' => '');
    protected $analysis = array('pt' => array(), 'en' => array());
    protected $idiomas  = array();

    protected static function boot()
    {
        parent::boot();
        static::observe(CorpusObserver::class);
    }

    public function texts()
    {
        return $this->hasMany('App\Text');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    /**
    * Set the texts for the corpus.
    *
    * @param  String  $corpus
    * @param  String  $lang
    * @return String
    */
    public function setAllTexts(String $text, String $lang)
    {
        $this->all_texts[$lang] = $text;
    }

    /**
    * Set and return the compilation of texts of a corpus.
    *
    * @param  String  $lang
    * @return String
    */
    public function getAllTexts(String $lang = "pt")
    {
        //verifica se o atributo já não foi setado e carrega os textos caso não e os seta
        if(empty($this->all_texts[$lang])) {
            $texts = $this->texts->filter(function ($value, $key) use ($lang) {
                return $value->idioma == $lang;
            });

            if(!empty($texts)) {
                foreach ($texts as $text) {
                    $this->all_texts[$lang] .= $text->conteudo;
                }
            }
        }

        return $this->all_texts[$lang];
    }

    /**
    * Set and return a specific analysis of a corpus of a specific language.
    *
    * @param  String  $type
    * @param  String  $lang
    * @return float|array|null
    */
    public function getAnalysis(String $type, String $lang = 'pt')
    {
        $all_texts = $this->getAllTexts($lang);

        if(empty($all_texts)) {
            return null;
        }

        if(empty($this->analysis[$lang])) {
            $analysis = new Utils($all_texts);
            $this->analysis[$lang] = $analysis->getAnalysis();
        }

        return $this->analysis[$lang][$type];
    }

    /**
    * Verifies if the specified corpus has text of a certain language.
    *
    * @param  String  $lang
    * @return boolean
    */
    public function hasTextLang($lang = 'pt')
    {
        return $this->texts->contains(function ($text, $key) use ($lang) {
            return $text->idioma == $lang;
        });
    }

    /**
    * Returns an array of languages of a specified corpus by its texts.
    *
    * @param  String  $lang
    * @return array
    */
    public function getLanguages()
    {
        if(empty($this->idiomas)) {
            $unique = $this->texts->unique(function ($text) {
                return $text->idioma;
            });
            $this->idiomas = $unique->values()->pluck('idioma');
        }

        return $this->idiomas;
    }

}
