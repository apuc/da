<?php

namespace backend\modules\service\controllers;

use backend\modules\company\models\Company;
use backend\modules\products\models\CategoryProduct;
use common\classes\Debug;
use common\models\db\CategoryShop;
use common\models\db\ProductMark;
use common\models\db\ProductsImg;
use Yii;
use backend\modules\products\models\Products;
use backend\modules\service\models\ServiceSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceController implements the CRUD actions for Products model.
 */
class ServiceController extends Controller
{
    function init()
    {
        parent::init();
    }

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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
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


    public function actionPublished($id)
    {
        Products::updateAll(['status' => 1], ['id' => $id]);
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Products model.
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
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionHit($id)
    {
        $model = ProductMark::findOne(['product_id' => $id, 'mark' => ProductMark::MARK_HIT]);
        if($model === null){
            $model = new ProductMark();
            $model->mark = ProductMark::MARK_HIT;
            $model->product_id = $id;
            $model->save();
        }
        else {
            $model->delete();
        }
        return $this->redirect(['view', 'id' => $id]);
    }
}
