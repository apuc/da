<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 21.02.18
 * Time: 9:10
 */

namespace frontend\modules\personal_area\controllers;

use frontend\modules\personal_area\models\UserProductsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserProductsController extends Controller
{
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
        $searchModel = new UserProductsSearch();
        $dataProvider = $searchModel->search(['user_id' => \Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}