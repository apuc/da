<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 07.11.2017
 * Time: 16:10
 */

namespace console\controllers;


use common\classes\Debug;
use common\models\API\Coin;
use common\models\API\Currency;
use common\models\API\Gas;
use common\models\API\Metal;
use common\models\API\Oil;
use yii\console\Controller;
use yii\helpers\Console;

class ApiController extends Controller
{
    function init()
    {
        parent::init();
    }

    public function actionGetCurrency()
    {
        $currency = new Currency();
        if ($currency->run()) $this->stdout("complete \n", Console::FG_GREEN);
        else            $this->stdout("error \n", Console::FG_RED);

    }

    public function actionGetMetal()
    {
        $metal = new Metal();
        if ($metal->run()) $this->stdout("complete \n", Console::FG_GREEN);
        else            $this->stdout("error \n", Console::FG_RED);
    }

    public function actionGetCoin()
    {
        $coin = new Coin();
        if ($coin->run()) $this->stdout("complete coin \t\n please wait for get rates\n", Console::FG_GREEN);
        else            $this->stdout("error \n", Console::FG_RED);

        if ($coin->runRates()) $this->stdout("complete coin rates \n", Console::FG_GREEN);
        else            $this->stdout("error \n", Console::FG_RED);
    }

    public function actionGetOil()
    {
        $oil = new Oil();
        if ($oil->run()) $this->stdout("complete \n", Console::FG_GREEN);
        else            $this->stdout("error \n", Console::FG_RED);
    }

    public function actionGetGas()
    {
        $gas = new Gas();
        if ($gas->run()) $this->stdout("complete \n", Console::FG_GREEN);
        else            $this->stdout("error \n", Console::FG_RED);
    }
}