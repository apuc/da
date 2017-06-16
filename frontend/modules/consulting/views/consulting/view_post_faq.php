<?php use yii\helpers\Url;

$this->title = (empty($post->meta_title)) ? $post->consulting->title : $post->meta_title . ' ' . $post->consulting->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $post->consulting->meta_descr,
]);

\frontend\assets\AppAssetConsulting::register($this);
?>

<!-- start breadcrumbs.html-->
<section class="breadcrumbs-wrap">
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="/consulting">Консультации</a></li>
            <li><a href="" class="current"> <?= $post->question; ?></a></li>
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
                'activeCategorySlug' => $activeCategory,
            ]); ?>
        </div>
        <div class="search"><input type="text" placeholder="Поиск">
            <button>Найти</button>
        </div>
        <article id="article">
            <h2><?= $post->question; ?></h2>

            <div class="laws">
                <div class="law">

                    <?= $post->answer; ?>
                </div>
            </div>
        </article>
    </div>
</main>