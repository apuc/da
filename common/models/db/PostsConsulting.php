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
            [['dt_add', 'dt_update', 'user_id', 'cat_id', 'views'], 'integer'],
            [['title', 'slug', 'photo', 'type'], 'string', 'max' => 255],
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
            'content' => Yii::t('faq', 'Content'),
            'dt_add' => Yii::t('faq', 'Dt Add'),
            'dt_update' => Yii::t('faq', 'Dt Update'),
            'slug' => Yii::t('faq', 'Slug'),
            'photo' => Yii::t('faq', 'Photo'),
            'user_id' => Yii::t('faq', 'User ID'),
            'type' => Yii::t('faq', 'Type'),
            'cat_id' => Yii::t('faq', 'Cat ID'),
            'views' => Yii::t('faq', 'Views'),
        ];
    }
}
