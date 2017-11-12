<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\coin\models\CoinRates */

$this->title = 'Create Coin Rates';
$this->params['breadcrumbs'][] = ['label' => 'Coin Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coin-rates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
