<?php
/**
 * @var $hitProducts array
 *
 */

use common\models\db\ProductMark;

?>
<aside class="shop__sidebar" id="shop-sidebar-cart">
    <h2 class="shop__sidebar-title">Посмотреть другие</h2>
    <?php foreach ($hitProducts as $hitProduct): ?>
        <a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $hitProduct->product->slug]) ?>"
           class="shop__top-sales-elements--item">

            <h3 class="category-name"><?= $hitProduct->product->category->name ?></h3>
            <p class="category-element"><?= $hitProduct->product->title ?></p>

            <div class="category-photo">
                <?php
                if (!empty($hitProduct->product['cover'])): ?>
                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($hitProduct->product['cover']); ?>"
                         alt="<?= $hitProduct->product['title']; ?>">
                <?php else: ?>

                    <?php if (!empty($hitProduct->product['images'][0]->img_thumb)): ?>
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage('/' . $hitProduct->product['images'][0]->img_thumb); ?>">
                    <?php else: ?>
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($hitProduct->product['cover']); ?>"
                             alt="<?= $hitProduct->product['title']; ?>">
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="category-price">
                <?php if ($hitProduct->product->new_price != null): ?>
                    <span class="category-price__old"><?= $hitProduct->product->price ?><i class="fa fa-rub"
                                                                                           aria-hidden="true"></i></span>
                    <span class="category-price__new"><?= $hitProduct->product->new_price ?><i class="fa fa-rub"
                                                                                               aria-hidden="true"></i></span>
                <?php else: ?>
                    <span class="category-price__new"><?= $hitProduct->product->price ?><i class="fa fa-rub"
                                                                                           aria-hidden="true"></i></span>
                <?php endif ?>
            </div>

            <button class="category-buy">Купить</button>

        </a>
    <?php endforeach ?>
</aside>