<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 21.09.2016
 * Time: 15:32
 */

namespace common\classes;


class WordFunctions
{

    public static function crop_str_word($text, $max_words = 50, $sep = ' ')
    {
        $words = split($sep, $text);

        if ( count($words) > $max_words )
        {
            $text = join($sep, array_slice($words, 0, $max_words));
            $text .=' ...';
        }

        return $text;
    }

}