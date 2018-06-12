<?php

use common\classes\Debug;
?>

<a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $model['slug']])?>" class="business__company-item">
    <div class="business__company-img">
        <?php
        if (!empty($model['cover'])): ?>
            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $model['cover'] . "?width=400px"); ?>" alt="<?= $model['title']; ?>">
        <?php else: ?>
            <?php if(!empty($model['images'][0]->img_)): ?>
                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $model['images'][0]->img); ?>">
            <?php else:?>
                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $model['cover']); ?>" alt="<?= $model['title']; ?>">
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="business__company-desc">
        <?= $model['title']; ?>
    </div>
    <div class="business__company-view"><span class="view"><?= $model['view']; ?> просмотров</span> <span class="heart"></span></div>
    <div class="business__company-price">
        <div class="price-label"><?= number_format($model['price'], 0, '.', ' '); ?> руб. / шт.</div>
        <div class="price-date"><?= date('d.m.Y', $model['dt_update'])?></div>
    </div>
    <button class="business__company-btn">Добавить в корзину</button>
</a>