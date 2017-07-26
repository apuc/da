<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\geobase_ip\models\GeobaseIp */

$this->title = 'Update Geobase Ip: ' . $model->ip_begin;
$this->params['breadcrumbs'][] = ['label' => 'Geobase Ips', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ip_begin, 'url' => ['view', 'id' => $model->ip_begin]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="geobase-ip-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
