<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_posts_digest".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property string $slug
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $icon
 * @property string $type
 * @property integer $sort_order
 * @property string $meta_title
 * @property string $meta_descr
 */
class CategoryPostsDigest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_posts_digest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_id', 'dt_add', 'dt_update', 'sort_order'], 'integer'],
            [['title', 'slug', 'icon', 'type', 'meta_title', 'meta_descr'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('poster', 'ID'),
            'title' => Yii::t('poster', 'Title'),
            'parent_id' => Yii::t('poster', 'Parent ID'),
            'slug' => Yii::t('poster', 'Slug'),
            'dt_add' => Yii::t('poster', 'Dt Add'),
            'dt_update' => Yii::t('poster', 'Dt Update'),
            'icon' => Yii::t('poster', 'Icon'),
            'type' => Yii::t('poster', 'Type'),
            'sort_order' => Yii::t('poster', 'Sort Order'),
            'meta_title' => Yii::t('poster', 'Meta Title'),
            'meta_descr' => Yii::t('poster', 'Meta Descr'),
        ];
    }
}
