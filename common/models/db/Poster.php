<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "poster".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $descr
 * @property string $short_descr
 * @property string $price
 * @property string $start
 * @property integer $views
 * @property integer $status
 * @property string $meta_title
 * @property string $meta_descr
 * @property string $photo
 * @property integer $dt_event
 * @property integer $dt_event_end
 * @property string $address
 * @property integer $popular
 * @property integer $phone
 * @property integer $metka
 * @property integer $user_id
 * @property integer $region_id
 */
class Poster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'dt_event', 'dt_event_end'], 'required'],
            [['dt_add', 'dt_update', 'views', 'status', 'rss', 'popular', 'user_id', 'region_id'], 'integer'],
            [['dt_event', 'dt_event_end', 'user_id'], 'safe'],
            [['descr', 'short_descr'], 'string'],
            [['title', 'slug', 'price', 'meta_title', 'meta_descr', 'photo', 'address'], 'string', 'max' => 255],
            [['start', 'phone'], 'string', 'max' => 512],
            [['metka'], 'string', 'max' => 25],
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
            'slug' => Yii::t('poster', 'Slug'),
            'dt_add' => Yii::t('poster', 'Dt Add'),
            'dt_update' => Yii::t('poster', 'Dt Update'),
            'descr' => Yii::t('poster', 'Descr'),
            'short_descr' => Yii::t('poster', 'Short Descr'),
            'price' => Yii::t('poster', 'Price'),
            'start' => Yii::t('poster', 'Start'),
            'views' => Yii::t('poster', 'Views'),
            'status' => Yii::t('poster', 'Status'),
            'meta_title' => Yii::t('poster', 'Meta Title'),
            'meta_descr' => Yii::t('poster', 'Meta Descr'),
            'photo' => Yii::t('poster', 'Photo'),
            'dt_event' => Yii::t('poster', 'Dt Event'),
            'dt_event_end' => Yii::t('poster', 'Dt Event End'),
            'rss' => Yii::t('poster', 'Rss'),
            'address' => Yii::t('poster', 'Address'),
            'popular' => Yii::t('poster', 'Popular'),
            'phone' => Yii::t('poster', 'Phone'),
            'metka' => Yii::t('poster', 'Metka'),
            'user_id' => Yii::t('poster', 'user_id'),
            'region_id' => Yii::t('poster', 'region'),
            'categories' => Yii::t('poster', 'Categories'),
        ];
    }

    public function getPosterCategories()
    {
        return $this->hasMany(CategoryPosterRelations::className(), ['poster_id' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(CategoryPoster::className(), ['id' => 'cat_id'])->via('posterCategories');
    }

    public function getCategory()
    {
        return $this->hasOne(CategoryPoster::className(), ['id' => 'cat_id'])->via('posterCategories');
    }

    public function getTagss()
    {
        return $this->hasMany(\backend\modules\tags\models\TagsRelation::className(), ['post_id' => 'id']);
    }



}
