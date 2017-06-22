<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 22.06.2017
 * Time: 14:40
 */

namespace frontend\modules\news\widgets;

use yii\base\Widget;

class ReadTheSame extends Widget
{
    public $news;
    public $template = 'right';

    public function run()
    {
        return $this->render('random-news-by-category/' . $this->template, [
            'news' => $this->news,
        ]);
    }
}