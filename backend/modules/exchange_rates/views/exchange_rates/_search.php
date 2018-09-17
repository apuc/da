<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\exchange_rates\models\ExchangeRatesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exchange-rates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'currencies') ?>

    <?= $form->field($model, 'buy') ?>

    <?= $form->field($model, 'sale') ?>

    <?= $form->field($model, 'type_id') ?>

    <?php // echo $form->field($model, 'up') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
