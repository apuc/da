<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 06.03.18
 * Time: 9:45
 */

namespace frontend\modules\shop\widgets;

use common\models\db\ProductsReviews;
use frontend\modules\shop\models\form\QuestionForm;
use frontend\modules\shop\models\form\ReviewsForm;
use yii\base\Widget;

class ReviewsProducts extends Widget
{
    public $productId;
    public $reviews;
    public function run()
    {
        $modelReviews = new ReviewsForm();
        $modelQuestion = new QuestionForm();

        //$reviews = ProductsReviews::find()->where(['product_id' => $this->productId])->all();

        return $this->render('reviews',
            [
                'modelReviews' => $modelReviews,
                'modelQuestion' => $modelQuestion,
                'productId' => $this->productId,
                'reviews' => $this->reviews,
            ]);
    }
}