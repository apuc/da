<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vk_authors".
 *
 * @property integer $id
 * @property integer $vk_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $sex
 * @property string $screen_name
 * @property string $photo
 * @property integer $user_id
 */
class VkAuthors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vk_authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vk_id'], 'required'],
            [['vk_id', 'sex', 'user_id'], 'integer'],
            [['first_name', 'last_name', 'screen_name', 'photo'], 'string', 'max' => 255],
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'sex' => 'Sex',
            'screen_name' => 'Screen Name',
            'photo' => 'Photo',
            'user_id' => 'User ID',
        ];
    }
}
