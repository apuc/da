<?php
/**
 * Created by PhpStorm.
 * User: perff
 * Date: 09.08.2017
 * Time: 14:05
 */

namespace frontend\widgets;


use common\classes\Debug;
use common\models\db\VkStream;
use yii\base\Widget;

class StreamMain extends Widget
{
    public function run()
    {
        $result = [];

        $posts = \backend\modules\vk\models\VkStream::find()
            ->where(['status' => 1,])
            ->with('author', 'group', 'photo', 'gif')
            ->orderBy('dt_add DESC')
            ->all();

        foreach ($posts as $post)
        {
            if(!empty($post->photo) || !empty($post->gif))
            {
                $result[] = $post;
            }
            if(count($result) >= 4)
            {
                return $this->render('stream_main', ['posts'=>$result]);
            }
        }
    }
}