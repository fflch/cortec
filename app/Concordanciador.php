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
    private $bufferLength;

    public function __construct(String $text, String $position, String $needle, int $contextLength, bool $case)
    {
        $this->text = $this->processText($text) . ' ';
        $this->textLength = strlen($this->text);
        $this->position = $position;
        $this->needle = utf8_decode($needle);
        $this->needleLength = strlen($this->needle);
        $this->contextLength = $contextLength;
        $this->case = $case;
        $this->setBufferLength();
    }

    public function processText(String $text)
    {
        $text = trim(preg_replace('/\s\s+/', ' ', $text));
        $text = utf8_decode($text);

        return $text;
    }

    public function concordance()
    {
        $case = ($this->case) ? '' : 'i';
        preg_match_all(Aux::getStringPattern($this->needle,$this->position).''.$case, $this->text, $matches, PREG_OFFSET_CAPTURE);
        $ocorrencias = collect($matches[1]);

        $ocorrencias->transform(\Closure::fromCallable([$this, 'highlight']));

        return $ocorrencias;
    }

    private function highlight($item)
    {
        $needlePosition = $item[1];
        $left = max($needlePosition - $this->contextLength, 0);

        //insere marcação para o termo
        $txt = Aux::markString($this->text, $needlePosition, $this->needleLength, ['{{','}}']);

        if($this->needleLength + $this->contextLength + $needlePosition > $this->textLength) {
            $txt = substr($txt, $left);
        }else{
            $txt = substr($txt, $left, $this->bufferLength);
        }

        return utf8_encode($txt);
    }

    public function setContextLength(int $size)
    {
        $this->contextLength = $size;
        $this->setBufferLength();
    }

    private function setBufferLength()
    {
        //acrescido da marcação
        $this->bufferLength = $this->needleLength + 4 + (2 * $this->contextLength);
    }

}
