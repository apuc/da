<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "messenger_phone".
 *
 * @property int $messenger_id
 * @property int $phone_id
 *
 * @property Messenger $messenger
 * @property Phones $phone
 */
class MessengerPhone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messenger_phone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['messenger_id', 'phone_id'], 'required'],
            [['messenger_id', 'phone_id'], 'integer'],
            [['messenger_id'], 'exist', 'skipOnError' => true, 'targetClass' => Messenger::className(), 'targetAttribute' => ['messenger_id' => 'id']],
            [['phone_id'], 'exist', 'skipOnError' => true, 'targetClass' => Phones::className(), 'targetAttribute' => ['phone_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'messenger_id' => Yii::t('messenger', 'Messenger ID'),
            'phone_id' => Yii::t('messenger', 'Phone ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessenger()
    {
        return $this->hasOne(Messenger::className(), ['id' => 'messenger_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhone()
    {
        return $this->hasOne(Phones::className(), ['id' => 'phone_id']);
    }
}
