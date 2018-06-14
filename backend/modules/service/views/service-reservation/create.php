<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\ServiceReservation */
/* @var $services common\models\db\Products[] */


$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Бронирования услуг', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-reservation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services
    ]) ?>

</div>
