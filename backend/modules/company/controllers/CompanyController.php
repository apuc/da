<?php

namespace backend\modules\company\controllers;

use backend\modules\company\models\CompanyForm;
use backend\modules\company\models\SocAvailable;
use backend\modules\tags\models\Tags;
use backend\modules\tags\models\TagsRelation;
use common\classes\Debug;
use common\classes\GeobaseFunction;
use common\classes\UserFunction;
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use common\models\db\CompanyOld;
use common\models\db\CompanyPhoto;
use common\models\db\GeobaseCity;
use common\models\db\KeyValue;
use common\models\db\Messenger;
use common\models\db\MessengerPhone;
use common\models\db\Phones;
use common\models\db\Services;
use common\models\db\ServicesCompanyRelations;
use common\models\db\Stock;
use backend\modules\company\models\SocCompany;
use Yii;
use backend\modules\company\models\Company;
use backend\modules\company\models\CompanySearch;
use yii\base\DynamicModel;
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
    public $enableCsrfValidation = false;

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

    /* public function beforeAction($action)
     {
         $this->enableCsrfValidation = ($action->id !== "update");
         $this->enableCsrfValidation = ($action->id !== "get_sub_categ");

         return parent::beforeAction($action);
     }*/

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
     * @throws NotFoundHttpException
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
        $model = new CompanyForm();
        $typeSeti = SocAvailable::find()->all();

        $socCompany = SocCompany::find()->where(['company_id' => $model->id])->all();
        $socCompany = ArrayHelper::index($socCompany, 'soc_type');
        $tags = Tags::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (empty($model->alt)) {
                $model->alt = $model->name;
            }
            $model->city_id = Yii::$app->request->post('Company')['city_id'];
            $city = GeobaseCity::findOne($model->city_id);
            $model->region_id = $city->region_id;
            if (UserFunction::hasRoles(['Редактор компаний'])) $model->user_id = Yii::$app->user->id;
            if (!$model->setTariff()) $model->save();

            $cats_ids = explode(',', $_POST['CompanyForm']['cats']);
            foreach ($cats_ids as $cats_id) {
                $catCompanyRel = new CategoryCompanyRelations();
                $catCompanyRel->cat_id = $cats_id;
                $catCompanyRel->company_id = $model->id;
                $catCompanyRel->save();
            }

            if (!empty($_POST['socicon'])) {
                //SocCompany::deleteAll(['company_id' => $id]);
                foreach ($_POST['socicon'] as $key => $value) {
                    $socCompany = new SocCompany();
                    $socCompany->company_id = $model->id;
                    $socCompany->link = $value[0];
                    $socCompany->soc_type = $key;
                    $socCompany->save();
                }
            }
            $phones = Yii::$app->request->post('Phones');
            if (!empty($phones)) {
                foreach ($phones as $phone) {
                    $newPhone = new Phones();
                    $newPhone->phone = $phone['phone'];
                    $newPhone->company_id = $model->id;
                    $newPhone->save();
                    if (!empty($phone['messengeresArray'])) {
                        foreach ($phone['messengeresArray'] as $messenger) {
                            $newMessenger = new MessengerPhone();
                            $newMessenger->messenger_id = $messenger;
                            $newMessenger->phone_id = $newPhone->id;
                            $newMessenger->save();
                        }
                    }
                }
            }

            if (!empty(Yii::$app->request->post('Tags'))) {
                foreach (Yii::$app->request->post('Tags') as $tag) {
                    $tags = new TagsRelation();
                    $tags->saveTagsRel($tag, $model->id, 'company');
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'city' => GeobaseFunction::getArrayCityRegion(),
                'typeSeti' => $typeSeti,
                'tags' => $tags,
                'tags_selected' => [],
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws \yii\base\InvalidParamException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        if (($model = CompanyForm::findOne($id)) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        //Debug::dd($model->categories);
        $companyPhotos = CompanyPhoto::findAll(['company_id' => $id]);
        $companyPhotos = ArrayHelper::getColumn($companyPhotos, 'photo');
        $companyPhotosStr = implode(',', $companyPhotos);
        $phones = Phones::find()->where(['company_id' => $model->id])->all();
        $tags = Tags::find()->asArray()->all();
        $tags_selected = ArrayHelper::getColumn(TagsRelation::find()->select('tag_id')
            ->where(['post_id' => $id, 'type' => 'company'])
            ->asArray()
            ->all(), 'tag_id');
        $socials = $model->getFullAndEmptySocials();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $post = Yii::$app->request->post();
            $post['Phones'] = array_values($post['Phones']);
            $model->city_id = Yii::$app->request->post('Company')['city_id'];
            $city = GeobaseCity::findOne($model->city_id);
            $model->region_id = $city->region_id;
            if (empty($model->alt)) {
                $model->alt = $model->name;
            }
            if ($model->tariff_id) {
                ServicesCompanyRelations::deleteAll(['company_id' => $model->id]);
                $model->setTariff();
            } else {
                $model->tariff_id = 0;
                $model->dt_end_tariff = 0;
                $model->save();
            }

            CompanyPhoto::deleteAll(['company_id' => $model->id]);

            if (Yii::$app->request->post('company-photos')) {
                $compPhotos = explode(',', Yii::$app->request->post('company-photos'));

                foreach ($compPhotos as $compPhoto) {
                    $company_photo = new CompanyPhoto();
                    $company_photo->company_id = $model->id;
                    $company_photo->photo = $compPhoto;
                    $company_photo->save();
                }
            }

            CategoryCompanyRelations::deleteAll(['company_id' => $model->id]);
            $cats_ids = explode(',', $_POST['CompanyForm']['cats']);
            foreach ($cats_ids as $cats_id) {
                $catCompanyRel = new CategoryCompanyRelations();
                $catCompanyRel->cat_id = $cats_id;
                $catCompanyRel->company_id = $model->id;
                $catCompanyRel->save();
            }

            if (SocCompany::loadMultiple($socials, Yii::$app->request->post()) &&
                SocCompany::validateMultiple($socials)) {
                foreach ($socials as $soc) {
                    /** @var SocCompany $soc */
                    $soc->save();
                }
            }

            if (!empty(Yii::$app->request->post('Tags'))) {
                TagsRelation::deleteAll(['post_id' => $id, 'type' => 'company']);
                foreach (Yii::$app->request->post('Tags') as $tag) {
                    $tags = new TagsRelation();
                    $tags->saveTagsRel($tag, $id, 'company');
                }
            }


            $phones = Phones::findAll(['company_id' => $id]);
            $post['Phones'] = array_values($post['Phones']);
            $diff = count($post['Phones']) - count($phones);
            if ($diff > 0) {
                for ($i = 0; $i < $diff; $i++) {
                    $phone = new Phones();
                    $phone->company_id = $id;
                    $phones[] = $phone;
                }
            }
            if (Phones::loadMultiple($phones, $post) && Phones::validateMultiple($phones)) {
                foreach ($phones as $phone) {
                    /** @var Phones $phone */
                    $phone->save();
                }
            }


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'companyPhotos' => $companyPhotos,
                'companyPhotosStr' => $companyPhotosStr,
                'city' => GeobaseFunction::getArrayCityRegion(),
                'socials' => $socials,
                'tags' => $tags,
                'tags_selected' => $tags_selected,
                'phones' => $phones
            ]);
        }
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $company = Company::findById($id);
        if ($company)
            $company->status = Company::COMPANY_DELETED;
        $company->save();
