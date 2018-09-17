<?php

use common\models\db\Currency;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model Currency */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('currency', 'Currencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('currency', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('currency', 'Delete'), ['delete', 'id' => $model->id], [
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
            'code',
            'char_code',
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function ($model) {
                    return ArrayHelper::getValue($model->Statuses, $model->status);
                },
            ],
            [
                'attribute' => 'type',
                'format' => 'text',
                'value' => function ($model) {
                    return ArrayHelper::getValue($model->Types, $model->type);
                },
            ],
            [
                'attribute' => 'coin',
                'label' => Yii::t('currency', 'Coin'),
                'format' => 'raw',
                'value' => $model->coin ? DetailView::widget([
                    'model' => $model->coin,
                    'attributes' => [
                        'url:url',
                        'image_url:url',
                        'symbol',
                        'full_name',
                        'algorithm',
                        'proof_type',
                        'fully_premined',
                        'total_coin_supply',
                        'pre_mined_value',
                        'total_coins_free_float',
                        'sort_order',
                        'sponsored',
                    ],
                ]) : null
            ]
        ],
    ]) ?>

</div>
