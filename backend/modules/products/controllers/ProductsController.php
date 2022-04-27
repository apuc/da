<?php

namespace backend\modules\products\controllers;

use backend\modules\products\models\Products;
use backend\modules\products\models\ProductsSearch;
use common\classes\Debug;
use common\models\db\ProductMark;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ProductsController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = Products::find()
            ->with('productFieldsValues.field', 'company', 'images', 'category')
            ->where(['id' => $id])->one();
        return $this->render('view', ['model' => $model]);
    }

    public function actionPublished($id)
    {
        Products::updateAll(['status' => 1], ['id' => $id]);
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        Products::updateAll(['status' => 3], ['id' => $id]);

        return $this->redirect(['index']);
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