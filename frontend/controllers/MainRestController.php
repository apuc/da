<?php

namespace frontend\controllers;


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
//                    [
//                        'allow' => false,
//                        'ips' => [
//                            '127.0.0.2',
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