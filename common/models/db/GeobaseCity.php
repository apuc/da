<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "geobase_city".
 *
 * @property integer $id
 * @property string $name
 * @property integer $region_id
 * @property double $latitude
 * @property double $longitude
 * @property integer $status
 */
class GeobaseCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geobase_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'region_id', 'latitude', 'longitude'], 'required'],
            [['id', 'region_id', 'status'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Город',
            'region_id' => 'Регион',
            'latitude' => 'Широта',
            'longitude' => 'Долгота',
            'status' => 'Статус',
        ];
    }
}
