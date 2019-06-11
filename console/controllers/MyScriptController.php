<?php


namespace console\controllers;


use yii\console\Controller;
use yii\helpers\Console;

class MyScript extends Controller
{

    public function actionIndex()
    {
        $this->stdout("complete \n", Console::FG_GREEN);
    }

}