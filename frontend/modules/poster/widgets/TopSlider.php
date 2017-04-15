<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 30.03.2017
 * Time: 16:08
 */

namespace frontend\modules\poster\widgets;

use common\classes\Debug;
use common\models\db\KeyValue;
use common\models\db\Poster;
use yii\base\Widget;

class TopSlider extends Widget
{

    public function run()
    {
        $topSlider = KeyValue::findOne(['key' => 'poster_page_top_slider']);
        $posters = Poster::find()
            ->where(['id' => json_decode($topSlider->value)])
            ->orderBy('views DESC')
            ->with('categories')
            ->all();
        return $this->render('top_slider', [
            'posters' => $posters,
        ]);
    }

}