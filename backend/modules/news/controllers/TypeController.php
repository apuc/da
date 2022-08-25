<?php

namespace backend\modules\news\controllers;

use backend\modules\news\models\NewsType;
use backend\modules\news\models\NewsTypeSearch;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\Response;

class TypeController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new NewsTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new NewsType();

        if ('POST' == Yii::$app->request->method) {
            $data = Yii::$app->request->getBodyParam('NewsType');
            $model->setAttribute('label', $data['label']);
            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return string|Response
     */
    public function actionUpdate($id)
    {
        $model = NewsType::findById($id);

        if ('POST' == Yii::$app->request->method) {
            $data = Yii::$app->request->getBodyParam('NewsType');
            $model->setAttribute('label', $data['label']);
            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return Response
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        NewsType::findById($id)->delete();

        return $this->redirect(['index']);
    }
}