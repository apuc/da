<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "inst_photos".
 *
 * @property int $id
 * @property string $inst_id
 * @property string $photo_url
 * @property string $author_name
 * @property string $author_img
 * @property string $dt_add
 * @property string $dt_publish
 * @property string $caption
 * @property int $status
 * @property int $views
 * @property string $slug
 * @property string $meta_title
 * @property string $meta_description
 */
class InstPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inst_photos';
    }

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'meta_title',
                'out_attribute' => 'slug',
                'translit' => true
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'views'], 'integer'],
            [['inst_id', 'photo_url', 'author_name', 'author_img', 'dt_add','dt_publish', 'caption', 'slug', 'meta_title', 'meta_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inst_id' => 'Inst ID',
            'photo_url' => 'Фотография',
            'author_name' => 'Имя автора',
            'author_img' => 'Иконка автора',
            'dt_publish' => 'Дата публикации',
            'dt_add' => 'Дата добавления',
            'caption' => 'Описание',
            'status' => 'Status',
            'views' => 'Views',
            'slug' => 'Slug',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
        ];
    }
}
