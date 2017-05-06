<?php

namespace common\models\db;

use common\models\User;
use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property string $post_type
 * @property integer $post_id
 * @property integer $user_id
 * @property string $content
 * @property integer $dt_add
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'user_id', 'dt_add'], 'integer'],
            [['content'], 'string'],
            [['post_type'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('comments', 'ID'),
            'post_type' => Yii::t('comments', 'Post Type'),
            'post_id' => Yii::t('comments', 'Post ID'),
            'user_id' => Yii::t('comments', 'User ID'),
            'content' => Yii::t('comments', 'Content'),
            'dt_add' => Yii::t('comments', 'Dt Add'),
        ];
    }

    public function getChildComments()
    {
        return $this->hasMany(Comments::className(), ['id' => 'parent_id'])->with('user');
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
