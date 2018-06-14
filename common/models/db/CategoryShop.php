<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_shop".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $parent_id
 * @property string $icon
 * @property string $meta_title
 * @property string $meta_description
 * @property integer $type
 */
class CategoryShop extends \yii\db\ActiveRecord
{

    const TYPE_PRODUCT = 0;
    const TYPE_SERVICE = 1;

    public static $productTypes = [
        self::TYPE_PRODUCT => 'Товар',
        self::TYPE_SERVICE => 'Услуга'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_shop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'meta_title', 'meta_description'], 'required'],
            [['parent_id', 'type'], 'integer'],
            [['name', 'slug', 'icon', 'meta_title', 'meta_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'slug' => 'Slug',
            'parent_id' => 'Родитель',
            'icon' => 'Изображение',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
        ];
    }
}
