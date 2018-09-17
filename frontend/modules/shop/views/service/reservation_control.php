<?php


/* @var $model \frontend\modules\shop\models\Products */

use common\models\db\ServicePeriods;

/* @var $reservations \common\models\db\ServiceReservation[] */

echo '<script>var photoCount = 0;</script>';
$this->title = 'Мои заказы';
$this->registerCssFile('/css/board.min.css');
//$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/Uploader.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/raw/img_upload.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/raw/service.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


?>
<div class="cabinet__container cabinet__container_white cabinet__inner-box">
    <div class="single-shop__info-content--counter">
        <?= \yii\jui\DatePicker::widget(['attribute' => 'from_date',
            'language' => 'ru',
            'dateFormat' => 'php:d-m-YY',
            'options' => [
                'class' => 'reservation_date_change',
                'data-id' => $model->id,
            ]
        ]) ?>
    </div>
    <div class="test">
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
                        Пользователь: <?= \common\models\User::findOne($reservation->user_id)->username ?>
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
                    <?php
                        $time = $period->getButtonLabel($i, $Duration);
                        $array[$time] = $time;
                    ?>
                <?php endif ?>
            <?php endfor ?>
        </div>
        <div class="reservation_control_create">
            <?= \yii\helpers\Html::dropDownList('chosen_period', null, $array, ['promt' => 'выберите время']) ?>
            <a href="#" data-id="<?= $reservation->id ?>" class="btn btn-info create-reservation">Добавить</a>
        </div>
    <?php endif ?>
    </div>


</div>
