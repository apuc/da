<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "subscribe".
 *
 * @property integer $id
 * @property string $email
 * @property integer $status
 * @property integer $dt_add
 */
class Subscribe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['status', 'dt_add'], 'integer'],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'status' => 'Статус',
            'dt_add' => 'Дата',
        ];
    }
}
