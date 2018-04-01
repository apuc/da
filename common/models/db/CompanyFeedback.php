<?php

namespace common\models\db;

use common\models\User;
use Yii;

/**
 * This is the model class for table "company_feedback".
 *
 * @property int $id
 * @property int $user_id
 * @property string $company_name
 * @property string $feedback
 * @property int $dt_add
 * @property int $dt_update
 * @property int $company_id
 * @property int $status
 * @property int $rating
 */
class CompanyFeedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'feedback', 'company_id', 'rating'], 'required'],
            [['user_id', 'dt_add', 'dt_update', 'company_id', 'status', 'rating'], 'integer'],
            [['feedback'], 'string'],
            [['company_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'company_name' => 'Название компании (пользователя)',
            'feedback' => 'Отзыв',
            'dt_add' => 'Дата добавления',
            'dt_update' => 'Дата редактирования',
            'company_id' => 'Компания',
            'status' => 'Статус',
            'rating' => 'Рейтинг',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id'])->joinWith('categories');
    }
}
