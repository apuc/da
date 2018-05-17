<?php

namespace backend\modules\company\controllers;

use backend\modules\key_value\models\KeyValue;
use common\models\db\CategoryShop;
use Yii;
use yii\helpers\ArrayHelper;

class ShopController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $youLike = KeyValue::findOne(['key' => 'you_like']);
        if ($request->isPost) {
            $json = json_encode($request->post()['you_like']);
            $youLike = KeyValue::setValue('you_like', $json);
            $youLike->save();
        }
        return $this->render('index', [
            'catList' => ArrayHelper::map(CategoryShop::find()->all(), 'id', 'name'),
            'cats' => json_decode($youLike->value),
        ]);
    }
}
