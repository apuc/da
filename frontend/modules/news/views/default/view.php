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
use yii\widgets\Breadcrumbs;
$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/news.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerMetaTag([
    'name' => 'og:title',
    'content' => $newTitle,
]);

$this->registerMetaTag([
    'name' => 'og:type',
    'content' => 'website',
]);

$this->registerMetaTag([
    'name' => 'og:url',
    'content' => yii\helpers\Url::current([], true),
]);


$this->registerMetaTag([
    'name' => 'og:image',
    'content' => 'https://' . $_SERVER['HTTP_HOST'] . $model->photo,
]);

$this->registerMetaTag([
    'name' => 'og:description',
    'content' => $newContent,
]);

$this->title = ($model->meta_title) ? $model->meta_title: $model->title;




$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_descr,
]);

$this->params['breadcrumbs'][] = ['label' => 'Все новости', 'url' => Url::to(['/news/news'])];
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => Url::to(['/news/news/category/', 'slug' => $category->slug])];
$this->params['breadcrumbs'][] = $model->title;

?>
<!-- close .header -->

<!-- end header.html-->

<main id="main-single-news">

    <div class="container">

        <article id="article">

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => 'breadcrumbs']
            ]) ?>

            <!--<div class="breadcrumbs">
                <a href="/">Главная</a> <span>></span> <a href="<?/*= Url::to([
                    '/news/news/category/',
                    'slug' => $category->slug,
                ]) */?>"><?/*= $category->title; */?></a>
            </div>-->

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
                            foreach ($model['tagss'] as $tags){ ?>
                                <a href="<?= Url::to(['/search/tag', 'id' => $tags['tagname']->id])?>">
                                    <div class="hashtag__wrapper--item"><?= $tags['tagname']->tag; ?></div>
                                </a>
                            <?php } ?>
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
                    'url' => yii\helpers\Url::current([], true),
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
