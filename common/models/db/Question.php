<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property string $title
 * @property integer $dt_add
 * @property integer $dt_update
 * @property integer $status
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['dt_add', 'dt_update', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'dt_add' => 'Дата добавления',
            'dt_update' => 'Dt Update',
            'status' => 'Status',
        ];
    }
}
