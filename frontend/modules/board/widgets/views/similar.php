<?php

if(!empty ($ads)):
?>

<div class="org">
    <h2>Похожие объявления </h2>

    <?php foreach ($ads->ads as $item) :

        ?>
    <div class="org-items">
        <a href="<?= \yii\helpers\Url::to(['/board/default/view', 'slug' => $item->slug, 'id' => $item->id]); ?>" class="slide-link">
            <?php if(!empty($item->adsImgs)): ?>
                <img src="<?= $item->adsImgs[0]->img_thumb; ?>" alt="">
            <?php else: ?>
                <img src="/theme/portal-donbassa/img/no-image.png" alt="<?= $item->title; ?>">
            <?php endif; ?>
            <h4><?= $item->title; ?></h4>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<?php endif;