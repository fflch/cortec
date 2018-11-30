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
    $this->text = $text . ' ';
    $this->textLength = strlen($this->text);
    $this->position = $position;
    $this->needle = $needle;
    $this->needleLength = strlen($this->needle);
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

  public function concordance()
  {
    $case = ($this->case) ? '' : 'i';
    preg_match_all($this->getPattern().'u'.$case, $this->text, $matches, PREG_OFFSET_CAPTURE);
    $ocorrencias = collect($matches[1]);

    $ocorrencias->transform(\Closure::fromCallable([$this, 'highlight']));
    return $ocorrencias;
  }

  private function highlight($item)
  {
    $needlePosition = $item[1];
    $left = max($needlePosition - $this->contextLength, 0);

    //insere bold para o termo
    $txt = substr_replace($this->text, '<b>', $needlePosition, 0);
    $txt = substr_replace($txt, '</b>', $needlePosition + $this->needleLength + 3, 0);

    //Verifica se o primeiro caractere é válido (encode)
    $first_char = $this->text[$left];
    $left = (mb_check_encoding($first_char)) ? $left : $left-1;

    if($this->needleLength + $this->contextLength + $needlePosition > $this->textLength) {
      $txt = substr($txt, $left);
    }else{
      //Verifica se o último caractere é válido (encode)
      $last_char = $txt[$left+$this->bufferLength+6];
      $right_count = (mb_check_encoding($last_char)) ? $this->bufferLength+7 : $this->bufferLength+8;

      $txt = substr($txt, $left, $right_count);
    }
    return $txt;
  }

}
