<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 21.09.2016
 * Time: 15:32
 */

namespace common\classes;

use MongoDB\BSON\Timestamp;

class WordFunctions
{

    public static function crop_str_word($text, $max_words = 50, $sep = ' ')
    {
        $words = explode($sep, $text);

        if (count($words) > $max_words) {
            $text = join($sep, array_slice($words, 0, $max_words));
            $text .= ' ...';
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
                case (1):
                    $ending = $ending_arr[0];
                    break;
                case (2):
                case (3):
                case (4):
                    $ending = $ending_arr[1];
                    break;
                default:
                    $ending = $ending_arr[2];
            }
        }
        return $ending;
    }

    public static function getRuMonth()
    {
        return [
            "01" => "января",
            "02" => "февраля",
            "03" => "марта",
            "04" => "апреля",
            "05" => "мая",
            "06" => "июня",
            "07" => "июля",
            "08" => "августа",
            "09" => "сентября",
            "10" => "октября",
            "11" => "ноября",
            "12" => "декабря",
        ];
    }

    public static function FullEventDate($date)
    {
        return date('d',
                $date) . ' ' .
            \common\classes\WordFunctions::getRuMonth()[date('m', $date)] . ' ' .
            date('Y', $date) . ', в ' .
            date('H:i', $date);
    }

    public static function getRuWeek()
    {
        return [
            1 => 'понедельник',
            2 => 'вторник',
            3 => 'среда',
            4 => 'четверг',
            5 => 'пятница',
            6 => 'суббота',
            7 => 'воскресенье',
        ];
    }

    public static function dateWithMonts($time)
    {
        return date('d',$time) . ' ' . self::getRuMonth()[date('m',$time)];
    }

}