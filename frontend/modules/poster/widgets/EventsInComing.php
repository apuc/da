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

    public function run()
    {
        if(empty($this->slug)){
            $poster = Poster::find()
                /*->joinWith('categories')*/
                ->where(['>=', 'dt_event_end', time()])
                /*->andFilterWhere(['`category_poster`.`slug`' => $this->slug])*/
                ->orderBy('dt_event ')
                ->limit(4)
                ->with('categories')
                ->all();

            $countPoster = Poster::find()
                ->where(['>=', 'dt_event_end', time()])
                ->count();
        }
        else {
            $poster = Poster::find()
                ->joinWith('categories')
                ->where(['>=', 'dt_event_end', time()])
                ->andFilterWhere(['`category_poster`.`slug`' => $this->slug])
                ->orderBy('dt_event ')
                ->limit(4)
                ->with('categories')
                ->all();

            $countPoster = Poster::find()
                ->joinWith('categories')
                ->where(['>=', 'dt_event_end', time()])
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