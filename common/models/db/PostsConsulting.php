<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "posts_consulting".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $slug
 * @property string $photo
 * @property integer $user_id
 * @property string $type
 * @property integer $cat_id
 * @property integer $views
 * @property integer $sort_order
 * @property string $meta_title
 * @property string $meta_descr
 */
class PostsConsulting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts_consulting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type', 'cat_id'], 'required'],
            [['content'], 'string'],
            [['dt_add', 'dt_update', 'user_id', 'cat_id', 'views', 'sort_order'], 'integer'],
            [['title', 'slug', 'photo', 'type', 'meta_title', 'meta_descr'], 'string', 'max' => 255],
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
            'content' => Yii::t('poster', 'Content'),
            'dt_add' => Yii::t('poster', 'Dt Add'),
            'dt_update' => Yii::t('poster', 'Dt Update'),
            'slug' => Yii::t('poster', 'Slug'),
            'photo' => Yii::t('poster', 'Photo'),
            'user_id' => Yii::t('poster', 'User ID'),
            'type' => Yii::t('poster', 'Type'),
            'cat_id' => Yii::t('poster', 'Cat ID'),
            'views' => Yii::t('poster', 'Views'),
            'sort_order' => Yii::t('poster', 'Sort Order'),
            'meta_title' => Yii::t('poster', 'Meta Title'),
            'meta_descr' => Yii::t('poster', 'Meta Descr'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPostsConsulting()
    {
        return $this->hasOne(CategoryPostsConsulting::className(), ['id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsulting()
    {
        return $this->hasOne(Consulting::className(), ['slug'=> 'type']);
    }

}
