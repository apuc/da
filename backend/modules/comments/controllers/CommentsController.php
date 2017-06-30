<?php

namespace backend\modules\comments\controllers;

use common\classes\Debug;
use common\models\db\News;
use dektrium\user\models\User;
use Yii;
use backend\modules\comments\models\Comments;
use backend\modules\comments\models\CommentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentsController implements the CRUD actions for Comments model.
 */
class CommentsController extends Controller
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
                    'multi-delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionMultiDelete()
    {
        Debug::prn(Yii::$app->request->post());
        /*if($keyList = Yii::$app->request->post('keyList'))
        {
            $arrKey = explode(',', $keyList);
            //var_dump($arrKey); // Получен массив со значениями
        }
        return false;*/
    }

    public function actionMultiModerChecked()
    {
        if ($keyList = Yii::$app->request->post('keyList')) {
            $arrKey = explode(',', $keyList);
            Comments::updateAll(['moder_checked' => 1], ['id' => $arrKey]);
        }
        return $this->redirect('index');
    }

    public function actionMultiPublished()
    {
        if ($keyList = Yii::$app->request->post('keyList')) {
            $arrKey = explode(',', $keyList);
            Comments::updateAll(['published' => 1], ['id' => $arrKey]);
        }
        return $this->redirect('index');
    }


    /**
     * Lists all Comments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comments model.
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
     * Creates a new Comments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Comments model.
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

            $news = News::find()->all();
            $user = User::find()->all();
            return $this->render('update', [
                'model' => $model,
                'news' => $news,
                'user' => $user,
            ]);
        }
    }

    public function actionUpdateModerChecked($id)
    {
        $model = $this->findModel($id);
        if ($model->moder_checked == 0) {
            $model->moder_checked = 1;
        } else {
            $model->moder_checked = 0;
        }
        $model->save();
        return $this->redirect('index');
    }

    public function actionUpdatePublished($id)
    {
        $model = $this->findModel($id);
        if ($model->published == 0) {
            $model->published = 1;
        } else {
            $model->published = 0;
        }
        $model->save();
        return $this->redirect('index');
    }

    /**
     * Deletes an existing Comments model.
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
     * Finds the Comments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
