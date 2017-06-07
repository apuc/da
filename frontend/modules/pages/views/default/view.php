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
                    <span class="data-time"><?= \common\classes\WordFunctions::FullEventDate($model->dt_add) ?>
                    </span>

                </div>

                <div class="content-single">
                    <?= $model->content; ?>
                </div>

                <div class="content-info">
                    <span class="data-time"><?= \common\classes\WordFunctions::FullEventDate($model->dt_add) ?></span>
                </div>


                <!-- start socials.html-->
                <div class="social-wrapper">
                    <a href="#" target="_blank" class="social-wrap__item vk">
                        <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                        <!-- <span>03</span> -->
                    </a>
                    <a href="#" target="_blank" class="social-wrap__item fb">
                        <img src="/theme/portal-donbassa/img/soc/fb.png" alt="fb">
                        <!-- <span>12</span> -->
                    </a>
                    <a href="#" target="_blank" class="social-wrap__item ok">
                        <img src="/theme/portal-donbassa/img/soc/ok-icon.png" alt="ok">
                        <!-- <span>05</span> -->
                    </a>
                    <a href="#" target="_blank" class="social-wrap__item insta">
                        <img src="/theme/portal-donbassa/img/soc/insta-icon.png" alt="instagramm">
                        <!-- <span>63</span> -->
                    </a>
                    <a href="#" target="_blank" class="social-wrap__item google">
                        <img src="/theme/portal-donbassa/img/soc/google-icon.png" alt="google">
                        <!-- <span>36</span> -->
                    </a>
                    <a href="#" target="_blank" class="social-wrap__item twitter">
                        <img src="/theme/portal-donbassa/img/soc/twi-icon.png" alt="twitter">
                        <!-- <span>11</span> -->
                    </a>
                </div>
                <!-- end socials.html-->

            </div>
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
