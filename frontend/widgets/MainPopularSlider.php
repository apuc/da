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
        $cookies = \Yii::$app->request->cookies;
        $useReg = $cookies->getValue('regionId');

        $query = News::find()
            ->distinct()
            ->from('news FORCE INDEX(`views`)')
            ->where(['>', 'dt_public', time() - (2592000 * $params['countMonth'])])
            ->andWhere(['exclude_popular' => 0])
            ->andWhere(['>', 'views', $params['countView']]);
        if($useReg != -1){
            $query->andWhere(['region_id' => NULL]);
            $query->orWhere(['region_id' => $useReg]);

        }
        $news = $query->orderBy('views DESC')
            ->limit(16)
            ->orderBy(new Expression('rand()'))
            ->with('category')
            ->all();

        //Debug::prn($query);

        return $this->render('main_popular_slider', [
            'news' => $news,
        ]);
    }

}