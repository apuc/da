<?php
/**
 * Created by PhpStorm.
 * User: Офис
 * Date: 14.07.2016
 * Time: 10:14
 */

namespace common\classes;


class DataTime
{
    public static function time($time)
    {
        $month_name =
            array(1 => 'января',
                2 => 'февраля',
                3 => 'марта',
                4 => 'апреля',
                5 => 'мая',
                6 => 'июня',
                7 => 'июля',
                8 => 'августа',
                9 => 'сентября',
                10 => 'октября',
                11 => 'ноября',
                12 => 'декабря'
            );

        $month = $month_name[date('n', $time)];

        $day = date('j', $time);
        $year = date('Y', $time);
        $hour = date('G', $time);
        $min = date('i', $time);

        $date = $day . ' ' . $month . ' ' . $year . ' г. в ' . $hour . ':' . $min;

        $dif = time() - $time;

        if ($dif < 59) {
            return $dif . " сек. назад";
        } elseif ($dif / 60 > 1 and $dif / 60 < 59) {
            return round($dif / 60) . " мин. назад";
        } elseif ($dif / 3600 > 1 and $dif / 3600 < 23) {
            return round($dif / 3600) . " час. назад";
        } else {
            return $date;
        }
    }

    public static function timeNews($time)
    {
        $month_name =
            array(1 => 'января',
                2 => 'февраля',
                3 => 'марта',
                4 => 'апреля',
                5 => 'мая',
                6 => 'июня',
                7 => 'июля',
                8 => 'августа',
                9 => 'сентября',
                10 => 'октября',
                11 => 'ноября',
                12 => 'декабря'
            );

        $month = $month_name[date('n', $time)];

        $day = date('j', $time);
        $year = date('Y', $time);
        $hour = date('G', $time);
        $min = date('i', $time);

        $date = $day . ' ' . $month . ' ' . $year . ', ' . $hour . ':' . $min;

        $dif = time() - $time;

            return $date;

    }

    public static function dateRus($time)
    {
        $month_name =
            array(1 => 'января',
                2 => 'февраля',
                3 => 'марта',
                4 => 'апреля',
                5 => 'мая',
                6 => 'июня',
                7 => 'июля',
                8 => 'августа',
                9 => 'сентября',
                10 => 'октября',
                11 => 'ноября',
                12 => 'декабря'
            );

        $month = $month_name[date('n', $time)];

        $day = date('j', $time);
        $year = date('Y', $time);


        $date = $day . ' ' . $month . ' ' . $year;


        return $date;
    }

    public static function dateOrg($time)
    {
        $month_name =
            array(1 => 'января',
                2 => 'февраля',
                3 => 'марта',
                4 => 'апреля',
                5 => 'мая',
                6 => 'июня',
                7 => 'июля',
                8 => 'августа',
                9 => 'сентября',
                10 => 'октября',
                11 => 'ноября',
                12 => 'декабря'
            );

        $month = $month_name[date('n', $time)];

        $day = date('j', $time);
        $year = date('Y', $time);


        $date =  $month . ' ' . $year;


        return $date;
    }
}