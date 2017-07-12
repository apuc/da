<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.09.2016
 * Time: 16:15
 * @var $model \common\models\db\Pages
 */

use yii\helpers\Url;

$this->registerMetaTag([
    'name' => 'og:image',
    'content' => 'http://' . $_SERVER['HTTP_HOST'] . $model->photo,
]);
$this->title = $model->meta_title;
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
            <div class="thumbnail-wrapper">
                <img class="thumbnail" src="<?= $model->photo; ?>" alt="">
            </div>

            <div class="breadcrumbs">
                <a href="/">Главная</a> <span>></span> <a href=""><?= $model->title; ?></a>
            </div>

            <div class="content-single-wrapper">

                <h1><?= $model->title; ?></h1>

                <div class="content-info">
                    <span class="data-time"><?= \common\classes\WordFunctions::FullEventDate($model->dt_update) ?>
                    </span>

                </div>

                <div class="content-single">
                    <?= $model->content; ?>
                </div>

                <div class="content-info">
                    <span class="data-time"><?= \common\classes\WordFunctions::FullEventDate($model->dt_update) ?></span>
                </div>


                <?= \frontend\widgets\Share::widget([
                    'url' => \yii\helpers\Url::base(true) . '/page/' . $model->slug,
                    'title' => $model->title,
                    'description' => $model->content,
                    'view' => 'share-news',
                    'image' => $model->photo,
                ]); ?>


            </div>
            <?= \frontend\widgets\Comments::widget([
                'pageTitle' => $model->title,
                'postType' => 'page',
                'postId' => $model->id,
            ]); ?>
        </article>

        <!-- start right_sidebar_news.html-->
        <aside id="aside">
            <div class="scroll">
                <?= \frontend\modules\pages\widgets\PagesFromGroup::widget(['model' => $model]) ?>

                <?= \frontend\modules\news\widgets\MostPopularNews::widget(); ?>
            </div>
        </aside>
        <!-- end right_sidebar_news.html-->

    </div>
</main>

<!-- start footer.html-->
