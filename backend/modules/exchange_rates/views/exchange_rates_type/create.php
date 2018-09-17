<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\exchange_rates\models\ExchangeRatesType */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Типы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-rates-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
