<?php

namespace frontend\modules\api\controllers;

use Classes\Wrapper\IUrls;
use Classes\Wrapper\Wrapper;
use common\classes\Debug;

class SimaController extends \yii\rest\Controller
{
    public $enableCsrfValidation = false;

    public static function allowedDomains() {
        return [
            '*',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors'  => [
                // restrict access to domains:
                'Origin'                           => static::allowedDomains(),
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Origin' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
            ],
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCategory()
    {
        $data = array(
            'level'=>'1');

        $res = Wrapper::runFor(IUrls::Category)
            ->query($data)->getJson();

        //$res = json_encode($res);

        return $res;
    }

}
