<?php
use yii\helpers\Url;
?>

<section class="what-say">

    <div class="container">

        <h2>Тем временем в соц. сетях:</h2>

        <div class="what-say__servises">

            <!--<a href=""><span class="comments-icon"></span>Задать свой вопрос</a>-->

            <a href=""><span class="mail-icon"></span>Подписаться на эту тему</a>

        </div>

        <div class="what-say__wrap">

            <?foreach ($posts as $post):?>
                <?//= \common\classes\Debug::prn($post->gif)  ?>
                <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $post->slug])?>" class="what-say__wrap_item">
                    <!--<span class="counter">99</span>-->
                    <div class="thumb">
                        <!-- <span>A</span>-->
                        <?if(!empty($post->author)):?>

                            <img src="<?= $post->author->photo?>" alt="">

                        <?elseif(!empty($post->group)):?>

                            <img src="<?= $post->group->getPhoto()?>" alt="">

                        <?endif;?>

                    </div>
                    <div class="wrapi">
                        <?if(!empty($post->author)):?>
                            <span class="name"><?= $post->author->first_name.' '.$post->author->last_name ?></span>

                        <?elseif(!empty($post->group)):?>
                            <span class="name"><?= $post->group->name ?></span>
                        <?endif;?>

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

            <?endforeach;?>

        </div>
        <a href="<?= Url::to(['/stream']) ?>" class="more">посмотреть больше <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
    </div>



</section>