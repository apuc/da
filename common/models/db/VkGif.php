<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vk_gif".
 *
 * @property integer $id
 * @property integer $vk_id
 * @property integer $vk_user_id
 * @property string $preview_m
 * @property string $preview_s
 * @property string $preview_x
 * @property string $preview_o
 * @property string $gif_link
 * @property integer $post_id
 * @property integer $owner_id
 * @property string $access_key
 * @property integer $vk_post_id
 * @property integer $comment_id
 */
class VkGif extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vk_gif';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vk_id'], 'required'],
            [['vk_id', 'vk_user_id', 'post_id', 'owner_id', 'vk_post_id', 'comment_id'], 'integer'],
            [['preview_m', 'preview_s', 'preview_x', 'preview_o', 'gif_link', 'access_key'], 'string', 'max' => 255],
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
            'preview_m' => 'Preview M',
            'preview_s' => 'Preview S',
            'preview_x' => 'Preview X',
            'preview_o' => 'Preview O',
            'gif_link' => 'Gif Link',
            'post_id' => 'Post ID',
            'owner_id' => 'Owner ID',
            'access_key' => 'Access Key',
            'vk_post_id' => 'Vk Post ID',
            'comment_id' => 'Comment ID',
        ];
    }

    public function getLargePreview()
    {
        if (!empty($this->preview_x)) {
            return $this->preview_x;
        }

        if(!empty($this->preview_o)) {
            return $this->preview_o;
        }

        if(!empty($this->preview_m)) {
            return $this->preview_m;
        }

        return $this->preview_s;
    }
}
