<?php

namespace backend\modules\company\controllers;

use backend\modules\key_value\models\KeyValue;
use common\models\db\CategoryShop;
use Yii;
use yii\helpers\ArrayHelper;

class ShopController extends \yii\web\Controller
{
    function init()
    {
        parent::init();
    }

    public function actionCategories()
    {
        $request = Yii::$app->request;
        $youLike = KeyValue::getValue('you_like');
        if(!$youLike){
            KeyValue::setValue('you_like', null);
        }
        if ($request->isPost) {
            $json = json_encode($request->post()['you_like']);
            KeyValue::setValue('you_like', $json);
            $youLike = $json;
        }
        return $this->render('index', [
            'catList' => ArrayHelper::map(CategoryShop::find()->all(), 'id', 'name'),
            'cats' => json_decode($youLike),
        ]);
    }
    public function actionChangeBanner()
    {
        $request = Yii::$app->request;
        $banner_path = KeyValue::getValue('banner_path');
        $banner_url = KeyValue::getValue('banner_url');
        if(!$banner_path){
            $banner_path = '';
            KeyValue::setValue('banner_path', $banner_path);
        }
        if(!$banner_url){
            $banner_url = '#';
            KeyValue::setValue('banner_url', $banner_url);
        }
        if ($request->isPost) {
            $banner_path = $request->post()['photo'];
            KeyValue::setValue('banner_path', $banner_path);
            $banner_url = $request->post()['banner_url'];
            KeyValue::setValue('banner_url', $banner_url);
        }

        return $this->render('change-banner', [
            'photo' => $banner_path,
            'banner_url' => $banner_url,
            ]);
    }
}
