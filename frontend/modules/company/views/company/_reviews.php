<?php
/**
 * @var $model \common\models\db\Company
 * @var $feedback \common\models\db\CompanyFeedback
 * @var $item \common\models\db\CompanyFeedback
 */

use common\classes\UserFunction;

?>
<div id="reviews" class="business__tab-content--wrapper">
    <div class="business__reviews">
        <?php if (!empty($feedback)): ?>
            <?php foreach ($feedback as $item): ?>
                <div class="business__reviews--item">
                    <div class="business__reviews--avatar">
                        <?= \common\classes\UserFunction::getUser_avatar_html($item['user_id']); ?>
                    </div>
                    <?php \common\classes\Debug::prn($item->rating); ?>
                    <div class="descr">
                        <span class="date"><?= date('H:i d-m-Y', $item->dt_add) ?></span>
                        <h3><?= UserFunction::getUserName($item['user_id']) ?></h3>
                        <p class="full"><?= $item->feedback ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="what-say__servises">
            <?php if (!Yii::$app->user->isGuest): ?>
                <a href="#" id="add-review"
                   data-id="<?= $model->id ?>"
                   data-name="<?= $model->name ?>"
                ><span class="comments-icon"></span>Написать свой отзыв</a>
            <?php else: ?>
                <a href="<?= \yii\helpers\Url::to(['/user/login']) ?>"><span
                            class="comments-icon"></span>Авторизируйтесь чтобы оставить отзыв</a>
            <?php endif; ?>
        </div>
    </div>
</div>