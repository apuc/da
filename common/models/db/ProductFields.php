<?php

namespace common\models\db;

use common\classes\Debug;
use Yii;

/**
 * This is the model class for table "product_fields".
 *
 * @property int $id
 * @property int $type_id
 * @property string $label
 * @property string $template
 * @property string $name
 * @property int $interval
 *
 * @property ProductFieldsType $type
 * @property ProductFieldsDefaultValue[] $productFieldsDefaultValues
 */
class ProductFields extends \yii\db\ActiveRecord
{
    public $category;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'label', 'category'], 'required'],
            [['type_id', 'interval'], 'integer'],
            [['label', 'template', 'name'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductFieldsType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Тип',
            'label' => 'Заголовок',
            'template' => 'Шаблон',
            'name' => 'Название',
            'interval' => 'Включить интервал для поиска',
            'category' => 'Категория',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ProductFieldsType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductFieldsDefaultValues()
    {
        return $this->hasMany(ProductFieldsDefaultValue::className(), ['product_field_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldsCategory()
    {
        return $this->hasMany(CategoryFields::className(), ['fields_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);
        if(!$this->isNewRecord){
            CategoryFields::deleteAll(['fields_id' => $this->id]);
        }

        $this->saveCategoryField($this->category, $this->id);
    }

    protected function saveCategoryField($category, $id)
    {
        foreach ($category as $item) {
            $fieldCategory = new CategoryFields();
            $fieldCategory->category_id = $item;
            $fieldCategory->fields_id = $id;
            $fieldCategory->save();
        }
    }
}
