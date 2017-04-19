<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "key_value".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property integer $dt_add
 * @property integer $dt_update
 */
class KeyValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'key_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['dt_add', 'dt_update'], 'integer'],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Value',
            'dt_add' => 'Dt Add',
            'dt_update' => 'Dt Update',
        ];
    }

    public static function getValue($key)
    {
        return self::findOne(['key' => $key])->value;
    }
}
