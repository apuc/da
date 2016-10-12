<?php

namespace backend\modules\news\controllers;

use backend\modules\key_value\models\KeyValue;
use backend\modules\news\News;
use yii\web\Controller;

/**
 * Default controller for the `news` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCron_news(){
        $news = \common\models\db\News::find()->where(['status'=>3])->all();
        foreach($news as $new){
            if($new->dt_public < time()){
                $new->status = 0;
                $new->save();
            }
        }
    }
}
