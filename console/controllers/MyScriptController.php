<?php


namespace console\controllers;


use yii\console\Controller;
use yii\helpers\Console;

class MyScript extends Controller
{

    function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        $this->stdout("complete \n", Console::FG_GREEN);
    }

}