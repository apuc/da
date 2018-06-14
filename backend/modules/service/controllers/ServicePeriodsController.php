<?php

namespace backend\modules\service\controllers;

use common\classes\Debug;
use common\models\db\Products;
use Yii;
use common\models\db\ServicePeriods;
use backend\modules\service\models\ServicePeriodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServicePeriodsController implements the CRUD actions for ServicePeriods model.
 */
class ServicePeriodsController extends Controller
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
     * Lists all ServicePeriods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicePeriodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServicePeriods model.
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
     * Creates a new ServicePeriods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServicePeriods();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->week_days = json_encode($model->week_days);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $services = Products::find()->where(['type' => Products::TYPE_SERVICE])->all();

        return $this->render('create', [
            'model' => $model,
            'services' => $services
        ]);
    }

    /**
     * Updates an existing ServicePeriods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->week_days = json_encode($model->week_days);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $model->week_days = json_decode($model->week_days);
        $services = Products::find()->where(['type' => Products::TYPE_SERVICE])->all();

        return $this->render('update', [
            'model' => $model,
            'services' => $services
        ]);
    }

    /**
     * Deletes an existing ServicePeriods model.
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
     * Finds the ServicePeriods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServicePeriods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServicePeriods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
