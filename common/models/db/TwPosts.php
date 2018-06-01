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
 * @property string $status
 * @property int $comment_status
 * @property string $slug
 * 
 * @property array $statuses
 * @property string $statusText
 */
class TwPosts extends \yii\db\ActiveRecord
{
	const STATUS_MODERATION = 0;
	const STATUS_PUBLISHED = 1;
	const STATUS_TO_PUBLISH = 2;
    const STATUS_APPREHEND = 4;

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
	        [['status'], 'in', 'range' => array_keys($this->getStatuses())]
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
        return $this->statuses[$this->status];
    }

    public function getStatuses()
    {
    	return [
    		self::STATUS_MODERATION => 'На модерации',
		    self::STATUS_PUBLISHED => 'Опубликовано',
		    self::STATUS_TO_PUBLISH => 'На публикацию',
            self::STATUS_APPREHEND => 'Отложено',
	    ];
    }
}
