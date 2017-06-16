<?php use yii\helpers\Url;

$this->title = (empty($post->meta_title)) ? $consulting->title : $post->meta_title .' '. $consulting->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $post->meta_descr,
]);
\frontend\assets\AppAssetConsulting::register($this);
?>

<!-- start breadcrumbs.html-->
<section class="breadcrumbs-wrap">
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="/consulting">Консультации</a></li>
            <li><a href="" class="current"> <?= $post->title; ?></a></li>
        </ul>
    </div>
</section>

<!-- end breadcrumbs.html-->

<main id="main-consultations">

    <div class="container">
        <div class="main-consultations-sidebar">
            <h1><?= $post->consulting->title; ?></h1>

            <?= \frontend\modules\consulting\widgets\ConsultingPostsMenu::widget([
                'consulting' => $post->consulting,
                'activeCategoryArray' => $activeCategory,
            ]); ?>
        </div>
        <div class="search"><input type="text" placeholder="Поиск">
            <button>Найти</button>
        </div>
        <article id="article">
            <h2><?= $post->title; ?></h2>

            <div class="laws">
                <div class="law">

                    <?= $post->content; ?>
                </div>
            </div>
        </article>
    </div>
</main>