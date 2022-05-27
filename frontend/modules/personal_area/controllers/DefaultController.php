<?php

namespace frontend\modules\personal_area\controllers;

use common\classes\Debug;
use common\models\db\Company;
use common\models\db\News;
use frontend\controllers\MainWebController;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `personal_area` module
 */
class DefaultController extends MainWebController
{
    function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    public $layout = 'personal_area';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $userNews = News::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->orderBy('dt_update DESC')
            ->limit(4)->all();
        $userCompany = Company::find()
            ->where(['user_id' => Yii::$app->user->id, 'status' => [1, 0]])
            ->limit(3)
            ->orderBy('dt_update DESC')
            ->with('tariff')
            ->all();

        return $this->render('index',
            [
                'userNews' => $userNews,
                'userCompany' => $userCompany,
            ]
        );
    }
}
