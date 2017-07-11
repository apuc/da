<?php

namespace frontend\modules\company\controllers;

use common\classes\Debug;
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use common\models\db\CompanyFeedback;
use common\models\db\CompanyPhoto;
use common\models\db\KeyValue;
use common\models\db\ServicesCompanyRelations;
use common\models\db\Stock;
use common\models\db\TariffServicesRelations;
use frontend\widgets\VipCompanyWidget;
use Yii;
use frontend\modules\company\models\Company;
use frontend\modules\company\models\CompanySearch;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
    public $layout = 'portal_page';

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
     * Lists all Company models.
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */

    public function actionIndex()
    {

        $organizations = Company::find()
            ->where([
                'status' => 0,
            ])
            ->orderBy('RAND()')
            ->limit(12)
            ->all();

        $wrc = KeyValue::getValue('we_recommend_companies');
        $wrc = \common\models\db\Company::find()->where(['id' => json_decode($wrc)])->all();
        $positions = [1, 4, 10];

        return $this->render('index', [
            'organizations' => $organizations,
            'meta_title' => KeyValue::findOne(['key' => 'company_page_meta_title'])->value,
            'meta_descr' => KeyValue::findOne(['key' => 'company_page_meta_descr'])->value,
            'wrc' => $wrc,
            'positions' => $positions,
        ]);
    }

    public function actionCategory($slug)
    {
        $cat = CategoryCompany::find()->where(['slug' => $slug])->one();
        if (empty($cat)) {
            return $this->goHome();
        }
        $cats = [];
        if ($cat->parent_id == 0) {
            $child_cat = CategoryCompany::find()->where(['parent_id' => $cat->id])->all();
            foreach ($child_cat as $c) {
                $cats[] = $c->id;
            }
        }
        $query = CategoryCompanyRelations::find()
            ->leftJoin('company', '`category_company_relations`.`company_id` = `company`.`id`')
            ->where(['cat_id' => ($cat->parent_id == 0) ? $cats : $cat->id])
            ->orderBy('`company`.`id` DESC')
            ->groupBy('`company`.`id`')
            ->with('company');

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $pages->pageSizeParam = false;

        $news = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('category', [
            'company' => $news,
            'cat' => $cat,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single Company model.
     *
     * @param string $slug
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     * @throws \yii\base\InvalidParamException
     */
    public function actionView($slug)
    {
        $model = \common\models\db\Company::findOne(['slug' => $slug]);
        if (empty($model)) {
            return $this->redirect(['site/error']);
        }
        $stoke = Stock::find()->where(['company_id' => $model->id])->limit(3)->all();
        $feedback = CompanyFeedback::find()->where(['company_id' => $model->id])->with('user')->all();
        $img = CompanyPhoto::findAll(['company_id' => $model->id]);
        return $this->render('view', [
            'model' => $model,
            'stock' => $stoke,
            'feedback' => $feedback,
            'img' => $img,
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
        //$this->goHome();

        $this->layout = "personal_area";
        $model = new Company();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $phone = '';
            foreach ($_POST['mytext'] as $item){
                $phone .= $item . ' ';
            }

            $model->status = 1;
            $model->phone = $phone;
            $model->user_id = Yii::$app->user->id;
            if ($_FILES['Company']['name']['photo']) {
                $upphoto = New \common\models\UploadPhoto();
                $upphoto->imageFile = UploadedFile::getInstance($model, 'photo');
                $loc = 'media/upload/userphotos/' . date('dmY') . '/';
                if (!is_dir($loc)) {
                    mkdir($loc);
                }
                $upphoto->location = $loc;
                $upphoto->upload();
                $model->photo = '/' . $loc . $_FILES['Company']['name']['photo'];
            }
            $model->save();
            $catCompanyRel = new CategoryCompanyRelations();
            $catCompanyRel->cat_id = $_POST['categParent'];
            $catCompanyRel->company_id = $model->id;
            $catCompanyRel->save();

            /*$servisec = TariffServicesRelations::find()->where(['tariff_id' => 1])->all();

            foreach ($servisec as $item){
                $scr = new ServicesCompanyRelations();
                $scr->services_id = $item->services_id;
                $scr->company_id = $model->id;
                $scr->save();
            }*/

            Yii::$app->session->setFlash('success','Ваше предприятие успешно добавлено. После прохождения модерации оно будет опубликовано.');
            return $this->redirect(['/personal_area/default/index']);
        }

        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionUpdate($id)
    {
        $this->layout = "personal_area";
        $model = Company::find()->where(['id' => $id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $phone = '';
            foreach ($_POST['mytext'] as $item){
                $phone .= $item . ' ';
            }

            $model->status = 1;
            $model->phone = $phone;
            $model->user_id = Yii::$app->user->id;

            if (!empty($_FILES['Company']['name']['photo'])) {
                $upphoto = New \common\models\UploadPhoto();
                $upphoto->imageFile = UploadedFile::getInstance($model, 'photo');
                $loc = 'media/upload/userphotos/' . date('dmY') . '/';
                if (!is_dir($loc)) {
                    mkdir($loc);
                }
                $upphoto->location = $loc;
                $upphoto->upload();
                $model->photo = '/' . $loc . $_FILES['Company']['name']['photo'];
            }else{
                $model->photo = $_POST['photo'];
            }
            $model->save();
            $catCompanyRel = new CategoryCompanyRelations();
            $catCompanyRel->cat_id = $_POST['categParent'];
            $catCompanyRel->company_id = $model->id;
            $catCompanyRel->save();

            //Debug::prn($_FILES);
            $i = 0;
            if(!empty($_FILES['fileCompanyPhoto']['name'][0])){
                $loc = 'media/upload/userphotos/' . date('dmY') . '/';
                if (!is_dir($loc)) {
                    mkdir($loc);
                }
                if (!file_exists('/media/upload/userphotos/' . date('dmY') . '/' . $model->id)) {
                    mkdir('/media/upload/userphotos/' . date('dmY') . '/' . $model->id . '/');
                }
                if (!file_exists('/media/upload/userphotos/' . date('dmY') . '/' . $model->id . '/' .date('Y-m-d'))) {
                    mkdir('/media/upload/userphotos/' . date('dmY') . '/' . $model->id . '/' . date('Y-m-d'));
                }

                $dir = '/media/upload/userphotos/' . date('dmY') . '/' . $model->id . '/'. date('Y-m-d') . '/';

                foreach ($_FILES['fileCompanyPhoto']['name'] as $file) {

                    move_uploaded_file($_FILES['fileCompanyPhoto']['tmp_name'][$i], $dir.$file);

                    $companyPhoto = new CompanyPhoto;
                    $companyPhoto->company_id = $model->id;
                    $companyPhoto->photo = $dir . $file;
                    $companyPhoto->save();
                    $i++;

                }
            }

            Yii::$app->session->setFlash('success','Ваше предприятие успешно сохранено. После прохождения модерации оно будет опубликовано.');
            return $this->redirect(['/personal_area/default/index']);
        } else {
            $companyRel = CategoryCompanyRelations::find()->where(['company_id' => $id])->one();

            $selectParentCat = CategoryCompany::find()->where(['id' => $companyRel->cat_id])->one();
            $selectCat = CategoryCompany::find()->where(['id' => $selectParentCat->parent_id])->one();

            $img = CompanyPhoto::find()->where(['company_id' => $id])->all();
            if($model->dt_end_tariff > time() || $model->dt_end_tariff == 0) {
                //Debug::prn($model);

                $services = ServicesCompanyRelations::find()
                    ->where(['company_id' => $id])
                    ->with('services')
                    ->all();

                $services = ArrayHelper::getColumn($services, 'services');

               $services = ArrayHelper::map($services, 'name_serv', 'val');
Debug::prn($services);
                return $this->render('update', [
                    'model' => $model,
                    'selectCat' => $selectCat,
                    'companyRel' => $companyRel,
                    'selectParentCat' => $selectParentCat,
                    'services' => $services,
                    'img' => $img,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        CategoryCompanyRelations::deleteAll(['company_id' => $id]);
        ServicesCompanyRelations::deleteAll(['company_id' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['/personal_area/default/index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
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

    public function actionViewCategory($slug)
    {
        $cat = CategoryCompany::find()->where(['slug' => $slug])->one();
        if (empty($cat)) {
            return $this->goHome();
        }
        $organizations = Company::find()
            ->joinWith('categories')
            ->where(['cat_id' => $cat->id])
            ->all();

        $positions = [1, 4, 10];

        return $this->render('view_category', [
            'organizations' => $organizations,
            'positions' => $positions,
            'categ' => $cat
        ]);
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
        $sub_company = CategoryCompany::find()->where(['parent_id' => $_POST['id']])->all();

        return $this->renderPartial('sub_company', [
            'sub_company' => $sub_company,
        ]);
    }

    public function actionGet_company_by_categ()
    {

        $select_categories = CategoryCompany::find()
            ->where(['parent_id' => $_POST['id']])
            ->all();
        $id_parrent_company = ArrayHelper::getColumn($select_categories, 'id');
        $select_organizations = Company::find()
            ->where(['status' => 0])
            ->leftJoin('category_company_relations', '`category_company_relations`.`company_id`=`company`.`id`')
            ->andWhere(['`category_company_relations`.`cat_id`' => $_POST['id']])
            ->orWhere([
                'status' => 0,
                '`category_company_relations`.`cat_id`' => $id_parrent_company,
            ])
            ->with('category_company_relations')
            ->all();

        return $this->renderPartial('organizations', [
            'organizations' => $select_organizations,
        ]);
    }

    public function actionGetMoreCompany()
    {
        $organizations = Company::find()
            ->where([
                'status' => 0,
            ])
            ->orderBy('RAND()')
            ->limit(12)
            ->all();

        $post = Yii::$app->request->post();
        $wrc = KeyValue::getValue('we_recommend_companies');
        $wrc = json_decode($wrc);
        $step = isset($post['step']) ? $post['step'] * 3 : 1;
        $wrc = array_splice($wrc, $step);
        $wrc = \common\models\db\Company::find()->where(['id' => $wrc])->all();
        $positions = [1, 4, 10];

        return $this->renderPartial('more_company', [
            'organizations' => $organizations,
            'wrc' => $wrc,
            'positions' => $positions,
        ]);
    }

    public static function actionStartwidgetcompany()
    {
        //return \frontend\modules\mainpage\widgets\Company::widget();
        return VipCompanyWidget::widget();
        // return '1';
    }

    public function actionGetCompany()
    {
        $select_categories = CategoryCompany::find()
            ->where(['parent_id' => $_GET['catId']])
            ->all();
        $id_parrent_company = ArrayHelper::getColumn($select_categories, 'id');
        $select_organizations = Company::find()
            ->where(['status' => 0])
            ->leftJoin('category_company_relations', '`category_company_relations`.`company_id`=`company`.`id`')
            ->andWhere(['`category_company_relations`.`cat_id`' => $_GET['catId']])
            ->orWhere([
                'status' => 0,
                '`category_company_relations`.`cat_id`' => $id_parrent_company,
            ])
            ->with('category_company_relations')
            ->all();

        $positions = [1, 4, 10];

        return $this->renderPartial('view_category', [
            'organizations' => $select_organizations,
            'positions' => $positions,
            'categ' => CategoryCompany::find()->where(['id' => $_GET['catId']])->one()
        ]);
    }
}
