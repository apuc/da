<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 20.04.2017
 * Time: 0:00
 * @var $feedbacks \common\models\db\CompanyFeedback
 */

?>
<section class="what-say">

    <div class="container">

        <h3 class="section-title">Отзывы о компаниях</h3>

        <div class="what-say__servises">

            <?php if (!Yii::$app->user->isGuest): ?><a href="#" id="add-review"><span class="comments-icon"></span>Написать
                отзыв</a><?php endif; ?>

            <a href=""><span class="mail-icon"></span>Подписаться на эту тему</a>

        </div>

        <div class="what-say__wrap">
            <?php foreach ($feedbacks as $feedback): ?>
                <!-- item -->
                <a href="" class="what-say__wrap_item">

                    <span class="rew-title"><?= $feedback->company_name ?> </span>

                    <div class="thumb">
                        <span>A</span>
                        <!-- <img src="img/home-content/what-say-1.png" alt="">-->
                    </div>

                    <div class="rew-wrap">
                        <span class="name"><?= $feedback->user->username ?></span>
                        <p class="rew-descr"><?= $feedback->feedback ?></p>
                    </div>

                </a>
                <!-- item -->
            <?php endforeach; ?>
            <div class="more-block">
                <a href="#" class="show-more">посмотреть все</a>
            </div>

        </div>

    </div>

</section>
