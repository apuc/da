<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "coin_rates".
 *
 * @property integer $id
 * @property string $coin_name
 * @property string $date
 * @property double $usd
 * @property double $eur
 * @property double $rub
 * @property double $uah
 */
class CoinRates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coin_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coin_name'], 'required'],
            [['date'], 'safe'],
            [['usd', 'eur', 'rub', 'uah'], 'number'],
            [['coin_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coin_name' => Yii::t('coin', 'Coin Name'),
            'date' => Yii::t('coin', 'Date'),
            'usd' => Yii::t('coin', 'Usd'),
            'eur' => Yii::t('coin', 'Eur'),
            'rub' => Yii::t('coin', 'Rub'),
            'uah' => Yii::t('coin', 'Uah'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoin()
    {
        return $this->hasOne(Coin::className(), ['name' => 'coin_name']);
    }
}
