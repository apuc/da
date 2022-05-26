<?php

namespace common\models\db;


/**
 * This is the model class for table "banned_ip".
 *
 * @property integer $id
 * @property string $fio
 */
class BannedIP extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banned_ips';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ip_mask'], 'string'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip_mask' => 'IP Маска',
        ];
    }

    /**
     * @param $id
     * @return static
     */
    public static function findById($id)
    {
        return static::findOne(['id' => $id]);
    }
}