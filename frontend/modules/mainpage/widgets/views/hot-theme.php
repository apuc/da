<?php use yii\helpers\Url;

if ($this->beginCache('show_hot_theme_news_widget' . $userReg, ['duration' => Yii::$app->params['hours-for-cache']])) { ?>
    <div class="home-content__hot-topics-russ">
        <div class="left-column">
            <div class="title">
                <span>Горячие темы</span>
            </div>
            <?php

            foreach ($newsLeft as $key => $val): ?>
                <?php if ($key == 0): ?>

                <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val->slug]); ?>">
                    <div class="left-column__content">
                        <h2><?= $val->title ?></h2>
                        <p>
                            <?= \yii\helpers\StringHelper::truncate(strip_tags($val->content), 150, '...'); ?>
                        </p>
                        <section class="hashtag">
                            <div class="hashtag__wrapper">
                                <?php
                                foreach ($val['tagss'] as $tagss=>$tag):
                                    if($tagss == 2){break;}
                                    ?>

                                    <a href="<?= Url::to(['/search/tag', 'id' => $tag['tagname']->id])?>">
                                        <div class="hashtag__wrapper--item"><?= $tag['tagname']->tag?></div>
                                    </a>
                                <?php endforeach;?>

                                <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val->slug]); ?>" class="comments">
                                    <?= \common\models\db\News::getCommentsCount($val->id); ?>
                                </a>
                                <p class="business__sm-item--views"><?= $val->views; ?></p>
                                <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val->slug]); ?>" class="home-like">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    <span class="like-counter"><?= \common\models\db\News::getLikeCount($val->id); ?></span>
                                </a>
                            </div>
                        </section>
                    </div>
                </a>
            <?php else: ?>
                <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val->slug]); ?>">
                    <div class="item">
                        <img src="<?= $val->photo . '?width=155' ?>" alt="<?= $val->title ?>">
                        <div class="item__wrapper">
                            <p>
                                <?= $val->title ?>
                            </p>
                            <div class="hashtag-wrap">
                                <?php
                                foreach ($val['tagss'] as $tagss=>$tag):
                                    if($tagss == 2){break;}
                                    ?>

                                    <a class="hashteg-mini" href="<?= Url::to(['/search/tag', 'id' => $tag['tagname']->id])?>">
                                        <?= $tag['tagname']->tag?>
                                    </a>
                                <?php endforeach;?>
                                <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val->slug]); ?>" class="comments">
                                    <?= \common\models\db\News::getCommentsCount($val->id); ?>
                                </a>
                                <p class="business__sm-item--views"><?= $val->views; ?></p>
                            </div>
                        </div>
                    </div>
                </a>

            <?php endif; ?>
            <?php endforeach; ?>
        </div>


        <div class="right-column">

                <?php

                foreach ($newsRight as $key => $val):
                    //\common\classes\Debug::prn($key);
                    ?>

                    <?php
                    if ($key == 0):
                        ?><div class="right-column__content">
                    <?php endif;
                    if ($key < 3):?>
                        <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val->slug]); ?>">
                            <div class="right-column__content__text-wrap">
                                <p><?= $val->title; ?></p>
                                <div class="wrap-icon">
                                    <p class="business__sm-item--views"><?= $val->views; ?></p>
                                    <a href="#" class="home-like">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                        <span class="like-counter">
                                            <?= \common\models\db\News::getLikeCount($val->id); ?>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </a>
                    <?php else: ?>
                        <?php if ($key == 3): ?>
                        </div><div class="right-column__content">
                            <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val->slug]); ?>" class="news__wrap_item-lg">
                                <div class="thumb">
                                    <img src="<?= $val->photo . '?width=300' ?>" alt="">
                                    <div class="content-row">
                                        <span><?= date('d.m.Y H:i', $val->dt_public) ?></span> <br>
                                        <span><?= $val['categoryNewsRelations'][0]['cat']->title?></span>
                                        <span><small class="view-icon"></small><?= $val->views; ?></span>
                                        <span><small class="comments-icon"></small>
                                            <?= \common\models\db\News::getCommentsCount($val->id); ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        <?php else:?>
                            <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val->slug]); ?>" class="news__wrap_item-lg">
                                <div class="thumb">
                                    <img src="<?= $val->photo . '?width=300' ?>" alt="">
                                    <div class="content-row">
                                        <span><?= date('d.m.Y H:i', $val->dt_public) ?></span> <br>
                                        <span><?= $val['categoryNewsRelations'][0]['cat']->title?></span>
                                        <span><small class="view-icon"></small><?= $val->views; ?></span>
                                        <span><small class="comments-icon"></small>
                                            <?= \common\models\db\News::getCommentsCount($val->id); ?>
                                        </span>
                                        <h2><?= $val->title; ?></h2>
                                    </div>
                                </div>
                            </a>
                        <?php endif;?>
                        <?php if($key == 4):?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php endforeach; ?>



        </div>
    </div>
    <?php $this->endCache();
} ?>

