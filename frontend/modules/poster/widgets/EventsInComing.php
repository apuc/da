<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.04.2017
 * Time: 13:04
 */

namespace frontend\modules\poster\widgets;

use common\classes\Debug;
use common\models\db\Poster;
use yii\base\Widget;

class EventsInComing extends Widget
{

    public $slug;
    public $useReg;


    public function run()
    {
        if(empty($this->slug)){
            $posterQuery = Poster::find()
                /*->joinWith('categories')*/
                ->where(['>=', 'dt_event_end', time()])
                ->andWhere(['status' => 0]);
            if($this->useReg != -1){
                $posterQuery->andWhere("(`region_id` IS NULL OR `region_id`=$this->useReg)");

            }
            $poster = $posterQuery
                /*->andFilterWhere(['`category_poster`.`slug`' => $this->slug])*/
                ->orderBy('dt_event ')
                ->limit(12)
                ->with('categories')
                ->all();

            $countPosterQuery = Poster::find()
                ->where(['>=', 'dt_event_end', time()]);
            if($this->useReg != -1){
                $countPosterQuery->andWhere("(`region_id` IS NULL OR `region_id`=$this->useReg)");

            }
            $countPoster = $countPosterQuery
                ->andWhere(['status' => 0])
                ->count();
        }
        else {
            $posterQuery = Poster::find()
                ->joinWith('categories')
                ->where(['>=', 'dt_event_end', time()])
                ->andWhere(['status' => 0])
                ->andFilterWhere(['`category_poster`.`slug`' => $this->slug]);
            if($this->useReg != -1){
                $posterQuery->andWhere("(`region_id` IS NULL OR `region_id`=$this->useReg)");

            }
            $poster = $posterQuery->orderBy('dt_event ')
                ->limit(12)
                ->with('categories')
                ->all();

            $countPosterQuery = Poster::find()
                ->joinWith('categories')
                ->where(['>=', 'dt_event_end', time()])
                ->andWhere(['status' => 0]);
            if($this->useReg != -1){
                $countPosterQuery->andWhere("(`region_id` IS NULL OR `region_id`=$this->useReg)");

            }
            $countPoster = $countPosterQuery
                ->andFilterWhere(['`category_poster`.`slug`' => $this->slug])
                ->count();
        }

        //Debug::prn($poster);
        if($poster){
            return $this->render('events_in_coming', [
                'posters' => $poster,
                'slug' => $this->slug,
                'countPoster' => $countPoster,
            ]);
        }
    }

}