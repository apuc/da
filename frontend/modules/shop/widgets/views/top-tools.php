<div class="shop__top-tools">

    <form id="shop-search-form" class="shop__top-form">

        <input class="shop__top-form--field" type="text" placeholder="Я ищу...">

        <!-- <div class="shop__top-form&#45;&#45;select-wrapper">-->
        <select class="shop__top-form--field-category">
            <option value="0">Все категории</option>
            <option value="1">Категория</option>
            <option value="2">Категория</option>
            <option value="3">Категория</option>
            <option value="4">Категория</option>
            <option value="5">Категория</option>
            <option value="6">Категория</option>
        </select>
        <!-- </div>-->
        <button id="shop-search-form-submit" class="shop__top-form--submit" type="submit"><i
                    class="fa fa-search" aria-hidden="true"></i></button>
        <!--<input id="shop-search-form-submit" class="shop__top-form--submit" type="submit" value="Найти">-->

    </form>

    <div class="shop__top-nav">

        <!--<a href="#" id="shop-toolbar-trigger" class="shop__top-trigger">-->

        <!--<span></span>-->
        <!--<span></span>-->
        <!--<span></span>-->

        <!--</a>-->

        <ul class="shop__top-nav--navigation">
            <li><a href="#" class="delivery">Доставка</a></li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/shop/shop/cart'])?>" class="basket">Корзина</a>
                <span class="basket-counter"><?= Yii::$app->cart->count; ?></span>
            </li>

            <li><a href="#" class="my-desires">Мои желания</a></li>
        </ul>

        <div class="button-second-menu">
            <a href="#">
                <div class="button-second-menu__hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                меню категорий
            </a>
        </div>
        <ul class="shop__top-nav--navigation-m">
            <li><a href="#" class="delivery"></a></li>
            <li>
                <a href="#" class="basket"></a>
                <span class="basket-counter">0</span>
            </li>

            <li><a href="#" class="my-desires"></a></li>
        </ul>
    </div>


</div>