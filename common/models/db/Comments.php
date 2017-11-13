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
 * @property integer $parent_id
 * @property integer $moder_checked
 * @property integer $published
 * @property integer $verified
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
            [['post_id', 'user_id', 'dt_add', 'parent_id', 'moder_checked', 'published', 'verified'], 'integer'],
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
            'parent_id' => Yii::t('comments', 'Parent'),
            'moder_checked' => Yii::t('comments', 'Отмечено модератором'),
            'published' => Yii::t('comments', 'Опубликовано'),
        ];
    }

    public function getChildComments()
    {
        return $this->hasMany(Comments::className(), ['parent_id' => 'id'])->andWhere(['published' => 1])->with('user');
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
