<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 07.09.2016
 * Time: 16:19
 */

namespace frontend\modules\mainpage\widgets;


use backend\modules\category\models\CategoryNews;
use common\classes\Debug;
use common\models\db\Lang;
use yii\base\Widget;

class News extends Widget
{

    public function run()
    {
        return $this->render('news', [
            'cat' => CategoryNews::find()->where(['lang_id'=>Lang::getCurrent()['id']])->all(),
            'news' => \common\models\db\News::find()
                ->where(['lang_id'=>Lang::getCurrent()['id'], 'status'=>0])
                ->orderBy('id DESC')
                ->limit(10)
                ->all(),
        ]);
    }

}