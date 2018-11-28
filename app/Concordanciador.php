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
    $this->text = $text;
    $this->textLength = strlen($text);
    $this->position = $position;
    $this->needle = $needle;
    $this->needleLength = strlen($needle);
    $this->contextLength = $contextLength;
    $this->case = $case;
    $this->bufferLength = $this->needleLength + 2 * $this->contextLength;
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
        return '/[^A-ZÁ-Ú\/\-_\']('.$this->needle.')[^A-ZÁ-Ú\/\-_\']/';
        break;
      case 'comeco':
        return '/([^A-ZÁ-Ú\/\-_\']('.$this->needle.')[\/\-_\']?[A-ZÁ-Ú]*)|^('.$this->needle.')/';
        break;
      case 'final':
        return '/[A-ZÁ-Ú]*[\/\-_\']?[A-ZÁ-Ú]*('.$this->needle.')[^A-ZÁ-Ú\/\-_\']/';
        break;
      case 'contem':
        return '/('.$this->needle.')/';
        break;

      default:
        return '/('.$this->needle.')/';
        break;
    }
  }

  public function concordance()
  {
    $case = ($this->case) ? 'i' : null;

    preg_match_all($this->getPattern().'u'.$case, $this->text, $matches, PREG_OFFSET_CAPTURE);
    $ocorrencias = collect($matches[1]);

    $ocorrencias->transform(\Closure::fromCallable([$this, 'highlight']));

    return $ocorrencias;
  }

  private function highlight($item)
  {
    $needlePosition = $item[1];
    $left = max($needlePosition - $this->contextLength - 4, 0);
    $txt = substr_replace($this->text, '<b>', $needlePosition, 0);
    $txt = substr_replace($txt, '</b>', $needlePosition + $this->needleLength + 3, 0);

    if($this->needleLength + $this->contextLength + $needlePosition > $this->textLength) {
      $txt = substr($txt, $left);
    }else{
      $txt = substr($txt, $left, $this->bufferLength+3);
    }
    return $txt;
  }

}
