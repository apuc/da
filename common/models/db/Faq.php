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
            [['dt_add', 'dt_update', 'views', 'user_id', 'company_id', 'cat_id', 'sort_order'], 'integer'],
            [['question', 'slug', 'type'], 'string', 'max' => 255],
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
        ];
    }
}
