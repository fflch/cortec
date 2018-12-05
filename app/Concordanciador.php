<?php

namespace App;

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

  /**
   * Get Regex Pattern
   *
   * @return void
   */
  private function getPattern()
  {
    switch ($this->position) {
      case 'igual':
        return '/[^A-ZÁ-Úa-zá-ú\/\-_\']('.$this->needle.')[^A-ZÁ-Úa-zá-ú\/\-_\']/';
        break;
      case 'comeco':
        return '/[^A-ZÁ-Úa-zá-ú\/\-_\']('.$this->needle.')[\/\-_\']?[A-ZÁ-Úa-zá-ú]*|^('.$this->needle.')/';
        break;
      case 'final':
        return '/[A-ZÁ-Úa-zá-ú]*[\/\-_\']?[A-ZÁ-Úa-zá-ú]*('.$this->needle.')[^A-ZÁ-Úa-zá-ú\/\-_\']/';
        break;
      case 'contem':
        return '/('.$this->needle.')/';
        break;

      default:
        return '/('.$this->needle.')/';
        break;
    }
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
    preg_match_all($this->getPattern().''.$case, $this->text, $matches, PREG_OFFSET_CAPTURE);
    $ocorrencias = collect($matches[1]);

    $ocorrencias->transform(\Closure::fromCallable([$this, 'highlight']));
    // ($this->contextLength == 160) ? dd($ocorrencias) : null;
    return $ocorrencias;
  }

  private function highlight($item)
  {
    $needlePosition = $item[1];
    $left = max($needlePosition - $this->contextLength, 0);

    //insere bold para o termo
    $txt = $this->text;
    $txt = substr_replace($txt, '{{', $needlePosition, 0);
    $txt = substr_replace($txt, '}}', $needlePosition + $this->needleLength + 2, 0);

    if($this->needleLength + $this->contextLength + $needlePosition > $this->textLength) {
      $txt = substr($txt, $left);
    }else{
      $txt = substr($txt, $left, $this->bufferLength+4);
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
    $this->bufferLength = $this->needleLength + 2 * $this->contextLength;
  }

}
