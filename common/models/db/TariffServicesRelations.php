<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "tariff_services_relations".
 *
 * @property integer $tariff_id
 * @property integer $services_id
 *
 * @property Services $services
 * @property Tariff $tariff
 */
class TariffServicesRelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tariff_services_relations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tariff_id', 'services_id'], 'integer'],
            [['services_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['services_id' => 'id']],
            [['tariff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tariff::className(), 'targetAttribute' => ['tariff_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tariff_id' => 'Tariff ID',
            'services_id' => 'Services ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasOne(Services::className(), ['id' => 'services_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTariff()
    {
        return $this->hasOne(Tariff::className(), ['id' => 'tariff_id']);
    }
}
