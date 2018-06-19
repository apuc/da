<?php
/**
 * @var $hitProducts array
 *
 */

use common\models\db\ProductMark;

?>

<h1 class="shop__all-categories-title">Вам понравится</h1>

<div class="shop__top-sales-home-elements single-shop-carousel shop__all-categories-rec">

    <?php foreach ($hitProducts as $hitProduct): ?>
        <a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $hitProduct->product->slug]) ?>"
           class="shop__top-sales-home-elements--item">
            <div class="label-wrap">

                <?php if ($hitProduct->product->daysPassed(3)): ?>
                    <div class="new-label tooltip-main tooltip-west">
                        NEW
                        <span class="tooltip-content">Lorem ipsum.</span>
                    </div>
                <?php endif ?>

                <?php if ($hitProduct->product->hasMark(ProductMark::MARK_HIT)): ?>
                    <div class="hit-label tooltip-main tooltip-east">
                        ХИТ
                        <span class="tooltip-content">Lorem ipsum.</span>
                    </div>
                <?php endif ?>

                <?php if ($hitProduct->product->hasMark(ProductMark::MARK_STOCK)): ?>
                    <div class="percent-label tooltip-main tooltip-west">
                        <span class="tooltip-content">Lorem ipsum.</span>
                    </div>
                <?php endif ?>

                <?php if ($hitProduct->product->hasMark(ProductMark::MARK_DISCOUNT)): ?>
                    <div class="percent-discount-label tooltip-main tooltip-east">
                        -20%
                        <span class="tooltip-content">Lorem ipsum.</span>
                    </div>
                <?php endif ?>

                <?php if ($hitProduct->product->hasMark(ProductMark::MARK_LOWEST_PRICE)): ?>
                    <div class="discount-arrow-label tooltip-main tooltip-west">
                        <span class="tooltip-content">Lorem ipsum.</span>
                    </div>
                <?php endif ?>

            </div>
            <?php if ($hitProduct->product->new_price != null): ?>
                <span class="category-sale">
                        <span><?= '-' . ceil(($hitProduct->product->price - $hitProduct->product->new_price) /
                                $hitProduct->product->price * 100) . '%' ?></span>
                        </span>
            <?php endif ?>
            <h3 class="category-name"><?= $hitProduct->product->category->name ?></h3>
            <p class="category-element"><?= $hitProduct->product->title ?></p>

            <div class="category-photo">
                <?php if (!empty($hitProduct->product['cover'])): ?>
                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($hitProduct->product['cover']); ?>"
                <?php else: ?>

                    <?php if (!empty($hitProduct->product['images'][0]->img)): ?>
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($hitProduct->product['images'][0]->img); ?>">
                    <?php elseif(!empty($hitProduct->product['images'][0]->img_thumb)):?>
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($hitProduct->product['images'][0]->img_thumb); ?>">
                    <?php else: ?>
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($hitProduct->product['cover']); ?>"
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

</div>