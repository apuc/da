<?php
/**
 * @var $categoryTree \frontend\modules\shop\models\CategoryShop
 * @var $like_categories
 * @var $products
 * @var $banner_photo
 */
$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/theme/portal-donbassa/js/slick.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/theme/portal-donbassa/js/products_search.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?= \frontend\modules\shop\widgets\ShowAllShopsCategory::widget(['category' => $categoryTree]); ?>

<div class="shop__stock-banner">

    <a href="#">
        <span>акция месяца</span>
        <img src="<?= $banner_photo ?>" alt="">
    </a>

</div>

<div class="shop__top-sales">

    <h3 class="shop__top-sales--title">ТОП ПРОДАЖ</h3>

    <div class="shop__top-sales-nav">

        <a href="#" class="shop__top-sales-nav--link">
            <span class="icon"><img src="/theme/portal-donbassa/img/shop/icons/payment-method-icon.png" alt=""></span>
            <span class="name">Способы <br> оплаты</span>
        </a>

        <a href="#" class="shop__top-sales-nav--link">
            <span class="icon"><img src="/theme/portal-donbassa/img/shop/icons/deliver-icon.png" alt=""></span>
            <span class="name">Склады в <br> ДНР</span>
        </a>

        <a href="#" class="shop__top-sales-nav--link">
            <span class="icon"><img src="/theme/portal-donbassa/img/shop/icons/warehouse-icon.png" alt=""></span>
            <span class="name">Ликвидация <br> товара</span>
        </a>

        <a href="#" class="shop__top-sales-nav--link">
            <span class="icon"><img src="/theme/portal-donbassa/img/shop/icons/deliver-icon.png" alt=""></span>
            <span class="name">Круглосуточный <br> колл-центр</span>
        </a>

    </div>

    <div class="shop__top-sales-elements">

        <a href="#" class="shop__top-sales-elements--stock-item hidden-xs">
            <span class="new-label">NEW</span>
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

        </a>

        <a href="#" class="shop__top-sales-elements--item">
            <span class="hit-label">Хит</span>
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

        </a>

        <a href="#" class="shop__top-sales-elements--item">
            <span class="hit-label">Хит</span>
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

        </a>

        <a href="#" class="shop__top-sales-elements--item hidden-xs hidden-sm">
            <span class="hit-label">Хит</span>
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

        </a>

    </div>

</div>

<div class="shop__main">

    <h3 class="shop__main--title">Вам понравится</h3>

    <ul class="shop__main--categories">
        <li data-id="0" class="active"><a href="#">Все</a></li>
        <?php foreach ($like_categories as $cat) { ?>
            <li data-id="<?= $cat->id ?>"><a href="#"><?= $cat->name ?></a></li>
        <?php } ?>
    </ul>


    <div id="you_like_items" class="shop__top-sales-home-elements single-shop-carousel">
        <?php foreach ($products as $product): ?>
            <a href="shop/product/<?= $product->slug ?>" class="shop__top-sales-home-elements--item">

                <h3 class="category-name"><?= $product->category->name ?></h3>
                <p class="category-element"><?= $product->title ?></p>

                <div class="category-photo">
                    <img src="<?= $product->cover ?>" alt="">
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