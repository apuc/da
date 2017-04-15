<?php use common\classes\WordFunctions;
use yii\helpers\Url;

$this->title = (empty($consulting->meta_title)) ? $consulting->title : $consulting->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $consulting->meta_descr,
]);; ?>


<section class="breadcrumbs-wrap">
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="/consulting">Консультации</a></li>
            <li><a href="" class="current"> <?= $consulting->title; ?></a></li>
        </ul>
    </div>
</section>

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
            <h2><?= $postsTitle; ?></h2>
            <div class="laws">
                <?php foreach ($posts as $post): ?>
                    <div class="law">
                        <div class="title"><?= $post->consulting->title; ?>
                            / <?= $post->category->title; ?></div>
                        <div class="data-time"><?= \common\classes\WordFunctions::FullEventDate($post->dt_add); ?></div>
                        <!--<div class="title-law">--><? //= $post->question; ?><!--</div>-->
                        <div class="text"><?= WordFunctions::crop_str_word(strip_tags($post->question), 50); ?>
                        </div>
                        <div class="info"><a href="#">Читать ответ</a><span
                                    class="view"><?= $post->views; ?> <?= WordFunctions::getNumEnding($post->views,
                                    ['просмотр', 'просмтора', 'просмотров']); ?></span></div>
                    </div>
                <?php endforeach; ?>
                <a href="#" data-post-type="faq" data-type="<?= $consulting->slug; ?>"
                   data-category="<?= $ajaxCategory; ?>" data-offset="3" id="consulting-more-posts" class="load-more">Загрузить
                    больше</a>
            </div>
        </article>
    </div>
</main>