<?php
/**
 * Created by PhpStorm.
 * User: MEMES
 * Date: 22.05.2018
 * Time: 12:30
 */

namespace frontend\modules\shop\widgets;
use common\models\db\ProductMark;
use yii\base\Widget;


class ShowCartSideProducts extends Widget
{

    public function run()
    {
        $hitProducts = ProductMark::getProductsByMarks([ProductMark::MARK_HIT], 2);
        return $this->render('cart_sidebar', ['hitProducts' => $hitProducts]);
    }
}