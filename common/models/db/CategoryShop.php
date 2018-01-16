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
 */
class CategoryShop extends \yii\db\ActiveRecord
{
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
            [['parent_id'], 'integer'],
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
