<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.05.2017
 * Time: 15:22
 */

namespace console\controllers;

use common\classes\Debug;
use common\models\db\Comments;
use common\models\db\VkAuthors;
use common\models\db\VkComments;
use common\models\db\VkDoc;
use common\models\db\VkGif;
use common\models\db\VkGroups;
use common\models\db\VkPhoto;
use common\models\db\VkStream;
use common\models\VK;
use yii\console\Controller;

class VkController extends Controller
{

    public $count = 50;
    public $vk;

    public function actionIndex()
    {
        echo 'test';
    }

    private function getVk()
    {
        $this->vk = new VK([
            'client_id' => '6029267',
            'client_secret' => '0QKWLW7n6XumtJV7VJ6h',
            'access_token' => '90fc0cc0178c0130800af68e6051952c869b88a713b1d787982d39c70660a561c8378c432e8c6dcdb077a',
        ]);
    }

    public function actionGetStream($group_id = null)
    {
        $this->getVk();

        if($group_id)
        {
            $groups = VkGroups::find()->where(['id' => $group_id])->all();
        }else $groups = VkGroups::find()->where(['status' => 1])->all();

        foreach ($groups as $group) {
            if(stristr($group->domain, 'public')){
                $res = $this->vk->getGroupWallByID($group->vk_id, ['count' => $this->count, 'extended' => 1]);
            }else
                $res = $this->vk->getGroupWall($group->domain, ['count' => $this->count, 'extended' => 1]);

            $res = json_decode($res);
            //Debug::prn($res);
            if(isset($res->response->profiles))
            {
                $this->saveAuthors($res->response->profiles);
            }
            if(isset($res->response->items))
            {
                $this->saveStream($res->response->items);
            }
        }
    }

    public function saveStream($items)
    {
       // Debug::prn($items);
        if (!empty($items)) {
            foreach ((array)$items as $item) {
                if (VkStream::find()->where(['vk_id' => $item->owner_id . '_' . $item->id])->count() == 0) {
                    $post = new VkStream();
                    $post->owner_type = $item->owner_id < 0 ? 0 : 1;
                    $post->owner_id = $item->owner_id;
                    $post->from_type = $item->from_id < 0 ? 0 : 1;
                    $post->from_id = $item->from_id;
                    $post->dt_add = $item->date;
                    $post->post_type = $item->post_type;
                    $post->text = $item->text;
                    $post->vk_id = $post->owner_id . '_' . $item->id;
                    $post->save();
                    echo 'post - ' . $post->vk_id . ' add' . "\n";
                    $this->savePhoto($item, $post->id);
                    $this->saveComments($item->owner_id, $item->id, $post->id);
                    $this->saveGif($item, $post->id);
                }
            }
        }

    }

    public function savePhoto($item, $postId = false, $commentId = false)
    {
        if (!empty($item->attachments)) {
            foreach ((array)$item->attachments as $attachment) {
                if ($attachment->type === 'photo') {
                    if (VkPhoto::find()->where(['vk_id' => $attachment->photo->id])->count() == 0) {
                        $photo = new VkPhoto();
                        $photo->vk_id = $attachment->photo->id;
                        $photo->vk_post_id = $item->id;
                        $photo->post_id = $postId ?: 0;
                        $photo->comment_id = $commentId ?: 0;
                        $photo->owner_id = isset($item->owner_id) ? $item->owner_id : 0;
                        $photo->vk_user_id = $item->from_id;
                        $photo->access_key = isset($attachment->photo->access_key) ? $attachment->photo->access_key : '';
                        $photo->photo_75 = isset($attachment->photo->photo_75) ? $attachment->photo->photo_75 : '';
                        $photo->photo_130 = isset($attachment->photo->photo_130) ? $attachment->photo->photo_130 : '';
                        $photo->photo_512 = isset($attachment->sticke->photo_512) ? $attachment->sticke->photo_512 : '';
                        $photo->photo_604 = isset($attachment->photo->photo_604) ? $attachment->photo->photo_604 : '';
                        $photo->photo_807 = isset($attachment->photo->photo_807) ? $attachment->photo->photo_807 : '';
                        $photo->photo_1280 = isset($attachment->photo->photo_1280) ? $attachment->photo->photo_1280 : '';
                        $photo->save();
                        echo 'photo - ' . $photo->vk_id . ' add' . "\n";
                    }
                }
            }
        }
    }

