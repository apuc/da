<?php

namespace frontend\widgets;

use common\classes\Debug;
use common\classes\UserFunction;
use common\models\db\News;
use yii\base\Widget;
use yii\db\Expression;

class MainPopularSlider extends Widget
{
    public $useReg;
    public function run()
    {
        $params = \Yii::$app->params;


        $query = News::find()
            ->distinct()
            ->from('news FORCE INDEX(`views`)')
            ->where(['>', 'dt_public', time() - (2592000 * $params['countMonth'])])
            ->andWhere(['exclude_popular' => 0])
            ->andWhere(['>', 'views', $params['countView']]);
        if($this->useReg != -1){
            $query->andWhere("(`region_id` IS NULL OR `region_id`=$this->useReg)");
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