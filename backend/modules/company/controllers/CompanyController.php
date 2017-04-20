<?php

namespace backend\modules\company\controllers;

use common\classes\Debug;
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use common\models\db\CompanyPhoto;
use common\models\db\KeyValue;
use Yii;
use backend\modules\company\models\Company;
use backend\modules\company\models\CompanySearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = ($action->id !== "update");

        return parent::beforeAction($action);
    }

    /**
     * Lists all Company models.
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionCreate()
    {
        $model = new Company();

        //Debug::prn($_POST);

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->getId();
            $model->save();
            $cats_ids = explode(',', $_POST['cats']);
            foreach ($cats_ids as $cats_id) {
                $catCompanyRel = new CategoryCompanyRelations();
                $catCompanyRel->cat_id = $cats_id;
                $catCompanyRel->company_id = $model->id;
                $catCompanyRel->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $companyPhotos = CompanyPhoto::findAll(['company_id' => $id]);
        $companyPhotos = ArrayHelper::getColumn($companyPhotos, 'photo');
        $companyPhotosStr = implode(',', $companyPhotos);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            CategoryCompanyRelations::deleteAll(['company_id' => $model->id]);
            $cats_ids = explode(',', $_POST['cats']);
            foreach ($cats_ids as $cats_id) {
                $catCompanyRel = new CategoryCompanyRelations();
                $catCompanyRel->cat_id = $cats_id;
                $catCompanyRel->company_id = $model->id;
                $catCompanyRel->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'companyPhotos' => $companyPhotos,
                'companyPhotosStr' => $companyPhotosStr,
            ]);
        }
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        CategoryCompanyRelations::deleteAll(['company_id' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGet_categ()
    {
        echo Html::dropDownList(
            'categ',
            null,
            ArrayHelper::map(CategoryCompany::find()->where(['lang_id' => $_POST['langId']])->all(), 'id', 'title'),
            ['class' => 'form-control', 'id' => 'categ_company']
        );
    }

    public function actionGet_sub_categ()
    {
        echo Html::dropDownList(
            'sub_categ',
            null,
            ArrayHelper::map(CategoryCompany::find()->where(['parent_id' => $_POST['catId']])->all(), 'id', 'title'),
            ['class' => 'form-control', 'id' => 'sub_categ_company']
        );
    }

    public function actionWeRecommendCompanies()
    {
        $request = Yii::$app->request;
        $wrc = KeyValue::findOne(['key' => 'we_recommend_companies']);
        if ($request->isPost) {
            $json = json_encode($request->post()['wrc']);
            $wrc->value = $json;
            $wrc->save();
        }
        return $this->render('wrc', [
            'wrcList' => ArrayHelper::map(\common\models\db\Company::find()->all(), 'id', 'name'),
            'wrc' => json_decode($wrc->value),
        ]);
    }

    public function actionUploadFile()
    {

    }

}
