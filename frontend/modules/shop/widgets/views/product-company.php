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

                <a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $item->slug])?>" class="shop__top-sales-elements--item">

                    <h3 class="category-name"><?= $item->title; ?></h3>
                    <!--<p class="category-element">iPhone 6s 16Gb</p>-->

                    <div class="category-photo">
                        <?php
                        if (!empty($item->cover)): ?>
                            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $item->cover); ?>" alt="<?= $item->title; ?>">
                        <?php else: ?>
                            <?php if(!empty($item->images[0]->img_thumb)): ?>
                                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($item->images[0]->img_thumb); ?>">
                            <?php else:?>
                                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $item->cover); ?>" alt="<?= $item->title; ?>">
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="category-price">
                        <?php if (empty($item->new_price)): ?>
                            <span class="category-price__new"><?= number_format($item->price, 0, '.', ' '); ?> <i class="fa fa-rub" aria-hidden="true"></i></span>
                        <?php else:?>
                            <span class="category-price__old"><?= number_format($item->price, 0, '.', ' '); ?> <i class="fa fa-rub" aria-hidden="true"></i></span>
                            <span class="category-price__new"><?= number_format($item->new_price, 0, '.', ' '); ?> <i class="fa fa-rub" aria-hidden="true"></i></span>
                        <?php endif; ?>
                    </div>

                    <button class="category-buy">Купить</button>

                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php
endif;