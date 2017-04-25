<?php use common\classes\WordFunctions;

foreach ($posts as $post): ?>
    <div class="law">
        <div class="title"><?= $post->consulting->title; ?>
            / <?= $post->categoryPostsDigest[0]->title; ?></div>
        <div class="data-time"><?= WordFunctions::FullEventDate($post->dt_add); ?></div>
        <div class="title-law"><?= $post->title; ?></div>
        <div class="text"><?= WordFunctions::crop_str_word(strip_tags($post->content), 50); ?>
        </div>
        <div class="info"><a href="<?= \yii\helpers\Url::to(['/consulting/consulting/document', 'slug' => $post->slug]); ?>">Читать ответ</a><span
                    class="view"><?= $post->views; ?> <?= WordFunctions::getNumEnding($post->views,
                    ['просмотр', 'просмтора', 'просмотров']); ?></span></div>
    </div>
<?php endforeach; ?>
