<?php

namespace backend\modules\tariff\controllers;

use backend\modules\services\models\Services;
use common\classes\Debug;
use common\models\db\TariffServicesRelations;
use Yii;
use backend\modules\tariff\models\Tariff;
use backend\modules\tariff\models\TariffSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TariffController implements the CRUD actions for Tariff model.
 */
class TariffController extends Controller
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
     * Lists all Tariff models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TariffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tariff model.
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
     * Creates a new Tariff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tariff();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $services = Services::find()->all();

            return $this->render('create', [
                'model' => $model,
                'services' => $services,
                'select_arr' => [],
            ]);
        }
    }

    /**
     * Updates an existing Tariff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

       // Debug::prn($_POST);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if(!empty(Yii::$app->request->post('services_id'))){
                \common\models\db\TariffServicesRelations::deleteAll(['tariff_id' => $id]);
                foreach (Yii::$app->request->post('services_id') as $item) {
                    $tsr = new TariffServicesRelations();
                    $tsr->tariff_id = $model->id;
                    $tsr->services_id = $item;
                    $tsr->save();
                }
            }


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $services = Services::find()->all();
            $select_arr = TariffServicesRelations::find()->where(['tariff_id' => $id])->all();
            $sel_rez = [];
            foreach ($select_arr as $item){
                $sel_rez[] = $item->services_id;
            }

            return $this->render('update', [
                'model' => $model,
                'services' => $services,
                'select_arr' => $sel_rez ,
            ]);
        }
    }

    /**
     * Deletes an existing Tariff model.
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
     * Finds the Tariff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tariff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tariff::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
