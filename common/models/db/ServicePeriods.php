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

    public static function getWeekDaysArray()
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

    public static function checkPeriods($periods){
        $array = [false, false, false, false, false, false, false];
        foreach($periods as $period){
            foreach ($period['week_days'] as $week_day) {
                if($week_day === 'Пн' && $array[0] === false)
                    $array[0] = true;
                else if($week_day === 'Вт' && $array[1] === false)
                    $array[1] = true;
                else if($week_day === 'Ср' && $array[2] === false)
                    $array[2] = true;
                else if($week_day === 'Чт' && $array[3] === false)
                    $array[3] = true;
                else if($week_day === 'Пт' && $array[4] === false)
                    $array[4] = true;
                else if($week_day === 'Сб' && $array[5] === false)
                    $array[5] = true;
                else if($week_day === 'Вс' && $array[6] === false)
                    $array[6] = true;
                else
                    return false;
            }
        }
        return true;
    }

}
