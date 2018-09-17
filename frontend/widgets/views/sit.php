<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.03.2017
 * Time: 15:07
 * @var $sit \common\models\db\Situation
 */

?>

<div class="home-content__wrap_checkpoint">
    <span class="color-zebra"></span>
    <div class="title">
        <h2>Ситуация на блокпостах и КПП</h2>
        <a href="/page/situacia-na-blokpostah-i-na-granice-dnr-rf-na-segodna">
            Все пункты пропуска
            <span class="rect-icon"></span>
        </a>
    </div>

    <?php foreach ($sit as $s): ?>
        <div class="item">
            <span class="color_checkpoint"
                  style="background-color: <?= $s->status->circle ?>;border: 3px solid <?= $s->status->border ?>"></span>
            <div class="item-city">
                    <a href="<?= $s->link ?>">#<?= $s->name ?></a>
            </div>
            <p><?= $s->report_time ?> - <?= $s->descr ?></p>
        </div>
    <?php endforeach; ?>
</div>
