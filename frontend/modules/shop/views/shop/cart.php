<?php
/**
 * @var $cart array
 */

use common\classes\GeobaseFunction;
use common\models\UploadPhoto;
use yii\helpers\Url;

?>

<h1 class="shop-cart__top-title">
    Ваша корзина <span>(<?= Yii::$app->cart->count; ?> товар)</span>
    <img src="img/icons/cheak.svg" alt="">
</h1>

<div class="shop-cart__content">

    <?php foreach ($cart as $item): ?>
        <div class="shop-cart__content-wrap">
        <div class="shop-cart__company">
            <h2 class="shop-cart__company-title">Продавец</h2>
            <div class="all-actions__company">
                <div class="all-actions__company--img">
                    <img src="<?= $item['photo']; ?>" alt="">
                </div>

                <h3 class="all-actions__company--title"><?= $item['name']; ?></h3>

                <?php
                if($item['region_id'] != 0){
                    $address = GeobaseFunction::getRegionName($item['region_id']) . ', ' .GeobaseFunction::getCityName($item['city_id']) . ', ' . $item['address'] ;
                }
                else{
                    $address = $model['address'];
                }
                ?>

                <div class="all-actions__company--addres"><?= $address; ?></div>

            </div>
            <a href="<?= Url::to(['/company/company/view', 'slug' => $item['slug']]) ?>" class="shop-cart__company-btn">На страницу компании</a>
        </div>

        <table class="shop-cart__table-cart">
            <thead>
            <tr>
                <td>Наименование товара и описание</td>
                <td class="text-center">Количество</td>
                <td class="text-center">Цена</td>
                <td>Доставка и оплата</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($item['products'] as $value):?>
            <tr>
                <td>
                    <div class="product-pic">
                        <?php if (!empty($value['cover'])): ?>
                            <img src="<?= UploadPhoto::getImageOrNoImage( $value['cover']); ?>" alt="<?= $value['title']; ?>">
                        <?php else: ?>
                            <img src="<?= UploadPhoto::getImageOrNoImage($value['cover'][0]->img_thumb); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="product-attribute">
                        <a href="<?= Url::to(['/shop/shop/show', 'slug' => $value['slug'] ])?>" class="product-link">
                            <?= $value['title'] ?>
                        </a>
                        <!--<span>Стиль: Кэжуал</span>
                        <span>Тип застёжки: Молния</span>-->
                        <a href="<?= Url::to(['/shop/shop/show', 'slug' => $value['slug'] ])?>" class="product-more">подробное описание</a>
                    </div>
                </td>
                <td class="text-center">
                    <div class="numbers">
                        <input type="number" min="1" max="999" value="1" class="js-product-quantity number " data-type="single" maxlength="999" pattern="[0-9]{3}">
                        <a class="minus"><i class="fa fa-minus" aria-hidden="true"></i></a>
                        <a class="plus"> <i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                </td>
                <td class="text-center">
                    <div class="price-sail">4 022,40 руб. / шт.</div>
                    <div class="old-price">4 022,40 руб. / шт.</div>
                </td>
                <td>
                    <a href="#" class="form-btn">заполнить форму доставки</a>
                    <a href="#" class="delete-product"></a>
                </td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <div class="shop-cart__footer">
            <div class="shop-cart__action">
                Акция продавца <a href="#">Получить купон продавца</a>
            </div>
            <div class="shop-cart__info-price">
                <p class="shop-cart__info-price-desc">
                    Стоимость: 597,10 руб. <span>Стоимость доставки: 0,00 руб</span>
                    Общая стоимость: 597,10 руб
                </p>
                <a href="#" class="shop-cart__info-price-btn">Заказать у этого продавца</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="shop-cart__content-wrap">

        <div class="shop-cart__company">

            <h2 class="shop-cart__company-title">Продавец</h2>

            <div class="all-actions__company">

                <div class="all-actions__company--img">
                    <img src="img/company-action.png" alt="">
                </div>

                <h3 class="all-actions__company--title">Электромаркет «Вилка-Розетка»</h3>

                <div class="all-actions__company--addres">ДНР, Донецк, ул. Университетская, 56б</div>

            </div>
            <a href="#" class="shop-cart__company-btn">На страницу компании</a>
        </div>

        <table class="shop-cart__table-cart">
            <thead>
            <tr>
                <td>Наименование товара и описание</td>
                <td class="text-center">Количество</td>
                <td class="text-center">Цена</td>
                <td>Доставка и оплата</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <div class="product-pic">
                        <img src="img/shop/cart-tov.png" alt="">
                    </div>
                    <div class="product-attribute">
                        <a href="#" class="product-link">
                            Стильный рюкзак мужской для
                            ноутбука 15,6" дюймов
                        </a>
                        <span>Стиль: Кэжуал</span>
                        <span>Тип застёжки: Молния</span>
                        <a href="#" class="product-more">подробное описание</a>
                    </div>
                </td>
                <td class="text-center">
                    <div class="numbers">
                        <input type="number" min="1" max="999" value="1" class="js-product-quantity number " data-type="single" maxlength="999" pattern="[0-9]{3}">
                        <a class="minus"><i class="fa fa-minus" aria-hidden="true"></i></a>
                        <a class="plus"> <i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                </td>
                <td class="text-center">
                    <div class="price-sail">4 022,40 руб. / шт.</div>
                    <div class="old-price">4 022,40 руб. / шт.</div>
                </td>
                <td>
                    <a href="#" class="form-btn">заполнить форму доставки</a>
                    <a href="#" class="delete-product"></a>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="shop-cart__footer">
            <div class="shop-cart__action">
                Акция продавца <a href="#">Получить купон продавца</a>
            </div>
            <div class="shop-cart__info-price">
                <p class="shop-cart__info-price-desc">
                    Стоимость: 597,10 руб. <span>Стоимость доставки: 0,00 руб</span>
                    Общая стоимость: 597,10 руб
                </p>
                <a href="#" class="shop-cart__info-price-btn">Заказать у этого продавца</a>
            </div>
        </div>
    </div>



    <div class="shop-cart__content-footer">
        <div class="shop-cart__content-footer-desc">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
            aliquip ex ea commodo consequat. Duis au
            <a href="#" class="clean-cart-btn">Очистить корзину</a>
        </div>
        <div class="shop-cart__content-footer-price">
            <div class="cost-goods">Стоимость(3 товара(ов)): <span>805,98</span> руб.</div>
            <div class="cost-delivery">Стоимость доставки: <span>94,31</span> руб.</div>
            <div class="total-cost">Общая сумма: <span>900,29</span> руб</div>
            <a href="#" class="buy-btn">Оформить заказ</a>
        </div>
    </div>
</div>

<aside class="shop-cart__sidebar" id="shop-cart-sidebar">
    <h2 class="shop-cart__sidebar-title">Посмотреть другие</h2>
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