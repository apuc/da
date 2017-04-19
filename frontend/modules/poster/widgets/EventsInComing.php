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
        $poster = Poster::find()
            ->joinWith('categories')
            ->where(['>', 'dt_event', time()])
            ->andFilterWhere(['`category_poster`.`slug`' => $this->slug])
            ->limit(4)
            ->all();
        //Debug::prn($poster);
        if($poster){
            return $this->render('events_in_coming', [
                'posters' => $poster,
                'slug' => $this->slug
            ]);
        }
    }

}