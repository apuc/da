<?php

namespace backend\modules\missing_person\controllers;

use backend\modules\missing_person\models\MissingPerson;
use backend\modules\missing_person\models\MissingPersonSearch;
use Yii;
use yii\filters\VerbFilter;

class MissingPersonController extends \yii\web\Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new MissingPersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete($id)
    {
        MissingPerson::findOne($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCreate()
    {
        $model = new MissingPerson();

        if('POST' == Yii::$app->request->method){
            $data = Yii::$app->request->getBodyParam('MissingPerson');
            $model->setAttribute('fio', $data['fio']);
            $model->setAttribute('date_of_birth', strtotime($data['date_of_birth']));
            $model->setAttribute('city_id', $data['city_id']);
            $model->setAttribute('additional_info', $data['additional_info']);
            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('create',[
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = MissingPerson::findById($id);

        if('POST' == Yii::$app->request->method){
            $data = Yii::$app->request->getBodyParam('MissingPerson');
            $model->setAttribute('fio', $data['fio']);
            $model->setAttribute('date_of_birth', strtotime($data['date_of_birth']));
            $model->setAttribute('city_id', $data['city_id']);
            $model->setAttribute('additional_info', $data['additional_info']);
            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('update',[
                'model' => $model,
            ]);
        }
    }
}