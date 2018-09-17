<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.03.2017
 * Time: 15:06
 */

namespace frontend\widgets;

use common\classes\Debug;
use common\models\db\Situation;
use common\models\db\SituationStatus;
use yii\base\Widget;

class SituationMain extends Widget
{

    public function run()
    {
        $sit = Situation::find()->with('status')->all();
        return $this->render('sit', ['sit'=>$sit]);
    }

}