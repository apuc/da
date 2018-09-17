<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "currency_rate".
 *
 * @property integer $id
 * @property string $date
 * @property integer $currency_from_id
 * @property integer $currency_to_id
 * @property double $rate
 *
 * @property Currency $currencyFrom
 * @property Currency $currencyTo
 */
class CurrencyRate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency_rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'currency_from_id', 'currency_to_id', 'rate'], 'required'],
            [['date'], 'safe'],
            [['currency_from_id', 'currency_to_id'], 'integer'],
            [['rate'], 'number'],
            [['date', 'currency_from_id', 'currency_to_id'], 'unique', 'targetAttribute' => ['date', 'currency_from_id', 'currency_to_id'], 'message' => 'The combination of Date, Currency From ID and Currency To ID has already been taken.'],
            [['currency_from_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_from_id' => 'id']],
            [['currency_to_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_to_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => Yii::t('currency', 'Date'),
            'currency_from_id' => Yii::t('currency', 'Currency From ID'),
            'currency_to_id' => Yii::t('currency', 'Currency To ID'),
            'rate' => Yii::t('currency', 'Rate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyFrom()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_from_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyTo()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_to_id']);
    }
}
