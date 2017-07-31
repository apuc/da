<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vk_groups".
 *
 * @property integer $id
 * @property string $domain
 * @property string $vk_id
 * @property string $name
 * @property integer $status
 */
class VkGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vk_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['domain', 'vk_id'], 'required'],
            [['status'], 'integer'],
            [['domain', 'vk_id', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'domain' => 'Domain',
            'vk_id' => 'Vk ID',
            'status' => 'Status',
            'name' => 'Имя',
        ];
    }
}
