<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 22.11.2017
 * Time: 14:55
 */

namespace console\controllers;


use Yii;
use yii\console\Controller;

class ClearController extends Controller
{
    public function actionIndex()
    {
        $migrations = [
            'm171121_133850_drop_currency_exchange_coin_coin_rates_metal_metal_rates_tables',
            'm171115_101923_create_metal_rates_table',
            'm171115_093939_create_metal_table',
            'm171110_122612_update_exchange_table',
            'm171110_113311_create_coin_rates_table',
            'm171109_161542_create_coin_table',
            'm171107_141207_create_exchange_table',
            'm171107_132458_create_currency_table',
        ];
        foreach ($migrations as $migration) {
            $sql = "DELETE FROM `migration` WHERE `migration`.`version` = '" . $migration . "'";
            Yii::$app->getDb()->createCommand($sql)->execute();
        }
        echo "success";
    }
}