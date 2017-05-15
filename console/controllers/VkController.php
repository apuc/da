<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.05.2017
 * Time: 15:22
 */

namespace console\controllers;

use common\classes\Debug;
use common\models\db\VkAuthors;
use common\models\db\VkGroups;
use common\models\db\VkStream;
use common\models\VK;
use yii\console\Controller;

class VkController extends Controller
{

    public $count = 50;

    public function actionIndex()
    {
        echo 'test';
    }

    public function actionGetStream()
    {
        $vk = new VK([
            'client_id' => '6029267',
            'client_secret' => '0QKWLW7n6XumtJV7VJ6h',
            'access_token' => '90fc0cc0178c0130800af68e6051952c869b88a713b1d787982d39c70660a561c8378c432e8c6dcdb077a',
        ]);
        $groups = VkGroups::find()->where(['status' => 1])->all();
        foreach ($groups as $group) {
            $res = $vk->getGroupWall($group->domain, ['count' => $this->count, 'extended' => 1]);
            $res = json_decode($res);
            //$this->saveAuthors($res->response->profiles);
            $this->saveStream($res->response->items);
        }
    }

    public function saveStream($items)
    {
        if(!empty($items)){
            foreach ((array)$items as $item){
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
                    $author->screen_name = $profile->screen_name;
                    $author->vk_id = $profile->id;
                    $author->photo = $profile->photo_100;
                    $author->save();
                    echo 'user - ' . $profile->id . ' add' . "\n";
                }
            }
        }
    }

}