<?php

//\common\classes\Debug::prn($model);

?>
<a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $model['slug']])?>" class="shop__top-sales-elements--item shop__top-sales-home-elements--item">
    <h3 class="category-name"><?= $model['title']; ?></h3>
    <!--<p class="category-element">Eleaf iStick TC</p>-->

    <div class="category-photo">
        <?php
        if (!empty($model['cover'])): ?>
            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $model['cover']); ?>" alt="<?= $model['title']; ?>">
        <?php else: ?>
            <?php if(!empty($model['images'][0]->img_thumb)): ?>
                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $model['images'][0]->img_thumb); ?>">
            <?php else:?>
                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $model['cover']); ?>" alt="<?= $model['title']; ?>">
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div class="category-price">
        <?php if (empty($model['new_price'])): ?>
            <span class="category-price__new"><?= number_format($model['price'], 0, '.', ' '); ?> <i class="fa fa-rub" aria-hidden="true"></i></span>
        <?php else:?>
            <span class="category-price__old"><?= number_format($model['price'], 0, '.', ' '); ?> <i class="fa fa-rub" aria-hidden="true"></i></span>
            <span class="category-price__new"><?= number_format($model['new_price'], 0, '.', ' '); ?> <i class="fa fa-rub" aria-hidden="true"></i></span>
        <?php endif; ?>
    </div>

    <button class="category-buy">Купить</button>

</a>