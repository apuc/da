<?php
/**
 * @var $model \common\models\db\ProductsReviews
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
    <?php $form = ActiveForm::begin(
        [
            'id' => 'addReviewsProducts',
            'action' => '/ajax/ajax/add-reviews-products',
        ]
    )?>
        <div class="addReviewsFormWr">
            <div class="reatingWr" >
                <h3>Поставте оценку</h3>
                <div style="width: 210px;">
                    <!--<input id="input-1-xs"  data-min="0" data-max="5" data-step="1" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs">-->
                    <input id="input-1-xs" data-step="1">
                    <?= $form->field($model, 'rating')->hiddenInput()
                        ->label(false);
                    ?>
                </div>


            </div>
            <?= $form->field($model, 'product_id')->hiddenInput(['value' => $productId])->label(false); ?>

            <?= $form->field($model, 'content')->textarea()->label('Ваш отзыв')?>

            <input type="submit" value="Добавить" class="btn btn-save" id="addReviews">
        </div>
    <?php ActiveForm::end(); ?>



<?php endif;?>

