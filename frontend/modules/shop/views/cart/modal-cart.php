<?php

use yii\helpers\Url;

?>
<h2 class="cart-carousel-title">Вместе с этим часто покупают:</h2>

<div class="shop__top-sales-elements ">
    <?php

    if (!empty($model)):
        foreach ($model as $item):?>
            <?php //\common\classes\Debug::dd($item);
            ?>
            <a href="<?= Url::to(['/shop/shop/show', 'slug' => $item['products']->slug]) ?>"
               class="shop__top-sales-elements--item">

                <h3 class="category-name"><?php $item['products']->title ?></h3>
                <!--<p class="category-element">iPhone 6s 16Gb</p>-->

                <div class="category-photo">
                    <?php
                    if (!empty($item['products']->cover)): ?>
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($item['products']->cover); ?>"
                             alt="<?= $item['products']->title; ?>">
                    <?php else: ?>
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage('/' . $item['products']['images'][0]->img_thumb); ?>">
                    <?php endif; ?>
                </div>

                <div class="category-price">
                    <?php if (empty($item['products']->new_price)): ?>
                        <span class="category-price__new">
                        <?= number_format($item['products']->price, 0, '.', ' '); ?>
                            <i class="fa fa-rub" aria-hidden="true"></i>
                    </span>
                    <?php else: ?>
                        <span class="category-price__old">
                        <?= number_format($item['products']->price, 0, '.', ' '); ?>
                            <i class="fa fa-rub" aria-hidden="true"></i>
                    </span>
                        <span class="category-price__new">
                        <?= number_format($item['products']->new_price, 0, '.', ' '); ?>
                            <i class="fa fa-rub" aria-hidden="true"></i>
                    </span>
                    <?php endif; ?>
                </div>

                <button class="category-buy">Купить</button>

            </a>
        <?php endforeach;
    endif;
    ?>

</div>