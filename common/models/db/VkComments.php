<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vk_comments".
 *
 * @property integer $id
 * @property string $vk_id
 * @property integer $from_id
 * @property integer $owner_id
 * @property integer $post_id
 * @property integer $dt_add
 * @property string $text
 */
class VkComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vk_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_id', 'owner_id', 'post_id', 'dt_add'], 'integer'],
            [['text'], 'string'],
            [['vk_id'], 'string', 'max' => 255],
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
            'post_id' => 'Post ID',
            'dt_add' => 'Dt Add',
            'text' => 'Text',
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(VkAuthors::className(), ['vk_id' => 'from_id']);
    }
}
