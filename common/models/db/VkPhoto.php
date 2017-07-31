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
 * @property integer $comment_id
 * @property integer $owner_id
 * @property string $access_key
 * @property string $vk_post_id
 * @property string $photo_130
 * @property string $photo_604
 * @property string $photo_512
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
            [['vk_id', 'vk_user_id', 'post_id', 'comment_id', 'owner_id', 'vk_post_id'], 'integer'],
            [
                ['photo_75', 'photo_807', 'photo_1280', 'access_key', 'photo_130', 'photo_604', 'photo_512'],
                'string',
                'max' => 255,
            ],
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
            'photo_130' => 'Photo 130',
            'photo_604' => 'Photo 604',
            'photo_512' => 'Photo 512',
            'photo_1280' => 'Photo 1280',
            'post_id' => 'Post ID',
            'comment_id' => 'Comment ID',
            'owner_id' => 'Owner ID',
            'access_key' => 'Access Key',
            'vk_post_id' => 'Vk post id',
        ];
    }

    public function getLargePhoto()
    {
        if (!empty($this->photo_1280)) {
            return $this->photo_1280;
        }

        if(!empty($this->photo_807)) {
            return $this->photo_807;
        }

        if(!empty($this->photo_604)) {
            return $this->photo_604;
        }

        if(!empty($this->photo_512)) {
            return $this->photo_512;
        }

        if(!empty($this->photo_130)) {
            return $this->photo_130;
        }

        return $this->photo_75;
    }
}
