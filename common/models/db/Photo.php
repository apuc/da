<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $region_id
 * @property string $photo
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['region_id'], 'integer'],
            [['photo'], 'string'],
            [['title', 'description'], 'string', 'max' => 255],
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
            'description' => 'Описание',
            'region_id' => 'Регион',
            'photo' => 'Фотографии',
        ];
    }
}
