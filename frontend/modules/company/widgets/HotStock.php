<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 24.04.2017
 * Time: 22:05
 */

namespace frontend\modules\company\widgets;

use common\models\db\KeyValue;
use common\models\db\Stock;
use yii\base\Widget;

class HotStock extends Widget
{

    public function run()
    {
        $hotStock = KeyValue::findOne(['key' => 'hot_stock']);
        $model = Stock::findAll(['id' => json_decode($hotStock->value)]);
        return $this->render('hot_stock', [
            'model' => $model,
        ]);
    }

}