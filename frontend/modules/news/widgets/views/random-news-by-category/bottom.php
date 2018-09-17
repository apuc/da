<div class="content__separator"></div>
<div class="content-single-wrapper__read-more">

    <h3>Читайте также:</h3>

    <div class="content-single-wrapper__read-more--links">
        <?php foreach ($news as $new): ?>
            <a href="<?= \yii\helpers\Url::to(['/news/default/view', 'slug' => $new->slug])?>" title="<?= $new->title;?>">
                <?= $new->title; ?>
            </a>
        <?php endforeach; ?>
    </div>

</div>