<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $possible_answers_id
 * @property integer $user_id
 * @property integer $user_ip
 * @property integer $dt_add
 */
class Answers extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'answers';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [ [ 'question_id', 'possible_answers_id', 'user_id', 'dt_add' ], 'integer' ],
            [ [ 'user_ip' ], 'safe' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'                  => Yii::t( 'answers', 'ID' ),
            'question_id'         => Yii::t( 'answers', 'Question ID' ),
            'possible_answers_id' => Yii::t( 'answers', 'Possible Answers ID' ),
            'user_id'             => Yii::t( 'answers', 'User ID' ),
            'dt_add'              => Yii::t( 'answers', 'Dt Add' ),
        ];
    }
}
