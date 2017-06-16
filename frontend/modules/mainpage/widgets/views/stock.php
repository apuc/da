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
        <div class="stock__item_visible">
            <div class="thumb">
                <img src="<?= $item->photo ?>" alt="">
                <a href="<?= $item->link ?>" class="time-icon"></a>
            </div>
            <div class="stock__item_label">
                <p><?= $item->short_descr ?></p>
            </div>
            <div class="content">
                <!--<p> Акция проходит <small>с 01.01.2017</small> </p>-->
                <p><?= $item->dt_event ?></p>
                <a href="<?= $item->link ?>">подробнее</a>
            </div>

        </div>


        <!--<div class="stock__item" title="Нажми">
            <div class="stock__item_hide">
            <span class="stock__item_close">
              <i class="fa fa-times" aria-hidden="true"></i>
            </span>
                <p><?/*= $item->short_descr */?></p>
                <a href="<?/*= $item->link */?>">подобнее <span class="red-arrow"></span></a>
            </div>
            <div class="stock__item_visible">
                <div class="thumb">
                    <img src="<?/*= $item->photo */?>" alt="">
                </div>
                <div class="content">
                    <p> <?/*= $item->dt_event */?></p>
                </div>
                <span class="mouse-area">
              <img src="/theme/portal-donbassa/img/home-content/mouse-area.png" alt="">
            </span>
            </div>
        </div>-->
    <?php endforeach; ?>
</div>
<button class="home-content__sidebar__button">Все акции</button>