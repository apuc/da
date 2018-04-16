<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 11.04.2018
 * Time: 16:07
 * @var $model Order
 */
use common\models\db\Order;
use yii\helpers\Url;

?>
<div class="cabinet__inner-box">
    <h3>Мои заказы</h3>
    <!--<a href="#" class="cabinet__inner-box--add">добавить <span><img src="img/icons/add-pkg-icon.png" alt=""></span></a>-->
    <!--<div class="cabinet-order-title">Ваши заказы <span> (1 товар)</span> <img src="img/shop/icons/red-ok.png" alt=""></div>-->

    <div class="cabinet-order">
        <table class="shop__table-cart ">
            <thead>
            <tr>
                <td>Номер заказа</td>
                <td class="text-center">Дата заказа</td>
                <td class="text-center">Количество товаров</td>
                <td class="text-center">Доставка и оплата</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $item): ?>
                <tr>
                    <td>
                        <div class="product-attribute">
                            <a href="<?= Url::to(['/personal_area/order', 'id' => $item->id]) ?>" class="product-link">
                                <?= $item->id ?>
                            </a>
                        </div>
                    </td>
                    <td class="text-center ">
                        <?= date('d-m-Y', $item->dt_add) ?>
                    </td>
                    <td class="text-center ">
                        <?= $item->cnt ?>
                    </td>
                    <td class="text-center">
                        <div class="price-sail"><?= $item->sum ?> руб.</div>
                        <div class="price-sail">С учетом скидок <?= $item->sum_sale ?> руб.</div>
                        <div class="processing"><?= Order::$statusText[$item->status] ?></div>
                        <?php if($item->status === Order::ORDER_STATUS_ACCEPTED): ?>
                            <button onclick="document.location.href = '<?= Url::to(['/personal_area/order/change-status',
                                'id' => $item->id,
                                'status' => Order::ORDER_STATUS_READY]) ?>'" class="take-processing">Заказ готов</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</div>
