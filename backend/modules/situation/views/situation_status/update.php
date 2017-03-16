<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\situation\models\SituationStatus */

$this->title = 'Редактировать статус: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ситуации на блок постах', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="situation-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
