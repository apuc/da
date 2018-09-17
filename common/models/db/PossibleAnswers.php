<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "possible_answers".
 *
 * @property integer $id
 * @property string $title
 * @property integer $question
 */
class PossibleAnswers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'possible_answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['question'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'question' => 'Question',
        ];
    }
}
