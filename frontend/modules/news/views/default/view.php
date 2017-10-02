<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.09.2016
 * Time: 16:15
 * @var $model \common\models\db\News
 * @var $tags array
 * @var $likes \common\models\db\Likes
 * @var $category string
 * @var $countComments integer
 * @var $thisUserLike \common\models\db\Likes | boolean
 */

use yii\helpers\Url;

$this->registerJsFile('/js/news.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerMetaTag([
    'name' => 'og:image',
    'content' => 'http://' . $_SERVER['HTTP_HOST'] . $model->photo,
]);
$this->title = ($model->meta_title) ? $model->meta_title: $model->title;

$this->registerMetaTag([
    'name' => 'og:title',
    'content' => $newTitle,
]);
$this->registerMetaTag([
    'name' => 'og:description',
    'content' => $newContent,
]);

$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_descr,
]);

?>
<!-- close .header -->

<!-- end header.html-->

<main id="main-single-news">

    <div class="container">

        <article id="article">

            <div class="breadcrumbs">
                <a href="/">Главная</a> <span>></span> <a href="<?= Url::to([
                    '/news/news/category/',
                    'slug' => $category->slug,
                ]) ?>"><?= $category->title; ?></a>
            </div>

            <h1><?= $model->title; ?></h1>

            <div class="content-info">
                <span class="author"><?= $model->author; ?></span>
                <span class="comments"><?= $countComments . ' ' . \common\classes\WordFunctions::getNumEnding($countComments,
                        [
                            'комментарий',
                            'комментария',
                            'комментариев',
                        ]); ?>
                </span>
                <span class="views"><?= $model->views; ?> просмотров</span>
                <span class="data-time"><?= \common\classes\WordFunctions::FullEventDate($model->dt_public) ?></span>

                <a href="#" class="like likes <?= (!empty($thisUserLike)) ? 'active' : ''?>"
                   csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                   data-id="<?= $model->id; ?>"
                   data-type="news">
                    <i class="like-set-icon"></i>
                    <span class="like-counter"><?= $likes; ?></span>
                </a>
            </div>

            <div class="thumbnail-wrapper">
                <?php if(stristr($model->photo, 'http')):?>
                <img class="thumbnail" src="<?= $model->photo?>" alt="">
                <?php else: ?>
                <img class="thumbnail" src="<?= \common\models\UploadPhoto::getImageOrNoImage($model->photo); ?>" alt="">
                <?php endif;?>
            </div>


            <div class="content-single-wrapper">
                <div class="content-single">
                    <?= $model->content; ?>
                </div>

                <?php if(!empty($model['tagss'])): ?>
                    <div class="content__separator"></div>
                    <section class="hashtag">
                        <div class="hashtag__wrapper">
                            <?php
                            foreach ($model['tagss'] as $tags){
                                \common\classes\Debug::prn($tags);
                            }
                            ?>
                            <a href="#">
                                <div class="hashtag__wrapper--item">Путешествия</div>
                            </a>
                            <a href="#">
                                <div class="hashtag__wrapper--item">израиль</div>
                            </a>
                            <a href="#">
                                <div class="hashtag__wrapper--item">Места</div>
                            </a>
                            <a href="#">
                                <div class="hashtag__wrapper--item">Путешествия</div>
                            </a>
                            <a href="#">
                                <div class="hashtag__wrapper--item">израиль</div>
                            </a>
                            <a href="#">
                                <div class="hashtag__wrapper--item">Места</div>
                            </a>
                            <a href="#">
                                <div class="hashtag__wrapper--item">Места</div>
                            </a>
                            <a href="#">
                                <div class="hashtag__wrapper--item">израиль</div>
                            </a>
                            <a href="#">
                                <div class="hashtag__wrapper--item">Путешествия</div>
                            </a>

                            <a href="#">
                                <div class="hashtag__wrapper--item">Путешествия</div>
                            </a>
                            <a href="#">
                                <div class="hashtag__wrapper--item">израиль</div>
                            </a>

                        </div>
                    </section>
                <?php endif; ?>

                <?php
                    echo \frontend\modules\news\widgets\ReadTheSame::widget(
                        [
                            'news' => array_slice($readTheSame, 0, 3),
                            'template' => 'bottom',
                        ]
                    );

                ?>

                <?= \frontend\widgets\Share::widget([
                    'url' => \yii\helpers\Url::base(true) . '/news/' . $model->slug,
                    'title' => $model->title,
                    'description' => $model->content,
                    'view' => 'share-news',
                    'image' => $model->photo,
                ]); ?>

            </div>
            <?= \frontend\widgets\Comments::widget([
                'pageTitle' => 'Комментарии к новости',
                'postType' => 'news',
                'postId' => $model->id,
            ]); ?>
        </article>
        <aside id="aside">
            <div class="scroll">
                <?php
                echo \frontend\modules\news\widgets\ReadTheSame::widget(
                    [
                        'news' => array_slice($readTheSame, 3),
                    ]
                );

                ?>

                <?= \frontend\modules\news\widgets\MostPopularNews::widget(); ?>
            </div>
        </aside>

       <?= \frontend\modules\news\widgets\WhatElseToRead::widget(); ?>
    </div>
</main>
