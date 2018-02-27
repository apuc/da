<?php
/**
 * @var $categoryTree \frontend\modules\shop\models\CategoryShop
 */
$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/theme/portal-donbassa/js/slick.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?= \frontend\modules\shop\widgets\ShowAllShopsCategory::widget(['category' => $categoryTree]); ?>

<div class="shop__stock-banner">

    <a href="#">
        <span>акция месяца</span>
        <img src="img/shop/stock-banner.png" alt="">
    </a>

</div>

<div class="shop__top-sales">

    <h3 class="shop__top-sales--title">ТОП ПРОДАЖ</h3>

    <div class="shop__top-sales-nav">

        <a href="#" class="shop__top-sales-nav--link">
            <span class="icon"><img src="img/shop/icons/payment-method-icon.png" alt=""></span>
            <span class="name">Способы <br> оплаты</span>
        </a>

        <a href="#" class="shop__top-sales-nav--link">
            <span class="icon"><img src="img/shop/icons/deliver-icon.png" alt=""></span>
            <span class="name">Склады в <br> ДНР</span>
        </a>

        <a href="#" class="shop__top-sales-nav--link">
            <span class="icon"><img src="img/shop/icons/warehouse-icon.png" alt=""></span>
            <span class="name">Ликвидация <br> товара</span>
        </a>

        <a href="#" class="shop__top-sales-nav--link">
            <span class="icon"><img src="img/shop/icons/deliver-icon.png" alt=""></span>
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
        <li class="active"><a href="#">Все</a></li>
        <li><a href="#">Молл</a></li>
        <li><a href="#">Для неё</a></li>
        <li><a href="#">Для него</a></li>
        <li><a href="#">Детям</a></li>
        <li><a href="#">Hi-Tech</a></li>
        <li><a href="#">Аксессуары</a></li>
        <li><a href="#">Компьютеры</a></li>
        <li><a href="#">Авто</a></li>
        <li><a href="#">Сумки и обувь</a></li>
        <li><a href="#">Дом и сад</a></li>
    </ul>


    <div class="shop__top-sales-elements single-shop-carousel">

        <a href="#" class="shop__top-sales-elements--item">

            <h3 class="category-name">Смартфон</h3>
            <p class="category-element">iPhone 6s 16Gb</p>

            <div class="category-photo">
                <img src="img/shop/category-photo-1.png" alt="">
            </div>

            <div class="category-price">
                                <span class="category-price__old">19 990 <i class="fa fa-rub"
                                                                            aria-hidden="true"></i></span>
                <span class="category-price__new">15 000 <i class="fa fa-rub"
                                                            aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">

            <h3 class="category-name">Смартфон</h3>
            <p class="category-element">iPhone 6s 16Gb</p>

            <div class="category-photo">
                <img src="img/shop/category-photo-1.png" alt="">
            </div>

            <div class="category-price">
                                <span class="category-price__old">19 990 <i class="fa fa-rub"
                                                                            aria-hidden="true"></i></span>
                <span class="category-price__new">15 000 <i class="fa fa-rub"
                                                            aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">

            <h3 class="category-name">Смартфон</h3>
            <p class="category-element">iPhone 6s 16Gb</p>

            <div class="category-photo">
                <img src="img/shop/category-photo-1.png" alt="">
            </div>

            <div class="category-price">
                                <span class="category-price__old">19 990 <i class="fa fa-rub"
                                                                            aria-hidden="true"></i></span>
                <span class="category-price__new">15 000 <i class="fa fa-rub"
                                                            aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">

            <h3 class="category-name">Смартфон</h3>
            <p class="category-element">iPhone 6s 16Gb</p>

            <div class="category-photo">
                <img src="img/shop/category-photo-1.png" alt="">
            </div>

            <div class="category-price">
                                <span class="category-price__old">19 990 <i class="fa fa-rub"
                                                                            aria-hidden="true"></i></span>
                <span class="category-price__new">15 000 <i class="fa fa-rub"
                                                            aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">

                    <span class="category-sale">
                        <span>-45%</span>
                    </span>

            <h3 class="category-name">Смартфон</h3>
            <p class="category-element">iPhone 6s 16Gb</p>

            <div class="category-photo">

                <img src="img/shop/category-photo-1.png" alt="">
            </div>

            <div class="category-price">
                                <span class="category-price__old">19 990 <i class="fa fa-rub"
                                                                            aria-hidden="true"></i></span>
                <span class="category-price__new">15 000 <i class="fa fa-rub"
                                                            aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">

            <h3 class="category-name">Смартфон</h3>
            <p class="category-element">iPhone 6s 16Gb</p>

            <div class="category-photo">
                <img src="img/shop/category-photo-1.png" alt="">
            </div>

            <div class="category-price">
                                <span class="category-price__old">19 990 <i class="fa fa-rub"
                                                                            aria-hidden="true"></i></span>
                <span class="category-price__new">15 000 <i class="fa fa-rub"
                                                            aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">

            <h3 class="category-name">Смартфон</h3>
            <p class="category-element">iPhone 6s 16Gb</p>

            <div class="category-photo">
                <img src="img/shop/category-photo-1.png" alt="">
            </div>

            <div class="category-price">
                                <span class="category-price__old">19 990 <i class="fa fa-rub"
                                                                            aria-hidden="true"></i></span>
                <span class="category-price__new">15 000 <i class="fa fa-rub"
                                                            aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">

            <h3 class="category-name">Смартфон</h3>
            <p class="category-element">iPhone 6s 16Gb</p>

            <div class="category-photo">
                <img src="img/shop/category-photo-1.png" alt="">
            </div>

            <div class="category-price">
                                <span class="category-price__old">19 990 <i class="fa fa-rub"
                                                                            aria-hidden="true"></i></span>
                <span class="category-price__new">15 000 <i class="fa fa-rub"
                                                            aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">

            <h3 class="category-name">Смартфон</h3>
            <p class="category-element">iPhone 6s 16Gb</p>

            <div class="category-photo">
                <img src="img/shop/category-photo-1.png" alt="">
            </div>

            <div class="category-price">
                                <span class="category-price__old">19 990 <i class="fa fa-rub"
                                                                            aria-hidden="true"></i></span>
                <span class="category-price__new">15 000 <i class="fa fa-rub"
                                                            aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">

                    <span class="category-sale">
                        <span>-45%</span>
                    </span>

            <h3 class="category-name">Смартфон</h3>
            <p class="category-element">iPhone 6s 16Gb</p>

            <div class="category-photo">

                <img src="img/shop/category-photo-1.png" alt="">
            </div>

            <div class="category-price">
                                <span class="category-price__old">19 990 <i class="fa fa-rub"
                                                                            aria-hidden="true"></i></span>
                <span class="category-price__new">15 000 <i class="fa fa-rub"
                                                            aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

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
