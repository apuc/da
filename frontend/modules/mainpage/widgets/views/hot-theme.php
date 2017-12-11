<?php

?>
<div class="home-content__hot-topics-russ">
    <div class="left-column">
        <div class="title">
            <span>Горячие темы</span>
        </div>
            <?php
            foreach ($newsLeft as $key=>$val):
               // \common\classes\Debug::prn($val);?>
                <?php if($key == 0):?>
                    <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val['slugNews']]); ?>">
                        <div class="left-column__content">
                            <h2>
                                <?= $val['titleNews'] ?>
                            </h2>
                            <p>
                                <?= \yii\helpers\StringHelper::truncate($val['content'],150,'...'); ?>
                            </p>
                        </div>
                    </a>
                <?php else: ?>
                    <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val['slugNews']]); ?>">
                        <div class="item">
                            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($val['photoNews']); ?>" alt="">
                            <p>
                                <?= $val['titleNews'] ?>
                            </p>
                        </div>
                    </a>
                <?php endif; ?>
            <?php endforeach;?>
    </div>


    <div class="right-column">
        <div class="right-column__content">
            <?php

            foreach ($newsRight as $key=>$val): ?>

                <?php
                if($key == 3): ?>
                    <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val['slugNews']]); ?>">
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($val['photoNews']); ?>" alt="">
                    </a>
                <?php else: ?>
                    <?php if ($key == 4): ?>
                        <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val['slugNews']]); ?>" class="news__wrap_item-lg">
                            <div class="thumb">
                                <img src="img/russ-home/5.jpg" alt="">
                                <div class="content-row">
                                    <span><?= date('d.m.Y H:i', $val['dt_public']) ?></span> <br>
                                    <span><?= $val['titleCat']; ?></span>
                                    <span><small class="view-icon"></small><?= $val['views']; ?></span>
                                    <span><small class="comments-icon"></small>
                                        <?= \common\models\db\News::getCommentsCount($val['idNews']); ?>
                                    </span>
                                    <h2><?= $val['titleNews'] ?></h2>
                                </div>
                            </div>
                        </a>
                    <?php else: ?>
                        <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val['slugNews']]); ?>">
                            <p><?= $val['titleNews'] ?></p>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>


            <?php endforeach; ?>

        </div>

    </div>
</div>

