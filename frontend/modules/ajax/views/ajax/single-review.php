<?php

/**
 * @var $modelReviews frontend\modules\shop\models\form\ReviewsForm
 * @var $modelQuestion frontend\modules\shop\models\form\QuestionForm
 * @var $item \common\models\db\ProductsReviews
 */

use common\classes\UserFunction;
use frontend\modules\shop\widgets\StarsRating;

?>
<div class="comments">
    <div class="review-header">
        <div class="name"><?= UserFunction::getUserName($item['user_id']) ?></div>
        <div class="rating-stars">
            <?php if ($item['rating']): ?>
                <?= StarsRating::widget([
                    'rating' => $item['rating']
                ]) ?>
            <?php endif ?>
            <div class="date"><?= date('d-F-Y', $item['dt_add']) ?></div>
        </div>
    </div>
    <?= $item->content ?>
    <div class="advantages">
        <?php if ($item['plus']): ?>
            <b>Достоинства:</b> <?= $item['plus'] ?>
        <?php endif ?>
    </div>

    <div class="disadvantages">
        <?php if ($item['minus']): ?>
            <b>Недостатки:</b> <?= $item['minus'] ?>
        <?php endif ?>
    </div>
    <a href="#" class="reply-btn">Ответить</a>
    <span class="delimiter">|</span>
    <a href="#" class="answers-btn">2 Ответа</a>
    <div class="replies-wrap">
    </div>
</div>

