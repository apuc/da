<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.03.2017
 * Time: 15:07
 * @var $sit \common\models\db\SituationStatus
 */

?>
<?php// \common\classes\Debug::prn($sit) ?>
<div class="home-content__wrap_checkpoint">
    <span class="color-zebra"></span>
    <div class="title">
        <h2>Ситауция на блокпостах</h2>
        <a href=""><span class="rect-icon"></span>Проинформировать</a>
    </div>

    <?php foreach ($sit as $s): ?>
        <?php if (!empty($s->situation)): ?>
            <div class="item">
                <span class="color_checkpoint" style="background-color: <?= $s->circle ?>;border: 3px solid <?= $s->border ?>"></span>
                <div class="item-city">
                    <?php foreach ((array)$s->situation as $item): ?>
                        <a href="">#<?= $item->name ?></a>
                    <?php endforeach ?>
                </div>
                <p>09:49 - Курахово очередь курахово очередь</p>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
