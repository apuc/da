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
                        <?php $avatar = \common\classes\UserFunction::getUser_avatar_html($feedback->user->id)?>
                        <?php if (strlen($avatar) > 2): ?>
                        <?= $avatar?>
                        <?php else: ?>
                        <span><?=$avatar ?></span>
                        <?php endif; ?>
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
            <h2 class="title">Lorem ipsum dolor sit amet.</h2>
            <span class="name"></span>
            <p class="rew-descr"></p>

            <?= \frontend\widgets\FooterSocial::widget() ?>

        </div>

    </div>

</section>
