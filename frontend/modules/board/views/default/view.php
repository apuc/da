<?php

$this->registerJsFile('/theme/portal-donbassa/js/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('/theme/portal-donbassa/js/owl.carousel.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/theme/portal-donbassa/js/slick.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('/theme/portal-donbassa/js/jquery.fancybox.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = mb_substr($ads->title . ' | DA Info Pro', 0, 50);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => yii\helpers\Url::current([], true),
]);

$this->registerMetaTag([
    'property' => 'og:type',
    'content' => 'article',
]);

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $ads->title,
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => mb_substr($ads->content, 0, 100),
]);

$this->registerMetaTag([
    'property' => 'og:image',
    'content' => $ads->adsImgs[0]->img_thumb,
]);
$this->registerMetaTag([
    'property' => 'og:image:secure_url',
    'content' => $ads->adsImgs[0]->img_thumb,
]);


$this->registerMetaTag([
    'name' => 'description',
    'content' => mb_substr($ads->content . ',' . $ads->phone . 'Подать бесплатное объявление, купить и продать бу товары вы можете на онлайн доске бесплатных объявлений ДНР и России на сайте ДА Инфо Про', 0, 100)
]);

//\common\classes\Debug::prn($ads);
?>
<section class="commercial ">

    <div class="container">

        <div class="commercial__wrapper">

            <div class="commercial__content commer-single-ads">

                <?= \frontend\modules\board\widgets\ShowFilterTop::widget(); ?>

                <div class="commercial__wrapper commer-single-ads">

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
                        <!--<a href="#" class="show-more">ПЕРЕЙТИ RUBON-RU</a>-->

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
                        <div class="commercial__wrap_item--numbers">

                            <span class="number-ads">Номер объявления: <?= $ads->id; ?></span>
                            <div class="view"><?= $ads->views; ?></div>

                            <!--<span>У продавца больше нет объявлений</span>-->

                        </div>
                        <!--<a href="#" class="show-more">ВСЕ ОБЪЯВЛЕНИЯ АВТОРА</a>-->

                    </div>

                    <!--<p class="commercial__ads-subtitle">* Данное объявление взять с сайта RUB-ON.RU</p>-->

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
                        </div>



                        <p><?= $ads->content; ?></p>

                    </div>

                </div>

                <?= \frontend\modules\board\widgets\ShowSimilarAds::widget(
                    [
                        'category' => $ads->category_id,
                        'limit' => 5,
                        'adsId' => $ads->id,
                    ]);?>
            </div>

            <?= \frontend\widgets\ShowRightRecommend::widget()?>

        </div>

    </div>

</section>

