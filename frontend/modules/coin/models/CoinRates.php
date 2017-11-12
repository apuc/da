<?php

namespace frontend\modules\coin\models;

use common\classes\Debug;
use common\models\db\Coin;
use Yii;


class CoinRates extends \common\models\db\CoinRates
{
    public static function getActiveCoin()
    {
        //выбираем все активные валюты
        $active = Coin::find()->select('name')->where(['status' => 1])->asArray()->all();

        //преобразуем массив
        $items = array_map(function ($ite) {
            return $items[] = $ite['name'];
        }, $active);

        //находим значение курсов
        $activeCoin = self::findAll(['coin_name' => $items, 'date' => date('Y-m-d', time())]);
        return $activeCoin;
    }
}
