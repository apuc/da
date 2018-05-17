<?php

namespace backend\modules\company\controllers;

use backend\modules\key_value\models\KeyValue;
use common\models\db\CategoryShop;
use Yii;
use yii\helpers\ArrayHelper;

class ShopController extends \yii\web\Controller
{
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
        $path = KeyValue::getValue('banner_path');
        if(!$path){
            $path = '';
            KeyValue::setValue('banner_path', $path);
        }
        if ($request->isPost) {
            $path = $request->post()['photo'];
            KeyValue::setValue('banner_path', $path);
        }

        return $this->render('change-banner', [
            'photo' => $path,
            ]);
    }
}
