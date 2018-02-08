<?php

namespace frontend\modules\shop\controllers;

use common\classes\Debug;
use common\models\db\CategoryFields;
use common\models\db\ProductFields;
use frontend\modules\shop\models\CategoryShop;
use frontend\modules\shop\models\Products;
use Yii;
use yii\web\Controller;

class ProductsController extends Controller
{
    public $layout = "personal_area";
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post()) /*&& $model->save()*/) {
            Debug::dd($model);
            //return $this->redirect(['index']);
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionGeneralModal()
    {
        $category = CategoryShop::find()->where(['parent_id' => 0])->all();
        echo $this->renderPartial('modal', ['category' => $category]);
    }

    public function actionShowCategory()
    {
        $id = $_POST['id'];
        //$id = 1;
        $parent_category = CategoryShop::find()->where(['parent_id' => $id])->all();

        if (!empty($parent_category)) {
            $category = CategoryShop::find()->where(['parent_id' => 0])->all();
            $catName = CategoryShop::find()->where(['id' => $id])->one();
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
        $category = $category = CategoryShop::find()->where(['parent_id' => $id])->all();
        //$category = json_decode($category);
        $catName = CategoryShop::find()->where(['id' => $id])->one();
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
        $categoryList = $model->getListCategory($id,[]);
        //$categoryList = json_decode($categoryList);
        echo $this->renderPartial('categoryList',
            [
                'category' => array_reverse($categoryList),
            ]
        );

    }

    public function actionShowAdditionalFields()
    {
        //$id = Yii::$app->request->post('id');
        $id = 3;
        $groupFieldsId = CategoryFields::find()
            ->where(['category_id' => $id])
            ->all();
//Debug::prn($groupFieldsId);
        $html = '';
        if (!empty($groupFieldsId)) {
            /*foreach ($adsFields as $adsField) {
                $adsFieldsAll = AdsFields::find()
                    ->leftJoin('ads_fields_type', '`ads_fields_type`.`id` = `ads_fields`.`type_id`')
                    ->leftJoin('ads_fields_default_value',
                        '`ads_fields_default_value`.`ads_field_id` = `ads_fields`.`id`')
                    ->where(['`ads_fields`.`id`' => $adsField->fields_id])
                    ->with('ads_fields_type', 'ads_fields_default_value')
                    ->all();
                $html .= $this->renderPartial('add_fields', ['adsFields' => $adsFieldsAll]);
            }*/

            $fields = json_decode($groupFieldsId);
            foreach ($fields as $item) {
                $html .= $this->renderPartial('add_fields', ['adsFields' => $item]);
            }

        }
        echo $html;

    }

}
