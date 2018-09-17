<?php
/**
 * Created by PhpStorm.
 * User: MEMES
 * Date: 22.05.2018
 * Time: 11:11
 */

namespace frontend\modules\shop\widgets;


use common\models\db\ProductMark;
use yii\base\Widget;

class ShowEmptyCartProds extends Widget
{

    public function run()
    {
        $hitProducts = ProductMark::getProductsByMarks([ProductMark::MARK_HIT]);
        return $this->render('empty_cart_prods', ['hitProducts' => $hitProducts]);
    }
}