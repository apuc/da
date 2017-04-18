<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.04.2017
 * Time: 15:57
 */

namespace frontend\modules\poster\widgets;

use common\classes\Debug;
use common\models\db\CategoryPoster;
use common\models\db\Poster;
use yii\base\Widget;

class WhatToSee extends Widget
{
    public function run()
    {
        $posters = Poster::find()
            ->joinWith('categories')
            ->where(['>', 'dt_event', time()])
            ->andWhere(['`category_poster`.`slug`' => 'kino'])
            ->limit(5)
            ->all();
        //Debug::prn($posters);
        return $this->render('what_to_see', [
            'posters' => $posters
        ]);
    }
}