<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property string $name
 * @property integer $code
 * @property string $char_code
 * @property integer $nominal
 * @property integer $status
 * @property integer $type
 *
 * @property CurrencyCoin $coin
 * @property CurrencyRate[] $ratesFrom
 * @property CurrencyRate[] $ratesTo
 */
class Currency extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_ACTIVE_FOR_COIN = 2;
    const STATUS_ACTIVE_FOR_WIDGET = 3;

    const TYPE_CURRENCY = 1;
    const TYPE_COIN = 2;
    const TYPE_METAL = 3;

    const RUB_ID = 1;
    const USD_ID = 16;
    const EUR_ID = 17;
    const UAH_ID = 33;
    const AU_ID = 2;
    const BTC_ID = 12074;

    const AU = 1;
    const AG = 2;
    const PT = 3;
    const PD = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['code', 'status', 'type', 'nominal'], 'integer'],
            [['name', 'char_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('currency', 'Name'),
            'code' => Yii::t('currency', 'Code'),
            'char_code' => Yii::t('currency', 'Char Code'),
            'nominal' => Yii::t('currency', 'Nominal'),
            'status' => Yii::t('currency', 'Status'),
            'type' => Yii::t('currency', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoin()
    {
        return $this->hasOne(CurrencyCoin::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatesFrom()
    {
        return $this->hasMany(CurrencyRate::className(), ['currency_from_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatesTo()
    {
        return $this->hasMany(CurrencyRate::className(), ['currency_to_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getStatuses()
    {
        return [
            self::STATUS_INACTIVE => Yii::t('currency', 'Inactive'),
            self::STATUS_ACTIVE => Yii::t('currency', 'Active Front'),
            self::STATUS_ACTIVE_FOR_COIN => Yii::t('currency', 'Active For Coin'),
            self::STATUS_ACTIVE_FOR_WIDGET => Yii::t('currency', 'Active For Widget'),
        ];
    }

    public function getTypes()
    {
        return [
            self::TYPE_CURRENCY => Yii::t('currency', 'Currency'),
            self::TYPE_COIN => Yii::t('currency', 'Coin'),
            self::TYPE_METAL => Yii::t('currency', 'Metal'),
        ];
    }

    public static function getCharMetals()
    {
        return [
            self::AU => 'Au',
            self::AG => 'Ag',
            self::PT => 'Pt',
            self::PD => 'Pd',
        ];
    }

    public static function getNameMetals()
    {
        return [
            self::AU => 'Золото',
            self::AG => 'Серебро',
            self::PT => 'Платина',
            self::PD => 'Палладий',
        ];
    }
}
