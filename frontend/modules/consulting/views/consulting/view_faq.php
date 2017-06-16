<?php use common\classes\WordFunctions;
use yii\helpers\Url;

$this->title = (empty($faq->meta_title)) ? $consulting->title : $faq->meta_title . ' ' . $consulting->meta_title;

if(isset($categoryFaq)){
    $this->title = (empty($categoryFaq->meta_title)) ? $consulting->title : $categoryFaq->meta_title . ' ' . $consulting->meta_title;
}

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
            <?= \frontend\modules\consulting\widgets\ConsultingPostsMenu::widget([
                'consulting' => $consulting,
                'activeCategorySlug' => $ajaxCategory,
            ]); ?>
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
                        <div class="info"><a href="<?= Url::to(['/consulting/consulting/faq-post','slug'=>$post->slug]);?>">Читать ответ</a><span
                                    class="view"><?= $post->views; ?> <?= WordFunctions::getNumEnding($post->views,
                                    ['просмотр', 'просмтора', 'просмотров']); ?></span></div>
                    </div>
                <?php endforeach; ?>
                <?php if ($postsCount > 3): ?>
                    <a href="#" data-post-type="faq" data-type="<?= $consulting->slug; ?>"
                       data-category="<?= $ajaxCategory; ?>" data-offset="3" id="consulting-more-posts"
                       class="load-more">Загрузить
                        больше</a>
                <?php endif; ?>
            </div>
        </article>
    </div>
</main>