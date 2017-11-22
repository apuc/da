<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "currency_coin".
 *
 * @property integer $id
 * @property integer $currency_id
 * @property string $url
 * @property string $image_url
 * @property string $symbol
 * @property string $full_name
 * @property string $algorithm
 * @property string $proof_type
 * @property integer $fully_premined
 * @property string $total_coin_supply
 * @property double $pre_mined_value
 * @property double $total_coins_free_float
 * @property integer $sort_order
 * @property integer $sponsored
 *
 * @property Currency $currency
 */
class CurrencyCoin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency_coin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currency_id'], 'required'],
            [['currency_id', 'fully_premined', 'sort_order', 'sponsored'], 'integer'],
            [['pre_mined_value', 'total_coins_free_float'], 'number'],
            [['url', 'image_url', 'symbol', 'full_name', 'algorithm', 'proof_type', 'total_coin_supply'], 'string', 'max' => 255],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency_id' => Yii::t('currency', 'Currency ID'),
            'url' => Yii::t('currency', 'Url'),
            'image_url' => Yii::t('currency', 'Image Url'),
            'symbol' => Yii::t('currency', 'Symbol'),
            'full_name' => Yii::t('currency', 'Full Name'),
            'algorithm' => Yii::t('currency', 'Algorithm'),
            'proof_type' => Yii::t('currency', 'Proof Type'),
            'fully_premined' => Yii::t('currency', 'Fully Premined'),
            'total_coin_supply' => Yii::t('currency', 'Total Coin Supply'),
            'pre_mined_value' => Yii::t('currency', 'Pre Mined Value'),
            'total_coins_free_float' => Yii::t('currency', 'Total Coins Free Float'),
            'sort_order' => Yii::t('currency', 'Sort Order'),
            'sponsored' => Yii::t('currency', 'Sponsored'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }
}
