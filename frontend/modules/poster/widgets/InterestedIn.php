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
        $interestedInPosters = KeyValue::findOne(['key' => 'intrested_in_posters']);

        return $this->render('interested_in', [
           'interestedInPosters' => json_decode($interestedInPosters->value),
        ]);
    }
}
