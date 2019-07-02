<?php

namespace frontend\modules\api\controllers;

use frontend\models\sitemap\CategoryCompany;

class CompanyController extends \yii\web\Controller
{
    public function init()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function actionGetCompanyCategories($parent = null)
    {
        $model = CategoryCompany::find()->select(['id','title'])
        ->andFilterWhere(['=', 'parent_id', $parent])
        ->all();
        if(!empty($model))
        {
            return $model;
        }

       return ['Нет данных.'];
    }

    public function actionGetCompanyCategory($id)
    {
        $model = CategoryCompany::find()->where(['=', 'id' , \Yii::$app->request->get('id')])->all();
        if(!empty($model))
        {
            return $model;
        }

        return ['Нет данных.'];
    }
}