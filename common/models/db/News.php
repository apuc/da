<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $slug
 * @property string $tags
 * @property string $photo
 * @property integer $status
 * @property integer $user_id
 * @property integer $lang_id
 * @property integer $views
 * @property string $meta_title
 * @property string $meta_descr
 * @property integer $dt_public
 * @property integer $exclude_popular
 *
 * @property CategoryNewsRelations[] $categoryNewsRelations
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content'], 'string'],
            [['dt_add', 'dt_update', 'status', 'user_id', 'lang_id', 'views', 'exclude_popular', 'rss'], 'integer'],
            [['title', 'slug', 'tags', 'photo', 'meta_title', 'meta_descr'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('news', 'ID'),
            'title' => Yii::t('news', 'Title'),
            'content' => Yii::t('news', 'Content'),
            'dt_add' => Yii::t('news', 'Dt Add'),
            'dt_update' => Yii::t('news', 'Dt Update'),
            'slug' => Yii::t('news', 'Slug'),
            'tags' => Yii::t('news', 'Tags'),
            'photo' => Yii::t('news', 'Photo'),
            'status' => Yii::t('news', 'Status'),
            'user_id' => Yii::t('news', 'User ID'),
            'lang_id' => Yii::t('news', 'Lang ID'),
            'views' => Yii::t('news', 'Views'),
            'meta_title' => Yii::t('news', 'Meta Title'),
            'meta_descr' => Yii::t('news', 'Meta Descr'),
            'dt_public' => Yii::t('news', 'Dt Public'),
            'exclude_popular' => Yii::t('news', 'Exclude popular'),
            'rss' => Yii::t('news', 'Rss'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryNewsRelations()
    {
        return $this->hasMany(CategoryNewsRelations::className(), ['new_id' => 'id']);
    }
}
