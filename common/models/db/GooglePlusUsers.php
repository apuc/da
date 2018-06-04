<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "google_plus_users".
 *
 * @property int $id
 * @property string $user_id
 * @property string $display_name
 * @property string $url
 * @property string $image
 */
class GooglePlusUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'google_plus_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['user_id', 'required'],
            [['user_id', 'display_name'], 'string', 'max' => 100],
            [['url', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'display_name' => 'Display Name',
            'url' => 'Url',
            'image' => 'Image',
        ];
    }
}
