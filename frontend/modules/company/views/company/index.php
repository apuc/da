<?php
/**
 * @var $organizations CategoryCompany
 * @var $meta_title \common\models\db\KeyValue
 * @var $meta_descr \common\models\db\KeyValue
 * @var $wrc array
 * @var $positions array
 */
use common\classes\WordFunctions;
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use yii\helpers\Url;

$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);
?>
<section class="business">

    <div class="container">

        <div class="business__wrapper">

            <div class="business__content">

                <h3 class="business__title">Предприятия</h3>
                <?php $pos = 0;
                $wrc_count = 0; ?>
                <?php while($pos < 12): ?>
                    <?php if (in_array($pos, $positions, true)): ?>
                        <?php $company = isset($wrc[$wrc_count]) ? $wrc[$wrc_count] : $organizations[$pos] ?>
                        <a href="#" class="business__big-item">

                            <div class="business__sm-item--img">

                                <div class="recommend">
                                    <span class="recommend__star"></span>
                                    Рекомендуем
                                </div>

                                <img src="<?= $company->photo ?>" alt="">
                            </div>

                            <p class="business__sm-item--title">
                                <?= $company->name ?>
                            </p>

                            <p class="business__big-item--address">
                                <span>Время работы Министерства:</span>
                                <span>с 9:00 до 18:00 (перерыв с 13:00 до 14:00)</span>
                            </p>

                            <p class="business__sm-item--address">
                                <span>Адрес:</span>
                                <span><?= $company->address ?></span>
                            </p>

                            <ul class="business__sm-item--numbers">
                                <li>+380667778540</li>
                                <li>+380667778540</li>
                            </ul>

                            <ul class="business__sm-item--numbers">
                                <li>+380667778540</li>
                                <li>+380667778540</li>
                            </ul>

                            <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                            <p class="business__sm-item--views"><?= $company->views ?></p>

                        </a>
                        <?php $pos += 2;$wrc_count++; ?>
                    <?php else: ?>
                        <a href="#" class="business__sm-item">

                            <div class="business__sm-item--img">
                                <img src="<?= $organizations[$pos]->photo ?>" alt="">
                            </div>

                            <p class="business__sm-item--title">
                                <?= $organizations[$pos]->name ?>
                            </p>

                            <p class="business__sm-item--address">
                                <span>Адрес:</span>
                                <span><?= $organizations[$pos]->address ?></span>
                            </p>
                            <?php $phone = explode(' ', $organizations[$pos]->phone) ?>
                            <ul class="business__sm-item--numbers">
                                <li><?= $phone[0] ?></li>
                                <li> <?= $phone[1] ?></li>
                            </ul>

                            <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                            <p class="business__sm-item--views"><?= $organizations[$pos]->views ?></p>

                        </a>
                        <?php $pos++; ?>
                    <?php endif; ?>
                <?php endwhile; ?>

                <a href="#" class="show-more">загрузить еще</a>

            </div>

            <?= \frontend\modules\company\widgets\CategoryMenu::widget() ?>
        </div>
    </div>
</section>

<section class="what-say">

    <div class="container">

        <h3 class="section-title">Отзывы о компаниях</h3>

        <div class="what-say__servises">

            <a href=""><span class="comments-icon"></span>Написать отзыв</a>

            <a href=""><span class="mail-icon"></span>Подписаться на эту тему</a>

        </div>

        <div class="what-say__wrap">
            <!-- item -->
            <a href="" class="what-say__wrap_item">

                <span class="rew-title">Веб студия Contrast </span>

                <div class="thumb">
                    <img src="img/home-content/what-say-1.png" alt="">
                </div>

                <div class="rew-wrap">
                    <span class="name">Кирилл Кириленко</span>
                    <p class="rew-descr">Пользовался услугами
                        перевозки все понравилось</p>
                </div>

            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">

                <span class="rew-title">Веб студия Contrast </span>

                <div class="thumb">
                    <img src="img/home-content/what-say-1.png" alt="">
                </div>

                <div class="rew-wrap">
                    <span class="name">Кирилл Кириленко</span>
                    <p class="rew-descr">Пользовался услугами
                        перевозки все понравилось</p>
                </div>

            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">

                <span class="rew-title">Веб студия Contrast </span>

                <div class="thumb">
                    <img src="img/home-content/what-say-1.png" alt="">
                </div>

                <div class="rew-wrap">
                    <span class="name">Кирилл Кириленко</span>
                    <p class="rew-descr">Пользовался услугами
                        перевозки все понравилось</p>
                </div>

            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">

                <span class="rew-title">Веб студия Contrast </span>

                <div class="thumb">
                    <img src="img/home-content/what-say-1.png" alt="">
                </div>

                <div class="rew-wrap">
                    <span class="name">Кирилл Кириленко</span>
                    <p class="rew-descr">Пользовался услугами
                        перевозки все понравилось</p>
                </div>

            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">

                <span class="rew-title">Веб студия Contrast </span>

                <div class="thumb">
                    <img src="img/home-content/what-say-1.png" alt="">
                </div>

                <div class="rew-wrap">
                    <span class="name">Кирилл Кириленко</span>
                    <p class="rew-descr">Пользовался услугами
                        перевозки все понравилось</p>
                </div>

            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">

                <span class="rew-title">Веб студия Contrast </span>

                <div class="thumb">
                    <img src="img/home-content/what-say-1.png" alt="">
                </div>

                <div class="rew-wrap">
                    <span class="name">Кирилл Кириленко</span>
                    <p class="rew-descr">Пользовался услугами
                        перевозки все понравилось</p>
                </div>

            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">

                <span class="rew-title">Веб студия Contrast </span>

                <div class="thumb">
                    <img src="img/home-content/what-say-1.png" alt="">
                </div>

                <div class="rew-wrap">
                    <span class="name">Кирилл Кириленко</span>
                    <p class="rew-descr">О сколько нам открытий чудных?</p>
                </div>

            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">

                <span class="rew-title">Веб студия Contrast </span>

                <div class="thumb">
                    <img src="img/home-content/what-say-1.png" alt="">
                </div>

                <div class="rew-wrap">
                    <span class="name">Кирилл Кириленко</span>
                    <p class="rew-descr">Пользовался услугами
                        перевозки все понравилось</p>
                </div>

            </a>
            <!-- item -->

            <a href="#" class="show-more">посмотреть все</a>

        </div>

    </div>

</section>