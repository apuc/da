<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\SocAvailable */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Социальные сети', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soc-available-view">

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
            'name',
            //'icon',
            [
                'attribute'=>'icon',
                'value'=>function ($data){
                        return '<img src="'.$data->icon.'">';
                },
                'format'=>'html'
            ]
        ],
    ]) ?>

</div>
