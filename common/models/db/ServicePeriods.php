<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "service_periods".
 *
 * @property int $id
 * @property int $product_id
 * @property string $week_days
 * @property string $start
 * @property string $end
 * @property Products $product
 */
class ServicePeriods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_periods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['start', 'end', 'product_id', 'week_days'], 'required'],
            [['start', 'end'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Услуга',
            'week_days' => 'Дни недели',
            'start' => 'Время начала',
            'end' => 'Время конца',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    public function getWeekDaysArray()
    {
        return [
            'Пн' => 'Пн',
            'Вт' => 'Вт',
            'Ср' => 'Ср',
            'Чт' => 'Чт',
            'Пт' => 'Пт',
            'Сб' => 'Сб',
            'Вс' => 'Вс'
        ];
    }

}
