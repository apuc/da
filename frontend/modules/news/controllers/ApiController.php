<?php

namespace frontend\modules\news\controllers;

use frontend\modules\news\models\News;
use yii\web\Controller;

class ApiController extends Controller
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function actionIndex()
    {
        $news = News::find();
    }
}