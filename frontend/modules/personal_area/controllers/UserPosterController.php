<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 20.07.2017
 * Time: 12:36
 */

namespace frontend\modules\personal_area\controllers;

use frontend\controllers\MainWebController;
use frontend\modules\personal_area\models\UserPosterSearch;
use yii\base\Controller;
use yii\filters\AccessControl;

class UserPosterController extends MainWebController
{
    function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return array_merge([
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ],
            parent::behaviors()
        );
    }

    public $layout = 'personal_area';


    public function actionIndex()
    {
        $searchModel = new UserPosterSearch();
        $dataProvider = $searchModel->search(['user_id' => \Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}