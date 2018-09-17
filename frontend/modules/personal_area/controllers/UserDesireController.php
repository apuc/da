<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 03.03.2018
 * Time: 19:23
 */

namespace frontend\modules\personal_area\controllers;

use frontend\modules\personal_area\models\UserDesireSearch;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserDesireController extends Controller
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
        $searchModel = new UserDesireSearch();
        $dataProvider = $searchModel->search(['user_id' => \Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}