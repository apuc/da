<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 20.04.2017
 * Time: 0:00
 * @var $feedbacks \common\models\db\CompanyFeedback
 */
use yii\helpers\Url;

?>
<section class="what-say">

    <div class="container">

        <h3 class="section-title">Отзывы о компаниях</h3>

        <div class="what-say__servises">

            <?php if (!Yii::$app->user->isGuest): ?><a href="#" id="add-review"><span class="comments-icon"></span>Написать
                отзыв</a><?php endif; ?>

            <a href="<?= Url::to(['/site/design']);?>"><span class="mail-icon"></span>Подписаться на эту тему</a>

        </div>

        <div class="what-say__wrap">
            <?php foreach ($feedbacks as $feedback): ?>
                <!-- item -->
                <a href="" class="what-say__wrap_item wrap-item-feedback">

                    <span class="rew-title"><?= $feedback->company_name ?> </span>

                    <div class="thumb">
                        <? $avatar = \common\classes\UserFunction::getUser_avatar_html($feedback->user->id)?>
                        <? if (strlen($avatar) > 2): ?>
                        <?= $avatar?>
                        <? else: ?>
                        <span><?=$avatar ?></span>
                        <? endif; ?>
                    </div>

                    <div class="rew-wrap">
                        <span class="name"><?= $feedback->user->username ?></span>
                        <p class="rew-descr"><?= $feedback->feedback ?></p>
                    </div>

                </a>
                <!-- item -->
            <?php endforeach; ?>
            <div class="more-block">
                <a href="<?= \yii\helpers\Url::to(['/site/design']);?>" class="show-more">посмотреть все</a>
            </div>

        </div>

    </div>

    <div id="modal-item-feedback" class="modal-review">
        <div class="container">
            <h3>Отзыв:</h3>
            <div class="what-say__wrap">

            </div>
        </div>
    </div>

    <div id="modal-company-rew" class="modal-company">

        <div class="thumb">
            <span>A</span>
            <img src="" alt="">
        </div>

        <div class="rew-wrap">
            <span class="name"></span>
            <p class="rew-descr"></p>

            <?= \frontend\widgets\FooterSocial::widget() ?>
           <!-- <span class="date"></span>-->

            <!--<div class="social-wrap">

                <a href="#" target="_blank" class="social-wrap__item vk">
                    <img src="img/soc/vk.png" alt="">
                </a>
                <a href="#" target="_blank" class="social-wrap__item fb">
                    <img src="img/soc/fb.png" alt="">
                </a>
                <a href="#" target="_blank" class="social-wrap__item ok">
                    <img src="img/soc/ok-icon.png" alt="">
                </a>
                <a href="#" target="_blank" class="social-wrap__item insta">
                    <img src="img/soc/insta-icon.png" alt="">
                </a>
                <a href="#" target="_blank" class="social-wrap__item twitter">
                    <img src="img/soc/twi-icon.png" alt="">
                </a>
                <a href="#" target="_blank" class="social-wrap__item google">
                    <img src="img/soc/google-icon.png" alt="">
                </a>
                <a href="#" target="_blank" class="social-wrap__item pinterest">
                    <img src="img/soc/pinter-icon.png" alt="">
                </a>
                <a href="#" target="_blank" class="social-wrap__item telegram">
                    <img src="img/soc/telegram-f.png" alt="">
                </a>
                <a href="#" target="_blank" class="social-wrap__item live-journal">
                    <img src="img/soc/livejournal-f.png" alt="">
                </a>
                <a href="#" target="_blank" class="social-wrap__item in">
                    <img src="img/soc/in-f.png" alt="">
                </a>

            </div>-->

        </div>

    </div>

</section>
