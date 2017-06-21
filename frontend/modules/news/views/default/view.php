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
$this->title = $model->meta_title;

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
                <img class="thumbnail" src="<?= \common\models\UploadPhoto::getImageOrNoImage($model->photo); ?>" alt="">
            </div>


            <div class="content-single-wrapper">
                <div class="content-single">
                    <?= $model->content; ?>
                </div>

                <!--<div class="content-info">
                    <span class="author"><?/*= $model->author; */?></span>
                    <span class="comments">
                        <?/*= $countComments . ' ' . \common\classes\WordFunctions::getNumEnding($countComments,
                            [
                                'комментарий',
                                'комментария',
                                'комментариев',
                            ]); */?>
                    </span>
                    <span class="views" style="color: black"><?/*= $model->views; */?></span>
                    <span class="data-time"><?/*= \common\classes\WordFunctions::FullEventDate($model->dt_public) */?></span>
                    <a style="cursor: pointer" csrf-token="<?/*= Yii::$app->request->getCsrfToken() */?>"
                       data-id="<?/*= $model->id; */?>"
                       data-type="news"
                       class="like likes">

                        <?php /*if (!empty($thisUserLike)): */?>
                            <i class="like-set-icon"></i>
                        <?php /*else:; */?>
                            <i class="like-icon"></i>
                        <?php /*endif; */?>

                        <span class="like-counter">
                                <?/*= $likes; */?>
                            </span>
                    </a>
                </div>-->

               <!-- <div class="tags">
                    <h3>Теги:</h3>
                    <?php
/*                    foreach ($tags as $tag): */?>
                        <a><?/*= $tag; */?></a>
                    <?php /*endforeach; */?>
                </div>-->

                <?= \frontend\modules\news\widgets\RandomNewsByCategory::widget(
                    [
                        'categoryId' => $category->id,
                        'template' => 'bottom',
                    ]
                ); ?>




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
                <?= \frontend\modules\news\widgets\RandomNewsByCategory::widget(['categoryId' => $category->id]); ?>

                <?= \frontend\modules\news\widgets\MostPopularNews::widget(); ?>
            </div>
        </aside>

       <?= \frontend\modules\news\widgets\WhatElseToRead::widget(); ?>
    </div>
</main>
