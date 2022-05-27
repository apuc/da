<?php

namespace backend\modules\banned_ip\controllers;

use backend\modules\banned_ip\models\BannedIp;
use backend\modules\banned_ip\models\BannedIpSearch;
use Yii;
use yii\filters\VerbFilter;


class BannedIpController extends \yii\web\Controller
{
    function init()
    {
        parent::init();
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET'],
                    'create' => ['GET', 'POST'],
                    'update' => ['GET', 'POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new BannedIpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new BannedIp();

        if ('POST' == Yii::$app->request->method) {
            $ip_mask = Yii::$app->request->getBodyParam('BannedIp')['ip_mask']
                ?? Yii::$app->request->getQueryParam('ip_mask');

            if(!BannedIp::find()->where(['ip_mask' => $ip_mask])->exists()){
                $model->setAttribute('ip_mask', $ip_mask);
                $model->save();
            }

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = BannedIp::findById($id);

        if ('POST' == Yii::$app->request->method) {
            $model->setAttribute('ip_mask', Yii::$app->request->getBodyParam('BannedIp')['ip_mask']);
            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        BannedIp::findOne($id)->delete();

        return $this->redirect(['index']);
    }
}