<?php
/**
 * @var $categoryTree \frontend\modules\shop\models\CategoryShop
 * @var $like_categories
 * @var $products
 * @var $hitProducts
 * @var $banner_photo
 * @var $banner_url
 */

use common\models\db\ProductMark;

$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/theme/portal-donbassa/js/slick.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/theme/portal-donbassa/js/products_search.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?= \frontend\modules\shop\widgets\ShowAllShopsCategory::widget(['category' => $categoryTree]); ?>

<div class="shop__stock-banner">

    <a href="<?= $banner_url ?>">
        <span>акция месяца</span>
        <img src="<?= $banner_photo ?>" alt="">
    </a>

</div>

<div class="shop__top-sales-home">

    <h3 class="shop__top-sales-home--titles">ТОП ПРОДАЖ</h3>

    <div class="shop__top-sales-home-nav">

        <a href="#" class="shop__top-sales-home-nav--link">
            <span class="icon"><img src="theme/portal-donbassa/img/shop/icons/payment-method-icon.png" alt=""></span>
            <span class="name">Способы <br> оплаты</span>
        </a>

        <a href="#" class="shop__top-sales-home-nav--link">
            <span class="icon"><img src="theme/portal-donbassa/img/shop/icons/deliver-icon.png" alt=""></span>
            <span class="name">Склады в <br> ДНР</span>
        </a>

        <a href="#" class="shop__top-sales-home-nav--link">
            <span class="icon"><img src="theme/portal-donbassa/img/shop/icons/warehouse-icon.png" alt=""></span>
            <span class="name">Ликвидация <br> товара</span>
        </a>

        <a href="#" class="shop__top-sales-home-nav--link">
            <span class="icon"><img src="theme/portal-donbassa/img/shop/icons/deliver-icon.png" alt=""></span>
            <span class="name">Круглосуточный <br> колл-центр</span>
        </a>

    </div>

    <div class="shop__top-sales-home-elements">


        <?php
        $index = 3;
        foreach ($hitProducts as $hitProduct): ?>
            <?php if ($index === 3): ?>
                <a href="#" class="shop__top-sales-home-elements--stock-item hidden-xs">
                    <div class="label-wrap">
                        <div class="new-label tooltip-main tooltip-west">
                            NEW
                            <span class="tooltip-content">Lorem ipsum.</span>
                        </div>

                        <div class="hit-label tooltip-main tooltip-east">
                            ХИТ
                            <span class="tooltip-content">Lorem ipsum.</span>
                        </div>

                        <div class="percent-label tooltip-main tooltip-west">
                              
                            <span class="tooltip-content">Lorem ipsum.</span>
                        </div>

                        <div class="percent-discount-label tooltip-main tooltip-east">
                            -20%
                            <span class="tooltip-content">Lorem ipsum.</span>
                        </div>

                    </div>

                    <div class="category-banner">

                        <h3>цена снижена</h3>

                        <span>
                            <img src="img/shop/category-banner.png" alt="">
                        </span>

                    </div>

                    <span class="category-sale">
                        <span>-45%</span>
                    </span>

                    <h3 class="category-name">Смартфон</h3>
                    <p class="category-element">iPhone 6s 16Gb</p>

                    <div class="category-photo">
                        <img src="img/shop/category-photo-1.png" alt="">
                    </div>

                    <div class="category-price">
                        <span class="category-price__old">19 990 <i class="fa fa-rub" aria-hidden="true"></i></span>
                        <span class="category-price__new">15 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
                    </div>

                    <button class="category-buy">Купить</button>
                    <div class="label-wrap">
                        <div class="new-label tooltip-main tooltip-east">
                            NEW
                            <span class="tooltip-content">Lorem ipsum.</span>
                        </div>

                        <div class="hit-label tooltip-main tooltip-east">
                            ХИТ
                            <span class="tooltip-content">Lorem ipsum.</span>
                        </div>

                        <div class="percent-label tooltip-main tooltip-east">
                              
                            <span class="tooltip-content">Lorem ipsum.</span>
                        </div>

                        <div class="percent-discount-label tooltip-main tooltip-east">
                            -20%
                            <span class="tooltip-content">Lorem ipsum.</span>
                        </div>


                    </div>
                </a>
                <?php $index = 0; ?>
            <?php else: ?>
                <a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $hitProduct->product->slug]) ?>"
                   class="shop__top-sales-home-elements--item">
                    <div class="label-wrap">

                        <?php if ($hitProduct->product->hasMark(ProductMark::MARK_NEW)): ?>
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
                    <span class="category-sale">
                    <span>-45%</span>
                </span>

                    <h3 class="category-name"><?= $hitProduct->product->category->name ?></h3>
                    <p class="category-element"><?= $hitProduct->product->title ?></p>

                    <div class="category-photo">
                        <img src="<?= $hitProduct->product->cover ?>" alt="">
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
            <?php endif ?>
            <?php $index++; ?>
        <?php endforeach ?>

    </div>

</div>

<div class="shop__main">

    <h3 class="shop__main--title">Вам понравится</h3>

    <ul class="shop__main--categories">
        <li data-id="0" class="active"><a href="#">Все</a></li>
        <?php foreach ($like_categories as $cat) : ?>
            <li data-id="<?= $cat->id ?>"><a href="#"><?= $cat->name ?></a></li>
        <?php endforeach; ?>
    </ul>


    <div id="you_like_items" class="shop__top-sales-home-elements single-shop-carousel">
        <?php foreach ($products as $product): ?>
            <a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $product->slug]) ?>"
               class="shop__top-sales-home-elements--item">

                <h3 class="category-name"><?= $product->category->name ?></h3>
                <p class="category-element"><?= $product->title ?></p>

                <div class="category-photo">
                    <?php
                    if (!empty($product['cover'])): ?>
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $product['cover']); ?>" alt="<?= $product['title']; ?>">
                    <?php else: ?>

                        <?php if(!empty($product['images'][0]->img_thumb)): ?>
                            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage('/'. $product['images'][0]->img_thumb); ?>">
                        <?php else:?>
                            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $product['cover']); ?>" alt="<?= $product['title']; ?>">
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="category-price">
                    <?php if ($product->new_price != null): ?>
                        <span class="category-price__old"><?= $product->price ?><i class="fa fa-rub"
                                                                                   aria-hidden="true"></i></span>
                        <span class="category-price__new"><?= $product->new_price ?><i class="fa fa-rub"
                                                                                       aria-hidden="true"></i></span>
                    <?php else: ?>
                        <span class="category-price__new"><?= $product->price ?><i class="fa fa-rub"
                                                                                   aria-hidden="true"></i></span>
                    <?php endif ?>
                </div>
                <button class="category-buy">Купить</button>

            </a>
        <?php endforeach ?>
    </div>
    <ul class="slick-navigation">
        <li class="prev"><i class="fa fa-2x fa-chevron-left" aria-hidden="true"></i></li>
        <li class="next"><i class="fa fa-2x fa-chevron-right" aria-hidden="true"></i></li>
    </ul>

    <ul class="slick-navigation">
        <li class="prev"><i class="fa fa-2x fa-chevron-left" aria-hidden="true"></i></li>
        <li class="next"><i class="fa fa-2x fa-chevron-right" aria-hidden="true"></i></li>
    </ul>
</div>