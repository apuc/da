<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "tw_posts".
 *
 * @property int $id
 * @property string $title
 * @property string $meta_descr
 * @property string $tw_id
 * @property string $content
 * @property string $media_url
 * @property string $link
 * @property int $page_id
 * @property string $page_title
 * @property string $page_icon
 * @property int $dt_add
 * @property int $dt_publish
 * @property int $status
 * @property int $comment_status
 * @property string $slug
 */
class TwPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tw_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meta_descr', 'content'], 'string'],
            [['tw_id', 'page_id'], 'required'],
            [['page_id', 'dt_add', 'dt_publish', 'status', 'comment_status'], 'integer'],
            [['title', 'media_url', 'link', 'page_title', 'page_icon', 'slug'], 'string', 'max' => 255],
            [['tw_id'], 'string', 'max' => 100],
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
            'meta_descr' => 'Мета Описание',
            'tw_id' => 'Tw ID',
            'content' => 'Контент',
            'media_url' => 'Media Url',
            'link' => 'Ссылка',
            'page_id' => 'Страница',
            'page_title' => 'Заголовок страницы',
            'page_icon' => 'Иконка страницы',
            'dt_add' => 'Дата добавления',
            'dt_publish' => 'Дата публикации',
            'status' => 'Статус',
            'comment_status' => 'Разрешение на комментирование',
            'slug' => 'Slug',
        ];
    }

    public function getStatusText()
    {
        if($this->status === 0){
            return 'На модерации';
        }
        if($this->status === 1){
            return 'Опубликовано';
        }
        if($this->status === 2){
            return 'На публикацию';
        }
    }
}
