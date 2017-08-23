<?php
use yii\helpers\Url;
?>

<section class="what-say">

    <div class="container">

        <h2>Тем временем в соцсетях:</h2>

        <div class="what-say__servises">

            <!--<a href=""><span class="comments-icon"></span>Задать свой вопрос</a>-->

            <a href=""><span class="mail-icon"></span>Подписаться на эту тему</a>

        </div>

        <div class="what-say__wrap">

            <?php foreach ($posts as $post):?>

                <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $post->slug])?>" class="what-say__wrap_item">
                    <!--<span class="counter">99</span>-->
                    <div class="thumb">
                        <!-- <span>A</span>-->
                        <?php if(!empty($post->author)):?>
                            <?php if(!empty($post->author->photo)): ?>
                                <img src="<?= $post->author->photo?>" alt="">
                            <?php endif; ?>
                        <?php elseif(!empty($post->group)):?>

                            <img src="<?= $post->group->getPhoto()?>" alt="">

                        <?php endif;?>

                    </div>
                    <div class="wrapi">
                        <?php if(!empty($post->author)):?>
                            <span class="name"><?= $post->author->first_name.' '.$post->author->last_name ?></span>

                        <?php elseif(!empty($post->group)):?>
                            <span class="name"><?= $post->group->name ?></span>
                        <?php endif;?>

                        <p><?= $post->title?></p>
                    </div>

                    <div class="what-say__wrap--photo">

                        <?php if (!empty($post->photo)): ?>
                            <img src="<?= $post->photo[0]->getLargePhoto()?>" alt="">
                        <?php elseif (!empty($post->gif)): ?>
                            <img src="<?= $post->gif[0]->getLargePreview()?>" alt="">
                        <?php endif; ?>

                    </div>

                </a>

            <?php endforeach; ?>

        </div>
        <a href="<?= Url::to(['/stream']) ?>" class="more">посмотреть больше <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
    </div>



</section>