<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "exchange".
 *
 * @property integer $id
 * @property integer $num_code
 * @property string $char_code
 * @property integer $nominal
 * @property string $name
 * @property double $value
 * @property double $previous
 * @property integer $date
 */
class Exchange extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exchange';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_code', 'char_code', 'value', 'previous'], 'required'],
            [['num_code', 'nominal', 'date'], 'integer'],
            [['name'], 'string'],
            [['value', 'previous'], 'number'],
            [['char_code'], 'string', 'max' => 3],
//            [['num_code'], 'unique'],
//            [['char_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num_code' => Yii::t('exchange_rates', 'Num Code'),
            'char_code' =>  Yii::t( 'exchange_rates','Char Code'),
            'nominal' => Yii::t( 'exchange_rates','Nominal'),
            'name' => Yii::t( 'exchange_rates','Name'),
            'value' => Yii::t( 'exchange_rates','Value'),
            'previous' => Yii::t( 'exchange_rates','Previous'),
            'date' => Yii::t( 'exchange_rates','Date'),
        ];
    }
}
