<?php
/**
 * @var $modelReviews frontend\modules\shop\models\form\ReviewsForm
 * @var $modelQuestion frontend\modules\shop\models\form\QuestionForm
 * @var $reviews \common\models\db\ProductsReviews
 * @var $productId integer
 */

use common\classes\UserFunction;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

?>

<h3 class="shop__reviews-title-2">Отзывы покупателей</h3>
<div class="shop__usefull-comments">
    <?php Pjax::begin(['id' => 'shop__usefull-comments'])?>

    <?php if (empty($reviews)): ?>
        <h3>Ни кто не оставлял отзыва</h3>
    <?php else: ?>


        <?php foreach ($reviews as $item): ?>
            <?php if ($item['parent_id'] === null): ?>
                <div class="comments">
                    <div class="review-header">
                        <div class="name"><?= UserFunction::getUserName($item['user_id']) ?></div>
                        <div class="rating-stars">
                            <ul class="stars">
                                <li class="star selected" title="Poor" data-value="1">
                                    <i class="fa fa-star fa-fw"></i>
                                </li>
                                <li class="star selected" title="Fair" data-value="2">
                                    <i class="fa fa-star fa-fw"></i>
                                </li>
                                <li class="star selected" title="Good" data-value="3">
                                    <i class="fa fa-star fa-fw"></i>
                                </li>
                                <li class="star selected" title="Excellent" data-value="4">
                                    <i class="fa fa-star fa-fw"></i>
                                </li>
                                <li class="star" title="WOW!!!" data-value="5">
                                    <i class="fa fa-star fa-fw"></i>
                                </li>
                            </ul>
                            <div class="date"><?= date('d-F-Y', $item['dt_add']) ?></div>
                        </div>
                    </div>
                    <?= $item->content ?>
                    <div class="advantages">
                        <b>Достоинства:</b> <?= $item['plus'] ?>
                    </div>

                    <div class="disadvantages">
                        <b>Недостатки:</b> <?= $item['minus'] ?>
                    </div>
                    <a href="#" class="reply-btn">Ответить</a>
                    <span class="delimiter">|</span>
                    <a href="#" class="answers-btn">2 Ответа</a>
                    <div class="replies-wrap">
                        <?php foreach ($reviews as $answer): ?>
                            <?php if ($answer['parent_id'] == $item['id']): ?>
                                <div class="replies" style="border-top: 1px solid #eee">

                                    <div class="name"><?= UserFunction::getUserName($answer['user_id']) ?></div>

                                    <div class="date"><?= date('d-F-Y', $item['dt_add']) ?></div>

                                    <div class="replies-comment">
                                        <?= $answer->content ?>
                                    </div>

                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach; ?>

    <?php endif; ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
<?php
if (Yii::$app->user->isGuest):?>
    <p class="offers_content">
        <span>Задайте вопрос или оставьте комментарий</span><br/>
        <span>Чтобы оставлять комментарии, Вам нужно авторизироваться.<br/></span>
    </p>
<?php else: ?>
    <div class="single-shop__tabs">
        <ul class="single-shop__tab-links">
            <li>Отзыв о товаре</li>
            <li>Краткий комментарий</li>
        </ul>
        <div class="single-shop__tab-content">

            <div class="single-shop__tab-item">

                <div class="rating-stars rating-tabs">
                    <ul class="stars">
                        <li class="star selected" title="Poor" data-value="1">
                            <i class="fa fa-star fa-fw"></i>
                        </li>
                        <li class="star selected" title="Fair" data-value="2">
                            <i class="fa fa-star fa-fw"></i>
                        </li>
                        <li class="star selected" title="Good" data-value="3">
                            <i class="fa fa-star fa-fw"></i>
                        </li>
                        <li class="star selected" title="Excellent" data-value="4">
                            <i class="fa fa-star fa-fw"></i>
                        </li>
                        <li class="star" title="WOW!!!" data-value="5">
                            <i class="fa fa-star fa-fw"></i>
                        </li>
                    </ul>
                    <span class="estimate">Оцените товар</span>
                </div>

                <?php $form = ActiveForm::begin(
                    [
                        'class' => 'single-shop__review-product',
                        'id' => 'addReviewsProducts',
                    ]
                ) ?>
                <div class="single-shop__form-left">


                    <?= $form->field($modelReviews, 'product_id')->hiddenInput(['value' => $productId])->label(false); ?>
                    <?= $form->field($modelReviews, 'plus')->textInput(['id' => 'dignity'])->label('Достоинтсва') ?>
                    <?= $form->field($modelReviews, 'minus')->textInput(['id' => 'disadvantages'])->label('Недостатки') ?>
                    <?= $form->field($modelReviews, 'content')->textarea(['id' => 'disadvantages'])->label('Комментарий') ?>

                    <input type="submit" value="Добавить" class="review-product-btn" id = 'addReviews'>
                    <?= \yii\helpers\Html::button('Отмена', ['class' => "review-product-cancel"]); ?>



                </div>
                <div class="single-shop__warning-right">
                    <h3 class="warning-right-title">Важно!</h3>

                    <p class="warning-right-desk">
                        Чтобы Ваш отзыв либо комментарий прошел модерацию и был опубликован, ознакомьтесь,
                        пожалуйста, <a href="#">с нашими правилами!</a>
                    </p>
                </div>
                <?php ActiveForm::end(); ?>

            </div>

            <div class="single-shop__tab-item">

                <?php $form = ActiveForm::begin(
                    [
                        'id' => 'addQuestionProducts',
                        'class' => 'single-shop__review-product',
                    ]
                ) ?>

                    <div class="single-shop__form-left">


                        <?= $form->field($modelQuestion, 'product_id')->hiddenInput(['value' => $productId])->label(false); ?>
                        <?= $form->field($modelQuestion, 'content')->textarea(['id' => 'disadvantages'])->label('Комментарий') ?>

                        <input type="submit" value="Отправить отзыв" class="review-product-btn" id = 'addQuestion'>
                        <?= \yii\helpers\Html::button('Отмена', ['class' => "review-product-cancel"]); ?>



                    </div>
                    <div class="single-shop__warning-right">
                        <h3 class="warning-right-title">Важно!</h3>

                        <p class="warning-right-desk">
                            Чтобы Ваш отзыв либо комментарий прошел модерацию и был опубликован, ознакомьтесь,
                            пожалуйста, <a href="#">с нашими правилами!</a>
                        </p>
                    </div>
                    <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>

<?php endif; ?>

