<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 01.09.17
 * Time: 14:18
 */

namespace frontend\modules\personal_area\controllers;

use yii\base\Controller;
use yii\filters\AccessControl;

class UserAdsController extends Controller
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

        return $this->render('index');
    }
}