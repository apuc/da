<?php

namespace common\models\db;

use common\models\User;
use Yii;

/**
 * This is the model class for table "service_reservation".
 *
 * @property int $id
 * @property string $start
 * @property string $end
 * @property string $date
 * @property int $product_id
 * @property int $user_id
 *
 * @property Products $product
 */
class ServiceReservation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_reservation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start', 'end', 'date', 'product_id', 'user_id'], 'required'],
            [['start', 'end', 'date'], 'safe'],
            [['product_id', 'user_id'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start' => 'Время начала',
            'end' => 'Время окончания',
            'date' => 'Дата',
            'product_id' => 'Услуга',
            'user_id' => 'Покупатель',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

}
