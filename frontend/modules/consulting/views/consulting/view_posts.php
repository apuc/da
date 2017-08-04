<?php use common\classes\WordFunctions;
use yii\helpers\Url;

$this->title = (empty($categoryPostsConsulting->meta_title)) ? $consulting->title : $categoryPostsConsulting->meta_title . ' ' . $consulting->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $consulting->meta_descr,
]);
\frontend\assets\AppAssetConsulting::register($this);
?>


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
            <button class="search-consulting-post">Найти</button>
        </div>
        <article id="article">
            <h2><?= $postsTitle; ?></h2>
            <div class="laws">
                <?php foreach ($posts as $post): ?>
                    <div class="law">
                        <div class="title"><?= $post->consulting->title; ?>
                            / <?= $post->categoryPostsConsulting->title; ?></div>
                        <div class="data-time"><?= \common\classes\WordFunctions::FullEventDate($post->dt_add); ?></div>
                        <div class="title-law"><?= $post->title; ?></div>
                        <div class="text"><?= WordFunctions::crop_str_word(strip_tags($post->content), 50); ?>
                        </div>
                        <div class="info"><a href="<?= Url::to(['/consulting/consulting/post','slug'=>$post->slug]);?>">Читать ответ</a><span
                                    class="view"><?= $post->views; ?> <?= WordFunctions::getNumEnding($post->views,
                                    ['просмотр', 'просмотра', 'просмотров']); ?></span></div>
                    </div>
                <?php endforeach; ?>
                <?php if ($postsCount > 3): ?>
                    <a href="#" data-post-type="posts" data-type="<?= $consulting->slug; ?>"
                       data-category="<?= $ajaxCategory; ?>" data-offset="3" id="consulting-more-posts"
                       class="load-more">Загрузить
                        больше</a>
                <?php endif; ?>
            </div>
        </article>
    </div>
</main>