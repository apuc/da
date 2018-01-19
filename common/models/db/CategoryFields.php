<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_fields".
 *
 * @property int $id
 * @property int $category_id
 * @property int $fields_id
 */
class CategoryFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'fields_id'], 'required'],
            [['category_id', 'fields_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'fields_id' => 'Fields ID',
        ];
    }
}
