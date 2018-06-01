<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\db\Order */

use common\classes\GeobaseFunction;
use common\models\UploadPhoto;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Оформление заказа';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="site-signup">
    <h1><?/*= Html::encode($this->title) */?></h1>

    <p>Заполните контактные данные для заказа:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php /*$form = ActiveForm::begin(['id' => 'form-signup']); */?>

            <?/*= $form->field($model, 'first_name')->textInput(['autofocus' => true]) */?>

            <?/*= $form->field($model, 'last_name') */?>

            <?/*= $form->field($model, 'email') */?>

            <?/*= $form->field($model, 'phone') */?>

            <?/*= $form->field($model, 'address') */?>


            <div class="form-group">
                <?/*= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) */?>
            </div>

            <?php /*ActiveForm::end(); */?>
        </div>
    </div>
</div>-->


<h2 class="shop__order-title"><?= Html::encode($this->title) ?></h2>

<div class="shop__ordering-wrap">
    <?php $form = ActiveForm::begin(
        [
            'id' => 'form-signup',
            'options' => [
                'class' => 'shop__ordering'
            ]
        ]
    ); ?>

        <div class="shop__ordering-header">Пожалуйста, заполните ваш адрес доставки:</div>

        <div class="shop__ordering-form">
            <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'last_name') ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'phone') ?>

            <?= $form->field($model, 'address') ?>

        </div>
        <div class="shop__guarantee">

            <h2 class="shop__guarantee-title">Доставка и гарантия</h2>
            <p class="shop__guarantee-desc">
                Мы всегда на стороне покупателя, вы можете вернуть
                товар или деньги в случаях:
            </p>
            <ol class="shop__guarantee-list">
                <li>Не соответствует описанию</li>
                <li>Ненадлежащего качества</li>
                <li>Не приехал</li>
            </ol>

            <?= Html::submitButton('Оформить заказ', ['class' => 'shop__guarantee-btn-order', 'name' => 'signup-button']) ?>
            <a href="<?= \yii\helpers\Url::to(['/shop/default/index'])?>" class="shop__guarantee-btn-back">Продолжить покупки</a>

        </div>
    <?php ActiveForm::end(); ?>

    <h2 class="shop__order-title">Проверьте детали заказа</h2>
    <div class="shop__content disable-product">

        <?php foreach ($cart as $item): ?>

            <div class="shop__content-wrap">
                <div class="shop__company">
                    <h2 class="shop__company-title">Продавец</h2>
                    <div class="all-actions__company">
                        <div class="all-actions__company--img">
                            <img src="<?= $item['photo']; ?>" alt="">
                        </div>
                        <h3 class="all-actions__company--title"><?= $item['name']; ?></h3>
                        <?php
                        if ($item['region_id'] != 0) {
                            $address = GeobaseFunction::getRegionName($item['region_id']) . ', ' . GeobaseFunction::getCityName($item['city_id']) . ', ' . $item['address'];
                        } else {
                            $address = $item['address'];
                        }
                        ?>
                        <div class="all-actions__company--addres"><?= $address; ?></div>
                    </div>

                </div>

                <table class="shop__table-cart">
                    <thead>
                    <tr>
                        <td>Наименование товара и описание</td>
                        <td class="text-center">Количество</td>
                        <td class="text-center">Цена</td>
                        <td><!--Доставка и оплата--></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($item['products'] as $value): ?>
                        <tr>
                            <td>
                                <div class="product-pic">
                                    <?php if (!empty($value['cover'])): ?>
                                        <img src="<?= UploadPhoto::getImageOrNoImage($value['cover']); ?>"
                                             alt="<?= $value['title']; ?>">
                                    <?php else: ?>
                                        <img src="<?= UploadPhoto::getImageOrNoImage($value['images'][0]['img_thumb']); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="product-attribute">
                                    <a href="#" class="product-link">
                                        <?= $value['title'] ?>
                                    </a>
                                    <!--<span>Стиль: Кэжуал</span>
                                    <span>Тип застёжки: Молния</span>-->
                                    <a href="<?= Url::to(['/shop/shop/show', 'slug' => $value['slug']]) ?>" class="product-more">подробное описание</a>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="numbers">
                                    <input type="number" id="js-product-quantity<?= $value['id']?>" min="1" max="999" value="<?= $value['count']; ?>" class="js-product-quantity number "
                                           data-type="single" maxlength="999" pattern="[0-9]{3}">
                                    <a class="minus">
                                        <i class="fa fa-minus update-count-cart" aria-hidden="true" shop-id="<?= $item['id']?>" product-id="<?= $value['id']?>"></i>
                                    </a>
                                    <a class="plus">
                                        <i class="fa fa-plus update-count-cart" aria-hidden="true" shop-id="<?= $item['id']?>" product-id="<?= $value['id']?>"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php if (empty($value['new_price'])): ?>
                                    <div class="price-sail"><?= number_format($value['price'], 0, '.', ' '); ?> руб. / шт.
                                    </div>
                                <?php else: ?>
                                    <div class="price-sail"><?= number_format($value['new_price'], 0, '.', ' '); ?> руб. /
                                        шт.
                                    </div>
                                    <div class="old-price"><?= number_format($value['price'], 0, '.', ' '); ?> руб. / шт.
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!--<a href="#" class="form-btn">заполнить форму доставки</a>-->
                                <a href="#" class="delete-product delete-product-cart"
                                   product-id="<?= $value['id'] ?>" shop-id="<?=$item['id'] ?>"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="shop__footer">
                    <div class="shop__action">
                        <!--Акция продавца <a href="#">Получить купон продавца</a>-->
                    </div>
                    <div class="shop__info-price">
                        <p class="shop__info-price-desc">
                            <!--Стоимость: 597,10 руб. <span>Стоимость доставки: 0,00 руб</span>-->

                            Общая стоимость: <?= \common\classes\Cart::getSummShop($item['id'])?> руб
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="shop__content-footer">
            <div class="shop__content-footer-desc">
                <!--Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat. Duis au-->
            </div>
            <div class="shop__content-footer-price">
                <!--<div class="cost-goods">Стоимость(3 товара(ов)): <span>805,98</span> руб.</div>-->
                <!--<div class="cost-delivery">Стоимость доставки: <span>94,31</span> руб.</div>-->
                <div class="total-cost">Общая сумма: <span><?= \common\classes\Cart::getSummCart(); ?></span> руб</div>
            </div>
        </div>
    </div>


</div>

<aside class="shop__sidebar" id="shop-sidebar-cart">
    <h2 class="shop__sidebar-title">Посмотреть другие</h2>
    <a href="#" class="shop__top-sales-elements--item">

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
</aside>