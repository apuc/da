<?php

namespace backend\modules\products\controllers;

use backend\modules\category\Category;
use backend\modules\products\models\ProductFields;
use common\classes\Debug;
use common\models\db\CategoryFields;
use common\models\db\CategoryShop;
use Yii;
use backend\modules\products\models\CategoryProduct;
use backend\modules\products\models\CategoryProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for CategoryProduct model.
 */
class CategoryController extends Controller
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
     * Lists all CategoryProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoryProductSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $allCategories = CategoryShop::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'allCategories' => $allCategories
        ]);
    }

    /**
     * Displays a single CategoryProduct model.
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
     * Creates a new CategoryProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoryProduct();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $category = CategoryProduct::find()->all();



        return $this->render('create', [
            'model' => $model,
            'category' => $category,
        ]);
    }

    /**
     * Updates an existing CategoryProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        /*Debug::prn(Yii::$app->request->post());
        die();*/
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        $category = CategoryProduct::find()->where(['!=', 'id', $id])->all();

        $fieldsRel = CategoryFields::find()->where(['category_id' => $id])->all();

        $fields = [];
        if($fieldsRel)
        foreach($fieldsRel as $fieldRel){
            $fields[] = ProductFields::find()->where(['id' => $fieldRel['fields_id']])->one();
        }



        return $this->render('update', [
            'model' => $model,
            'category' => $category,
            'fields' => $fields
        ]);
    }

    /**
     * Deletes an existing CategoryProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        CategoryShop::delCat($id);
        return $this->redirect(['index']);
    }

    /**
     * Finds the CategoryProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryProduct the loaded model
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
