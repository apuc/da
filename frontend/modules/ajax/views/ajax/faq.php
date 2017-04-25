<?php foreach ($lastFaq as $item): ?>
    <div class="question">
        <div class="title">Консультации / <?= $item->consulting->title; ?></div>
        <div class="data-time"><?= \common\classes\WordFunctions::FullEventDate($item->dt_add); ?></div>
        <div class="text">
            <?= $item->question; ?>
        </div>
        <div class="info">
            <a href="<?= \yii\helpers\Url::to(['/consulting/consulting/faq-post', 'slug' => $item->slug]); ?>">Читать ответ</a>
            <span class="view">
                    <?= $item->views . ' ' . \common\classes\WordFunctions::getNumEnding($item->views,
                        [
                            'просмотр',
                            'просмотра',
                            'просмотров',
                        ]); ?>
                </span>
        </div>
    </div>
<?php endforeach; ?>