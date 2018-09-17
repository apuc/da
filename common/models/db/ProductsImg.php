<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "products_img".
 *
 * @property int $id
 * @property string $img
 * @property string $img_thumb
 * @property int $product_id
 *
 * @property Products $product
 */
class ProductsImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img', 'img_thumb', 'product_id'], 'required'],
            [['product_id'], 'integer'],
            [['img', 'img_thumb'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Img',
            'img_thumb' => 'Img Thumb',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
