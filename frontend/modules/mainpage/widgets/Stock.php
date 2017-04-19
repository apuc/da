<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 18.04.2017
 * Time: 15:16
 */

namespace frontend\modules\mainpage\widgets;

use yii\base\Widget;

class Stock extends Widget
{

    public function run()
    {
        $stock = \common\models\db\Stock::find()->where(['main' => 1])->all();
        return $this->render('stock', [
            'stock' => $stock
        ]);
    }

}