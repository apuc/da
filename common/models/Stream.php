<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 25.02.2018
 * Time: 13:15
 *
 * @property $id
 * @property $title
 * @property $descr
 * @property $meta_descr
 * @property $type
 * @property $author
 * @property $text
 * @property $photo
 * @property $allPhoto
 * @property $gif
 * @property $allGif
 * @property $gifPreview
 * @property $group
 * @property $slug
 * @property $views
 * @property $comment_status
 * @property $comments
 * @property $likes
 * @property $dt_publish
 */

namespace common\models;

use common\models\db\Likes;
use common\models\db\VkStreamComments;

/**
 * Class Stream
 * @package common\models
 * @property $id
 * @property $title
 * @property $descr
 * @property $meta_descr
 * @property $type
 * @property $author
 * @property $text
 * @property $photo
 * @property $allPhoto
 * @property $gif
 * @property $allGif
 * @property $gifPreview
 * @property $group
 * @property $slug
 * @property $views
 * @property $comment_status
 * @property $comments
 * @property $likes
 * @property $dt_publish
 */
class Stream
{
    public $id;
    public $title;
    public $descr;
    public $meta_descr;
    public $type;
    public $author;
    public $text;
    public $photo;
    public $allPhoto;
    public $gif;
    public $allGif;
    public $gifPreview;
    public $group;
    public $slug;
    public $views;
    public $comment_status;
    public $comments;
    public $likes;
    public $dt_publish;

    /**
     * @param array $data
     * @return array
     */
    public static function create(Array $data)
    {
        $result = [];
        foreach ($data as $item) {
            $result[] = self::createItem($item);
        }
        return $result;
    }

    /**
     * @param $item
     * @return bool|Stream
     */
    public static function createItem($item)
    {
        if (!empty($item)) {
            if (isset($item->tw_id)) {
                return self::createTw($item);
            }
            if (isset($item->vk_id)) {
                return self::createVk($item);
            }
        }
        return false;
    }

    /**
     * @param $item
     * @return Stream
     */
    public static function createTw($item)
    {
        $streamItem = new self();
        $streamItem->author = new StreamAuthor();
        $streamItem->group = new StreamGroup();
        $streamItem->type = 'tw';
        $streamItem->title = $item->title;
        $streamItem->id = $item->id;
        $streamItem->group->name = $item->page_title;
        $streamItem->group->photo = $item->page_icon;
        $streamItem->photo = $item->media_url;
        $streamItem->allPhoto[] = $item->media_url;
        $streamItem->text = $item->content;
        $streamItem->slug = $item->slug;
        $streamItem->views = $item->views;
        $streamItem->comment_status = $item->comment_status;
        $streamItem->dt_publish = $item->dt_publish;
        $streamItem->likes = $streamItem->getLikesCount();
        $streamItem->comments = $streamItem->getAllComments();
        return $streamItem;
    }

    /**
     * @param $item
     * @return Stream
     */
    public static function createVk($item)
    {
        $streamItem = new self();
        $streamItem->author = new StreamAuthor();
        $streamItem->group = new StreamGroup();
        $streamItem->type = 'vk';
        $streamItem->title = $item->title;
        $streamItem->id = $item->id;
        $streamItem->slug = $item->slug;
        $streamItem->views = $item->views;
        $streamItem->comment_status = $item->comment_status;
        $streamItem->text = $item->text;
        if (!empty($item->photo)) {
            $streamItem->photo = $item->photo[0]->getLargePhoto();
            foreach ((array)$item->photo as $p) {
                $streamItem->allPhoto[] = $p->getLargePhoto();
            }
        }
        if (!empty($item->gif)) {
            $streamItem->gifPreview = $item->gif[0]->getLargePreview();
            $streamItem->gif = $item->gif[0]->gif_link;
            foreach ((array)$item->gif as $g) {
                $streamItem->allGif[] = $g->gif_link;
            }
        }
        if (!empty($item->group)) {
            $streamItem->group->photo = $item->group->getPhoto();
            $streamItem->group->name = $item->group->name;
        }
        $streamItem->meta_descr = $item->meta_descr;
        $streamItem->dt_publish = $item->dt_publish;
        $streamItem->likes = $streamItem->getLikesCount();
        $streamItem->comments = $streamItem->getAllComments();
        return $streamItem;
    }

    /**
     * @return int|string
     */
    public function getLikesCount()
    {
        return Likes::find()->where(['post_type' => $this->type, 'post_id' => $this->id])->count();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getComments()
    {
        return VkStreamComments::find()
            ->where(['vk_stream_id' => $this->id])
            ->andWhere(['published' => 1])
            ->all();
    }

    /**
     * @return array
     */
    public function getAllComments()
    {
        $arr = [];
        $comments = $this->getComments();
        if ($comments) {
            /** @var VkStreamComments $comment */
            foreach ($comments as $comment) {
                $commObj = new StreamComments();
                $commObj->text = $comment->content;
                if (null !== $comment->user_id) {
                    $user = User::findOne($comment->user_id);
                    $commObj->username = $user->username;
                }
                $arr[] = $commObj;
            }
        }
        return $arr;
    }

}

/**
 * Class StreamAuthor
 * @package common\models
 */
class StreamAuthor
{
    public $photo;
    public $name;
}

/**
 * Class StreamGroup
 * @package common\models
 */
class StreamGroup
{
    public $photo;
    public $name;
}

/**
 * Class StreamComments
 * @package common\models
 * @property string $username
 * @property string $text
 */
class StreamComments
{
    public $username;
    public $text;
    public $photo;
    public $sticker;
}