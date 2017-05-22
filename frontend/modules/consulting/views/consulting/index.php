<?php
$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);
\frontend\assets\AppAssetConsulting::register($this);
?>
<main id="main-consultation">

    <div class="container">
        <article id="article">
            <p>Наши ключевые</p>
            <h1>Консультации</h1>
            <!--<p>voluptatem accusantium doloremque laudantium, totam rem aperiam,-->
            <!--    eaque ipsa quae ab illo</p>-->


            <div class="consultation-slider">
                <?php foreach ($consultingsSlider as $item): ?>
                    <a href="<?= \yii\helpers\Url::to(['/consulting/consulting/view','slug'=>$item->slug]);?>" class="item">
                        <div class="item__img">
                            <img src="<?= $item->photo;?>" alt="" class="lazyOwl">
                        </div>
                        <p><?= $item->title;?></p>
                    </a>
                <?php endforeach; ?>
            </div>

            <?= \frontend\modules\consulting\widgets\LastFaq::widget();?>

        </article>

        <?= \frontend\modules\consulting\widgets\ConsultingCompanies::widget();?>
    </div>
</main>

