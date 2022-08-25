<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.05.2017
 * Time: 15:22
 */

namespace console\controllers;

use common\classes\Debug;
use common\models\db\GooglePlusPhoto;
use common\models\db\GooglePlusPosts;
use common\models\db\GooglePlusUsers;
use yii\console\Controller;

class GoogleController extends Controller
{
    function init()
    {
        parent::init();
    }

    public static $key = 'AIzaSyA8pB7KFccjRUonbm4Uy8kJHU8ui2k_K5M';

    public function actionIndex()
    {
        echo "test";
    }

    public function actionGetUserPosts($id){
        $result = $this->getUserWall($id);
        $result = json_decode($result);
        foreach($result->items as $item){
            if(!GooglePlusPosts::find()->where(['post_id' => $item->id])->one()) {
                $post = new GooglePlusPosts();
                $post->post_id = $item->id;
                $post->updated = $item->updated;
                $post->dt_publish = strtotime(substr($item->published, 0, 10));
                $post->content = $item->title;
                $post->url = $item->url;
                $post->user_id = self::saveUser($item->actor);
                $post->views = 0;
                $post->status = 2;
                $post->save();
                echo "    SAVE PHOTOS    ";
                if(isset($item->object->attachments[0])) {
                    echo "     NO ATTACHMENTS    \n";
                    self::savePhotos($item->object->attachments, $post->id);
                }
            }
        }
    }

    //сохраняет пользователя, возвращает его id в базе данных
    public function saveUser($actor){
        if(!$user = GooglePlusUsers::find()->where(['user_id' => $actor->id])->one()) {
            $user = new GooglePlusUsers();
            $user->user_id = $actor->id;
            $user->display_name = $actor->displayName;
            $user->url = $actor->url;
            $user->image = $actor->image->url;
            $user->save();
        }
        return $user->id;
    }
    //сохраняет картинки и гифки
    public function savePhotos($attachments, $post_id){
        foreach($attachments as $attachment){
            echo 'att  ';
            if($attachment->objectType == 'photo'){
                echo 'photo  ';
                $photo = new GooglePlusPhoto();
                $photo->google_url = $attachment->url;
                $photo->url = $attachment->image->url;
                $photo->full_image_url = $attachment->fullImage->url;
                $photo->post_id = $post_id;
                $photo->save();
            }
            else if($attachment->objectType == 'album'){
                echo 'album  ';
                foreach($attachment->thumbnails as $thumbnail){
                    echo 'album_photo  ';
                    $photo = new GooglePlusPhoto();
                    $photo->google_url = $thumbnail->url;
                    $photo->url = $thumbnail->image->url;
                    $photo->post_id = $post_id;
                    $photo->save();
                }
            }
            else if($attachment->objectType == 'article'){
                echo 'article  ';
                $photo = new GooglePlusPhoto();
                $photo->display_name = $attachment->displayName;
                $photo->google_url = $attachment->url;
                $photo->url = $attachment->image->url;
                $photo->full_image_url = $attachment->fullImage->url;
                $photo->post_id = $post_id;
                $photo->save();
            }
        }
    }

    public function actionGetUsersInfo()
    {
        $users = GooglePlusUsers::find()->all();
        foreach($users as $user) {
            $response = json_decode(file_get_contents('https://www.googleapis.com/plus/v1/people/' .
                $user->user_id . '?key=' . self::$key));
            if (!isset($response->error)) {
                $user->display_name = $response->displayName;
                $user->url = $response->url;
                $user->image = $response->image->url;
                $user->save();
            }
        }
    }

    //отправляет запрос, возвращает ответ от google
    public function getUserWall($UserId)
    {
        return file_get_contents('https://www.googleapis.com/plus/v1/people/' .
            $UserId .
            '/activities/public?key=' . self::$key);
    }

}