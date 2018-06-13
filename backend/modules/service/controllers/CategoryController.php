<?php

namespace backend\modules\service\controllers;

use backend\modules\products\models\CategoryProduct;
use common\classes\Debug;
use Yii;
use common\models\db\CategoryShop;
use backend\modules\service\models\CategoryShopSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for CategoryShop model.
 */
class CategoryController extends Controller
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
     * Lists all CategoryShop models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoryShopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoryShop model.
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
     * Creates a new CategoryShop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoryProduct();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->type = $model::TYPE_SERVICE;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $category = CategoryProduct::find()->where(['type' => CategoryProduct::TYPE_SERVICE, 'parent_id' => 0])->all();
        return $this->render('create', [
            'model' => $model,
            'category' => $category,
        ]);
    }

    /**
     * Updates an existing CategoryShop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->type = $model::TYPE_SERVICE;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $category = CategoryProduct::find()->where(['type' => CategoryProduct::TYPE_SERVICE])->all();
        return $this->render('update', [
            'model' => $model,
            'category' => $category,
        ]);
    }

    /**
     * Deletes an existing CategoryShop model.
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
     * Finds the CategoryShop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryShop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
