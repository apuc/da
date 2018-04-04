<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 07.12.17
 * Time: 16:02
 */

namespace frontend\modules\mainpage\widgets;

use common\classes\UserFunction;
use common\models\db\NewsComments;
use yii\base\Widget;

class ShowRightSidebar extends Widget
{
    public $tagId = 1;

    public function run()
    {
        $useReg = UserFunction::getRegionUser();
        $query = NewsComments::find()
            ->select('news_id, count(*) AS count');
        if ($useReg != -1) {
            $query->joinWith('news');
            $query->andWhere("(`news`.`region_id` IS NULL OR `news`.`region_id`=$useReg)");
        } else {
            $query->with('news');
        }

        $news = $query
            ->groupBy('`news_comments`.`news_id`')
            ->orderBy('RAND()')
            ->limit(5)
            ->all();


        return $this->render('sidebar',
            [
                'news' => $news,
                'userReg' => $useReg,
            ]);
    }

}