<?php ?>
<div class="user-questions">
    <h3>Последние вопросы пользователей</h3>
    <?php foreach ($lastFaq as $item): ?>
        <div class="question">
            <div class="title">Консультации / <?= $item->consulting->title; ?></div>
            <div class="data-time"><?= \common\classes\WordFunctions::FullEventDate($item->dt_add); ?></div>
            <div class="text">
                <?= $item->question; ?>
            </div>
            <div class="info">
                <a href="#">Читать ответ</a>
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

    <a href="#" class="ask-question">задать свой вопрос</a>

    <a href="" id="get-more-faq" class="load-more" data-offset="3">загрузить БОЛЬШЕ</a>

</div>