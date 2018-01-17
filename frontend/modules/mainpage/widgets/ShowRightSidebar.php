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
            ->orderBy('RAND()')
            //->orderBy('cnt DESC')
            ->limit(5)
            ->all();


       // Debug::prn($news);
        return $this->render('sidebar',
            [
                'news' => $news,
                'userReg' => $useReg,
            ]);
    }

}