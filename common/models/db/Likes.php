<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "likes".
 *
 * @property integer $id
 * @property string $post_type
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $dt_add
 */
class Likes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'likes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'user_id', 'dt_add'], 'integer'],
            [['post_type'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('answers', 'ID'),
            'post_type' => Yii::t('answers', 'Post Type'),
            'post_id' => Yii::t('answers', 'Post ID'),
            'user_id' => Yii::t('answers', 'User ID'),
            'dt_add' => Yii::t('answers', 'Dt Add'),
        ];
    }
}
