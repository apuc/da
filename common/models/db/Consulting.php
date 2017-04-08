<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "consulting".
 *
 * @property integer $id
 * @property string $title
 * @property string $descr
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $slug
 * @property string $icon
 * @property integer $views
 * @property integer $company_id
 * @property string $title_digest
 * @property integer $about_company
 * @property integer $documents
 * @property integer $posts
 * @property integer $faq
 * @property string $meta_title
 * @property string $meta_descr
 */
class Consulting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consulting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'company_id', 'title_digest'], 'required'],
            [['descr'], 'string'],
            [['dt_add', 'dt_update', 'views', 'company_id', 'about_company', 'documents', 'posts', 'faq'], 'integer'],
            [['title', 'slug', 'icon', 'title_digest', 'meta_title', 'meta_descr'], 'string', 'max' => 255],
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
            'descr' => Yii::t('poster', 'Descr'),
            'dt_add' => Yii::t('poster', 'Dt Add'),
            'dt_update' => Yii::t('poster', 'Dt Update'),
            'slug' => Yii::t('poster', 'Slug'),
            'icon' => Yii::t('poster', 'Icon'),
            'views' => Yii::t('poster', 'Views'),
            'company_id' => Yii::t('poster', 'Company ID'),
            'title_digest' => Yii::t('poster', 'Title Digest'),
            'about_company' => Yii::t('poster', 'About Company'),
            'documents' => Yii::t('poster', 'Documents'),
            'posts' => Yii::t('poster', 'Posts'),
            'faq' => Yii::t('poster', 'Faq'),
            'meta_title' => Yii::t('poster', 'Meta Title'),
            'meta_descr' => Yii::t('poster', 'Meta Descr'),
        ];
    }
}
