<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "company_tariff_order".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $tariff_id
 * @property integer $dt_end_tariff
 * @property string $price
 */
class CompanyTariffOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_tariff_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'tariff_id'], 'required'],
            [['company_id', 'tariff_id', 'dt_end_tariff'], 'integer'],
            [['price'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Компания',
            'tariff_id' => 'Тариф',
            'dt_end_tariff' => 'Дата окончания тарифа',
            'price' => 'Сумма',
        ];
    }

    public function getTariff()
    {
        return $this->hasOne(\common\models\db\Tariff::className(), ['id' => 'tariff_id']);
    }
}
