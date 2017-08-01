<?php
/**
 * @var $model \common\models\db\VkStream
 */
use common\classes\DateFunctions;
use common\models\User;
use frontend\widgets\ShowRightRecommend;

?>

<section class="parser">

    <div class="container">

        <h3 class="parser__title">О чем говорят в городе</h3>

        <div class="business__wrapper">

            <div class="business__content">

                <div class="parser__top-counter">

                    <a href="#">Показать <span class="counter">89</span> новых записи</a>

                </div>

                <div class="parser__top-link">

                    <a href="#">Подписаться на эту тему</a>

                </div>

                <ul class="parser__top-nav">
                    <li><a href="#">Все материалы <span>4034</span></a></li>
                    <li><a href="#">ВК <span>1026</span></a></li>
                </ul>

                <div class="parser__wrapper">
                    <div class="grid-sizer"></div>

                    <?php foreach ($model as $item): ?>
                        <div class="parser__element grid-item <?= $item->id ?>">

                            <a href="<?= \yii\helpers\Url::to('')?>" class="parser__element--author">

                                <div class="avatar">
                                    <?php if (!empty($item->author)): ?>
                                        <img src="<?= $item->author->photo ?>" alt="">
                                    <?php endif; ?>
                                    <?php if (!empty($item->group)): ?>

                                    <?php endif; ?>
                                </div>

                                <div class="name">
                                    <?php if (!empty($item->group)): ?>
                                        <?= $item->group->name ?>
                                    <?php endif; ?>

                                    <?php if (!empty($item->author)): ?>
                                        <?= $item->author->first_name . ' ' . $item->author->last_name ?>
                                    <?php endif; ?>
                                </div>

                                <span class="date"><?= DateFunctions::getGetNiceDate($item->dt_add) ?></span>

                            </a>

                            <div class="social-wrap__item vk">
                                <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                            </div>

                            <!--<h3 class="parser__element--title">F-Secure рассказала об опасностях пиратских версий-->
                            <!--    Windows</h3>-->

                            <?php if (!empty($item->text)): ?>

                                <p class="parser__element--descr"><?= $item->text ?></p>
                                <?php if (mb_strlen($item->text) > 131): ?>
                                    <a href="#" class="parser__element--more">читать далее</a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (!empty($item->photo)): ?>
                                <a data-fancybox="gallery" class="parser__element--photo"
                                   href="<?= $item->photo[0]->getLargePhoto() ?>">
                                    <img src="<?= $item->photo[0]->getLargePhoto() ?>" alt="">
                                </a>
                            <?php endif; ?>

                            <div class="parser__element--tools">

                                <a href="#" class="like <?= User::hasLike('stream', $item->id) ? 'active' : '' ?>"
                                   csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                                   data-id="<?= $item->id; ?>"
                                   data-type="stream">
                                    <i class="like-set-icon"></i>
                                    <span class="like-counter"><?= $item->getLikesCount() ?></span>
                                </a>

                                <a href="#" class="views"><?= $item->views ?></a>

                                <a href="#" class="comments">
                                    <?= count($item->comments) ?>
                                </a>

                            </div>

                            <div class="parser__element--comments-block">

                                <?php if (!empty($item->comments)): ?>
                                    <?php foreach ($item->comments as $comment): ?>
                                        <div class="avatar">
                                            <img src="<?= $comment->author->photo ?>" alt="">
                                        </div>

                                        <div class="name">
                                            <?= $comment->author->first_name . ' ' . $comment->author->last_name ?>
                                        </div>

                                        <p><?= $comment->text ?></p>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>

                        </div>
                    <?php endforeach; ?>
                <span class="stream-flag"></span>
                </div>

                <div class="parser__more">

                    <a href="#"  class="show-more show-more-stream" data-step="1" csrf-token="<?= Yii::$app->request->getCsrfToken() ?>">загрузить еще</a>

                </div>

            </div>
            <?= ShowRightRecommend::widget() ?>

            <!--<div id="parser-sidebar" class="business__sidebar stock">-->
            <!---->
            <!--    <h3>что посмотреть?</h3>-->
            <!---->
            <!--    <a href="#" class="business__sm-item">-->
            <!---->
            <!--        <div class="recommend">-->
            <!--            <span class="recommend__star"></span>-->
            <!--            Рекомендуем-->
            <!--        </div>-->
            <!---->
            <!--        <div class="business__sm-item--img">-->
            <!--            <img src="img/business/business-sm.png" alt="">-->
            <!--        </div>-->
            <!---->
            <!--        <p class="business__sm-item--title">Региональный центр восстановления позвоночника и-->
            <!--            реабилитации</p>-->
            <!---->
            <!--        <!--<p class="business__sm-item&#45;&#45;address">-->
            <!--            <span>Адрес:</span>-->
            <!--            <span>г. Донецк, проспект Мира, 8а</span>-->
            <!--        </p>-->
            <!---->
            <!--        <ul class="business__sm-item--numbers">-->
            <!--            <li>+380667778540</li>-->
            <!--            <li>+380667778540</li>-->
            <!--        </ul>-->
            <!---->
            <!--        <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
            <!--        <p class="business__sm-item--views">569</p>-->
            <!---->
            <!--    </a>-->
            <!---->
            <!--    <h3>оставайся с нами</h3>-->
            <!---->
            <!--    <script type="text/javascript" src="//vk.com/js/api/openapi.js?146"></script>-->
            <!---->
            <!--    <!-- VK Widget -->
            <!--    <div id="vk_groups"></div>-->
            <!--    <script type="text/javascript">-->
            <!--        VK.Widgets.Group("vk_groups", {mode: 3, width: "260", height: "296"}, 20003922);-->
            <!--    </script>-->
            <!---->
            <!--</div>-->

        </div>

    </div>

</section>