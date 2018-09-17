<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\vk\models\VkGroups */

$this->title = 'Редактировать: ' . $model->domain;
$this->params['breadcrumbs'][] = ['label' => 'Группы ВК', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="vk-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
