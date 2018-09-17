<?php
use common\classes\WordFunctions;
use yii\helpers\Url;
?>

<section id="go_rubricator" class="rubrick-slider">
    <div class="container">
        <button class="toggle_mnu__rubrick">
        <span class="sandwich">
          <span class="sw-topper"></span>
          <span class="sw-bottom"></span>
          <span class="sw-footer"></span>
        </span>
        </button>
        <div class="rubrick-slider__wrap">
            <?php

            foreach ($newsArray as $title => $news):
                if (!empty($news[0])):
                    $firstNew = $news[0];
           /* \common\classes\Debug::prn($firstNew);
            \common\classes\Debug::prn($firstNew->categoryNewsRelations[0]->cat->slug);*/
                    ?>
                    <div class="rubrick-slider__item ">
                        <div class="rubrick-slider__title">
                            <h2><?= $title; ?></h2>
                            <p><?= $firstNew->categoryNewsRelations[0]->cat->meta_descr; ?></p>
                            <a href="<?= Url::to([
                                '/news/news/category',
                                'slug' => $firstNew->categoryNewsRelations[0]->cat->slug,
                            ]); ?>" class="go-rubrick">перейти в рубрику</a>
                        </div>
                        <div class="rubrick-slider__item_wrap">
                            <a href="<?= Url::to([
                                '/news/default/view',
                                'slug' => $firstNew->slug,
                            ]); ?>" class="item__big">
                                <?php if(stristr($firstNew->photo, 'http')):?>
                                    <img src="<?= $firstNew->photo?>" alt="">
                                <?php else: ?>
                                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($firstNew->photo); ?>" alt="">
                                <?php endif;?>
                                <div class="item__big_content">
                                    <h4><?= $firstNew->title; ?></h4>
                                    <span class="hour-ago"><?= WordFunctions::FullEventDate($firstNew->dt_public); ?></span>
                                    <div class="item__content_panel">
                                        <span><small class="view-icon"></small><?= $firstNew->views; ?></span>
                                        <span><small class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($firstNew->id); ?></span>
                                    </div>
                                </div>
                            </a>

                            <?php foreach ($news as $key => $new):
                                if ($key == 0) {
                                    continue;
                                }
                                ?>
                                <a href="<?= Url::to([
                                    '/news/default/view',
                                    'slug' => $new->slug,
                                ]); ?>" class="item__small">
                                    <?php if(stristr($new->photo, 'http')):?>
                                        <img src="<?= $new->photo?>" alt="">
                                    <?php else: ?>
                                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($new->photo); ?>" alt="">
                                    <?php endif;?>
                                    <div class="item__small_content">
                                        <span class="hour-ago"><?= WordFunctions::FullEventDate($new->dt_public); ?></span>
                                        <div class="item__content_panel">
                                            <span><small class="view-icon"></small><?= $new->views; ?></span>
                                            <span><small class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($new->id); ?></span>
                                        </div>
                                        <h4><?= $new->title; ?></h4>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php
                endif;
            endforeach; ?>

        </div>
        <div id="dotscustom">
            <?php
            foreach ($newsArray as $title => $new): ?>
                <div><?= $title; ?></div>
            <?php endforeach; ?>
        </div>
    </div>


</section>
