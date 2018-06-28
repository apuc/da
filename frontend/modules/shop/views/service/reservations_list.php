<?php
/**
 * @var $reservations \common\models\db\ServiceReservation[]
 * @var $model \frontend\modules\shop\models\Products
 */

use common\models\db\ServicePeriods;

?>
<br/>
<?php if ($reservations): ?>
    <?php foreach ($reservations as $reservation): ?>
        <div>
            <div class='form-line'>
                <p>Начало:<?= $reservation->start ?></p>
            </div>

            <div class='form-line'>
                <p>Конец:<?= $reservation->end ?></p>
            </div>

            <div class='form-line'>
                Пользователь: <?php if ($user = \common\models\User::findOne($reservation->user_id))
                    echo $user->username;
                else
                    echo 'Не задано';
                ?>
            </div>

            <a href="#" data-id="<?= $reservation->id ?>" class="btn btn-danger delete-reservation">-</a>
            <hr>
        </div>
    <?php endforeach ?>
<?php else: ?>
    <p>В этот день заказов нет.</p>
<?php endif ?>
<?php if ($period = $model->getServicePeriodByWeekDay(ServicePeriods::getWeekDayLabel()[date("w", time())])): ?>
    <?php
    $array = [];
    $dayDuration = $period->getDayDuration();
    $Duration = $model->durability;
    $count = $dayDuration / $Duration; ?>
    <div class='container-lg-3'>
        <?php for ($i = 0; $i < $count; $i++): ?>
            <?php if (!$period->checkReservation($i, $Duration, time(), $model->id)): ?>
                <?php $time = $period->getButtonLabel($i, $Duration);
                $array[$time] = $time; ?>
            <?php endif ?>
        <?php endfor ?>
    </div>
    <div class="reservation_control_create">
        <?= \yii\helpers\Html::dropDownList('chosen_period', null, $array, ['promt' => 'выберите время']) ?>
        <a href="#" data-id="<?= $reservation->id ?>" class="btn btn-info create-reservation">Добавить</a>
    </div>
<?php endif ?>
