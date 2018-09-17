<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\tariff\models\Tariff */

$this->title = 'Update Tariff: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tariffs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tariff-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'select_arr' => $select_arr
    ]) ?>

</div>
