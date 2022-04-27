<?php

use yii\db\ActiveRecord;

/**
 * This is the model class for table "missing_person".
 *
 * @property integer $id
 * @property string $FIO
 * @property integer $date_of_birth
 * @property integer $city_id
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
            [['FIO', 'date_of_birth', 'city_id'], 'required'],
            [['id', 'city_id'], 'integer'],
            [['FIO'], 'string', 'max' => 256],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FIO' => 'ФИО',
            'date_of_birth' => 'Дата рождения',
            'city_id' => 'ID Города',
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
        return static::findOne(['FIO', 'LIKE', "%$str%"]);
    }
}