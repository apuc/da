<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 28.03.2018
 * Time: 16:07
 */

namespace console\controllers;


use common\models\db\Comments;
use yii\console\Controller;

class CommentsController extends Controller
{
    public function actionIndex()
    {
        $comments = Comments::find()->where(['post_type' => 'news'])->all();
        foreach ($comments as $comment) {
            $newsComments = new \common\models\db\NewsComments();
            $newsComments->id = $comment->id;
            $newsComments->news_id = $comment->post_id;
            $newsComments->user_id = $comment->user_id;
            $newsComments->content = $comment->content;
            $newsComments->dt_add = $comment->dt_add;
            $newsComments->parent_id = $comment->parent_id;
            $newsComments->moder_checked = $comment->moder_checked;
            $newsComments->published = $comment->published;
            $newsComments->verified = $comment->verified;
            $newsComments->save();
        }

        $comments = Comments::find()->where(['post_type' => 'page'])->all();
        foreach ($comments as $comment) {
            $pagesComments = new \common\models\db\PagesComments();
            $pagesComments->id = $comment->id;
            $pagesComments->pages_id = $comment->post_id;
            $pagesComments->user_id = $comment->user_id;
            $pagesComments->content = $comment->content;
            $pagesComments->dt_add = $comment->dt_add;
            $pagesComments->parent_id = $comment->parent_id;
            $pagesComments->moder_checked = $comment->moder_checked;
            $pagesComments->published = $comment->published;
            $pagesComments->verified = $comment->verified;
            $pagesComments->save();
        }

        $comments = Comments::find()->where(['post_type' => 'vk_post'])->all();
        foreach ($comments as $comment) {
            $vkStreamComments = new \common\models\db\VkStreamComments();
            $vkStreamComments->id = $comment->id;
            $vkStreamComments->vk_stream_id = $comment->post_id;
            $vkStreamComments->user_id = $comment->user_id;
            $vkStreamComments->content = $comment->content;
            $vkStreamComments->dt_add = $comment->dt_add;
            $vkStreamComments->parent_id = $comment->parent_id;
            $vkStreamComments->moder_checked = $comment->moder_checked;
            $vkStreamComments->published = $comment->published;
            $vkStreamComments->verified = $comment->verified;
            $vkStreamComments->save();
        }
    }
}