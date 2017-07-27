<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 27.07.2017
 * Time: 11:19
 */

namespace frontend\widgets;

use common\models\db\Stock;
use yii\base\Widget;

class StockErrorPage extends Widget
{
    public function run()
    {
        $stock = Stock::find()->where(['status' => 0])->orderBy('RAND()')->limit(4)->all();
        return $this->render('stock-error-page', ['stock' => $stock]);
    }
}