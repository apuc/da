<?php

$this->registerJsFile('/js/board.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/theme/portal-donbassa/js/slick.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = $ads->title;

\common\classes\Debug::prn($ads);
?>

<section class="commercial">

    <div class="container">

        <div class="commercial__wrapper">

            <div class="commercial__content">

                <?= \frontend\modules\board\widgets\ShowFilterTop::widget(); ?>

                <div class="commercial__wrapper">

                    <h3 class="commercial__ads-title"><?= $this->title?></h3>

                    <div class="commercial__ads-slider">

                        <div class="commercial__ads-slider--single">
                            <?php foreach ($ads->adsImgs as $item): ?>
                                <div class="slide"><img src="<?= $item->img; ?>" alt=""></div>
                            <?php endforeach; ?>

                        </div>

                        <div class="commercial__ads-slider--nav">
                            <?php foreach ($ads->adsImgs as $item): ?>
                                <div class="slide"><img src="<?= $item->img_thumb; ?>" alt=""></div>
                            <?php endforeach; ?>

                        </div>


                    </div>

                    <div class="commercial__ads-sidebar">

                        <span class="price"><?= number_format($ads->price, 0, '.', ' '); ?> Руб</span>

                        <a href="#" class="show-more">НАПИСАТЬ ПРОДАВЦУ</a>
                        <a href="http://rub-on.ru/ads/<?= $ads->slug; ?>" target="_blank" class="show-more">ПЕРЕЙТИ RUBON-RU</a>

                        <!--<div class="what-say__wrap_item">
                            <div class="thumb">
                                <img src="img/home-content/what-say-1.png" alt="">
                            </div>
                            <div class="wrapi">
                                <p>Продавец</p>
                                <span class="name">Дмитрий</span>
                            </div>
                        </div>

                        <a href="#" class="show-more">ВСЕ ОБЪЯВЛЕНИЯ АВТОРА</a>-->

                    </div>

                    <p class="commercial__ads-subtitle">* Данное объявление взято с сайта RUB-ON.RU</p>

                    <div class="commercial__ads-descr">

                        <div class="commercial__ads-descr--rows">
                            <?php
                                if(!empty($ads->adsFieldsValues)):
                                    foreach ($ads->adsFieldsValues as $item):
                            ?>
                                        <div class="commercial__ads-descr--row">
                                            <span>Тип кузова</span>
                                            <span>Седан</span>
                                        </div>

                           <?php
                                    endforeach;
                           endif; ?>

                        </div>

                        <div class="commercial__ads-descr--numbers">

                            <span>Номер объявления: 63</span>

                            <span>У продавца больше нет объявлений</span>

                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed
                            ut perspiciatis unde omnis iste natus erdolore magnamm.</p>

                    </div>

                </div>

            </div>

            <div class="business__sidebar stock" id="commercial-stock-sidebar">

                <h3>Лучшие предложения</h3>

                <a href="#" class="stock__item">
                    <div class="stock__item_visible">
                        <div class="thumb">
                            <img src="img/home-content/stock-pic-1.png" alt="">
                            <span class="time-icon"></span>
                        </div>
                        <div class="stock__item_label">
                            <p>Грандиозное снижение цен на шкафы - 20%</p>
                        </div>
                        <div class="content">
                            <p> Акция проходит
                                <small>с 01.01.2017</small>
                            </p>
                            <!-- <a href="">подробнее</a>-->
                        </div>

                    </div>
                </a>

                <a href="#" class="stock__item">
                    <div class="stock__item_visible">
                        <div class="thumb">
                            <img src="img/home-content/stock-pic-1.png" alt="">
                            <span class="time-icon"></span>
                        </div>
                        <div class="stock__item_label">
                            <p>Грандиозное снижение цен на шкафы - 20%</p>
                        </div>
                        <div class="content">
                            <p> Акция проходит
                                <small>с 01.01.2017</small>
                            </p>
                            <!-- <a href="">подробнее</a>-->
                        </div>

                    </div>
                </a>

                <a href="#" class="stock__item">
                    <div class="stock__item_visible">
                        <div class="thumb">
                            <img src="img/home-content/stock-pic-1.png" alt="">
                            <span class="time-icon"></span>
                        </div>
                        <div class="stock__item_label">
                            <p>Грандиозное снижение цен на шкафы - 20%</p>
                        </div>
                        <div class="content">
                            <p> Акция проходит
                                <small>с 01.01.2017</small>
                            </p>
                            <!-- <a href="">подробнее</a>-->
                        </div>

                    </div>
                </a>

            </div>

        </div>

    </div>

</section>
