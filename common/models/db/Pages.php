<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property integer $dt_add
 * @property integer $dt_update
 * @property integer $status
 * @property string $meta_title
 * @property string $meta_descr
 * @property string $photo
 * @property integer $group_id
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content', 'photo'], 'string'],
            [['dt_add', 'dt_update', 'status', 'group_id'], 'integer'],
            [['title', 'slug', 'meta_title', 'meta_descr'], 'string', 'max' => 255],
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
            'slug' => 'Slug',
            'content' => 'Текст',
            'dt_add' => 'Дата добавления',
            'dt_update' => 'Дата редактирования',
            'status' => 'Статус',
            'meta_title' => 'Meta Title',
            'meta_descr' => 'Meta Descr',
            'photo' => 'Фотография',
            'group_id' => 'Группа',
        ];
    }
}
