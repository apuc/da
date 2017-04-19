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
        <div class="stock__item">
            <div class="stock__item_hide">
                <p><?= $item->short_descr ?></p>
                <a href="<?= $item->link ?>">подобнее <span class="red-arrow"></span></a>
            </div>
            <div class="stock__item_visible">
                <div class="thumb">
                    <img src="<?= $item->photo ?>" alt="">
                </div>
                <div class="content">
                    <p> <?= $item->dt_event ?></p>
                </div>
                <span class="mouse-area">
                            <img src="/theme/portal-donbassa/img/home-content/mouse-area.png" alt="">
                        </span>
            </div>
        </div>
    <?php endforeach; ?>
</div>
