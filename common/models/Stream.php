<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 25.02.2018
 * Time: 13:15
 */

namespace common\models;

use common\classes\Debug;
use common\models\db\Comments;
use common\models\db\Likes;

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

    public static function create(Array $data)
    {
        $result = [];
        foreach ($data as $item) {
            $result[] = self::createItem($item);
        }
        return $result;
    }

    public static function createItem($item)
    {
        if(!empty($item)){
            if (isset($item->tw_id)) {
                return self::createTw($item);
            }
            if (isset($item->vk_id)) {
                return self::createVk($item);
            }
            if (isset($item->post_id)) {
                return self::createGplus($item);
            }
        }
        return false;
    }

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
        $streamItem->likes = $item->getLikesCount();
        $streamItem->comments = $streamItem->getAllComments();
        return $streamItem;
    }

    public static function createGplus($item)
    {
        $streamItem = new self();
        $streamItem->author = new StreamAuthor();
        $streamItem->group = new StreamGroup();
        $streamItem->type = 'gplus';
        $streamItem->title = $item->title;
        $streamItem->id = $item->id;
        $streamItem->author->name = $item->author->display_name;
        $streamItem->author->photo = $item->author->image;
        $streamItem->photo = $item->photos[0]->url;
        if(isset($item->photos)){
            foreach($item->photos as $photo){
                $streamItem->allPhoto[] = $photo->url;
            }
        }
        $streamItem->text = $item->content;
        $streamItem->slug = $item->slug;
        $streamItem->views = $item->views;
        $streamItem->comment_status = 1;
        $streamItem->dt_publish = $item->dt_publish;
        $streamItem->likes = $item->getLikesCount();
        $streamItem->comments = $streamItem->getAllComments();
        return $streamItem;
    }


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
            foreach ((array)$item->photo as $p){
                $streamItem->allPhoto[] = $p->getLargePhoto();
            }
        }
        if (!empty($item->gif)) {
            $streamItem->gifPreview = $item->gif[0]->getLargePreview();
            $streamItem->gif = $item->gif[0]->gif_link;
            foreach ((array)$item->gif as $g){
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

    public function getLikesCount()
    {
        return Likes::find()->where(['post_type' => $this->type === 'vk' ? 'Stream' : $this->type, 'post_id' => $this->id])->count();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getComments()
    {
        return Comments::find()->where(['post_id' => $this->id])
            ->andWhere(['post_type' => $this->type === 'vk' ? $this->type . '_post' : $this->type])
            ->andWhere(['published' => 1])
            ->all();
    }

    public function getAllComments()
    {
        $arr = [];
        $comm = $this->getComments();
        if ($comm) {
            foreach ($comm as $item) {
                $commObj = new StreamComments();
                $commObj->text = $item->content;
                if (null !== $item->user_id) {
                    $user = User::findOne($item->user_id);
                    $commObj->username = $user->username;
                }
                $arr[] = $commObj;
            }
        }
        return $arr;
    }

}

class StreamAuthor
{
    public $photo;
    public $name;
}

class StreamGroup
{
    public $photo;
    public $name;
}

class StreamComments
{
    public $username;
    public $text;
    public $photo;
    public $sticker;
}