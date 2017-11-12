<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\coin\models\CoinRates */

$this->title = Yii::t('coin', 'Update Coin Rates: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('coin', 'Coin Rates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('coin', 'Update');
?>
<div class="coin-rates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
