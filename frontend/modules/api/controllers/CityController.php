<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\City;

class CityController extends \yii\web\Controller
{
    public function init()
    {
        parent::init();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function actionGetCities($region_id = null)
    {
        $model = City::find()->select(['id','name','region_id'])
            ->andFilterWhere(['=', 'region_id', $region_id])
            ->all();
        if(!empty($model))
        {
            return $model;
        }

        return ['Нет данных'];
    }

    public function actionGetCity($id)
    {
        $model = City::find()->where(['=', 'id' , $id])->all();
        if(!empty($model))
        {
            return $model;
        }

        return ['Нет данных.'];
    }
}