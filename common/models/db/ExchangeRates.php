<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "exchange_rates".
 *
 * @property integer $id
 * @property string $currencies
 * @property string $buy
 * @property string $sale
 * @property integer $type_id
 * @property integer $up
 */
class ExchangeRates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exchange_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currencies', 'buy', 'sale'], 'required'],
            [['type_id', 'up'], 'integer'],
            [['currencies', 'buy', 'sale'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currencies' => 'Валюта',
            'buy' => 'Покупка',
            'sale' => 'Продажа',
            'type_id' => 'Тип',
            'up' => 'Up',
        ];
    }
}
