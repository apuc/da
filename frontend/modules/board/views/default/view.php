<?php

$this->registerJsFile('/theme/portal-donbassa/js/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('/theme/portal-donbassa/js/owl.carousel.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/theme/portal-donbassa/js/slick.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('/theme/portal-donbassa/js/jquery.fancybox.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = $ads->title;

//\common\classes\Debug::prn($ads);
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
                            <?php if(empty($ads->adsImgs)): ?>
                                <img src="/theme/portal-donbassa/img/no-image.png" alt="">
                            <?php endif; ?>
                            <?php foreach ($ads->adsImgs as $item): ?>
                                <a href="<?= $item->img; ?>" class="slide" data-fancybox="gallery">
                                    <img src="<?= $item->img; ?>" alt="">
                                </a>
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

                        <!--<a href="#" class="show-more">НАПИСАТЬ ПРОДАВЦУ</a>-->
                        <!--<a href="http://rub-on.ru/ads/<?/*= $ads->slug; */?>" target="_blank" class="show-more">ПЕРЕЙТИ RUBON-RU</a>-->

                        <div class="what-say__wrap_item">
                            <!--<div class="thumb">
                                <img src="img/home-content/what-say-1.png" alt="">
                            </div>-->
                            <div class="wrapi">
                                <p>Продавец</p>
                                <span class="name"><?= $ads->name; ?></span>
                            </div>
                            <div class="wrapi">
                                <p>Телефон</p>
                                <span class="name"><?= $ads->phone; ?></span>
                            </div>
                        </div>

                        <!--<a href="#" class="show-more">ВСЕ ОБЪЯВЛЕНИЯ АВТОРА</a>-->

                    </div>

                    <!--<p class="commercial__ads-subtitle">* Данное объявление взято с сайта RUB-ON.RU</p>-->

                    <div class="commercial__ads-descr">

                        <div class="commercial__ads-descr--rows">
                            <?php
                                if(!empty($ads->adsFieldsValues)):
                                    foreach ($ads->adsFieldsValues as $item):
                            ?>
                                        <div class="commercial__ads-descr--row">
                                            <span><?= \frontend\modules\board\models\BoardFunction::getLabelAdditionalField($item->ads_fields_name)?></span>
                                            <span><?= $item->value?></span>
                                        </div>

                           <?php
                                    endforeach;
                           endif; ?>
                            <p><?= $ads->content; ?></p>
                        </div>

                        <div class="commercial__ads-descr--numbers">

                            <span>Номер объявления: <?= $ads->id?></span>
                            <div class="view"><?= $ads->views; ?></div>
                            <!--<span>У продавца больше нет объявлений</span>-->

                        </div>



                    </div>

                </div>

            </div>

            <?= \frontend\widgets\ShowRightRecommend::widget()?>

        </div>

    </div>

</section>
