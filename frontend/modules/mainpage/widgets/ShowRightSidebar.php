<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 07.12.17
 * Time: 16:02
 */

namespace frontend\modules\mainpage\widgets;

use common\classes\Debug;
use common\classes\UserFunction;
use common\models\db\Comments;
use common\models\db\TagsRelation;
use yii\base\Widget;

class ShowRightSidebar extends Widget
{
    public $tagId = 1;
    public function run()
    {
        $useReg = UserFunction::getRegionUser();
        $query = Comments::find()
            ->select('post_id, count(*) AS cnt')
            ->where(['`comments`.`post_type`' => 'news']);
        if($useReg != -1){
            $query->joinWith('news');
            $query->andWhere("(`news`.`region_id` IS NULL OR `news`.`region_id`=$useReg)");
        }else{
            $query->with('news');
        }

        $news = $query
            ->groupBy('`comments`.`post_id`')
            ->orderBy('cnt DESC')
            ->limit(5)
            ->all();
       // Debug::prn($news);

        /*Debug::prn($news);

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

            ->all();*/

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
                'userReg' => $useReg,
            ]);
    }

}