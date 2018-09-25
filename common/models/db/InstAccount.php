<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "inst_accounts".
 *
 * @property int $id
 * @property int $account_id
 * @property string $username
 * @property string $profile_img
 * @property string $iprofile_link
 */
class InstAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inst_accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id'], 'integer'],
            [['username', 'profile_img', 'iprofile_link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_id' => 'ID пользователя',
            'username' => 'Имя пользователя',
            'profile_img' => 'Иконка',
            'iprofile_link' => 'Ссылка',
        ];
    }
}
