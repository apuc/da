<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\vk\models\VkAuthors */

$this->title = 'Update Vk Authors: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vk Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vk-authors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
