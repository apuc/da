<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "product_fields_value".
 *
 * @property int $id
 * @property int $product_id
 * @property string $product_fields_name
 * @property string $value
 * @property int $value_id
 *
 * @property ProductFieldsDefaultValue $value0
 * @property Products $product
 */
class ProductFieldsValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_fields_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'value_id'], 'integer'],
            [['product_fields_name', 'value'], 'string', 'max' => 255],
            [['value_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductFieldsDefaultValue::className(), 'targetAttribute' => ['value_id' => 'id']],
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
            'product_id' => 'Product ID',
            'product_fields_name' => 'Product Fields Name',
            'value' => 'Value',
            'value_id' => 'Value ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValue0()
    {
        return $this->hasOne(ProductFieldsDefaultValue::className(), ['id' => 'value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
