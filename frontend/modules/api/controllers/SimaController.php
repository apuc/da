<?php

namespace frontend\modules\api\controllers;

use Classes\Wrapper\IUrls;
use Classes\Wrapper\Wrapper;
use common\classes\Debug;

class SimaController extends \yii\rest\Controller
{
    public $enableCsrfValidation = false;

    function init()
    {
        parent::init();
    }


    public static function allowedDomains()
    {
        return [
            '*',
        ];
    }

//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//
//        // add CORS filter
//        $behaviors['corsFilter'] = [
//            'class' => \yii\filters\Cors::className(),
//            'cors' => [
//                // restrict access to domains:
//                'Origin' => static::allowedDomains(),
//                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
//                'Access-Control-Request-Headers' => ['*'],
//                'Access-Control-Allow-Origin' => ['*'],
//                'Access-Control-Allow-Credentials' => true,
//                'Access-Control-Max-Age' => 3600,                 // Cache (seconds)
//            ],
//        ];
//
//        return $behaviors;
//    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCategory()
    {
        header("Access-Control-Allow-Origin: *");
        $cache = \Yii::$app->cache;
        $items = $cache->get('sima-category');

        if(!$items){
            $items = [];

            $res = Wrapper::runFor(IUrls::Category)
                ->query(['level' => '1'])->getItemFromJson();

            //$res = json_encode($res);

            foreach ((array)$res as $re) {
                $subCat = Wrapper::runFor(IUrls::Category)
                    ->query(['level' => '2', 'path' => $re->path])->getItemFromJson();
                $items[] = [
                    'id' => $re->id,
                    'photo' => $re->photo,
                    'icon' => $re->icon,
                    'name' => $re->name,
                    'full_slug' => $re->full_slug,
                    'subCat' => $subCat,
                ];
            }
            $cache->set('sima-category', $items, 60 * 60 * 24);
        }

        return json_encode($items);
    }

}
