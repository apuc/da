<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\exchange_rates\models\ExchangeRates */

$this->title = 'Редактировать курс: ' . $model->currencies;
$this->params['breadcrumbs'][] = ['label' => 'Курсы валют', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->currencies, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="exchange-rates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
