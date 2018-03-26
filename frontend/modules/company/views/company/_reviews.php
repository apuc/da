<?php
/**
 * @var $model \common\models\db\Company
 * @var $feedback \common\models\db\CompanyFeedback
 * @var $item \common\models\db\CompanyFeedback
 */

use common\classes\UserFunction;
use common\models\db\CompanyFeedback;
use yii\widgets\ActiveForm;

?>
<div id="reviews" class="business__tab-content--wrapper">
    <div class="business__reviews">
        <?php if (!empty($feedback)): ?>
            <?php foreach ($feedback as $item): ?>
                <div class="business__reviews--item">
                    <div class="business__reviews--avatar">
                        <?= \common\classes\UserFunction::getUser_avatar_html($item['user_id']); ?>
                    </div>
                    <div class="descr">
                        <span class="date"><?= date('H:i d-m-Y', $item->dt_add) ?></span>
                        <h3><?= UserFunction::getUserName($item['user_id']) ?></h3>
                        <?php if (!empty($item->rating)): ?>
                            <div class='rating-stars'>
                                <input id="input-user-xs" data-step="1" value="<?= $item->rating; ?>">
                            </div>
                        <?php endif; ?>
                        <p class="full"><?= $item->feedback ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>


        <?php

        $companyFeedback = new CompanyFeedback();

        if (Yii::$app->user->isGuest):?>
            <p class="offers_content">
                <span>Задайте вопрос или оставьте комментарий</span><br/>
                <span>Чтобы оставлять комментарии, Вам нужно подтвердить авторизироваться.<br/></span>
            </p>
        <?php else: ?>
            <?php $form = ActiveForm::begin(
                [
                    'id' => 'addCompanyReviews',
                    'action' => '/company/company/add-feedback',

                ]) ?>
            <h3>Напишите свой отзыв:</h3>
            <div class="addCompanyReviewsForm">
                <div class="company-rating">
                    <h3>Поставте оценку</h3>
                    <div style="width: 141px;">
                        <input id="input-1-xs" data-step="1">
                        <?= $form->field($companyFeedback, 'rating')->hiddenInput()
                            ->label(false);
                        ?>
                    </div>
                </div>

                <?= $form->field($companyFeedback, 'dt_add')->hiddenInput(['value' => time()])->label(false); ?>
                <?= $form->field($companyFeedback, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false); ?>
                <?= $form->field($companyFeedback, 'company_id')->hiddenInput(['value' => $model->id])->label(false); ?>
                <?= $form->field($companyFeedback, 'feedback')->textarea()->label('Ваш отзыв') ?>

                <input type="submit" value="Добавить" class="btn btn-save" id="addReviews">
            </div>
            <?php ActiveForm::end(); ?>
        <?php endif; ?>
    </div>
</div>