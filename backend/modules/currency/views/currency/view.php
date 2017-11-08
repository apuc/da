<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\currency\models\Currency */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('exchange_rates', 'Currencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-view">

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
            'name:ntext',
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function ($model) {
                    switch ($model->status) {
                        case 0:
                            return 'Скрыта';
                        case 1:
                            return 'Доступна для показа';
                    }
                },
            ],
        ],
    ]) ?>

</div>
