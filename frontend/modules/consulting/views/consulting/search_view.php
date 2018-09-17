
<main id="main-consultation">
<div class="container">
    <?= \frontend\modules\consulting\widgets\SearchForm::widget() ?>
    <article id="article">

            <h2>По запросу: "<?= $q?>", найдено <?= $count?> результатов</h2>
            <div class="user-questions">
                    <?php foreach ($posts as $post): ?>
                    <?/*\common\classes\Debug::prn($post) */?>

                    <div class="question">
                        <!--<div class="title"><?/*= $post->consulting->title; */?>
                            / <?/*= $post->categoryPostsConsulting->title; */?></div>-->

                        <div class="title"><?= $post['title']; ?></div>
                        <div class="data-time"><?= \common\classes\WordFunctions::FullEventDate($post['dt_add']); ?></div>
                        <div class="text"><?= \common\classes\WordFunctions::crop_str_word(strip_tags($post['text']), 50); ?>
                        </div>
                        <div class="info"><a href="<?= \yii\helpers\Url::to(['/consulting/consulting/'.$post['url'],'slug'=>$post['slug']]);?>">Читать ответ</a><span
                                class="view"><?= $post['views']; ?> <?=  \common\classes\WordFunctions::getNumEnding($post['views'],
                                    ['просмотр', 'просмотра', 'просмотров']); ?></span></div>
                    </div>
                <?php endforeach; ?>
        </div>

    </article>
    <?= \frontend\modules\consulting\widgets\ConsultingCompanies::widget();?>
</div>

</main>
