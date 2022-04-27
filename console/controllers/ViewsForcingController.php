<?php

namespace console\controllers;


use backend\modules\news\News;
use yii\console\Controller;

class ViewsForcingController extends Controller
{
    const NEWS_IDS = [1,2,3];

    function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        print_r('FORCE');
    }

    public function actionForce()
    {
        foreach (self::NEWS_IDS as $id){
            $news = News::findOne($id);
            $news->views = $news->views + rand(2,5);
            $news->save();
        }
    }
}