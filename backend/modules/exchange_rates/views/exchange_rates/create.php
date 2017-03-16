<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\exchange_rates\models\ExchangeRates */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Курсы валют', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-rates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
