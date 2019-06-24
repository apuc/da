<?php use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = ['label' => 'Консультации', 'url' => ['/consulting']];
$this->params['breadcrumbs'][] = $post->consulting->title;
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
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs']
        ]) ?>
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
        <!--<div class="consultants__main">
            <form action="" class="search-block">
                <input type="text" placeholder="Поиск">
                <button>Найти</button>
            </form>
        </div>-->
        <?= \frontend\modules\consulting\widgets\SearchForm::widget() ?>
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