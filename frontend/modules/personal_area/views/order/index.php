<?php
/**
 * @var $model \common\models\db\OrderProduct
 * @var $order Order
 */
use common\models\db\Order;
use yii\helpers\Url;

?>
<div class="cabinet__inner-box">
    <h3>Мои заказы</h3>
    <a href="#" class="cabinet__inner-box--add">добавить <span><img src="img/icons/add-pkg-icon.png" alt=""></span></a>
    <div class="cabinet-order-title">Заказ № <?= $order->id ?> <span> (Кол-во товаров: <?= $order->cnt ?>)</span> <img src="img/shop/icons/red-ok.png" alt="">
    </div>

    <div class="cabinet-order">
        <table class="shop__table-cart ">
            <thead>
            <tr>
                <td>Наименование товара и описание</td>
                <td class="text-center">Дата заказа</td>
                <td class="text-center">Количество</td>
                <td class="text-center">Доставка и оплата</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $item): ?>
                <tr>
                    <td>
                        <div class="product-pic">
                            <img src="<?= $item->products->cover ?>" alt="">
                        </div>
                        <div class="product-attribute">
                            <a href="#" class="product-link">
                                <?= $item->products->title ?>
                            </a>
                            <a href="#" class="product-more">подробное описание</a>
                        </div>
                    </td>
                    <td class="text-center ">
                        <?= $item->order->dt_add ?>
                    </td>
                    <td class="text-center ">
                        <?= $item->count ?>
                    </td>
                    <td class="text-center">
                        <div class="price-sail"><?= $item->products->price ?> руб. / шт.</div>
                        <!--<div class="discount-coupon">введен купон на скидку в 10%</div>-->
                        <div class="processing">Товар ожидает обработки</div>
                        <!--<button class="take-processing">Принять в обработку</button>-->
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="shop__footer" style="flex-wrap: wrap">
            <div class="shop__action">
                <a href="#" class="form-delivery-link">посмотреть форму доставки клиента</a>
                <div class="form-delivery-container">
                    <div><?= $model[0]->order->first_name ?></div>
                    <div><?= $model[0]->order->address ?></div>
                    <div>
                        <b>контактный телефон</b>
                        <a href="tel:0668479966"><?= $model[0]->order->phone ?></a>
                    </div>
                </div>

            </div>
            <div class="shop__info-price">
                <p class="shop__info-price-desc">
                    <span>Стоимость с учетом скидок <?= $order->sum_sale ?> руб.</span> Общая стоимость: <?= $order->sum ?> руб
                </p>
            </div>
            <div style="width: 100%">
                <button onclick="document.location.href = '<?= Url::to(['/personal_area/order/change-status',
                    'id' => $order->id,
                    'status' => Order::ORDER_STATUS_ACCEPTED]) ?>'" class="take-processing">Принять в обработку</button>
            </div>

        </div>
    </div>

</div>