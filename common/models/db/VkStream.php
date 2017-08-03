<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vk_stream".
 *
 * @property integer $id
 * @property string $vk_id
 * @property integer $from_id
 * @property integer $owner_id
 * @property integer $owner_type
 * @property integer $dt_add
 * @property string $post_type
 * @property string $text
 * @property integer $from_type
 * @property integer $status
 * @property integer $views
 * @property integer $likes
 */
class VkStream extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vk_stream';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vk_id'], 'required'],
            [['from_id', 'owner_id', 'owner_type', 'dt_add', 'from_type', 'status', 'views', 'likes'], 'integer'],
            [['text'], 'string'],
            [['vk_id', 'post_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vk_id' => 'Vk ID',
            'from_id' => 'From ID',
            'owner_id' => 'Owner ID',
            'owner_type' => 'Owner Type',
            'dt_add' => 'Dt Add',
            'post_type' => 'Post Type',
            'text' => 'Text',
            'from_type' => 'From Type',
            'status' => 'Статус',
            'views' => 'Просмотры',
            'likes' => 'Лайки',
        ];
    }

    public function getPhoto()
    {
        return $this->hasMany(VkPhoto::className(), ['post_id' => 'id']);
    }

    public function getComments()
    {
        return $this->hasMany(VkComments::className(), ['post_id' => 'id'])->with('author');
    }

    public function getAuthor()
    {
        return $this->hasOne(VkAuthors::className(), ['vk_id' => 'from_id']);
    }

    public function getGroup()
    {
        return $this->hasOne(VkGroups::className(), ['vk_id' => 'from_id']);
    }

    public function getLikesCount()
    {
        return Likes::find()->where(['post_type' => 'stream', 'post_id' => $this->id])->count();
    }

    public static function getPosts($limit = 10, $offset = 0)
    {
        return self::find()
            ->where(['status' => 1])
            ->orderBy('`vk_stream`.`dt_add` DESC')
            ->limit($limit)
            ->offset($offset)
            ->with('photo', 'comments', 'author', 'group')
            ->all();
    }

    public static function getPublishedCount()
    {
        return self::find()
            ->where(['status' => 1])
            ->count();
    }
}
