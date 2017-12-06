<?php
use yii\helpers\Url;

?>
<section class="news-slider-index">
    <div class="container">
        <h3 class="main-title">популярные новости</h3>
        <span class="separator"></span>
        <div class="news-slider-wrap">
            <div class=" js-carousel-1 owl-carousel" id="sync1">
                <?php

                foreach ($newsSlider1 as $item): ?>
                    <a href="<?= Url::to(['/news/default/view', 'slug' => $item->slug]) ?>" class="item">
                        <img src="<?= $item->photo  . '?width=600' ?>" alt="">
                        <div class="content-item">
                            <div class="content-row">
                                <span>Новости</span>
                                <span><small class="view-icon"></small> <?= $item->views ?></span>
                                <span><small class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($item->id)?></span>
                                <?= \frontend\widgets\Share::widget([
                                    'url' => \yii\helpers\Url::base(true) . '/news/' . $item->slug,
                                    'title' => $item->title,
                                    'description' => $item->content,
                                ]); ?>
                            </div>
                            <div class="item__info">
                                <h4><?= $item->title; ?></h4>
                                <p><?= strip_tags($item->content) ?></p>
                            </div>

                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="js-carousel-2 owl-carousel" id="sync2">
                <?php foreach ($newsSlider2 as $item): ?>
                    <a href="<?= Url::to(['/news/default/view', 'slug' => $item->slug]) ?>" class="item">
                        <img src="<?= $item->photo  . '?width=600' ?>" alt="">
                        <div class="content-item">
                            <div class="content-row">
                                <span>Новости</span>
                                <span><small class="view-icon"></small> <?= $item->views ?></span>
                                <span><small class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($item->id)?></span>
                                <?= \frontend\widgets\Share::widget(
                                    [
                                        'url' => \yii\helpers\Url::base(true) . '/news/' . $item->slug,
                                        'title' => $item->title,
                                        'description' => $item->content,
                                    ]
                                ); ?>
                            </div>
                            <div class="item__info">
                                <h4><?= $item->title; ?></h4>
                                <p><?= strip_tags($item->content) ?></p>
                            </div>

                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="js-carousel-3 owl-carousel">
                <?php foreach ($newsSlider3 as $item): ?>
                    <a href="<?= Url::to(['/news/default/view', 'slug' => $item->slug]) ?>" class="item">
                        <img src="<?= $item->photo  . '?width=600' ?>" alt="">
                        <div class="content-item">
                            <div class="content-row">
                                <span>Новости</span>
                                <span><small class="view-icon"></small> <?= $item->views; ?></span>
                                <span><small class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($item->id)?></span>
                                <?= \frontend\widgets\Share::widget([
                                    'url' => \yii\helpers\Url::base(true) . '/news/' . $item->slug,
                                    'title' => $item->title,
                                    'description' => $item->content,
                                ]); ?>
                                <div class="item__info">
                                    <h4><?= $item->title; ?></h4>
                                    <p><?= strip_tags($item->content) ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>
            <div class="js-carousel-4 owl-carousel">
                <?php foreach ($newsSlider4 as $item): ?>
                    <a href="<?= Url::to(['/news/default/view', 'slug' => $item->slug]) ?>" class="item"><img
                                src="<?= $item->photo  . '?width=600' ?>" alt="">
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="slider-nav">
                <a href="#" class="customPrevBtn"></a>
                <a href="#" class="customNextBtn"></a>
            </div>
        </div>
        <div class="news-slider-index-panel">
            <h3>Важные новости дня</h3>
            <div class="buttons-wrap">
                <a href="<?= \yii\helpers\Url::to(['/site/design']); ?>">подписаться</a>
                <a href="<?= \yii\helpers\Url::to(['/news/news']) ?>">посмотреть больше</a>
            </div>
        </div>
    </div>
</section>