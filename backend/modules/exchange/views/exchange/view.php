<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\exchange\models\Exchange */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('exchange_rates', 'Exchanges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('exchange_rates', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('exchange_rates', 'Delete'), ['delete', 'id' => $model->id], [
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
            'num_code',
            'char_code',
            'nominal',
            'name:ntext',
            'value',
            'previous',
            [
                'attribute' => 'date',
                'value' => function ($model) {
                    return date('d.m.Y', $model->date);
                },
            ],
        ],
    ]) ?>

</div>
