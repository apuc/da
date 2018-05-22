<?php
/**
 * @var $model \frontend\modules\shop\models\Products
*/


if(!empty($model)):
?>
    <div class="single-shop__view-more">
        <h2 class="single-shop__view-title">
            Посмотреть другие
        </h2>
        <div class="shop__top-sales-elements">
            <?php foreach ($model as $item): ?>

                <a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $item->product->slug])?>" class="shop__top-sales-elements--item">

                    <h3 class="category-name"><?= $item->product->title; ?></h3>
                    <!--<p class="category-element">iPhone 6s 16Gb</p>-->

                    <div class="category-photo">
                        <?php
                        if (!empty($item->product->cover)): ?>
                            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $item->product->cover); ?>" alt="<?= $item->product->title; ?>">
                        <?php else: ?>
                            <?php if(!empty($item->product->images[0]->img_thumb)): ?>
                                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage('/'. $item->product->images[0]->img_thumb); ?>">
                            <?php else:?>
                                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $item->product->cover); ?>" alt="<?= $item->product->title; ?>">
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="category-price">
                        <?php if (empty($item->product->new_price)): ?>
                            <span class="category-price__new"><?= number_format($item->product->price, 0, '.', ' '); ?> <i class="fa fa-rub" aria-hidden="true"></i></span>
                        <?php else:?>
                            <span class="category-price__old"><?= number_format($item->product->price, 0, '.', ' '); ?> <i class="fa fa-rub" aria-hidden="true"></i></span>
                            <span class="category-price__new"><?= number_format($item->product->new_price, 0, '.', ' '); ?> <i class="fa fa-rub" aria-hidden="true"></i></span>
                        <?php endif; ?>
                    </div>

                    <button class="category-buy">Купить</button>

                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php
endif;