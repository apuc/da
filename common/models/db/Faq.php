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
            [['question'], 'required'],
            [['answer'], 'string'],
            [['dt_add', 'dt_update', 'views', 'user_id', 'company_id'], 'integer'],
            [['question', 'slug', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('faq', 'ID'),
            'question' => Yii::t('faq', 'Question'),
            'answer' => Yii::t('faq', 'Answer'),
            'dt_add' => Yii::t('faq', 'Dt Add'),
            'dt_update' => Yii::t('faq', 'Dt Update'),
            'slug' => Yii::t('faq', 'Slug'),
            'views' => Yii::t('faq', 'Views'),
            'user_id' => Yii::t('faq', 'User ID'),
            'type' => Yii::t('faq', 'Type'),
            'company_id' => Yii::t('faq', 'Company ID'),
        ];
    }
}
