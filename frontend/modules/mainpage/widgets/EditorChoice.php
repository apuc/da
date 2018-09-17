<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 20.12.17
 * Time: 10:47
 */

namespace frontend\modules\mainpage\widgets;

use common\classes\UserFunction;
use yii\jui\Widget;

class EditorChoice extends Widget
{
    public function run()
    {
        $useReg = UserFunction::getRegionUser();
        $query = \frontend\modules\news\models\News::find()
            ->where(['editor_choice' => 1]);
        if($useReg != -1){
            $query->andWhere("(`region_id` IS NULL OR `region_id`=$useReg)");

        }
        $news = $query
            ->with('category')
            ->orderBy('dt_public DESC')
            ->limit(2)
            ->all();
        return $this->render('editor-choice',
            [
                'news' => $news,
            ]);
    }
}