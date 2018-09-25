<?php

namespace backend\modules\instagram\controllers;

use Yii;
use \common\models\db\InstPhoto;
use backend\modules\instagram\models\InstPhotosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * PhotoController implements the CRUD actions for InstPhoto model.
 */
class PhotoController extends Controller
{

    /**
     * {@inheritdoc}
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
     * Lists all InstPhoto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InstPhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionPublished($id = null)
    {

        if($id!=null)
        {
            $model = InstPhoto::find()->where("id=".$id)->one();
            $model->status = 2;
            $model->save();

            Yii::$app->session->setFlash('success', 'Фото опубликованно!');
            return $this->redirect("/secure/instagram/photo/publish");
        }

        $searchModel = new InstPhotosSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => InstPhoto::find()->where("status=2"),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionPublish($id = null)
    {

        if($id!=null)
        {
          $model = InstPhoto::find()->where("id=".$id)->one();
          $model->status = 1;
          $model->save();

            Yii::$app->session->setFlash('success', 'Фото добавленно в раздел "На публикацию"');
          return $this->redirect(['index']);
        }

        $searchModel = new InstPhotosSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => InstPhoto::find()->where("status=1"),
        ]);

        return $this->render('onpublish', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    /**
     * Displays a single InstPhoto model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new InstPhoto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InstPhoto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InstPhoto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InstPhoto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InstPhoto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InstPhoto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InstPhoto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
