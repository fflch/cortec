<?php

namespace App\Cortec;

class Concordanciador
{
  /**
   * Get Regex Pattern
   *
   * @return void
   */
  public static function getStringPattern($part, $position)
  {
    $word_part = "A-ZÁ-Úa-zá-ú\/\-_\'";

    switch ($position) {
      case 'igual':
        return "/[^$word_part](" . $part. ")[^$word_part]/";
        break;
      case 'comeco':
        return '/[^A-ZÁ-Úa-zá-ú\/\-_\']('.$part.')[\/\-_\']?[A-ZÁ-Úa-zá-ú]*|^('.$part.')/';
        break;
      case 'final':
        return '/[A-ZÁ-Úa-zá-ú]*[\/\-_\']?[A-ZÁ-Úa-zá-ú]*('.$part.')[^A-ZÁ-Úa-zá-ú\/\-_\']/';
        break;
      case 'contem':
        return '/('.$part.')/';
        break;

      default:
        return '/('.$part.')/';
        break;
    }
  }

}
