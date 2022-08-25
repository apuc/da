<?php

namespace frontend\controllers;


use common\models\db\BannedIp;
use yii\filters\AccessControl;
use yii\rest\Controller;

class MainRestController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'rules' => [
                    [
                        'allow' => false,
                        'ips' => BannedIp::getIps()
                    ],
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