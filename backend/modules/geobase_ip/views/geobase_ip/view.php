<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\geobase_ip\models\GeobaseIp */

$this->title = $model->ip_begin;
$this->params['breadcrumbs'][] = ['label' => 'Geobase Ips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geobase-ip-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ip_begin], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ip_begin], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ip_begin',
            'ip_end',
            'country_code',
            'city_id',
        ],
    ]) ?>

</div>
