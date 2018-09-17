<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 27.07.2017
 * Time: 10:48
 */

namespace frontend\widgets;

use common\models\db\News;
use yii\base\Widget;

class NewsPageError extends Widget
{
    public function run()
    {
        $news = News::find()->where(['show_error' => 1, 'status' => 0])->limit(4)->orderBy('RAND()')->all();
        return $this->render('news-page-error', ['news' => $news]);
    }
}