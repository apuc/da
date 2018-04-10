<?php

namespace backend\modules\tw\controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use common\classes\Debug;
use common\models\db\TwPosts;
use Yii;
use backend\modules\tw\models\TwPages;
use backend\modules\tw\models\TwPagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TwPagesController implements the CRUD actions for TwPages model.
 */
class TwPagesController extends Controller
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
     * Lists all TwPages models.
     * @return mixed
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionIndex()
    {
        $searchModel = new TwPagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TwPages model.
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
     * Creates a new TwPages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionCreate()
    {
        $model = new TwPages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TwPages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws \yii\base\InvalidArgumentException
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TwPages model.
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
     * Finds the TwPages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TwPages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TwPages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetInfo($id)
    {
        $model = \common\models\db\TwPages::findOne($id);
        $connection = new TwitterOAuth(
            'wvFJ8e9H2srypMXDcVkUB1Ebm',
            'rR21MJkF0PlmcZvnaIWrqsq2oNLpEOc2AEfOD71w4UNrMBpGkK',
            '818440355309846528-xrlDwxr1JxWrLYBFVpXuw3XPTGUiQq6',
            'GPbrt8v6nz2MJFAA0nCyuZVEdOTEAfOyFacev8r6fHuH3');

        //return $this->render('index');
        $data = $connection->get("statuses/user_timeline",
            array('count' => 1, 'exclude_replies' => true, 'screen_name' => $model->screen_name));
        $model->title = $data[0]->user->name;
        $model->tw_id = (string)$data[0]->user->id;
        $model->icon = $data[0]->user->profile_image_url_https;
        $model->save();
        Yii::$app->session->setFlash('success', 'Данные получены');
        return $this->redirect('index');
    }

    public function actionParse($id)
    {
        $model = \common\models\db\TwPages::findOne($id);
        $connection = new TwitterOAuth(
            'wvFJ8e9H2srypMXDcVkUB1Ebm',
            'rR21MJkF0PlmcZvnaIWrqsq2oNLpEOc2AEfOD71w4UNrMBpGkK',
            '818440355309846528-xrlDwxr1JxWrLYBFVpXuw3XPTGUiQq6',
            'GPbrt8v6nz2MJFAA0nCyuZVEdOTEAfOyFacev8r6fHuH3');
        $data = $connection->get("statuses/user_timeline",
            array('count' => 200, 'exclude_replies' => true, 'screen_name' => $model->screen_name));

        if($data){
            foreach ((array)$data as $tw_post){
                if(!TwPosts::find()->where(['tw_id' => $tw_post->id_str])->one()){
                    $post = new TwPosts();
                    $post->tw_id = $tw_post->id_str;
                    $post->content = $tw_post->text;
                    if(!empty($tw_post->entities->media[0])){
                        $post->media_url = $tw_post->entities->media[0]->media_url_https;
                    }
                    if(!empty($tw_post->entities->urls[0])){
                        $post->link = $tw_post->entities->urls[0]->url;
                    }
                    $post->page_id = $id;
                    $post->page_title = $tw_post->user->name;
                    $post->page_icon = $tw_post->user->profile_image_url_https;
                    $post->dt_add = time();
                    $post->save();
                }
            }
        }
        Yii::$app->session->setFlash('success', 'Данные получены');
        return $this->redirect('index');
    }
}
