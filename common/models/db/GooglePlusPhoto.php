<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "google_plus_photo".
 *
 * @property int $id
 * @property int $post_id
 * @property string $display_name
 * @property string $google_url
 * @property string $url
 * @property string $full_image_url
 */
class GooglePlusPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'google_plus_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id'], 'required'],
            [['post_id'], 'integer'],
            [['display_name', 'google_url', 'url', 'full_image_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'display_name' => 'Display Name',
            'google_url' => 'Google Url',
            'url' => 'Url',
            'full_image_url' => 'Full Image Url',
        ];
    }
}
