<?php

namespace backend\modules\currency\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property integer $num_code
 * @property string $char_code
 * @property string $name
 * @property integer $status
 */
class Currency extends \yii\db\ActiveRecord
{
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
            [['num_code', 'char_code'], 'required'],
            [['num_code', 'status'], 'integer'],
            [['name'], 'string'],
            [['char_code'], 'string', 'max' => 3],
            [['num_code'], 'unique'],
            [['char_code'], 'unique'],
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
            'char_code' => Yii::t('exchange_rates', 'Char Code'),
            'name' => Yii::t('exchange_rates', 'Name'),
            'status' => Yii::t('exchange_rates', 'Status'),
        ];
    }
}
