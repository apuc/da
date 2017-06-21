<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 21.06.2017
 * Time: 15:29
 */

namespace frontend\modules\news\widgets;

use yii\base\Widget;
use common\models\db\News;
use common\models\db\Lang;

class WhatElseToRead extends Widget
{
    public function run()
    {
        $news = News::find()
            ->where([
                'status' => 0,
                'lang_id' => Lang::getCurrent()['id'],
                'hot_new' => 0,
            ])
            ->limit(6)
            ->orderBy('dt_public DESC')
            ->with('category')
            ->all();

        $hotNews = News::find()
            ->where([
                'status' => 0,
                'lang_id' => Lang::getCurrent()['id'],
                'hot_new' => 1,
            ])
            ->limit(2)
            ->orderBy('dt_public DESC')
            ->with('category')
            ->all();

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