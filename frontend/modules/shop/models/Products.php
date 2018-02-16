<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 08.02.18
 * Time: 11:03
 */

namespace frontend\modules\shop\models;

use common\classes\Debug;
use common\models\db\ProductFields;
use common\models\db\ProductFieldsDefaultValue;
use common\models\db\ProductFieldsType;
use common\models\db\ProductFieldsValue;
use common\models\db\ProductsImg;
use Yii;
use yii\db\ActiveRecord;
use yii\imagine\Image;

class Products extends \common\models\db\Products
{
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add', 'dt_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_update'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['user_id'] = ['user_id', 'default', 'value' => \Yii::$app->user->id];
        return $rules;
    }

    /**
     * Получить список всех категорий начиная с последней(Только заголовки категорий)
     * @param $id
     * @param $arr
     * @return array
     */

    public function getListCategory($id, $arr)
    {
        $category = CategoryShop::find()->where(['id' => $id])->one();
        $arr[] = $category->name;

        if ($category->parent_id != 0) {
            $arr = self::getListCategory($category->parent_id, $arr);
        } else {
            $arr[] = $category->icon;
        }
        //$arrEnd = array_reverse($arr);
        return $arr;
    }


    //Сохранение доп полей товара
    public function saveProductFields($productFields, $productId)
    {
        if(!empty($productFields)){
            foreach ($productFields as $name=>$value) {
                if(!empty($value)){
                    $productFieldsOne = ProductFields::find()->where(['name' => $name])->one();

                    $type = ProductFieldsType::find()->where(['id' => $productFieldsOne->type])->one()->type;

                    $productFieldVal = new ProductFieldsValue();

                    $productFieldVal->product_id = $productId;
                    if($type == 'text'){
                        $productFieldVal->product_fields_name = $name;
                        $productFieldVal->value = $value;
                    }
                    if($type == 'select'){
                        $productFieldVal->product_fields_name = $name;
                        $productFieldVal->value = ProductFieldsDefaultValue::find()->where(['id'=>$value])->one()->value;
                        $productFieldVal->value_id = $value;
                    }

                    $productFieldVal->save();
                }
            }
        }
    }

    //Сохранение фото товара
    public function saveProductPhoto($files, $productId)
    {
        if (!file_exists('media/users/' . Yii::$app->user->id)) {
            mkdir('media/users/' . Yii::$app->user->id . '/');
        }
        if (!file_exists('media/users/' . Yii::$app->user->id . '/' . date('Y-m-d'))) {
            mkdir('media/users/' . Yii::$app->user->id . '/' . date('Y-m-d'));
        }
        if (!file_exists('media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/thumb')) {
            mkdir('media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/thumb');
        }

        $dir = 'media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/';
        $dirThumb = $dir . 'thumb/';
        $i = 0;
//Debug::dd($_SERVER['DOCUMENT_ROOT']);
        foreach ($files['file']['name'] as $file) {
            Image::watermark($files['file']['tmp_name'][$i],
                $_SERVER['DOCUMENT_ROOT'] . '/frontend/web/img/logo_watermark.png')
                ->save($dir . $files['file']['name'][$i], ['quality' => 100]);

            Image::thumbnail($files['file']['tmp_name'][$i], 142, 100,
                $mode = \Imagine\Image\ManipulatorInterface::THUMBNAIL_OUTBOUND)
                ->save($dirThumb . $file, ['quality' => 100]);

            $prodImg = new ProductsImg();
            $prodImg->img = $dir . $files['file']['name'][$i];
            $prodImg->img_thumb = $dirThumb . $file;
            $prodImg->product_id = $productId;
            $prodImg->save();

            $i++;
        }
    }
}