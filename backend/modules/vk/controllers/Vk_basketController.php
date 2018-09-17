<?php

namespace backend\modules\vk\controllers;

use backend\modules\vk\models\VkComments;
use common\classes\Debug;
use common\models\db\VkGif;
use common\models\db\VkPhoto;
use Yii;
use backend\modules\vk\models\VkStream;
use backend\modules\vk\models\VkStreamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Vk_basketController implements the CRUD actions for VkStream model.
 */
class Vk_basketController extends Controller
{
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['status' => 3], 'dt_add');

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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing VkStream model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $id = Yii::$app->request->post('id');

        if ($this->findModel($id)->delete())
        {
            VkComments::deleteAll(['post_id' => $id]);
            VkPhoto::deleteAll(['post_id' => $id]);
            VkGif::deleteAll(['post_id' => $id]);
            return true;
        }
        else return false;
        //return $this->redirect(['index']);
    }

    public function actionDeleteAll()
    {
        $ids = VkStream::find()->select('id')->where(['status' => 3])->asArray()->all();

            VkComments::deleteAll(['post_id' => $ids]);
            VkPhoto::deleteAll(['post_id' => $ids]);
            VkGif::deleteAll(['post_id' => $ids]);


        VkStream::deleteAll(['status' => 3]);
        $this->redirect('index');
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
