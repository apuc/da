<?php
/**
 * @var $cart array
 */

use common\classes\GeobaseFunction;
use common\models\UploadPhoto;
use yii\helpers\Url;


$this->registerJsFile('/js/raw/products.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<h1 class="shop__top-title">
    Ваша корзина <span>(<?= Yii::$app->cart->count; ?> товар)</span>
    <img src="/theme/portal-donbassa/img/icons/cheak.svg" alt="">
</h1>

<div class="shop__content shop__content-cart">

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
                <a href="<?= Url::to(['/company/company/view', 'slug' => $item['slug']]) ?>" class="shop__company-btn">На
                    страницу компании</a>
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
                                    <img src="<?= UploadPhoto::getImageOrNoImage('/' . $value['images'][0]['img_thumb']); ?>">
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
                    <a href="<?= Url::to(['/shop/cart/order-one-shop', 'shopId' => $item['id']])?>" class="shop__info-price-btn">Заказать у этого продавца</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="shop__content-footer">
        <div class="shop__content-footer-desc">
            <!--Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
            aliquip ex ea commodo consequat. Duis au-->
            <a href="<?= Url::to(['/shop/cart/clear'])?>" class="clean-cart-btn">Очистить корзину</a>
        </div>
        <div class="shop__content-footer-price">
            <!--<div class="cost-goods">Стоимость(3 товара(ов)): <span>805,98</span> руб.</div>-->
            <!--<div class="cost-delivery">Стоимость доставки: <span>94,31</span> руб.</div>-->
            <div class="total-cost">Общая сумма: <span><?= \common\classes\Cart::getSummCart(); ?></span> руб</div>
            <a href="<?= Url::to(['/shop/cart/order-shop'])?>" class="buy-btn">Оформить заказ</a>
        </div>
    </div>
</div>
<?= \frontend\modules\shop\widgets\ShowCartSideProducts::widget(); ?>
