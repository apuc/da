<?php

namespace frontend\modules\personal_area\controllers;

use common\models\db\News;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `personal_area` module
 */
class DefaultController extends Controller
{

    public $layout = 'personal_area';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $userNews = News::find()->where(['user_id' => Yii::$app->user->id])->limit(4)->all();

        return $this->render('index',
            [
                'userNews' => $userNews
            ]);
    }
}
