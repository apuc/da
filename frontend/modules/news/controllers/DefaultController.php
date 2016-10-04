<?php

namespace frontend\modules\news\controllers;

use common\classes\Debug;
use common\models\db\Lang;
use common\models\db\News;
use yii\web\Controller;

/**
 * Default controller for the `news` module
 */
class DefaultController extends Controller
{
    public $layout = 'portal_page';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'news' => News::find()->where(['lang_id'=>Lang::getCurrent()['id']])->all(),
        ]);
    }

    public function actionView(){
        $new = News::find()->where(['slug'=>$_GET['slug']])->one();
        $new->updateAllCounters(['views'=>1], ['id'=>$new->id]);
        return $this->render('view', [
             'news' => $new
        ]);
    }

    public function actionSet_dt_public(){
        $news = News::find()->where(['dt_public' => null])->all();

        foreach($news as $new){
            News::updateAll(['dt_public'=>$new->dt_add], ['id'=>$new->id]);
        }
    }
}
