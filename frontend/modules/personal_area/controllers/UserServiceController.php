<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 21.02.18
 * Time: 9:10
 */

namespace frontend\modules\personal_area\controllers;

use frontend\modules\personal_area\models\UserProductsSearch;
use frontend\modules\personal_area\models\UserServiceSearch;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserServiceController extends Controller
{
    function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public $layout = 'personal_area';

    public function actionIndex()
    {
        $searchModel = new UserServiceSearch();
        $dataProvider = $searchModel->search(['user_id' => \Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}