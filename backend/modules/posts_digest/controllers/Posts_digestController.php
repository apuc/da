<?php

namespace backend\modules\posts_digest\controllers;

use common\classes\Debug;
use common\models\db\CategoryPostsDigestRelations;
use Yii;
use backend\modules\posts_digest\models\PostsDigest;
use backend\modules\posts_digest\models\PostsDigestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Posts_digestController implements the CRUD actions for PostsDigest model.
 */
class Posts_digestController extends Controller
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
     * Lists all PostsDigest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostsDigestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PostsDigest model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $cats = CategoryPostsDigestRelations::find()->where(['posts_digest_id' => $id])->all();
        $cats_arr = [];
        foreach ($cats as $cat_item) {
            $cats_arr[] = $cat_item->cat_id;
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'cats_arr' => $cats_arr,
        ]);
    }

    /**
     * Creates a new PostsDigest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionCreate()
    {
        $model = new PostsDigest();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            foreach ($_POST['categ'] as $cat) {
                $catNewRel = new CategoryPostsDigestRelations();
                $catNewRel->cat_id = $cat;
                $catNewRel->posts_digest_id = $model->id;
                $catNewRel->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $cats_arr = [];
            return $this->render('create', [
                'model' => $model,
                'cats_arr' => $cats_arr,
            ]);
        }
    }

    /**
     * Updates an existing PostsDigest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $cats = CategoryPostsDigestRelations::find()->where(['posts_digest_id' => $id])->all();
        $cats_arr = [];
        foreach ($cats as $cat_item) {
            $cats_arr[] = $cat_item->cat_id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            CategoryPostsDigestRelations::deleteAll(['posts_digest_id' => $model->id]);
            foreach ($_POST['categ'] as $cat) {
                $catNewRel = new CategoryPostsDigestRelations();
                $catNewRel->cat_id = $cat;
                $catNewRel->posts_digest_id = $model->id;
                $catNewRel->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'cats_arr' => $cats_arr,
            ]);
        }
    }

    /**
     * Deletes an existing PostsDigest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PostsDigest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return PostsDigest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PostsDigest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
