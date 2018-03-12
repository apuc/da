<?php
/**
 * @var $cart array
 */

use common\classes\GeobaseFunction;
use common\models\UploadPhoto;
use yii\helpers\Url;

$this->registerJsFile('/js/raw/products.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>


<div class="shop__empty-cart">Ваша Корзина пуста <span>Начните покупать сейчас!</span></div>

<h1 class="shop__all-categories-title">Вам понравится</h1>

<div class="shop__top-sales-home-elements single-shop-carousel shop__all-categories-rec">

    <a href="#" class="shop__top-sales-home-elements--item">

        <h3 class="category-name">Смартфон</h3>
        <p class="category-element">iPhone 6s 16Gb</p>

        <div class="category-photo">
            <img src="img/broad.png" alt="">
        </div>

        <div class="category-price">
            <span class="category-price__old">19 990 <i class="fa fa-rub" aria-hidden="true"></i></span>
            <span class="category-price__new">15 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
        </div>

        <button class="category-buy">Купить</button>

    </a>

    <a href="#" class="shop__top-sales-home-elements--item">

        <h3 class="category-name">Смартфон</h3>
        <p class="category-element">iPhone 6s 16Gb</p>
        <span class="hit-label">Хит</span>
        <div class="category-photo">
            <img src="img/shop/category-photo-1.png" alt="">
        </div>

        <div class="category-price">
            <span class="category-price__old">19 990 <i class="fa fa-rub" aria-hidden="true"></i></span>
            <span class="category-price__new">15 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
        </div>

        <button class="category-buy">Купить</button>

    </a>

    <a href="#" class="shop__top-sales-home-elements--item">

        <h3 class="category-name">Смартфон</h3>
        <p class="category-element">iPhone 6s 16Gb</p>

        <div class="category-photo">
            <img src="img/broad.png" alt="">
        </div>

        <div class="category-price">
            <span class="category-price__old">19 990 <i class="fa fa-rub" aria-hidden="true"></i></span>
            <span class="category-price__new">15 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
        </div>

        <button class="category-buy">Купить</button>

    </a>

    <a href="#" class="shop__top-sales-home-elements--item">

        <h3 class="category-name">Смартфон</h3>
        <p class="category-element">iPhone 6s 16Gb</p>
        <span class="hit-label">Хит</span>
        <div class="category-photo">
            <img src="img/shop/category-photo-1.png" alt="">
        </div>

        <div class="category-price">
            <span class="category-price__old">19 990 <i class="fa fa-rub" aria-hidden="true"></i></span>
            <span class="category-price__new">15 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
        </div>

        <button class="category-buy">Купить</button>

    </a>

    <a href="#" class="shop__top-sales-home-elements--item">

                    <span class="category-sale">
                        <span>-45%</span>
                    </span>

        <h3 class="category-name">Смартфон</h3>
        <p class="category-element">iPhone 6s 16Gb</p>

        <div class="category-photo">

            <img src="img/broad.png" alt="">
        </div>

        <div class="category-price">
            <span class="category-price__old">19 990 <i class="fa fa-rub" aria-hidden="true"></i></span>
            <span class="category-price__new">15 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
        </div>

        <button class="category-buy">Купить</button>

    </a>

    <a href="#" class="shop__top-sales-home-elements--item">

        <h3 class="category-name">Смартфон</h3>
        <p class="category-element">iPhone 6s 16Gb</p>
        <span class="hit-label">Хит</span>
        <div class="category-photo">
            <img src="img/shop/category-photo-1.png" alt="">
        </div>

        <div class="category-price">
            <span class="category-price__old">19 990 <i class="fa fa-rub" aria-hidden="true"></i></span>
            <span class="category-price__new">15 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
        </div>

        <button class="category-buy">Купить</button>

    </a>

    <a href="#" class="shop__top-sales-home-elements--item">

        <h3 class="category-name">Смартфон</h3>
        <p class="category-element">iPhone 6s 16Gb</p>
        <span class="hit-label">Хит</span>
        <div class="category-photo">
            <img src="img/shop/category-photo-1.png" alt="">
        </div>

        <div class="category-price">
            <span class="category-price__old">19 990 <i class="fa fa-rub" aria-hidden="true"></i></span>
            <span class="category-price__new">15 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
        </div>

        <button class="category-buy">Купить</button>

    </a>

    <a href="#" class="shop__top-sales-home-elements--item">

        <h3 class="category-name">Смартфон</h3>
        <p class="category-element">iPhone 6s 16Gb</p>

        <div class="category-photo">
            <img src="img/broad.png" alt="">
        </div>

        <div class="category-price">
            <span class="category-price__old">19 990 <i class="fa fa-rub" aria-hidden="true"></i></span>
            <span class="category-price__new">15 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
        </div>

        <button class="category-buy">Купить</button>

    </a>

    <a href="#" class="shop__top-sales-home-elements--item">

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

    <a href="#" class="shop__top-sales-home-elements--item">

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

    <a href="#" class="shop__top-sales-home-elements--item">

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

    <a href="#" class="shop__top-sales-home-elements--item">

                    <span class="category-sale">
                        <span>-45%</span>
                    </span>

        <h3 class="category-name">Смартфон</h3>
        <p class="category-element">iPhone 6s 16Gb</p>

        <div class="category-photo">

            <img src="img/broad.png" alt="">
        </div>

        <div class="category-price">
            <span class="category-price__old">19 990 <i class="fa fa-rub" aria-hidden="true"></i></span>
            <span class="category-price__new">15 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
        </div>

        <button class="category-buy">Купить</button>

    </a>

</div>


