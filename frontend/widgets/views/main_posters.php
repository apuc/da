<?php
use yii\helpers\Url;
//\common\classes\Debug::prn($events); ?>
<section class="afisha">
    <div class="container">
        <h3 class="main-title">куда сходить</h3>
        <span class="separator"></span>
        <div class="afisha-wrap">
            <?php

            if (!empty($events)) {?>
            <div class="afisha-wrap__event">
                <h3>События в ближайшие дни</h3>
                <?php
                    foreach ($events as $event):

                        ?>
                        <a href="<?= Url::to(['/poster/default/view', 'slug'=>$event->slug]) ?>" class="item">
                            <img src="<?= $event->photo  . '?width=155' ?>" alt="">
                            <div class="item-content">
                                <span class="type"><?= $event->categories[0]->title; ?></span>
                                <span class="time"><?= date('d',
                                        $event->dt_event)
                                    . ' ' . \common\classes\WordFunctions::getRuMonth()[date('m', $event->dt_event)]
                                    . ' ' . $event->start; ?></span>
                                <span class="name-item"><?= $event->title; ?></span>
                            </div>
                        </a>
                    <?php endforeach;?>
            </div>
                <?php }
                ?>
            <?php if(!empty($premiereImages)): ?>
                <div class="afisha-wrap__yesterday">
                <h3>Выбор редакции</h3>
                <div class="gallery">
                    <div class="main-gallery">
                        <a class="fancybox" rel="gallery1" data-fancybox="gallery"
                           href="<?= $premiereImages[0]  . '?width=600' ?>">
                            <img src="<?= $premiereImages[0]  . '?width=600' ?>" alt=""/>
                        </a>

                    </div>
                    <div class="nav-gallery">
                        <?php
                        $photos = array_slice($premiereImages, 1);
                        foreach ($photos as $photo): ?>
                            <a class="fancybox" rel="gallery1" data-fancybox="gallery"
                               href="<?= $photo  . '?width=600' ?>">
                                <img src="<?= $photo  . '?width=50' ?>" alt=""/>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <p><?= $premiereDescription;?></p>

                <a class="show-more" href="<?= Url::to(['/poster/default/view', 'slug'=>$poster->slug]) ?>">посмотреть</a>
            </div>
            <?php endif; ?>
            <?php
            if (!empty(($movies))) { ?>
            <div class="afisha-wrap__look">
                <h3>Что посмотреть</h3>

                    <?php foreach ($movies as $poster): ?>
                        <a href="<?= Url::to(['/poster/default/view', 'slug'=>$poster->slug]) ?>" class="item">
                            <img src="<?= $poster->photo  . '?width=155' ?>" alt="">
                            <div class="item-content">
                                <span class="type"><?= $poster->categories[0]->title; ?></span>
                                <span class="time"><?= date('d',
                                        $poster->dt_event)
                                    . ' ' . \common\classes\WordFunctions::getRuMonth()[date('m', $poster->dt_event)]
                                    . ' ' . $poster->start; ?></span>
                                <span class="name-item"><?= $poster->title; ?></span>
                            </div>
                        </a>
                    <?php endforeach;?>
            </div>
            <?php } ?>
        </div>
        <a href="<?= Url::to(['/poster/default/category']) ?>" class="more">посмотреть больше <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
    </div>
</section>