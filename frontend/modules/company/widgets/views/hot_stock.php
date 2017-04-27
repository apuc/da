<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 24.04.2017
 * Time: 22:06
 * @var $model \common\models\db\Stock
 */

?>

<div class="business__sidebar stock" id="business-stock-sidebar">

    <h3>популярные акции</h3>

    <?php foreach ($model as $item): ?>
        <a href="<?= $item->link ?>" class="stock__link">

            <span class="stock__title"></span>

            <div class="stock__link--img">
                <img src="<?= $item->photo ?>" alt="">
            </div>

            <div class="stock__link--descr">

                <p><?= $item->title ?></p>

            </div>

        </a>
    <?php endforeach; ?>

</div>
