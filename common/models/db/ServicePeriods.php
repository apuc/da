<?php

namespace common\models\db;

use common\classes\Debug;
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

    public static function getWeekDayLabel()
    {
        return [
            1 => 'Пн',
            2 => 'Вт',
            3 => 'Ср',
            4 => 'Чт',
            5 => 'Пт',
            6 => 'Сб',
            0 => 'Вс'
        ];
    }

    public function getDayDuration(){
        $result = 0;
        $start = explode(':', $this->start);
        $end = explode(':', $this->end);
        $result += (intval($end[0]) - intval($start[0])) * 60;
        $result += intval($end[1]) - intval($start[2]);
        return $result;


    }

    public static function checkPeriods($periods){
        $array = [false, false, false, false, false, false, false];
        foreach($periods as $period){
            if(strripos($period['start'], '_') || strripos($period['end'], '_'))
                return false;
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

    public static function addTime($time, $minutes){
        $time = explode(':', $time);
        $time[0] = intval(intval($time[0]) + $minutes / 60);
        $time[1] = intval($time[1]) + $minutes % 60;
        if($time[1] >= 60){
            $time[0] += 1;
            $time[1] -= 60;
        }
        if(strlen($time[0]) === 1){
            $time[0] = '0' . $time[0];
        }
        if(strlen($time[1]) === 1){
            $time[1] = '0' . $time[1];
        }
        return $time[0] . ':' . $time[1] . ':' . $time[2];
    }

    public function getButtonLabel($index, $duration){
        $start = self::addTime($this->start, $duration * $index);
        $end = self::addTime($this->start, $duration * ($index + 1));
        return $start . '-' . $end;
    }

    public function checkReservation($index, $duration, $date, $product_id)
    {
        $date = date('y-m-d',$date);
        $start = self::addTime($this->start, $duration * $index);
        $end = self::addTime($this->start, $duration * ($index + 1));
        $reservation = ServiceReservation::find()
            ->where([
                'start' => $start,
                'end' => $end,
                'product_id' => $product_id,
                'date' => $date
            ])->count();
        if($reservation < Products::findOne($product_id)->person_count)
            return false;
        else
            return true;
    }
}
