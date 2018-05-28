<?php
/**
 * @var $modelReviews frontend\modules\shop\models\form\ReviewsForm
 * @var $modelQuestion frontend\modules\shop\models\form\QuestionForm
 * @var $reviews \common\models\db\ProductsReviews
 */

use common\classes\UserFunction;
use yii\bootstrap\ActiveForm;
?>

<h2 class="single-shop__tab-title">Отзывы товара</h2>
<div class="business__reviews">
<?php if(empty($reviews)):?>
    <h3>Ни кто не оставлял отзыва</h3>
<?php else:?>


    <?php foreach ($reviews as $item): ?>
        <div class="business__reviews--item">
            <div class="business__reviews--avatar">
                <?= \common\classes\UserFunction::getUser_avatar_html($item['user_id']); ?>
            </div>
            <div class="descr">
                <span class="date"><?= date('H:i d-m-Y', $item->dt_add) ?></span>
                <h3><?= UserFunction::getUserName($item['user_id']) ?></h3>
                <p class="full"><?= $item->content ?></p>
            </div>
        </div>
    <?php endforeach; ?>

<?php endif;?>
</div>
<?php
if(Yii::$app->user->isGuest):?>
    <p class="offers_content">
        <span>Задайте вопрос или оставьте комментарий</span><br/>
        <span>Чтобы оставлять комментарии, Вам нужно подтвердить авторизироваться.<br/></span>
    </p>
<?php else: ?>

<h3>Напишите свой отзыв:</h3>
    <?php /*$form = ActiveForm::begin(
        [
            'id' => 'addReviewsProducts',
            'action' => '/ajax/ajax/add-reviews-products',
        ]
    )*/?><!--
        <div class="addReviewsFormWr">
            <div class="reatingWr" >
                <h3>Поставте оценку</h3>
                <div style="width: 141px;">
                    <input id="input-1-xs" data-step="1">
                    <?/*= $form->field($model, 'rating')->hiddenInput()
                        ->label(false);
                    */?>
                </div>


            </div>
            <?/*= $form->field($model, 'product_id')->hiddenInput(['value' => $productId])->label(false); */?>

            <?/*= $form->field($model, 'content')->textarea()->label('Ваш отзыв')*/?>

            <input type="submit" value="Добавить" class="btn btn-save" id="addReviews">
        </div>
    --><?php /*ActiveForm::end(); */?>


        <h4 class="add-owl-reviews-title">Добавьте совой отзыв или коментарий по данному товару</h4>
        <ul class="single-shop__tab-links">
            <li class="active" data-page="0">Отзыв о товаре</li>
            <li data-page="1" class="">Краткий комментарий</li>
        </ul>
        <div class="single-shop__tab-content">

            <div class="single-shop__tab-item" style="display: none;">

                <?php $form = ActiveForm::begin(
                    [
                        'id' => 'addReviewsProducts',
                        'action' => '/ajax/ajax/add-reviews-products',
                    ]
                )?>
                <div class="single-shop__form-left">
                    <div class="reatingWr" >
                        <h3>Поставте оценку</h3>
                        <div style="width: 141px;">
                            <input id="input-1-xs" data-step="1">
                            <?= $form->field($modelReviews, 'rating')->hiddenInput()
                                ->label(false);
                            ?>
                        </div>


                    </div>
                    <?= $form->field($modelReviews, 'plus')->textInput()->label('Достоинтсва')?>

                    <?= $form->field($modelReviews, 'minus')->textInput()->label('Недостатки')?>

                    <?= $form->field($modelReviews, 'product_id')->hiddenInput(['value' => $productId])->label(false); ?>

                    <?= $form->field($modelReviews, 'content')->textarea()->label('Ваш отзыв')?>


                    <input type="submit" value="Добавить" class="btn btn-save" id="addReviews">
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

            <div class="single-shop__tab-item" style="display:block;">
                <?php $form = ActiveForm::begin(
                    [
                        'id' => 'addQuestionProducts',
                        'action' => '/ajax/ajax/add-question-products',
                    ]
                )?>
                <div class="single-shop__form-left">

                    <?= $form->field($modelQuestion, 'product_id')->hiddenInput(['value' => $productId])->label(false); ?>

                    <?= $form->field($modelQuestion, 'content')->textarea()->label('Ваш отзыв')?>


                    <input type="submit" value="Добавить" class="btn btn-save" id="addReviews">
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


<?php endif;?>

