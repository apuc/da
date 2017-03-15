<?php

namespace frontend\widgets;

use common\classes\Debug;
use common\models\db\News;
use yii\base\Widget;
use yii\db\Expression;

class MainPopularSlider extends Widget
{

    public function run()
    {

        return $this->render('main_popular_slider', [
            'newsSlider1' => News::find()->orderBy('views DESC')->limit(4)->orderBy(new Expression('rand()'))->all(),
            'newsSlider2' => News::find()->orderBy('views DESC')->limit(4)->orderBy(new Expression('rand()'))->all(),
            'newsSlider3' => News::find()->orderBy('views DESC')->limit(4)->orderBy(new Expression('rand()'))->all(),
            'newsSlider4' => News::find()->orderBy('views DESC')->limit(4)->orderBy(new Expression('rand()'))->all(),
        ]);
    }


}