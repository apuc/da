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

    public function run()
    {
        $poster = Poster::find()
            ->where(['>', 'dt_event', time()])
            ->limit(4)
            ->with('categories')
            ->all();
        //Debug::prn($poster);
        return $this->render('events_in_coming', [
            'posters' => $poster
        ]);
    }

}