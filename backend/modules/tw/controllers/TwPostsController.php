<?php

namespace backend\modules\tw\controllers;

use common\classes\Debug;
use Yii;
use backend\modules\tw\models\TwPosts;
use backend\modules\tw\models\TwPostsSearch;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TwPostsController implements the CRUD actions for TwPosts model.
 */
class TwPostsController extends Controller
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
     * Lists all TwPosts models.
     * @return mixed
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionIndex()
    {
        $searchModel = new TwPostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //Debug::dd(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDeletePage()
    {
        $searchModel = new TwPostsSearch();

        if(isset(Yii::$app->request->queryParams[1])){
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams[1]);
        }
        else{
            $dataProvider = new ActiveDataProvider([
                'query' => TwPosts::find()->orderBy('tw_id DESC')
            ]);
        }
        if(isset(Yii::$app->request->queryParams[1]['page']))
            $dataProvider->setPagination(new Pagination(['page' => Yii::$app->request->queryParams[1]['page'] - 1]));
        Debug::dd($dataProvider->getModels());
        foreach($dataProvider->getModels() as $model){
            TwPosts::deleteAll(['id' => $model->id]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Displays a single TwPosts model.
     * @param integer $id
     * @return mixed
     * @throws \yii\base\InvalidArgumentException
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TwPosts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionCreate()
    {
        $model = new TwPosts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TwPosts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws \yii\base\InvalidArgumentException
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->status === 1) {
                $model->dt_publish = time();
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TwPosts model.
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
     * Finds the TwPosts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TwPosts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TwPosts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }



    public function actionToPublic($id)
    {
        $model = \common\models\db\TwPosts::findOne($id);
        $model->status = 2;
        $model->save();
        Yii::$app->session->setFlash('success', 'Пост добавлен в раздел "На публикацию"');
        return $this->redirect('index');
    }
}
