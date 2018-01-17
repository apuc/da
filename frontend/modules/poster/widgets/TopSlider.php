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
    public $useReg;

    public function run()
    {
        $topSlider = KeyValue::findOne(['key' => 'poster_page_top_slider']);
        $query = Poster::find()
            ->where(['id' => json_decode($topSlider->value)])
            ->orderBy('views DESC');
        if($this->useReg != -1){
            $query->andWhere("(`region_id` IS NULL OR `region_id`=$this->useReg)");

        }
        $posters = $query->with('categories')
            ->all();
        return $this->render('top_slider', [
            'posters' => $posters,
        ]);
    }

}