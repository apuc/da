<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.04.2017
 * Time: 23:08
 */

namespace frontend\modules\poster\widgets;

use yii\base\Widget;
use common\classes\Debug;
use common\models\db\KeyValue;

class InterestedIn extends Widget
{
    public function run()
    {
        $interestedInPostersJson = KeyValue::findOne(['key' => 'intrested_in_posters']);
        $interestedInPosters = json_decode($interestedInPostersJson->value);
        $firstInterestedInPosters = array_slice($interestedInPosters, 0, 4);

        return $this->render('interested_in', [
            'interestedInPosters' => $firstInterestedInPosters,
            'interestedInPostersCount' => count($interestedInPosters),
        ]);
    }
}
