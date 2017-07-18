<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 04.07.2017
 * Time: 13:30
 */

namespace frontend\modules\personal_area\controllers;

use frontend\modules\personal_area\models\UserCommentsSearch;
use yii\base\Controller;
use yii\filters\AccessControl;

class UserCommentsController extends Controller
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
        $searchModel = new UserCommentsSearch();
        $dataProvider = $searchModel->search(['user_id' => \Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}