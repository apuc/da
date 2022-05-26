<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24.07.2017
 * Time: 14:19
 */

namespace frontend\modules\personal_area\controllers;

use common\classes\Debug;
use frontend\controllers\MainWebController;
use frontend\modules\personal_area\models\UserPromotionsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;


class UserPromotionsController extends MainWebController
{

    public $layout = 'personal_area';

    function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        $searchModel = new UserPromotionsSearch();
        $dataProvider = $searchModel->search(['user_id' => \Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}