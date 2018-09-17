<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 18.04.2017
 * Time: 15:16
 * @var $stock \common\models\db\Stock
 */

?>
<div class="home-content__sidebar_stock">
    <h3 class="main-title">Акции</h3>
    <span class="separator"></span>
    <?php foreach ($stock as $item): ?>

        <!--<div class="stock__item_visible">
            <div class="thumb">
                <img src="<?/*= $item->photo */?>" alt="">
                <a href="<?/*= $item->link */?>" class="time-icon"></a>
            </div>
            <div class="stock__item_label">
                <p><?/*= $item->short_descr */?></p>
            </div>
            <div class="content">
                <!--<p> Акция проходит <small>с 01.01.2017</small> </p>>
                <p><?/*= $item->dt_event */?></p>
                <a href="<?/*= $item->link */?>">подробнее</a>
            </div>

        </div>-->
        <a href="<?= $item->link ?>" target="_blank" class="stock__item">
            <div class="stock__item_visible">
                <div class="thumb">
                    <img src="<?= $item->photo  . '?width=300'  ?>" alt="">
                    <span class="time-icon"></span>
                </div>
                <div class="stock__item_label">
                    <p><?= $item->short_descr ?></p>
                </div>
                <div class="content">
                    <p><?= $item->dt_event ?></p>
                    <!--<p> Акция проходит <small>с 01.01.2017</small> </p>-->
                    <!-- <a href="">подробнее</a>-->
                </div>

            </div>
        </a>
    <?php endforeach; ?>
</div>
<a href="<?= \yii\helpers\Url::to(['/promotions/promotions/index'])?>" class="home-content__sidebar__button">Все акции</a>