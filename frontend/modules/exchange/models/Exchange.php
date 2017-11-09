<?php

namespace frontend\modules\exchange\models;

use common\classes\Debug;
use common\models\db\Currency;
use Yii;


class Exchange extends \common\models\db\Exchange
{
    /**
     * @return mixed
     */
    public static function getActiveCurrency()
    {
        //выбираем все активные валюты
        $active = Currency::find()->select('num_code')->where(['status' => 1])->asArray()->all();

        //преобразуем массив
        $items = array_map(function ($ite) {
            return $items[] = $ite['num_code'];
        }, $active);

        //находим значение курсов
        $activeExchange['activeExchange'] = self::findAll(['num_code' => $items, 'date' => self::getEndThisDay()]);
        $activeExchange['date'] = self::getEndThisDay();
        return $activeExchange;
    }

    /**
     * @param $charCode
     * @return float|null|static
     */
    public static function getCurrencyValue($charCode)
    {
        //находим значение курса
        $value = self::findOne(['char_code' => $charCode, 'date' => self::getEndThisDay()]);
        if ($value) {
            $value = $value->value;
        }
        return $value;
    }

    /**
     * @return array|mixed|null|\yii\db\ActiveRecord
     */
    private static function getEndThisDay()
    {
        //берем дату последней записи
        $endThisDay = mktime(23, 59, 59);
        $date = self::find()->where(['<', 'date', $endThisDay])->orderBy(['date' => SORT_DESC])->one();
        if ($date) {
            $date = $date->date;
        }
        return $date;
    }
}
