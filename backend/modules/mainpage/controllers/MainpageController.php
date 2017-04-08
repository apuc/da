<?php

namespace backend\modules\mainpage\controllers;


use common\models\db\KeyValue;
use yii\web\Controller;

/**
 * Default controller for the `exchange_rates` module
 */
class MainpageController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionPhotos()
    {
        $request = \Yii::$app->request->post();
        if (!empty($request)) {

            $json['title'] = $request['title'];
            $json['description'] = $request['description'];
            $json['photos_images'] = $request['photos_images'];

            $main_photos = KeyValue::findOne(['key' => 'main_photos']);
            $main_photos->value = json_encode($json);
            $main_photos->save();

        }

        return $this->render('photos',
            ['mainPhotos' => json_decode(KeyValue::findOne(['key' => 'main_photos'])->value)]);

    }
}
