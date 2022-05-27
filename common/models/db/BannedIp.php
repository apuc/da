<?php

namespace common\models\db;


use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "banned_ip".
 *
 * @property integer $id
 * @property string $ip_mask
 */
class BannedIp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banned_ip';
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

    /**
     * @return array
     */
    public static function getIps(): array
    {
        return ArrayHelper::getColumn((new \yii\db\Query())->select('ip_mask')->from('banned_ip')->all(), 'ip_mask');
    }
}