    public function saveGif($item, $postId = false, $commentId = false)
    {
        if (!empty($item->attachments)) {
            foreach ((array)$item->attachments as $attachment) {
                if ($attachment->type === 'doc') {
                    if (VkGif::find()->where(['vk_id' => $attachment->doc->id])->count() == 0) {
                        $gif = new VkGif();
                        $gif->vk_id = $attachment->doc->id;
                        $gif->vk_post_id = $item->id;
                        $gif->post_id = $postId ?: 0;
                        $gif->comment_id = $commentId ?: 0;
                        $gif->owner_id = isset($item->owner_id) ? $item->owner_id : 0;
                        $gif->vk_user_id = $item->from_id;
                        $gif->access_key = isset($attachment->doc->access_key) ? $attachment->doc->access_key : '';

                        if(isset($attachment->doc->preview->photo->sizes))
                        {
                            foreach ($attachment->doc->preview->photo->sizes as $size)
                            {
                                $sizes[$size->type] = $size->src;
                            }
                        }

                        $gif->preview_m = isset($sizes['m']) ? $sizes['m'] : '';
                        $gif->preview_o = isset($sizes['o']) ? $sizes['o'] : '';
                        $gif->preview_s = isset($sizes['s']) ? $sizes['s'] : '';
                        $gif->preview_x = isset($sizes['x']) ? $sizes['x'] : '';

                        $gif->gif_link = $attachment->doc->url;
                        $gif->save();
                        //Debug::prn($gif);
                        echo 'gif - ' . $gif->vk_id . ' add' . "\n";
                    }
                }
            }
        }
    }

    public function saveDoc($item, $commentId = null)
    {
        if (!empty($item->attachments)) {
            $comment = VkComments::findOne(['id' => $commentId]);
            foreach ((array)$item->attachments as $attachment) {
                if (($attachment->type === 'doc') && ($attachment->doc->ext === 'png')) {
                    //Debug::prn($attachment);
                    $comment->sticker = $attachment->doc->url;
                    $comment->save();
                    echo 'sticker - ' . $attachment->doc->id . ' add to comment' . "\n";
                } elseif ($attachment->type === 'sticker') {
                    $comment->sticker = $attachment->sticker->photo_512;
                    $comment->save();
                    echo 'sticker - ' . $attachment->sticker->id . ' add to comment' . "\n";
                }
            }
        }
    }

    public function saveAuthors($profiles)
    {
        if (!empty($profiles)) {
            foreach ((array)$profiles as $profile) {
                if (VkAuthors::find()->where(['vk_id' => $profile->id])->count() == 0) {
                    $author = new VkAuthors();
                    $author->first_name = $profile->first_name;
                    $author->last_name = $profile->last_name;
                    $author->sex = $profile->sex;
                    $author->screen_name = isset($profile->screen_name) ? $profile->screen_name : '';
                    $author->vk_id = $profile->id;
                    $author->photo = $profile->photo_100;
                    $author->save();
                    echo 'user - ' . $profile->id . ' add' . "\n";
                }
            }
        }
    }

    public function actionSaveComments()
    {
        $vk = new VK([
            'client_id' => '6029267',
            'client_secret' => '0QKWLW7n6XumtJV7VJ6h',
            'access_token' => '90fc0cc0178c0130800af68e6051952c869b88a713b1d787982d39c70660a561c8378c432e8c6dcdb077a',
        ]);
        $res = $vk->getPostComments(-107103361, 382083, ['extended' => 1, 'count' => 100]);
        $res = json_decode($res);
        Debug::prn($res->response);
    }

    public function saveComments($ownerId, $postId, $postSysId)
    {
        $res = $this->vk->getPostComments($ownerId, $postId, ['extended' => 1, 'count' => 100]);
        $res = json_decode($res);
        if (!empty($res->response->items)) {
            foreach ((array)$res->response->items as $item) {
                $comm = new VkComments();
                $comm->vk_id = $ownerId . '_' . $postId . '_' . $item->id;
                $comm->from_id = $item->from_id;
                $comm->owner_id = $ownerId;
                $comm->post_id = $postSysId;
                $comm->dt_add = $item->date;
                $comm->text = $item->text;
                //$comm->save();
                echo 'comment - ' . $comm->vk_id . ' add' . "\n";
                if(!empty($item->attachments))
                {
                    $this->saveDoc($item, $comm->id);
                }

                $this->savePhoto($item, $postSysId, $comm->id);
                $this->saveGif($item, $postSysId, $comm->id);
            }
            $this->saveAuthors($res->response->profiles);
        }
    }

    public function actionGetGroupInfo()
    {
        $this->getVk();
        $groups = VkGroups::find()->where(['in','status', [1, 2]])->all();
        foreach ($groups as $group) {
            sleep(1);
            $res = $this->vk->request('groups.getById', ['group_id' => $group->vk_id * -1]);
            $res = json_decode($res);
            if(isset($res->response[0])){
                $this->saveGroupInfo($res->response[0], $groups);
            }
        }

    }

    public function saveGroupInfo($group_info, $groups = null)
    {
        $groups = (!$groups)? : VkGroups::find()->where(['in','status', [1, 2]])->all();
        foreach ($groups as $group)
        {
            if($group->vk_id * -1 == $group_info->id)
            {
                $group->photo_50 = $group_info->photo_50;
                $group->photo_100 = $group_info->photo_100;
                $group->photo_200 = $group_info->photo_200;
                $group->save();
                //Debug::prn($group);
            }

        }

    }

}