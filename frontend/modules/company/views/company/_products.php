<?php
/**
 * @var $products \frontend\modules\shop\models\Products
 * @var $product \frontend\modules\shop\models\Products
 */
?>


<div id="shop-company" class="business__tab-content--wrapper">

    <div class="business__company">
        <?php foreach ($products as $product): ?>
        <a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $product->slug])?>" class="business__company-item">
            <div class="business__company-img">
                <?php if (!empty($product->cover)): ?>
                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $product->cover); ?>" alt="<?= $product->title; ?>">
                <?php else: ?>
                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($product->images[0]->img_thumb); ?>">
                <?php endif; ?>
                <!--<img src="img/company-shop/1.png" alt="">-->
            </div>
            <div class="business__company-desc">
                <?= $product->title; ?>
            </div>
            <div class="business__company-price"><?= number_format($product->price, 0, '.', ' '); ?> руб. / шт. <span class="heart"></span></div>
        </a>
        <?php endforeach; ?>
    </div>


</div>
