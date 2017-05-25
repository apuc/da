<?php

namespace backend\modules\mainpage\controllers;

use common\classes\Debug;
use common\models\db\KeyValue;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `exchange_rates` module
 */
class MainpageController extends Controller
{
    public function beforeAction($action) {
        if($action->id = 'photos') {
            Yii::$app->request->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
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

    public function _actionWeather()
    {
        $request = \Yii::$app->request;
        if (\Yii::$app->request->isPost) {
            $json['header_img'] = $request->post('header_img');
            $json['header_temp'] = $request->post('header_temp');
            $weather = KeyValue::findOne(['key' => 'weather']);
            $weather->value = json_encode($json);
            $weather->save();

        }

        $weatherItems = [
            'sunny' => 'Солнечно',
            'storm' => 'Гроза',
            'snow' => 'Снег',
            'rain' => 'Дождь',
            'partly_cloudy' => 'Переменная облачность',
            'cloudy' => 'Облачно',
            'breeze' => 'Ветер',
        ];

        return $this->render('weather', [
            'weather' => json_decode(KeyValue::findOne(['key' => 'weather'])->value),
            'weatherItems' => $weatherItems,
        ]);

    }

    public function actionWeather()
    {
        $request = \Yii::$app->request;
        if (\Yii::$app->request->isPost) {

            $json[strtotime('now 00:00:00')]['header_img'] = $request->post('header_img_today');
            $json[strtotime('now 00:00:00')]['header_temp'] = $request->post('header_temp_today');
            $json[strtotime('+1 day 00:00:00')]['header_img'] = $request->post('header_img_tomorrow');
            $json[strtotime('+1 day  00:00:00')]['header_temp'] = $request->post('header_temp_tomorrow');
            $json[strtotime('+2 days 00:00:00')]['header_img'] = $request->post('header_img_after_tomorrow');
            $json[strtotime('+2 days  00:00:00')]['header_temp'] = $request->post('header_temp_after_tomorrow');

            $weather = KeyValue::findOne(['key' => 'weather']);
            $weather->value = json_encode($json);
            $weather->save();


        }

        $weatherItems = [
            'sunny' => 'Солнечно',
            'storm' => 'Гроза',
            'snow' => 'Снег',
            'rain' => 'Дождь',
            'partly_cloudy' => 'Переменная облачность',
            'cloudy' => 'Облачно',
            'breeze' => 'Ветер',
        ];

        return $this->render('weather', [
            'weather' => json_decode(KeyValue::findOne(['key' => 'weather'])->value,true),
            'weatherItems' => $weatherItems,
        ]);

    }

    public function actionSettings()
    {
        $request = \Yii::$app->request;
        if (\Yii::$app->request->isPost) {
            $dayFeedCount = KeyValue::findOne(['key' => 'day_feed_count']);
            $dayFeedCount->value = $request->post('day_feed_count');

            $dayFeedCount->save();
        }

        return $this->render('settings', [
            'dayFeedCount' => KeyValue::findOne([
                'key' => 'day_feed_count',
            ])->value,
        ]);

    }
}
