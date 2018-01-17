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
{ public $useReg;
    public function run()
    {
        $postersQuery = Poster::find()
            ->joinWith('categories')
            ->where(['>=', 'dt_event_end', time()])
            ->andWhere(['`category_poster`.`slug`' => 'kino']);
        if($this->useReg != -1){
            $postersQuery->andWhere("(`region_id` IS NULL OR `region_id`=$this->useReg)");

        }
        $posters = $postersQuery
            ->orderBy('dt_event ASC')
            ->limit(4)
            ->all();
        //Debug::prn($posters->createCommand()->rawSql);

        $countPosterQuery = Poster::find()
            ->joinWith('categories')
            ->where(['>=', 'dt_event_end', time()]);
        if($this->useReg != -1){
            $countPosterQuery->andWhere("(`region_id` IS NULL OR `region_id`=$this->useReg)");

        }
        $countPoster = $countPosterQuery
            ->andWhere(['`category_poster`.`slug`' => 'kino'])
            ->count();

        //Debug::prn($posters);
        return $this->render('what_to_see', [
            'posters' => $posters,
            'countPoster' => $countPoster,
        ]);
    }
}