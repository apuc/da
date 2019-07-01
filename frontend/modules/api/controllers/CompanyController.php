<?php

namespace frontend\modules\api\controllers;

use common\classes\Debug;
use frontend\models\sitemap\CategoryCompany;

class CompanyController extends \yii\web\Controller
{
    public function init()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function actionGetCompanyCategories()
    {
        $model = CategoryCompany::find()->select(['id','title']);
        if(\Yii::$app->request->get('parent'))
        {
                $model->where(['=', 'parent_id', \Yii::$app->request->get('parent')]);
        }
        $model = $model->all();
        if(!empty($model))
        {
            return $model;
        }

       return ['Нет данных.'];
    }

    public function actionGetCompanyCategory()
    {
        if(\Yii::$app->request->get('id'))
        {
            $model = CategoryCompany::find()->where(['=', 'id' , \Yii::$app->request->get('id')])->all();

        }
        if(!empty($model))
        {
            return $model;
        }

        return ['Нет данных.'];
    }
}