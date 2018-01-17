<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 21.06.2017
 * Time: 15:29
 */

namespace frontend\modules\news\widgets;

use frontend\modules\news\models\NewsSearch;
use yii\base\Widget;


class WhatElseToRead extends Widget
{
    public $useReg;
    public function run()
    {
        $model = new NewsSearch();

        $news = $model->getNews($this->useReg);
        $hotNews = $model->getHotNews($this->useReg);

        $hotNewsIndexes = [1, 5];
        $bigNewsIndexes = [3];
        return $this->render('what-read',
            [
                'news' => $news,
                'hotNews' => $hotNews,
                'hotNewsIndexes' => $hotNewsIndexes,
                'bigNewsIndexes' => $bigNewsIndexes,
            ]);
    }
}