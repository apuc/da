<?php

namespace frontend\modules\missing_person\models;

/**
 * This is the model class for table "missing_person".
 *
 * @property integer $id
 * @property string $fio
 * @property integer $date_of_birth
 * @property integer $city_id
 * @property integer $user_id ID пользователя
 * @property integer $user_ip IP запроса
 * @property mixed|null $additional_info
 */
class MissingPerson extends \common\models\db\MissingPerson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fio', 'date_of_birth', 'city_id'], 'required'],
            [['id', 'city_id'], 'integer'],
            [['fio'], 'string', 'max' => 256],
        ];
    }
}