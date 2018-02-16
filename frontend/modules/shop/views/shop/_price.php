<?php
/**
 * @var $model \frontend\modules\shop\models\Products
 */
?>
<?php if(empty($model->new_price)): ?>
    <div class="single-shop__info-item">
        <div>Цена:</div>
        <div>
            <span class="price-sail"><?= number_format($model->price, 0, '.', ' '); ?> руб. / шт.</span>
        </div>
    </div>
<?php else:
    $sale = $model->new_price * 100 / $model->price - 100;

    ?>


    <div class="single-shop__info-item">
        <div class="">Цена</div>
        <div class="old-price"><?= number_format($model->price, 0, '.', ' '); ?> руб. / шт.</div>
    </div>
    <div class="single-shop__info-item">
        <div>Цена со скидкой:</div>
        <div>
            <span class="price-sail"><?= number_format($model->new_price, 0, '.', ' '); ?> руб. / шт.</span>
            <a href="#" class="discount"><span class="discount-sale"><?= round($sale) ?>%</span> <!--Осталось дней: 6--></a>
        </div>

    </div>

<?php endif; ?>