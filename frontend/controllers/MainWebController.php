<?php

/**
 * Контроллер сознан как родительский для остальных.
 * Этот контроллер использует фильтр по IP.
 */

namespace frontend\controllers;

use common\models\db\BannedIp;
use yii\filters\AccessControl;

class MainWebController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'rules' => [
//                    [
//                        'allow' => false,
//                        'ips' => [
//                            BannedIP::find()->all()
//                        ],
//                    ],
                    [
                        'allow' => true,
                        'ips' => [
                            '*',
                        ],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    \Yii::$app->response->statusCode = 403;
                    \Yii::$app->response->content = 'Access denied!';
                }
            ],
        ];
    }
}