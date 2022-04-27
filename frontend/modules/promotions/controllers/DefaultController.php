<?php

namespace frontend\modules\promotions\controllers;

use common\classes\Debug;
use frontend\modules\promotions\models\Stock;
use yii\web\Controller;

/**
 * Default controller for the `PromotionsModule` module
 */
class DefaultController extends Controller
{
    function init()
    {
        parent::init();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $user_id = \Yii::$app->user->id;
        $promotions = Stock::find()->where(['user_id' => $user_id])->all();


        return $this->render('index', ['promotions' => $promotions]);
    }
}
