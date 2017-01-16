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
            [['dt_add', 'dt_update', 'views', 'status','rss'], 'integer'],
            [['dt_event', 'dt_event_end'],'safe'],
            [['descr', 'short_descr'], 'string'],
            [['title', 'slug', 'price', 'meta_title', 'meta_descr', 'photo'], 'string', 'max' => 255],
            [['start'], 'string', 'max' => 512],
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
        ];
    }
}
