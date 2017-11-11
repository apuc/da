<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\coin\models\CoinRates */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('coin', 'Coin Rates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coin-rates-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('coin', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('coin', 'Delete'), ['delete', 'id' => $model->id], [
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
            'coin_name',
            'date',
            'usd',
            'eur',
            'rub',
            'uah',
        ],
    ]) ?>

</div>
