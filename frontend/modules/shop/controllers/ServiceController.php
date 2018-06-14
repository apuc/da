<?php

namespace frontend\modules\shop\controllers;

use common\classes\Debug;
use common\models\db\CategoryFields;
use common\models\db\ProductFields;
use common\models\db\ProductFieldsValue;
use common\models\db\ProductsImg;
use frontend\modules\company\models\Company;
use frontend\modules\shop\models\CategoryShop;
use frontend\modules\shop\models\Products;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class ServiceController extends Controller
{
    public $layout = "personal_area";

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
                    /*[
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],*/
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new Products();
        $beforeCreate = $model->beforeCreate();
        if (!$beforeCreate) {
            return $this->render('not-add');
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->company->verifikation === 1){
                $model->status = 1;
            } else {
                $model->status = 0;
            }
            $model->type = Products::TYPE_SERVICE;
            if (!empty($_POST['productImg'])) {
                $model->cover = $_POST['productImg'][1];
            }

            $model->save();
            if (!empty($_POST['ProductField'])) {
                $model->saveProductFields($_POST['ProductField'], $model->id);
            }

            if (!empty($_POST['productImg'])) {
                $i = 0;
                foreach ((array)$_POST['productImg'] as $photo) {
                    if (!empty($photo)) {
                        $prodImg = new ProductsImg();
                        $prodImg->img = $photo;
                        $prodImg->img_thumb = $_POST['productImgThumb'][$i];
                        $prodImg->product_id = $model->id;
                        $prodImg->save();
                    }
                    $i++;
                }
            }

            //if (!empty($_FILES['file']['name'][0])) {
            //    $model->saveProductPhoto($_FILES, $model->id);
            //}
            Yii::$app->session->setFlash('success',
                'Ваш товар успешно сохранен. После прохождения модерации он будет опубликован.');
            return $this->redirect(['/personal_area/user-products']);
        }
        /* $str = 'image (1).jpg';
         Debug::dd(str_replace( array('(',')'), '_', $str));*/
        //$userCompany =Company::find()->where(['user_id' => Yii::$app->user->id])->all();
        return $this->render('create', [
            'model' => $model,
            'userCompany' => ArrayHelper::getColumn($beforeCreate, 'company'),
        ]);
    }

    public function actionGeneralModal()
    {
        $category = CategoryShop::find()->where(['parent_id' => 0, 'type' => CategoryShop::TYPE_SERVICE])->all();
        echo $this->renderPartial('modal', ['category' => $category]);
    }

    public function actionShowCategory()
    {
        $id = $_POST['id'];
        //$id = 1;
        $parent_category = CategoryShop::find()->where(['parent_id' => $id, 'type' => CategoryShop::TYPE_PRODUCT])->all();

        if (!empty($parent_category)) {
            $category = CategoryShop::find()->where(['parent_id' => 0, 'type' => CategoryShop::TYPE_PRODUCT])->all();
            $catName = CategoryShop::find()->where(['id' => $id, 'type' => CategoryShop::TYPE_PRODUCT])->one();
            //$catName = json_decode($catName);
            echo $this->renderPartial('sel_cat',
                [
                    'category' => $category,
                    'parent_category' => $parent_category,
                    'title' => $catName->name,
                    'id' => $id,
                ]
            );
        } else {
            return false;
        }

    }

    public function actionShowParentModalCategory()
    {
        $id = $_POST['id'];
        $category = $category = CategoryShop::find()->where(['parent_id' => $id, 'type' => CategoryShop::TYPE_PRODUCT])->all();
        //$category = json_decode($category);
        $catName = CategoryShop::find()->where(['id' => $id, 'type' => CategoryShop::TYPE_PRODUCT])->one();
        //$catName = json_decode($catName);
        //Debug::prn($category);
        if (!empty($category)) {
            echo $this->renderPartial('shw_category',
                [
                    'category' => $category,
                    'title' => $catName->name,
                ]);
        } else {
            return false;
        }
    }

    public function actionShowCategoryEnd()
    {
        $id = Yii::$app->request->post('id');
        //$id = 2;
        $model = new Products();
        $categoryList = $model->getListCategory($id, []);
        //$categoryList = json_decode($categoryList);
        echo $this->renderPartial('categoryList',
            [
                'category' => array_reverse($categoryList),
            ]
        );

    }

    public function actionShowAdditionalFields()
    {
        $id = Yii::$app->request->post('id');
        //$id = 2;
        $groupFieldsId = CategoryFields::find()
            ->joinWith('fields.productFieldsDefaultValues')
            ->where(['category_id' => $id])
            ->groupBy('id')
            //->with('fields.productFieldsDefaultValues');
            //Debug::dd($groupFieldsId->createCommand()->rawSql);
            ->all();

        // Debug::dd($groupFieldsId);

        $html = '';
        if (!empty($groupFieldsId)) {
            foreach ($groupFieldsId as $item) {
                $html .= $this->renderPartial('add_fields', ['adsFields' => $item]);
            }
        }
        return $html;

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

        Yii::$app->session->setFlash('success', 'Ваш товар успешно удален.');
        return $this->redirect(['/personal_area/user-products', 'page' => Yii::$app->request->get('page', 1)]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $this->layout = 'personal_area';
        $model = Products::find()
            ->where(['id' => $id, 'type' => Products::TYPE_PRODUCT])
            ->with('productFieldsValues')
            ->one();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!empty($_POST['productImg'])) {
                $model->cover = $_POST['productImg'][1];

                ProductsImg::deleteAll(['product_id' => $model->id]);
                $i = 0;
                foreach ((array)$_POST['productImg'] as $photo) {
                    if (!empty($photo)) {
                        $prodImg = new ProductsImg();
                        $prodImg->img = $photo;
                        $prodImg->img_thumb = $_POST['productImgThumb'][$i];
                        $prodImg->product_id = $model->id;
                        $prodImg->save();
                    }
                    $i++;
                }

            }
            if ($model->company->verifikation === 1){
                $model->status = 1;
            } else {
                $model->status = 0;
            }
            $model->save();
            ProductFieldsValue::deleteAll(['product_id' => $model->id]);

            if (!empty($_POST['ProductField'])) {
                // Debug::dd($_POST['ProductField']);
                $model->saveProductFields($_POST['ProductField'], $model->id);
            }

            Yii::$app->session->setFlash('success',
                'Ваш товар успешно сохранен. После прохождения модерации он будет опубликован.');
            return $this->redirect('/personal_area/user-products');
        } else {
            $userCompany = Company::find()->where(['user_id' => Yii::$app->user->id])->all();
            $categoryList = $model->getListCategory($model->category_id, []);
            $categorySelect = $this->renderPartial('categoryList', ['category' => array_reverse($categoryList)]);

            $groupFieldsId = CategoryFields::find()
                ->joinWith('fields.productFieldsDefaultValues')
                ->where(['category_id' => $model->category_id])
                ->groupBy('id')
                ->all();

            $adsField = '';
            if (!empty($groupFieldsId)) {
                foreach ($groupFieldsId as $item) {
                    $adsField .= $this->renderPartial('add_fields_update',
                        [
                            'adsFields' => $item,
                            'model' => $model['productFieldsValues'],
                        ]);
                }
            }

            return $this->render('update',
                [
                    'model' => $model,
                    'userCompany' => $userCompany,
                    'categorySelect' => $categorySelect,
                    'adsField' => $adsField,
                ]
            );
        }
    }

    public function actionDeleteImg()
    {
        ProductsImg::deleteAll(['id' => Yii::$app->request->get('id')]);
        echo 1;
    }
}
