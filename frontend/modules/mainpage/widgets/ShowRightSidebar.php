<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 07.12.17
 * Time: 16:02
 */

namespace frontend\modules\mainpage\widgets;

use common\classes\Debug;
use common\models\db\TagsRelation;
use yii\base\Widget;

class ShowRightSidebar extends Widget
{
    public $tagId = 1;
    public function run()
    {
        $news = TagsRelation::find()
            ->joinWith('news.comments')
            ->where(
                [
                    'tag_id' => $this->tagId,
                    '`tags_relation`.`type`' => 'news',
                    '`news`.`status`' => 0,

                ]
            )
            ->andWhere(['<=', '`news`.`dt_public`', time()])
            ->orderBy('`news`.`dt_update` DESC')
            ->limit(5)

            ->all();

        $result = [];

        $posts = \backend\modules\vk\models\VkStream::find()
            ->where(['status' => 1,])
            ->with('group', 'photo', 'gif')
            ->orderBy('dt_add DESC')
            ->limit(5)
            ->all();

        foreach ($posts as $post)
        {
            if(!empty($post->photo) || !empty($post->gif))
            {
                $result[] = $post;
            }
            if(count($result) >= 1)
            {
                break;
            }
        }

       // Debug::prn($news);
        return $this->render('sidebar',
            [
                'news' => $news,
                'post' => $result,
            ]);
    }

}