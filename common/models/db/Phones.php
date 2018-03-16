<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "phones".
 *
 * @property integer $id
 * @property string $phone
 * @property integer $company_id
 */
class Phones extends \yii\db\ActiveRecord
{

    private $_messengeresArray;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['phone'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessengerPhones()
    {
        return $this->hasMany(MessengerPhone::className(), ['phone_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessengeres()
    {
        return $this->hasMany(Messenger::className(), ['id' => 'messenger_id'])->via('messengerPhones');
    }

    public function getMessengeresArray()
    {
        if (empty($this->_messengeresArray)) {
            $this->_messengeresArray = $this->getMessengerPhones()->select('messenger_id')->column();
        }

        return $this->_messengeresArray;
    }

    public function setMessengeresArray($value)
    {
        return $this->_messengeresArray = (array)$value;
    }

    public function afterSave($insert, $changedAttributes)
    {
        \common\classes\Debug::dd(234234);
        $this->updateMessengeres();
        parent::afterSave($insert, $changedAttributes);
    }

    public function updateMessengeres()
    {
        $currentMessengeresIds = $this->getMessengeres()->select('id')->column();
        $newMessengeresIds = $this->getMessengeresArray();
        \common\classes\Debug::prn($currentMessengeresIds);
        \common\classes\Debug::dd($newMessengeresIds);
        foreach (array_filter(array_diff($newMessengeresIds, $currentMessengeresIds)) as $messengerId) {
            /** @var Messenger $messenger */
            if ($messenger = Messenger::findOne($messengerId)) {
                $this->link('messengeres', $messenger);
            }
        }
        foreach (array_filter(array_diff($currentMessengeresIds, $newMessengeresIds)) as $messengerId) {
            /** @var Messenger $messenger */
            if ($messenger = Messenger::findOne($messengerId)) {
                $this->unlink('messengeres', $messenger, true);
            }
        }
    }
}
