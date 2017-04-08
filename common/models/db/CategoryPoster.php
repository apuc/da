<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_poster".
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
 * @property string $slug
 * @property integer $lang_id
 */
class CategoryPoster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_poster';
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
            'id' => Yii::t('poster', 'ID'),
            'parent_id' => Yii::t('poster', 'Parent ID'),
            'title' => Yii::t('poster', 'Title'),
            'descr' => Yii::t('poster', 'Descr'),
            'dt_add' => Yii::t('poster', 'Dt Add'),
            'dt_update' => Yii::t('poster', 'Dt Update'),
            'icon' => Yii::t('poster', 'Icon'),
            'meta_title' => Yii::t('poster', 'Meta Title'),
            'meta_descr' => Yii::t('poster', 'Meta Descr'),
            'slug' => Yii::t('poster', 'Slug'),
            'lang_id' => Yii::t('poster', 'Lang ID'),
        ];
    }

    public function getCategoriesPoster()
    {
        return $this->hasMany(CategoryPosterRelations::className(), ['cat_id' => 'id']);
    }

    public function getPoster()
    {
        return $this->hasMany(Poster::className(), ['id' => 'poster_id'])->via('categoriesPoster');
    }

}
