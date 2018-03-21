<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "messenger".
 *
 * @property int $id
 * @property string $name
 *
 * @property MessengerPhone[] $messengerPhones
 * @property string $icon [varchar(255)]
 */
class Messenger extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messenger';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'icon' ], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('messenger', 'ID'),
            'name' => Yii::t('messenger', 'Name'),
            'icon' => Yii::t('messenger', 'Icon'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessengerPhones()
    {
        return $this->hasMany(MessengerPhone::className(), ['messenger_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(Phones::className(), ['id' => 'phone_id'])->via('messengerPhones');
    }
}