//        CategoryCompanyRelations::deleteAll(['company_id' => $id]);
//        $phones = Phones::find()->select('id')->where(['company_id' => $id])->column();
//        if (!empty($phones)) {
//            foreach ($phones as $phone) {
//                MessengerPhone::deleteAll(['phone_id' => $phone]);
//            }
//            Phones::deleteAll(['company_id' => $id]);
//        }
//        $this->findModel($id)->delete();

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
        $id = $_POST['catId'];
        echo Html::dropDownList(
            'sub_categ',
            null,
            ArrayHelper::map(CategoryCompany::find()->where(['parent_id' => $id])->all(), 'id', 'title'),
            ['class' => 'form-control', 'id' => 'sub_categ_company', 'prompt' => 'Выберите подкатегорию']
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

    public function actionHotStock()
    {
        $request = Yii::$app->request;
        $hotStock = KeyValue::findOne(['key' => 'hot_stock']);
        if ($request->isPost) {
            $json = json_encode($request->post()['hot_stock']);
            $hotStock->value = $json;
            $hotStock->save();
        }
        return $this->render('hot_stock', [
            'hotStockList' => ArrayHelper::map(Stock::find()->all(), 'id', 'title'),
            'hotStock' => json_decode($hotStock->value),
        ]);
    }

    public function actionAddPhone()
    {
        return $this->renderPartial('phone', [
            'iterator' => Yii::$app->request->post('iterator'),
            'messengeres' => ArrayHelper::map(Messenger::find()->all(), 'id', 'name'),
        ]);
    }

    public function actionRemovePhone()
    {
        $id = Yii::$app->request->post('id');
        MessengerPhone::deleteAll(['phone_id' => $id]);
        $phone = Phones::findOne(['id' => $id]);
        if (!is_null($phone)) {
            if (!$phone->delete()) {
                return 0;
            }
        }
        return 1;
    }

    public function actionGetServices()
    {
        return $this->renderPartial('checkbox-services', [
            'model' => Services::find()->asArray()->all()
        ]);
    }

    public function actionReplacePhone()
    {
        $company_old = CompanyOld::find()->all();

        foreach ($company_old as $company) {
            if (!empty($company->phone)) {
                $company_replace = Company::findOne($company->id);


                if (!empty($company_replace) && empty($company_replace->phone)) {
                    $company_replace->phone = $company->phone;

                    if ($company_replace->save()) {
                        echo 'номер ' . $company_replace->phone . ' Добавлен к компании ' . $company_replace->id . "</br>";
                    }
                }
            }
        }
    }

}
