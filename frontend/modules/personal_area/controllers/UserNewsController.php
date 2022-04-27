<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 03.07.2017
 * Time: 16:34
 */

namespace frontend\modules\personal_area\controllers;

use frontend\modules\personal_area\models\UserNewsSearch;
use yii\base\Controller;
use yii\filters\AccessControl;

class UserNewsController extends Controller
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
        $searchModel = new UserNewsSearch();
        $dataProvider = $searchModel->search(['user_id' => \Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}