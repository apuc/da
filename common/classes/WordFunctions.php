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
        $words = explode($sep, $text);

        if ( count($words) > $max_words )
        {
            $text = join($sep, array_slice($words, 0, $max_words));
            $text .=' ...';
        }

        return $text;
    }

    public static function getNumEnding($number, $ending_arr)
    {
        $number = $number % 100;
        if ($number >= 11 && $number <= 19) {
            $ending = $ending_arr[2];
        } else {
            $i = $number % 10;
            switch ($i) {
                case (1): $ending = $ending_arr[0];
                    break;
                case (2):
                case (3):
                case (4): $ending = $ending_arr[1];
                    break;
                default: $ending = $ending_arr[2];
            }
        }
        return $ending;
    }

}