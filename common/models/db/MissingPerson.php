<?php

namespace common\models\db;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "missing_person".
 *
 * @property integer $id
 * @property string $fio
 * @property integer $date_of_birth
 * @property integer $city_id
 * @property mixed|null $additional_info
 * @property integer $user_id
 * @property string $user_ip
 * @property integer $moderated 1 - опубликовано, 0 - нет
 */
class MissingPerson extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'missing_person';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'user_id'], 'integer'],
            [['fio'], 'string', 'max' => 256],
            [['additional_info', 'user_ip'], 'string'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'date_of_birth' => 'Дата рождения',
            'city_id' => 'ID Города',
            'user_id' => 'ID Пользователя',
            'user_ip' => 'IP Пользователя',
            'additional_info' => 'Доп. информация',
            'moderated' => 'Опубликовано',
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
     * @param $id
     * @return static
     */
    public static function findByName($str)
    {
        return static::findOne(['fio', 'LIKE', "%$str%"]);
    }
}