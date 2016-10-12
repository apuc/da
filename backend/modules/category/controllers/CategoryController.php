<?php

namespace backend\modules\category\controllers;

use backend\modules\category_company\models\CategoryCompany;
use common\classes\Debug;
use common\models\db\CategoryCompanyRelations;
use common\models\db\CategoryNewsRelations;
use common\models\db\Lang;
use frontend\modules\mainpage\widgets\News;
use PHPExcel;
use PHPExcel_IOFactory;
use Yii;
use backend\modules\category\models\CategoryNews;
use backend\modules\category\models\CategoryNewsSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for CategoryNews model.
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
     * Lists all CategoryNews models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoryNewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoryNews model.
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
     * Creates a new CategoryNews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoryNews();

        if ($model->load(Yii::$app->request->post())) {
            if(empty($model->parent_id)){
                $model->parent_id = 0;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'lang' => Lang::find()->all(),
                'all_cat' => CategoryNews::find()->all(),
            ]);
        }
    }

    /**
     * Updates an existing CategoryNews model.
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
            return $this->render('update', [
                'model' => $model,
                'lang' => Lang::find()->all(),
                'all_cat' => CategoryNews::find()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing CategoryNews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $news = CategoryNewsRelations::find()->where(['cat_id'=>$id])->all();
        CategoryNewsRelations::deleteAll(['cat_id'=>$id]);
        foreach($news as $new){
            \common\models\db\News::deleteAll(['id'=>$new->new_id]);
        }
        //CategoryNewsRelations::deleteAll(['cat_id'=>$id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CategoryNews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryNews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryNews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImport_cat(){
        $objPHPExcel = new PHPExcel();
        $excel = PHPExcel_IOFactory::load('excel/cat.xls');
        $excel->setActiveSheetIndex(0);
        $sheet = $excel->getActiveSheet();
        $rowIterator = $sheet->getRowIterator();
        $i = 0;
        $arr = [];
        foreach ($rowIterator as $row) {
            if($i < 2000){
                $cellIterator = $row->getCellIterator();
                $j = 0;
                foreach ($cellIterator as $cell) {
                    $arr[$i][$j] = $cell->getCalculatedValue();
                    $j++;
                }
            }
            $i++;
        }

        foreach($arr as $item){
            if($item[1] == '-'){
                $cat = new \common\models\db\CategoryCompany();
                $cat->title = $item[0];
                $cat->parent_id = 0;
                $cat->save();
            }
        }
        foreach($arr as $item){
            if($item[1] != '-'){
                $parent = \common\models\db\CategoryCompany::find()->where(['title'=>$item[1]])->one();
                $cat = new \common\models\db\CategoryCompany();
                $cat->title = ($item[0][0] == '-')? substr( $item[0], 1):$item[0];
                $cat->parent_id = $parent->id;
                $cat->save();
            }
        }
    }


}
