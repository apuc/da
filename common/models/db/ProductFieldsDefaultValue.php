<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "product_fields_default_value".
 *
 * @property int $id
 * @property string $value
 * @property int $product_field_id
 *
 * @property ProductFields $productField
 */
class ProductFieldsDefaultValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_fields_default_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'product_field_id'], 'required'],
            [['product_field_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['product_field_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductFields::className(), 'targetAttribute' => ['product_field_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Значение',
            'product_field_id' => 'Поле',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductField()
    {
        return $this->hasOne(ProductFields::className(), ['id' => 'product_field_id']);
    }
}
