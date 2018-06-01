<?php
namespace frontend\modules\shop\widgets;

use yii\base\Widget;

class StarsRating extends Widget
{
    public $rating;

    public function run()
    {
        return $this->render('stars-rating',
            [
                'rating' => $this->rating
            ]);
    }
}