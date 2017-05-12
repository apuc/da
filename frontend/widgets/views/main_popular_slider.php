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
                        <img src="<?= $item->photo ?>" alt="">
                        <div class="content-item">
                            <div class="content-row">
                                <span>Новости</span>
                                <span><small class="view-icon"></small> <?= $item->views ?></span>
                                <div class="hide-social">
                                    <span><i class="fa fa-vk  fa-lg"></i></span>
                                    <span><i class="fa fa-twitter fa-lg"></i></span>
                                    <span><i class="fa fa-facebook fa-lg"></i></span>
                                    <span><i class="fa fa-odnoklassniki  fa-lg"></i></span>

                                </div>
                                <span class="open-soc"><i class="fa fa-random fa-lg"></i>

              </span>
                            </div>
                            <div class="item__info">
                                <h4><?= $item->title; ?></h4>
                                <p><?= $item->content ?></p>
                            </div>

                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="js-carousel-2 owl-carousel" id="sync2">
                <?php foreach ($newsSlider2 as $item): ?>
                    <a href="<?= Url::to(['/news/default/view', 'slug' => $item->slug]) ?>" class="item">
                        <img src="<?= $item->photo ?>" alt="">
                        <div class="content-item">
                            <div class="content-row">
                                <span>Новости</span>
                                <span><small class="view-icon"></small> <?= $item->views ?></span>
                                <div class="hide-social">
                                    <span><i class="fa fa-vk  fa-lg"></i></span>
                                    <span><i class="fa fa-twitter fa-lg"></i></span>
                                    <span><i class="fa fa-facebook fa-lg"></i></span>
                                    <span><i class="fa fa-odnoklassniki  fa-lg"></i></span>

                                </div>
                                <span class="open-soc"><i class="fa fa-random fa-lg"></i>

              </span>
                            </div>
                            <div class="item__info">
                                <h4><?= $item->title; ?></h4>
                                <p><?= $item->content ?></p>
                            </div>

                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="js-carousel-3 owl-carousel">
                <?php foreach ($newsSlider3 as $item): ?>
                    <a href="<?= Url::to(['/news/default/view', 'slug' => $item->slug]) ?>" class="item">
                        <img src="<?= $item->photo ?>" alt="">
                        <div class="content-item">
                            <div class="content-row">
                                <span>Новости</span>
                                <span><small class="view-icon"></small> <?= $item->views; ?></span>
                                <div class="hide-social">
                                    <span><i class="fa fa-vk  fa-lg"></i></span>
                                    <span><i class="fa fa-twitter fa-lg"></i></span>
                                    <span><i class="fa fa-facebook fa-lg"></i></span>
                                    <span><i class="fa fa-odnoklassniki  fa-lg"></i></span>

                                </div>
                                <span class="open-soc"><i class="fa fa-random fa-lg"></i>

              </span>
                                <div class="item__info">
                                    <h4><?= $item->title; ?></h4>
                                    <p><?= $item->content ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
                <!--  <div class="item"><img src="/theme/portal-donbassa/img/home-content/2pic.jpg" alt="">-->
                <!--      <div class="content-item">-->
                <!--          <div class="content-row">-->
                <!--              <a href="">Новости</a>-->
                <!--              <span><small class="view-icon"></small> 2589</span>-->
                <!--              <div class="hide-social">-->
                <!--                  <a href=""><i class="fa fa-vk  fa-lg"></i></a>-->
                <!--                  <a href=""><i class="fa fa-twitter fa-lg"></i></a>-->
                <!--                  <a href=""><i class="fa fa-facebook fa-lg"></i></a>-->
                <!--                  <a href=""><i class="fa fa-odnoklassniki  fa-lg"></i></a>-->
                <!---->
                <!--              </div>-->
                <!--              <span class="open-soc"><i class="fa fa-random fa-lg"></i>-->
                <!---->
                <!--</span>-->
                <!--          </div>-->
                <!--      </div>-->
                <!--  </div>-->

            </div>
            <div class="js-carousel-4 owl-carousel">
                <?php foreach ($newsSlider4 as $item): ?>
                    <a href="<?= Url::to(['/news/default/view', 'slug' => $item->slug]) ?>" class="item"><img src="<?= $item->photo; ?>" alt="">
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
                <a href="">подписаться</a>
                <a href="<?= \yii\helpers\Url::to(['/news/news']) ?>">посмотреть больше</a>
            </div>
        </div>
    </div>
</section>