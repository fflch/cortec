<?php

namespace App;

use App\Cortec\Concordanciador as Aux;

class Concordanciador
{
    private $text;
    private $textLength;
    private $position;
    private $needle;
    private $needleLength;
    private $contextLength;
    private $case;

    public function __construct(String $text, String $position, String $needle, int $contextLength, bool $case)
    {
        $this->text = ' ' . $this->processText($text) . ' ';
        $this->textLength = strlen($this->text);
        $this->position = $position;
        $this->needle = utf8_decode($needle);
        $this->needleLength = strlen($this->needle);
        $this->contextLength = $contextLength;
        $this->case = $case;
    }

    /**
    * Process string for analyze
    *
    * @return String
    */
    public function processText(String $text)
    {
        $text = trim(preg_replace('/\s\s+/', ' ', $text));
        $text = utf8_decode($text);

        return $text;
    }

    /**
    * Find occurences of a neddle and returns with its context
    *
    * @return String
    */
    public function concordance()
    {
        $case = ($this->case) ? '' : 'i';
        preg_match_all(Aux::getStringPattern($this->needle,$this->position).$case, $this->text, $matches, PREG_OFFSET_CAPTURE);
        dd(Aux::getStringPattern($this->needle,$this->position));

        $ocorrencias = collect($matches[1]);
        $ocorrencias->transform(\Closure::fromCallable([$this, 'extractExcerptTerm']));

        return $ocorrencias;
    }

    /**
    * Mark the neddle and get its context
    *
    * @return String
    */
    private function extractExcerptTerm($needle)
    {
        $needlePosition = $needle[1];

        //insere marcação para o termo
        $txt = Aux::markString($this->text, $needlePosition, $this->needleLength, ['{{','}}']);
        //recorta o texto, conta com os caracteres de marcação
        $txt = Aux::getExcerpt($txt, $needlePosition, $this->needleLength+4, $this->contextLength);

        return utf8_encode($txt);
    }

    /**
    * Set the context length
    *
    * @return String
    */
    public function setContextLength(int $size)
    {
        $this->contextLength = $size;
    }

}
