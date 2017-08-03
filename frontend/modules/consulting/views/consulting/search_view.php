<h3>По запросу: "<?= $q?>", найдено <?= $count?> результатов</h3>
<?php foreach ($posts as $post): ?>
    <?// \common\classes\Debug::prn($post->consulting) ?>

    <div class="law">
        <!--<div class="title"><?/*= $post->consulting->title; */?>
            / <?/*= $post->categoryPostsConsulting->title; */?></div>-->
        <div class="data-time"><?= \common\classes\WordFunctions::FullEventDate($post->dt_add); ?></div>
        <div class="title-law"><?= $post->title; ?></div>
        <div class="text"><?= \common\classes\WordFunctions::crop_str_word(strip_tags($post->content), 50); ?>
        </div>
        <div class="info"><a href="<?= \yii\helpers\Url::to(['/consulting/consulting/post','slug'=>$post->slug]);?>">Читать ответ</a><span
                class="view"><?= $post->views; ?> <?=  \common\classes\WordFunctions::getNumEnding($post->views,
                    ['просмотр', 'просмотра', 'просмотров']); ?></span></div>
    </div>
<?php endforeach; ?>