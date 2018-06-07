<?php

namespace frontend\modules\company\controllers;

use common\classes\CompanyFunction;
use common\classes\Debug;
use common\classes\GeobaseFunction;
use common\classes\UserFunction;
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use common\models\db\CompanyFeedback;
use common\models\db\CompanyPhoto;
use common\models\db\KeyValue;
use common\models\db\Messenger;
use common\models\db\MessengerPhone;
use common\models\db\Phones;
use common\models\db\ProductsImg;
use common\models\db\SocCompany;
use common\models\UploadPhoto;
use Yii;
use frontend\modules\company\models\Company;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
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

    public function init()
    {
        $this->on('beforeAction', function ($event) {

            // запоминаем страницу неавторизованного пользователя, чтобы потом отредиректить его обратно с помощью  goBack()
            if (Yii::$app->getUser()->isGuest) {
                $request = Yii::$app->getRequest();
                // исключаем страницу авторизации или ajax-запросы
                if (!($request->getIsAjax() || strpos($request->getUrl(), 'login') !== false)) {
                    Yii::$app->getUser()->setReturnUrl($request->getUrl());
                }
            }
        });
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'category', 'view-category', 'get_categ', 'get_sub_categ', 'get_company_by_categ', 'get-more-company', 'startwidgetcompany', 'get-company'],
                        'roles' => ['?'],
                    ],
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
        $useReg = UserFunction::getRegionUser();
        $organizationsQuery = Company::find()
            ->with('allPhones')
            ->where([
                'status' => 0,
            ]);
        if ($useReg != -1) {
            $organizationsQuery->andWhere(
                [
                    'region_id' => $useReg,
                ]
            );
        }
        $organizations = $organizationsQuery
            ->orderBy('RAND()')
            ->limit(16)
            ->all();

        $wrc = KeyValue::getValue('we_recommend_companies');
        $wrcQuery = \common\models\db\Company::find()
            ->where(['id' => json_decode($wrc)]);

        if ($useReg != -1) {
            $wrcQuery->andWhere(
                [
                    'region_id' => $useReg,
                ]
            );
        }

        $wrc = $wrcQuery
            ->all();
        $positions = [1, 4, 10, 15];

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
            ->andWhere(['`company`.`status`' => 0])
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
     * @param string $page
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     * @throws \yii\base\InvalidParamException
     * @throws \yii\db\Exception
     */
    public function actionView($slug, $place = '')
    {
        $model = Company::find()
            ->with('allPhones')
            ->joinWith('tagss.tagname')
            ->joinWith('socCompany')
            ->where(['slug' => $slug])
            //->andWhere(['`tags_relation`.`type`' => 'company'])
            ->one();
        if (empty($model) || $model->status == 1) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $services = [];
        if ($model->dt_end_tariff > time() || $model->dt_end_tariff == 0) {
            $services = CompanyFunction::getServiceCompany($model->id);
        }

        $categoryCompany = CategoryCompanyRelations::find()
            ->with('category.categ')
            ->where(['company_id' => $model->id])
            ->one();
        $rating = Yii::$app->db->createCommand(
            "SELECT AVG(`rating`) AS `rating`, COUNT(`rating`) AS `count`
                    FROM `company_feedback`
                    WHERE `company_id` = :company_id
                    GROUP BY `company_id`",
            [
                ':company_id' => $model->id,
            ])
            ->queryAll();

        return $this->render('view', [
            'model' => $model,
            'services' => $services,
            'categoryCompany' => $categoryCompany,
            'slug' => $slug,
            'page' => $place,
            'options' => $model->getPage($place),
            'rating' => $rating,
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
        $this->layout = "personal_area";
        $model = new Company();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $post = Yii::$app->request->post();

            $model->status = 1;
            $model->user_id = Yii::$app->user->id;
            $model->meta_title = $model->name;
            $model->meta_descr = StringHelper::truncate($model->descr, 250);

            if (empty($model->alt)) {
                $model->alt = $model->name;
            }

            if ($_FILES['Company']['name']['photo']) {
                $upphoto = New UploadPhoto();
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

            $phones = $model->allPhones;

            $post['Phones'] = array_values($post['Phones']);
            $post['messengeresArray'] = array_values($post['messengeresArray']);

            $diff = count($post['Phones']);
            if ($diff > 0) {
                for ($i = 0; $i < $diff; $i++) {
                    $phone = new Phones();
                    $phone->company_id = $model->id;
                    $phone->phone = $post['Phones'][$i]['phone'];
                    $phone->messengeresArray = $post['messengeresArray'][$i];
                    $phones[] = $phone;

                }
            }
            if (Phones::validateMultiple($phones)) {
                for ($i = 0; $i < $diff; $i++) {
                    /** @var Phones $phone */
                    $phones[$i]->save();
                }
            }

            $catCompanyRel = new CategoryCompanyRelations();
            $catCompanyRel->cat_id = $model['categ'][0];
            $catCompanyRel->company_id = $model->id;
            $catCompanyRel->save();

            Yii::$app->session->setFlash('success', 'Ваше предприятие успешно добавлено. После прохождения модерации оно будет опубликовано.');
            return $this->redirect(['/personal_area/user-company']);
        } else {
            $categoryCompanyAll = CategoryCompany::find()->select('id, title, parent_id')->asArray()->all();
            $data = [];
            foreach ($categoryCompanyAll as $item) {
                if ($item['parent_id'] == 0) {
                    foreach ($categoryCompanyAll as $value) {
                        if ($value['parent_id'] == $item['id']) {
                            $data[$item['title']][$value['id']] = $value['title'];
                        }
                    }
                }
            }

            return $this->render('create', [
                'model' => $model,
                'city' => GeobaseFunction::getArrayCityRegion(),
                'categoryCompanyAll' => $data,
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
        $model = Company::find()->with('allPhones')->where(['id' => $id])->one();

        $socials = $model->getFullAndEmptySocials();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $post = Yii::$app->request->post();
            $phones = $model->allPhones;
            $post['Phones'] = array_values($post['Phones']);
            $diff = count($post['Phones']) - count($phones);
            if ($diff > 0) {
                for ($i = 0; $i < $diff; $i++) {
                    $phone = new Phones();
                    $phone->company_id = $id;
                    $phone->phone = $post['Phones'][$i];
                    $phone->messengeresArray = $post['messengeresArray'][$i];
                    $phones[] = $phone;

                }
            }
            if (Phones::loadMultiple($phones, $post) && Phones::validateMultiple($phones)) {
                foreach ($phones as $phone) {
                    /** @var Phones $phone */
                    if(isset($post['messengeresArray'])){
                        $phone->messengeresArray = $post['messengeresArray'][$phone->id];
                    }
                    $phone->save();
                }
            }

            $model->status = 2;
            $model->user_id = Yii::$app->user->id;

            if (empty($model->alt)) {
                $model->alt = $model->name;
            }

            if (!empty($_FILES['Company']['name']['photo'])) {
                $upphoto = New UploadPhoto();
                $upphoto->imageFile = UploadedFile::getInstance($model, 'photo');
                $loc = 'media/upload/userphotos/' . date('dmY') . '/';
                if (!is_dir($loc)) {
                    mkdir($loc);
                }
                $upphoto->location = $loc;
                $upphoto->upload();
                $model->photo = '/' . $loc . $_FILES['Company']['name']['photo'];
            } else {
                $model->photo = $_POST['photo'];
            }
            $model->save();
            CategoryCompanyRelations::deleteAll(['company_id' => $model->id]);

            foreach ($model['categ'] as $item) {
                $catCompanyRel = new CategoryCompanyRelations();
                $catCompanyRel->cat_id = $item;
                $catCompanyRel->company_id = $model->id;
                $catCompanyRel->save();
            }

            if (!empty($_POST['productImg'])) {
                CompanyPhoto::deleteAll(['company_id' => $model->id]);
                foreach ((array)$_POST['productImg'] as $photo) {
                    if($photo){
                        $companyPhoto = new CompanyPhoto;
                        $companyPhoto->company_id = $model->id;
                        $companyPhoto->photo = $photo;
                        $companyPhoto->save();
                    }
                }

            }

            if (SocCompany::loadMultiple($socials, Yii::$app->request->post()) &&
                SocCompany::validateMultiple($socials)) {
                foreach ($socials as $soc) {
                    /** @var SocCompany $soc */
                    $soc->save();
                }
            }
            Yii::$app->session->setFlash('success', 'Ваше предприятие успешно сохранено. После прохождения модерации оно будет опубликовано.');
            return $this->redirect(['/personal_area/user-company']);
        } else {
            $companyRel = CategoryCompanyRelations::find()->where(['company_id' => $id])->all();
            $categoryCompanyAll = CategoryCompany::find()->select('id, title, parent_id')->asArray()->all();
            $data = [];
            foreach ($categoryCompanyAll as $item) {
                if ($item['parent_id'] == 0) {
                    foreach ($categoryCompanyAll as $value) {
                        if ($value['parent_id'] == $item['id']) {
                            $data[$item['title']][$value['id']] = $value['title'];
                        }
                    }
                }
            }

            $services = [];
            $img = CompanyPhoto::find()->where(['company_id' => $id])->all();
            if ($model->dt_end_tariff > time() || $model->dt_end_tariff != 0) {
                $services = CompanyFunction::getServiceCompany($id);
            }

            return $this->render('update', [
                'model' => $model,
                'companyRel' => $companyRel,
                'services' => $services,
                'img' => $img,
                'city' => GeobaseFunction::getArrayCityRegion(),
                'categoryCompanyAll' => $data,
                'socials' => $socials,
                'phones' => $model->allPhones
            ]);
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
        Company::updateAll(['status' => 3], ['id' => $id]);
        $phones = Phones::find()->select('id')->where(['company_id' => $id])->column();
        if (!empty($phones)) {
            foreach ($phones as $phone) {
                MessengerPhone::deleteAll(['phone_id' => $phone]);
            }
            Phones::deleteAll(['company_id' => $id]);
        }
        Yii::$app->session->setFlash('success', 'Ваше предприятие успешно удалено.');
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

        $useReg = UserFunction::getRegionUser();

        $arryResult = $cat->id;
        if ($cat->parent_id == 0) {
            $category = CategoryCompany::find()->where(['parent_id' => $cat->id])->all();
            if (!empty($category)) {
                $arryResult = [];
                $arryResult = ArrayHelper::getColumn($category, 'id');
                foreach ($category as $item) {
                    $catP = CategoryCompany::find()->where(['parent_id' => $item->id])->all();
                    $arryResult = array_merge($arryResult, ArrayHelper::getColumn($catP, 'id'));
                }
            }
        }


        $organizationsQuery = Company::find()
            ->with('allPhones')
            ->joinWith('categories')
            ->where(['cat_id' => $arryResult, 'status' => 0]);

        if ($useReg != -1) {
            $organizationsQuery->andWhere(
                [
                    'region_id' => $useReg,
                ]
            );
        }

        $organizations = $organizationsQuery
            ->all();

        $positions = [1, 4, 10, 15, 16, 21, 26, 31, 34, 39, 41];

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
        $useReg = UserFunction::getRegionUser();

        $organizationsQuery = Company::find()
            ->with('allPhones')
            ->where([
                'status' => 0,
            ]);
        if ($useReg != -1) {
            $organizationsQuery->andWhere(
                [
                    'region_id' => $useReg,
                ]
            );
        }
        $organizations = $organizationsQuery->orderBy('RAND()')
            ->limit(16)
            ->all();

        $post = Yii::$app->request->post();
        $wrc = KeyValue::getValue('we_recommend_companies');
        $wrc = json_decode($wrc);
        $step = isset($post['step']) ? $post['step'] * 3 : 1;
        $wrc = array_splice($wrc, $step);
        $wrc = \common\models\db\Company::find()->where(['id' => $wrc])->all();
        $positions = [1, 4, 10, 15];

        return $this->renderPartial('more_company', [
            'organizations' => $organizations,
            'wrc' => $wrc,
            'positions' => $positions,
        ]);
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

    public function actionDeleteImg()
    {
        CompanyPhoto::deleteAll(['id' => $_GET['id']]);
        return 1;
    }

    public function actionAddPhone()
    {
        return $this->renderPartial('one_phone', [
            'iterator' => Yii::$app->request->post('iterator'),
            'messengers' => ArrayHelper::map(Messenger::find()->all(), 'id', 'name'),
        ]);
    }

    /**
     * @return string
     */
    public function actionAddFeedback()
    {
        if (!empty(Yii::$app->request->post())) {
            $companyFeedback = new CompanyFeedback();
            if ($companyFeedback->load(Yii::$app->request->post())) {
                $companyFeedback->dt_add = time();
                $companyFeedback->status = 0;
                $companyFeedback->company_name = Company::findOne(['id' => Yii::$app->request->post()['CompanyFeedback']['company_id']])->name;
                $companyFeedback->save();
            }
        }
        return "Спасибо, Ваш отзыв будет проверен и опубликован модератором";
    }

}
