<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\ServiceReservation */
/* @var $services common\models\db\Products[] */


$this->title = 'Update Service Reservation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Бронирование услуг', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="service-reservation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services
    ]) ?>

</div>
