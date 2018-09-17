<?php if($orderInfo > 0): ?>

    <a href="<?= \yii\helpers\Url::to(['/personal_area/order/all']); ?>" class="viewed-orders">
        <span>
            <img src="/theme/portal-donbassa/img/shop/icons/package.png" alt="">
        </span>
        Не просмотреных заказов <b><?= $orderInfo; ?></b>
    </a>
<?php else: ?>
    <a href="<?= \yii\helpers\Url::to(['/personal_area/order/all']); ?>" class="all-viewed-orders">
        <span>
            <img src="/theme/portal-donbassa/img/shop/icons/package.png" alt="">
        </span>
        Все заказы просмотрены
    </a>
<?php endif;