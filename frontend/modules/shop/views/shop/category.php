<?php
/**
 * @var $this yii\web\View
 * @var $categoryInfo \frontend\modules\shop\models\CategoryShop
 */

$this->title = $categoryInfo->name;
?>

<div class="breadcrumbs-wrap">
    <ul class="breadcrumbs">
        <li><a href="#">Главная</a></li>
        <li><a href="#">Все категории</a></li>
        <li><a href="#">Телефоны...</a></li>
        <li><a href="#">Женская одежда и аксессуары</a></li>
    </ul>
</div>
<h1 class="shop__title"><?= $this->title; ?></h1>
<?= $this->render('_left-category',
    [
        'categoryId' => $categoryInfo->id,
        'categoryTreeArr' => $categoryTreeArr,
        'ollCategory' => $ollCategory,
    ]
); ?>
<div class="shop__top-sales">

    <div class="shop__top-sales-nav">

        <h3 class="shop__top-sales-nav--title">Популярные товары
            этой категории
        </h3>

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

        <a href="#" class="shop__top-sales-elements--item">
            <h3 class="category-name">Механический мод</h3>
            <p class="category-element">Eleaf iStick TC</p>

            <div class="category-photo">
                <img src="img/broad.png" alt="">
            </div>

            <div class="category-price">
                <span class="category-price__new">3 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">
            <h3 class="category-name">Механический мод</h3>
            <p class="category-element">Eleaf iStick TC</p>

            <div class="category-photo">
                <img src="img/broad.png" alt="">
            </div>

            <div class="category-price">
                <span class="category-price__new">3 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">
            <h3 class="category-name">Механический мод</h3>
            <p class="category-element">Eleaf iStick TC</p>

            <div class="category-photo">
                <img src="img/broad.png" alt="">
            </div>

            <div class="category-price">
                <span class="category-price__new">3 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">
            <h3 class="category-name">Механический мод</h3>
            <p class="category-element">Eleaf iStick TC</p>

            <div class="category-photo">
                <img src="img/broad.png" alt="">
            </div>

            <div class="category-price">
                <span class="category-price__new">3 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">
            <h3 class="category-name">Механический мод</h3>
            <p class="category-element">Eleaf iStick TC</p>

            <div class="category-photo">
                <img src="img/broad.png" alt="">
            </div>

            <div class="category-price">
                <span class="category-price__new">3 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">
            <h3 class="category-name">Механический мод</h3>
            <p class="category-element">Eleaf iStick TC</p>

            <div class="category-photo">
                <img src="img/broad.png" alt="">
            </div>

            <div class="category-price">
                <span class="category-price__new">3 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">
            <h3 class="category-name">Механический мод</h3>
            <p class="category-element">Eleaf iStick TC</p>

            <div class="category-photo">
                <img src="img/broad.png" alt="">
            </div>

            <div class="category-price">
                <span class="category-price__new">3 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

        <a href="#" class="shop__top-sales-elements--item">
            <h3 class="category-name">Механический мод</h3>
            <p class="category-element">Eleaf iStick TC</p>

            <div class="category-photo">
                <img src="img/broad.png" alt="">
            </div>

            <div class="category-price">
                <span class="category-price__new">3 000 <i class="fa fa-rub" aria-hidden="true"></i></span>
            </div>

            <button class="category-buy">Купить</button>

        </a>

    </div>

</div>