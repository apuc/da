<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.09.2016
 * Time: 11:41
 */

namespace common\classes;


class DateFunctions
{

    static function getMonthName($m){
        switch ($m) {
            case '01':
                return "января";
            case '02':
                return "февраля";
            case '03':
                return "марта";
            case '04':
                return "апреля";
            case '05':
                return "мая";
            case '06':
                return "июня";
            case '07':
                return "июля";
            case '08':
                return "августа";
            case '09':
                return "сентября";
            case '10':
                return "октября";
            case '11':
                return "ноября";
            case '12':
                return "декабря";
        }
    }

    static function getMonthShortName($m){
        switch ($m) {
            case '01':
                return "янв";
            case '02':
                return "фев";
            case '03':
                return "мар";
            case '04':
                return "апр";
            case '05':
                return "мая";
            case '06':
                return "июн";
            case '07':
                return "июл";
            case '08':
                return "авг";
            case '09':
                return "сен";
            case '10':
                return "окт";
            case '11':
                return "ноя";
            case '12':
                return "дек";
        }
    }

}