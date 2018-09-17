<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "journal".
 *
 * @property int $id
 * @property string $title
 * @property string $photo
 * @property string $iframe
 * @property int $dt_add
 * @property int $status
 * @property int $views
 */
class Journal extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iframe'], 'string'],
            [['dt_add', 'status', 'views'], 'integer'],
            [['title', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'photo' => 'Фото',
            'iframe' => 'Iframe',
            'dt_add' => 'Дата публикации',
            'status' => 'Статус',
            'views' => 'Просмотры',
        ];
    }
}
