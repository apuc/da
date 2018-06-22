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

$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/news.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => yii\helpers\Url::current([], true),
]);

$this->registerMetaTag([
    'property' => 'og:type',
    'content' => 'article',
]);

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $newTitle,
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $newContent,
]);

$this->registerMetaTag([
    'property' => 'og:image',
    'content' => 'https://' . $_SERVER['HTTP_HOST'] . $model->photo,
]);
$this->registerMetaTag([
    'property' => 'og:image:secure_url',
    'content' => 'https://' . $_SERVER['HTTP_HOST'] . $model->photo,
]);

$this->title = ($model->meta_title) ? $model->meta_title : $model->title;

$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_descr,
]);

$this->registerLinkTag([
    'rel' => 'amphtml',
    'href' => Url::to(['/news/default/view-amp', 'slug' => $model->slug])
]);

$this->params['breadcrumbs'][] = ['label' => 'Всё чтиво', 'url' => Url::to(['/news/news'])];
$this->params['breadcrumbs'][] = [
    'label' => $category->title,
    'url' => Url::to(['/news/news/category/', 'slug' => $category->slug]),
];
$this->params['breadcrumbs'][] = $model->title;

?>
<!-- close .header -->

<!-- end header.html-->

<main id="main-single-news">

    <div class="container">

        <article id="article">

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => 'breadcrumbs'],
            ]); ?>

            <h1><?= $model->title; ?></h1>
            <?= $this->render('news-info',
                [
                    'model' => $model,
                    'countComments' => $countComments,
                    'likes' => $likes,
                ]); ?>


            <?php if (stristr($model->photo, 'http')):
                $img = $model->photo;
            else:
                $img = \common\models\UploadPhoto::getImageOrNoImage($model->photo);
            endif;
            $alt = !empty($model->alt) ? $model->alt : $model->title;
            ?>

            <a href="<?= $img; ?>" class="thumbnail-wrapper" data-fancybox="news">
                <img class="thumbnail" src="<?= $img; ?>" alt="<?= $alt; ?>">
            </a>

            <div class="content-single-wrapper">
                <div class="content-single">
                    <?= $model->content; ?>
                </div>

                <?php if (!empty($model['tagss'])): ?>
                    <div class="content__separator"></div>
                    <section class="hashtag">
                        <div class="hashtag__wrapper">
                            <?php
                            foreach ($model['tagss'] as $tags) { ?>
                                <a href="<?= Url::to(['/search/tag', 'id' => $tags['tagname']->id]) ?>">
                                    <div class="hashtag__wrapper--item"><?= $tags['tagname']->tag; ?></div>
                                </a>
                            <?php } ?>
                        </div>
                    </section>
                <?php endif; ?>
                <?= $this->render('news-info',
                    [
                        'model' => $model,
                        'countComments' => $countComments,
                        'likes' => $likes,
                    ]);
                ?>
                <?= \frontend\modules\news\widgets\ReadTheSame::widget(
                    [
                        'news' => array_slice($readTheSame, 0, 3),
                        'template' => 'bottom',
                    ]
                ); ?>

                <?= \frontend\widgets\Share::widget([
                    'url' => yii\helpers\Url::current([], true),
                    'title' => $model->title,
                    'description' => $model->content,
                    'view' => 'share-news',
                    'image' => $model->photo,
                ]); ?>

            </div>
            <?= \frontend\widgets\Comments::widget([
                'pageTitle' => 'Комментарии к чтиву',
                'postType' => 'news',
                'postId' => $model->id,
            ]); ?>
        </article>
        <aside id="aside">
            <div class="scroll">
                <?= \frontend\modules\news\widgets\ReadTheSame::widget(
                    [
                        'news' => array_slice($readTheSame, 3),
                    ]
                ); ?>

                <?= \frontend\modules\news\widgets\MostPopularNews::widget(
                    [
                        'newsCurrentId' => $model->id,
                        'useReg' => $useReg,
                    ]
                ); ?>
            </div>
        </aside>

        <?= \frontend\modules\news\widgets\WhatElseToRead::widget(['useReg' => $useReg]); ?>
    </div>
</main>
