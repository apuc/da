<?php use yii\helpers\Url;

$this->title = (empty($consulting->meta_title)) ? $consulting->title : $consulting->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $consulting->meta_descr,
]);
\frontend\assets\AppAssetConsulting::register($this);
?>

<!-- start breadcrumbs.html-->
<section class="breadcrumbs-wrap">
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="/consulting">Консультации</a></li>
            <li><a href="" class="current"> <?= $consulting->title; ?></a></li>
        </ul>
    </div>
</section>

<!-- end breadcrumbs.html-->

<main id="main-consultations">

    <div class="container">
        <div class="main-consultations-sidebar">
        <h1><?= $consulting->title; ?></h1>

        <?= \frontend\modules\consulting\widgets\ConsultingPostsMenu::widget(['consulting' => $consulting]); ?>
        </div>
        <div class="search"><input type="text" placeholder="Поиск">
            <button>Найти</button>
        </div>
        <article id="article">
            <h2><?= $consulting->company->name; ?></h2>

            <div class="laws">
                <div class="law">

                    <?= $consulting->descr; ?>
                    <div id="map" class="ymaps"></div>
                    <p class="concreate-adress"><?= $consulting->company->address; ?></p>
                    <div class="title-law"><?= $consulting->company->phone; ?></div>
                </div>
            </div>
        </article>
    </div>
</main>