<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\vk\models\VkComments */

$this->title = 'Update Vk Comments: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vk Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vk-comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
