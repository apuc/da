<?php

namespace common\models\db;

use common\models\User;
use Yii;

/**
 * This is the model class for table "company_feedback".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $company_name
 * @property string $feedback
 * @property integer $dt_add
 * @property integer $dt_update
 * @property integer $company_id
 * @property integer $status
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
            [['user_id', 'feedback', 'company_id'], 'required'],
            [['user_id', 'dt_add', 'dt_update', 'company_id', 'status'], 'integer'],
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
