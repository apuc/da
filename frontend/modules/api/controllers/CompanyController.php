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

    public function actionGetCompanyCategory()
    {
        $model = CategoryCompany::find()->select(['id','title'])->all();
        if(\Yii::$app->request->get('parent'))
        {
            $model = CategoryCompany::find()->select(['id','title'])
                ->where(['=', 'parent_id', \Yii::$app->request->get('parent')])->all();
        }

        if(!empty($model))
        {
            return $model;
        }

       return 'Нет данных.';

    }
}