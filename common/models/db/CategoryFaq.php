<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_faq".
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
class CategoryFaq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_faq';
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaq()
    {
        return $this->hasMany(Faq::className(), ['cat_id' => 'id'])->andWhere(['main_page' => 1]);
    }

    public function getConsulting()
    {
        return $this->hasOne(Consulting::className(), ['slug' => 'type']);
    }
}
