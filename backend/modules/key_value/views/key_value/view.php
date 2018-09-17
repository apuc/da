<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\key_value\models\KeyValue */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Key Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-value-view">

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
            'id',
            'key',
            'value:ntext',
            'dt_add',
            'dt_update',
        ],
    ]) ?>

</div>
