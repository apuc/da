<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "faq".
 *
 * @property integer $id
 * @property string $question
 * @property string $answer
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $slug
 * @property integer $views
 * @property integer $user_id
 * @property string $type
 * @property integer $company_id
 * @property integer $cat_id
 * @property integer $sort_order
 * @property string $meta_title
 * @property string $meta_descr
 * @property integer $main_page
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'answer', 'type', 'company_id', 'cat_id'], 'required'],
            [['answer'], 'string'],
            [['dt_add', 'dt_update', 'views', 'user_id', 'company_id', 'cat_id', 'sort_order', 'main_page'], 'integer'],
            [['question', 'slug', 'type', 'meta_title', 'meta_descr'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('poster', 'ID'),
            'question' => Yii::t('poster', 'Question'),
            'answer' => Yii::t('poster', 'Answer'),
            'dt_add' => Yii::t('poster', 'Dt Add'),
            'dt_update' => Yii::t('poster', 'Dt Update'),
            'slug' => Yii::t('poster', 'Slug'),
            'views' => Yii::t('poster', 'Views'),
            'user_id' => Yii::t('poster', 'User ID'),
            'type' => Yii::t('poster', 'Type'),
            'company_id' => Yii::t('poster', 'Company ID'),
            'cat_id' => Yii::t('poster', 'Cat ID'),
            'sort_order' => Yii::t('poster', 'Sort Order'),
            'meta_title' => Yii::t('poster', 'Meta Title'),
            'meta_descr' => Yii::t('poster', 'Meta Descr'),
            'main_page' => Yii::t('poster', 'Main page'),
        ];
    }

    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id'])->with('user');
    }

    public function getCategory()
    {
        return $this->hasOne(CategoryFaq::className(), ['id' => 'cat_id']);
    }

    public function getConsulting()
    {
        return $this->hasOne(Consulting::className(), ['slug' => 'type']);
    }
}
