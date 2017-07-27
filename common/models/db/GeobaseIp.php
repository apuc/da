<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "geobase_ip".
 *
 * @property integer $ip_begin
 * @property integer $ip_end
 * @property string $country_code
 * @property integer $city_id
 */
class GeobaseIp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geobase_ip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip_begin', 'ip_end', 'country_code', 'city_id'], 'required'],
            [['ip_begin', 'ip_end', 'city_id'], 'integer'],
            [['country_code'], 'string', 'max' => 2],
            [['ip_begin'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ip_begin' => 'Ip Begin',
            'ip_end' => 'Ip End',
            'country_code' => 'Country Code',
            'city_id' => 'City ID',
        ];
    }
}
