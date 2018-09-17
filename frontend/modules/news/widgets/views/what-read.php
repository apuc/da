<?php
use common\classes\WordFunctions;
use yii\helpers\Url;
?>

<div class="content__read-more">

    <h2>Что еще почитать</h2>

    <div class="news__wrap">

        <?php


        $simpleNewId = 0;
        $hotNewId = 0;
        for ($i = 0; $i <= 7; $i++):
            if (!in_array($i, $hotNewsIndexes)):
                $currNew = $news[$simpleNewId];

                if (in_array($i, $bigNewsIndexes)):
                    ?>
                    <a href="<?= Url::to([
                        '/news/default/view',
                        'slug' => $currNew->slug,
                    ]); ?>" class="news__wrap_item-lg" title="<?= $currNew->title;?>">
                        <div class="thumb">
                            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($currNew->photo); ?>"
                                 alt="">
                            <div class="content-row">
                                <span><?= WordFunctions::dateWithMonts($currNew->dt_public); ?></span>
                                <span><?= $currNew['categoryNewsRelations'][0]['cat']->title; ?></span>
                                <span><small class="view-icon"></small> <?= $currNew->views; ?></span>
                                <span><small
                                        class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($currNew->id) ?></span>
                                <h2><?= $currNew->title; ?></h2>
                            </div>

                        </div>
                    </a>
                <?php else: ?>
                    <div class="news__wrap_item-sm">
                        <!-- thumb -->
                        <a href="<?= Url::to([
                            '/news/default/view',
                            'slug' => $currNew->slug,
                        ]); ?>" class="thumb" title="<?= $currNew->title;?>">
                            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($currNew->photo); ?>"
                                 alt="">
                            <div class="content-row">
                                <span><small class="view-icon"></small> <?= $currNew->views; ?></span>
                                <span><small
                                        class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($currNew->id) ?></span>
                                <span><?= $currNew['categoryNewsRelations'][0]['cat']->title; ?></span>
                            </div>
                        </a>
                        <!-- thumb -->
                        <div class="content-item">
                            <p><a href="<?= Url::to([
                                    '/news/default/view',
                                    'slug' => $currNew->slug,
                                ]); ?>"><?= $currNew->title; ?></a></p>
                            <span><?= WordFunctions::dateWithMonts($currNew->dt_public); ?></span>
                        </div>
                    </div>
                    <?php
                endif;
                $simpleNewId++;
            else:

                $currHotNew = $hotNews[$hotNewId];
                ?>
                <a href="<?= Url::to([
                    '/news/default/view',
                    'slug' => $currHotNew->slug,
                ]); ?>" class=" news__wrap_item-sm-hot" title="<?= $currHotNew->title;?>">
                    <!-- thumb -->
                    <div class="thumb">
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($currHotNew->photo); ?>" alt="">
                        <div class="content-row">
                            <span><small class="view-icon"></small><?= $currHotNew->views; ?></span>
                            <span><small
                                    class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($currNew->id) ?></span>
                            <span><?= $currNew['categoryNewsRelations'][0]['cat']->title; ?></span>
                        </div>
                    </div>
                    <!-- thumb -->
                    <div class="hover-wrap">
                              <span class="category">
                                <span class="category-star"></span>
                                ГОРЯЧЕЕ
                              </span>
                        <h2><?= $currHotNew->title; ?></h2>
                    </div>
                </a>


                <?php
                $hotNewId = $hotNewId + 1 == count($hotNews) ? 0 : $hotNewId + 1;
            endif;
        endfor; ?>

    </div>

</div>