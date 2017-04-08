<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_news".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $descr
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $icon
 * @property string $meta_title
 * @property string $meta_descr
 * @property integer $lang_id
 * @property string $slug
 *
 * @property CategoryNewsRelations[] $categoryNewsRelations
 */
class CategoryNews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'dt_add', 'dt_update', 'lang_id'], 'integer'],
            [['title'], 'required'],
            [['descr'], 'string'],
            [['title', 'icon', 'meta_title', 'meta_descr', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('category_news', 'ID'),
            'parent_id' => Yii::t('category_news', 'Parent ID'),
            'title' => Yii::t('category_news', 'Title'),
            'descr' => Yii::t('category_news', 'Descr'),
            'dt_add' => Yii::t('category_news', 'Dt Add'),
            'dt_update' => Yii::t('category_news', 'Dt Update'),
            'icon' => Yii::t('category_news', 'Icon'),
            'meta_title' => Yii::t('category_news', 'Meta Title'),
            'meta_descr' => Yii::t('category_news', 'Meta Descr'),
            'lang_id' => Yii::t('category_news', 'Lang ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryNewsRelations()
    {
        return $this->hasMany(CategoryNewsRelations::className(), ['cat_id' => 'id'])->with('new');
    }
}
