<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 30.03.2017
 * Time: 16:08
 */

namespace frontend\modules\poster\widgets;

use common\classes\Debug;
use common\models\db\Poster;
use yii\base\Widget;

class TopSlider extends Widget
{

    public function run()
    {
        $posters = Poster::find()
            ->where(['>','dt_event', time()])
            ->orderBy('views DESC')
            ->limit(6)
            ->with('categories')
            ->all();
        return $this->render('top_slider', [
            'posters' => $posters,
        ]);
    }

}