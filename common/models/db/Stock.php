<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property integer $id
 * @property string $title
 * @property string $photo
 * @property string $short_descr
 * @property string $descr
 * @property integer $dt_add
 * @property integer $dt_update
 * @property integer $status
 * @property string $dt_event_description
 * @property string $link
 * @property integer $main
 * @property integer $company_id
 * @property integer $user_id
 * @property integer $recommended
 * @property integer $view
 * @property string $slug [varchar(255)]
 * @property string $dt_event
 * @property string $dt_event_end
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['short_descr', 'descr'], 'string'],
            [['dt_event', 'dt_event_end'], 'safe'],
            [['dt_add', 'dt_update', 'status', 'main', 'company_id', 'user_id', 'recommended', 'view'], 'integer'],
            [['title', 'photo', 'dt_event_description', 'link', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'photo' => 'Фото',
            'short_descr' => 'Короткое описание',
            'descr' => 'Полное описание',
            'dt_add' => 'Дата добавления',
            'dt_update' => 'Дата редактирования',
            'status' => 'Статус',
            'dt_event_description' => 'Дата события',
            'link' => 'Ссылка',
            'main' => 'На главной',
            'company_id' => 'Компания',
            'recommended' => 'Рекомендуем',
            'dt_event' => 'Dt Event',
            'dt_event_end' => 'Dt Event End',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getcompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

}
