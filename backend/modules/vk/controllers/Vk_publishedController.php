<?php

namespace backend\modules\vk\controllers;

use common\classes\Debug;
use Yii;
use backend\modules\vk\models\VkStream;
use backend\modules\vk\models\VkStreamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Vk_publishedController implements the CRUD actions for VkStream model.
 */
class Vk_publishedController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all VkStream models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VkStreamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['status' => 1, ['<', 'dt_publish', time()]], 'dt_publish');

        return $this->render('../vk_stream/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VkStream model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new VkStream model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VkStream();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing VkStream model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = VkStream::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $request = Yii::$app->request->post();
            if(!empty($request['VkStream']['dt_publish'])){
                $model->dt_publish = strtotime($request['VkStream']['dt_publish'].' '.$request['dt_publish_time']);
            }else
                $model->dt_publish = time();

            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('../vk_publish/update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDeffered()
    {
        $searchModel = new VkStreamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['status' => 4 ], 'dt_publish');

        return $this->render('../vk_stream/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing VkStream model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VkStream model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VkStream the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VkStream::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
