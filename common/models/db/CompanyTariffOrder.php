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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'tariff_id' => 'Tariff ID',
            'dt_end_tariff' => 'Dt End Tariff',
        ];
    }
}
