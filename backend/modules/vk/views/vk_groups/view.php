<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\vk\models\VkGroups */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Группы ВК', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-groups-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'domain',
            'vk_id',
        ],
    ]) ?>

</div>
