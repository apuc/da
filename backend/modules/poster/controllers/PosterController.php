<?php

namespace backend\modules\poster\controllers;

use backend\modules\category\Category;
use common\classes\Debug;
use common\models\db\CategoryPosterRelations;
use common\models\db\KeyValue;
use Yii;
use backend\modules\poster\models\Poster;
use backend\modules\poster\models\PosterSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PosterController implements the CRUD actions for Poster model.
 */
class PosterController extends Controller
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
     * Lists all Poster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PosterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Poster model.
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
     * Creates a new Poster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Poster();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->dt_event = strtotime($model->dt_event);
            $model->dt_event_end = strtotime($model->dt_event_end);
            $model->save();

            foreach ($_POST['cat'] as $cat) {
                $catNewRel = new CategoryPosterRelations();
                $catNewRel->cat_id = $cat;
                $catNewRel->poster_id = $model->id;
                $catNewRel->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categoriesSelected' => [],
            ]);
        }
    }

    /**
     * Updates an existing Poster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->dt_event = strtotime($model->dt_event);
            $model->dt_event_end = strtotime($model->dt_event_end);

            CategoryPosterRelations::deleteAll(['poster_id' => $id]);

            foreach ($_POST['cat'] as $cat) {
                $catNewRel = new CategoryPosterRelations();
                $catNewRel->cat_id = $cat;
                $catNewRel->poster_id = $model->id;
                $catNewRel->save();
            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categoriesSelected' => ArrayHelper::getColumn(
                    CategoryPosterRelations::findAll(['poster_id' => $id]),
                    'cat_id'),
            ]);
        }
    }

    /**
     * Deletes an existing Poster model.
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
     * Finds the Poster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Poster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Poster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMainPremiere()
    {
        $request = Yii::$app->request->post();
        if (isset($request['poster_images'][0])) {
            $json['main_posters'] = $request['poster_images'][0];
            $json['description'] = $request['description'];
            $main_poster = KeyValue::findOne(['key' => 'main_posters']);
            $main_poster->value = json_encode($json);
            $main_poster->save();

        }
        $key_val = KeyValue::find()->where(['key' => 'main_posters'])->one();
        $main_posters = json_decode($key_val->value);

        return $this->render('main_poster', [
            'key_val' => ArrayHelper::map($key_val, 'key', 'value'),
            'main_posters' => $main_posters,
        ]);
    }
}
