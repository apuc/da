<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "product_fields_type".
 *
 * @property int $id
 * @property string $type
 *
 * @property ProductFields[] $productFields
 */
class ProductFieldsType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_fields_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductFields()
    {
        return $this->hasMany(ProductFields::className(), ['type_id' => 'id']);
    }
}
