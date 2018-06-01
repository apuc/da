<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 28.05.18
 * Time: 16:23
 */

namespace frontend\modules\shop\models\form;

use common\models\db\ProductsReviews;
use dektrium\user\models\User;
use frontend\modules\shop\models\Products;

class ReviewsForm extends ProductsReviews
{
    public function rules()
    {
        return [
            [['user_id', 'content', 'dt_add', 'product_id', 'rating', 'plus', 'minus'], 'required'],
            [['user_id', 'dt_add', 'product_id', 'published', 'rating'], 'integer'],
            [['content'], 'string'],
            [['plus', 'minus'], 'string', 'max' => 512],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'content' => 'Отзыв',
            'rating' => 'Рейтинг',
            'plus' => 'Достоинства',
            'minus' => 'Недостатки'
        ];
    }

}