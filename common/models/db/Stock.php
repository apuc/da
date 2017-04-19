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
 * @property string $dt_event
 * @property string $link
 * @property integer $main
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
            [['title', 'link'], 'required'],
            [['short_descr', 'descr'], 'string'],
            [['dt_add', 'dt_update', 'status', 'main'], 'integer'],
            [['title', 'photo', 'dt_event', 'link'], 'string', 'max' => 255],
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
            'dt_event' => 'Дата события',
            'link' => 'Ссылка',
            'main' => 'На главной',
        ];
    }
}
