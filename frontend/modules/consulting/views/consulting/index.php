<?php
$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);; ?>
<main id="main-consultation">

    <div class="container">
        <article id="article">
            <p>Наши ключевые</p>
            <h1>Консультации</h1>
            <!--<p>voluptatem accusantium doloremque laudantium, totam rem aperiam,-->
            <!--    eaque ipsa quae ab illo</p>-->


            <div class="consultation-slider">
                <?php foreach ($consultingsSlider as $item): ?>
                    <a href="" class="item">
                        <img src="<?= $item->photo;?>" alt="" class="lazyOwl">
                        <p><?= $item->title;?></p>
                    </a>
                <?php endforeach; ?>
            </div>

            <?= \frontend\modules\consulting\widgets\LastFaq::widget();?>

        </article>

        <?= \frontend\modules\consulting\widgets\ConsultingCompanies::widget();?>
    </div>
</main>

