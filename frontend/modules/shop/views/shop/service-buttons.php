<?php /**
 * Created by PhpStorm.
 * User: MEMES
 * Date: 18.06.2018
 * Time: 13:03
 */ ?>
<?php
use common\models\db\ServiceReservation;
use common\models\db\Products;
use common\models\db\ServicePeriods;
?>
<div class = "container-lg-3">
    <?php
    $period = $model->getServicePeriodByWeekDay(ServicePeriods::getWeekDayLabel()[date("w", strtotime($date))]);
    $dayDuration = $period->getDayDuration();
    $Duration = $model->durability;
    $count = $dayDuration / $Duration; ?>
    <div class='container-lg-3'>
        <?php for ($i = 0; $i < $count; $i++): ?>
            <?php for ($i = 0; $i < $count; $i++): ?>
                <?php if ($period->checkReservation($i, $Duration, strtotime($date), $model->id)): ?>
                    <button data-id="<?= $i ?>"
                            class="btn btn-warning service-reserve"><?= $period->getButtonLabel($i, $Duration) ?></button>
                <?php else: ?>
                    <button data-id="<?= $i ?>"
                            class="btn btn-info service-reserve"><?= $period->getButtonLabel($i, $Duration) ?></button>
                <?php endif ?>
            <?php endfor ?>
        <?php endfor ?>
    </div>
</div>
