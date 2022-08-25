<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 03.07.2017
 * Time: 15:51
 */

namespace frontend\modules\personal_area\controllers;

use common\classes\Debug;
use frontend\controllers\MainWebController;
use frontend\modules\personal_area\models\UserCompanySearch;
use yii\base\Controller;
use yii\filters\AccessControl;

class UserCompanyController extends MainWebController
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
        $searchModel = new UserCompanySearch();
        $dataProvider = $searchModel->search(['user_id' => \Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}