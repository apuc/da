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
        $params = \Yii::$app->params;

        return $this->render('main_popular_slider', [
            'newsSlider1' => News::find()
                ->where(['>', 'dt_public', time() - (2592000 * $params['countMonth'])])
                ->andWhere(['exclude_popular' => 0])
                ->andWhere(['>', 'views', $params['countView']])
                ->orderBy('views DESC')
                ->limit(4)
                ->orderBy(new Expression('rand()'))
                ->with('category')
                ->all(),
            'newsSlider2' => News::find()
                ->where(['>', 'dt_public', time() - (2592000 * $params['countMonth'])])
                ->andWhere(['exclude_popular' => 0])
                ->andWhere(['>', 'views', $params['countView']])
                ->orderBy('views DESC')
                ->limit(4)
                ->orderBy(new Expression('rand()'))
                ->with('category')
                ->all(),
            'newsSlider3' => News::find()
                ->where(['>', 'dt_public', time() - (2592000 * $params['countMonth'])])
                ->andWhere(['exclude_popular' => 0])
                ->andWhere(['>', 'views', $params['countView']])
                ->orderBy('views DESC')
                ->limit(4)
                ->orderBy(new Expression('rand()'))
                ->with('category')
                ->all(),
            'newsSlider4' => News::find()
                ->where(['>', 'dt_public', time() - (2592000 * $params['countMonth'])])
                ->andWhere(['exclude_popular' => 0])
                ->andWhere(['>', 'views', $params['countView']])
                ->orderBy('views DESC')
                ->limit(4)
                ->orderBy(new Expression('rand()'))
                ->with('category')
                ->all(),
        ]);
    }

}