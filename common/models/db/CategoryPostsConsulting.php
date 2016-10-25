<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_posts_consulting".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property string $slug
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $icon
 * @property string $type
 */
class CategoryPostsConsulting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_posts_consulting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_id', 'dt_add', 'dt_update'], 'integer'],
            [['title', 'slug', 'icon', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('faq', 'ID'),
            'title' => Yii::t('faq', 'Title'),
            'parent_id' => Yii::t('faq', 'Parent ID'),
            'slug' => Yii::t('faq', 'Slug'),
            'dt_add' => Yii::t('faq', 'Dt Add'),
            'dt_update' => Yii::t('faq', 'Dt Update'),
            'icon' => Yii::t('faq', 'Icon'),
            'type' => Yii::t('faq', 'Type'),
        ];
    }
}
