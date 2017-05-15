<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vk_photo".
 *
 * @property integer $id
 * @property integer $vk_id
 * @property integer $vk_user_id
 * @property string $photo_75
 * @property string $photo_807
 * @property string $photo_1280
 * @property integer $post_id
 * @property integer $owner_id
 * @property string $access_key
 */
class VkPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vk_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vk_id'], 'required'],
            [['vk_id', 'vk_user_id', 'post_id', 'owner_id'], 'integer'],
            [['photo_75', 'photo_807', 'photo_1280', 'access_key'], 'string', 'max' => 255],
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
            'vk_user_id' => 'Vk User ID',
            'photo_75' => 'Photo 75',
            'photo_807' => 'Photo 807',
            'photo_1280' => 'Photo 1280',
            'post_id' => 'Post ID',
            'owner_id' => 'Owner ID',
            'access_key' => 'Access Key',
        ];
    }
}
