<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\db\ServicePeriods */

$this->title = $model->product->title . ' ' . $model->start . '-' . $model->end;
$this->params['breadcrumbs'][] = ['label' => 'Приёмы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-periods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            [
                'attribute' => 'product_id',
                'value' => function($model){
                    return $model->product->title;
                }
            ],
            'start',
            'end',
            [
                'attribute' => 'week_days',
                'value' => function($model){
                    $days = json_decode($model->week_days);
                    $result = '';
                    foreach($days as $day)
                        $result .= $day . ', ';
                    return $result;
                }
            ]

        ],
    ]) ?>

</div>
