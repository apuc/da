<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 06.03.18
 * Time: 9:45
 */

namespace frontend\modules\shop\widgets;

use common\models\db\ProductsReviews;
use yii\base\Widget;

class ReviewsProducts extends Widget
{
    public $productId;
    public function run()
    {
        $model = new ProductsReviews();

        $reviews = ProductsReviews::find()->where(['product_id' => $this->productId])->all();

        return $this->render('reviews',
            [
                'model' => $model,
                'productId' => $this->productId,
                'reviews' => $reviews,
            ]);
    }
}