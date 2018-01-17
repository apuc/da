<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\mainpage\models\MainPremiere */

$this->title = 'Update Main Premiere: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Main Premieres', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="main-premiere-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'region' => $region,
    ]) ?>

</div>
