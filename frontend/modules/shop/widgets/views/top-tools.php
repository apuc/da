<?php
/**
 * @var $this yii\web\View
 * @var $category \frontend\modules\shop\models\CategoryShop
 */
?>

<div class="shop__top-tools">

    <form id="shop-search-form" class="shop__top-form" action="<?= \yii\helpers\Url::to(['/shop/shop/search'])?>">
        <?= \yii\helpers\Html::textInput(
            'textSearch',
            null,
            [
                'class' => 'shop__top-form--field',
                'placeholder' => 'Я ищу...',
            ]
        ) ?>

        <?= \yii\helpers\Html::dropDownList(
            'categorySearch',
            null,
            \yii\helpers\ArrayHelper::map($category, 'id', 'name'),
            [
                'class' => 'shop__top-form--field-category',
                'prompt' => 'Все категории',
            ]
        ) ?>

        <button id="shop-search-form-submit" class="shop__top-form--submit" type="submit"><i
                    class="fa fa-search" aria-hidden="true"></i></button>

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
                <a href="<?= \yii\helpers\Url::to(['/shop/cart/cart']) ?>" class="basket">Корзина</a>
                <span class="basket-counter"><?= Yii::$app->cart->count; ?></span>
            </li>

            <li><a href="<?= \yii\helpers\Url::to(['/personal_area/user-desire']) ?>" target="_blank" class="my-desires">Мои желания</a>
            </li>
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