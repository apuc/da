<?php //\common\classes\Debug::prn($events); ?>
<section class="afisha">
    <div class="container">
        <h3 class="main-title">куда сходить</h3>
        <span class="separator"></span>
        <div class="afisha-wrap">
            <div class="afisha-wrap__event">
                <h3>События в ближайшие дни</h3>
                <?php
                if (!empty($events)) {
                    foreach ($events as $event):
                        ?>
                        <a href="" class="item">
                            <img src="<?= $event->photo; ?>" alt="">
                            <div class="item-content">
                                <span class="type"><?= $event->categories[0]->title; ?></span>
                                <span class="name-item"><?= $event->title; ?></span>
                                <span class="time">"<?= date('d',
                                        $event->dt_event)
                                    . ' ' . \common\classes\WordFunctions::getRuMonth()[date('m', $event->dt_event)]
                                    . ' ' . $event->start; ?>"</span>
                            </div>
                        </a>
                    <?php endforeach;
                }
                ?>


            </div>
            <div class="afisha-wrap__yesterday">
                <h3>Премьера завтра</h3>
                <div class="gallery">
                    <div class="main-gallery">
                        <a class="fancybox" rel="gallery1"
                           href="<?= $premiereImages[0]; ?>">
                            <img src="<?= $premiereImages[0]; ?>" alt=""/>
                        </a>

                    </div>
                    <div class="nav-gallery">
                        <?php
                        $photos = array_slice($premiereImages, 1);
                        foreach ($photos as $photo): ?>
                            <a class="fancybox" rel="gallery1"
                               href="<?= $photo; ?>">
                                <img src="<?= $photo; ?>" alt=""/>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <p><?= $premiereDescription;?></p>
            </div>
            <div class="afisha-wrap__look">
                <h3>Что посмотреть</h3>
                <?php
                if (!empty(($movies))) {
                    foreach ($movies as $poster): ?>
                        <a href="" class="item">
                            <img src="<?= $poster->photo; ?>" alt="">
                            <div class="item-content">
                                <span class="type"><?= $poster->categories[0]->title; ?></span>
                                <span class="name-item"><?= $poster->title; ?></span>
                                <span class="time">"<?= date('d',
                                        $poster->dt_event)
                                    . ' ' . \common\classes\WordFunctions::getRuMonth()[date('m', $poster->dt_event)]
                                    . ' ' . $poster->start; ?>"</span>
                            </div>
                        </a>
                    <?php endforeach;
                } ?>
            </div>
        </div>
        <a href="#" class="more">посмотреть больше <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
    </div>
</section>