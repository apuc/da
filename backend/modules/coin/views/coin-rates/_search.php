<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\coin\models\CoinRatesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coin-rates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'coin_name') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'usd') ?>

    <?= $form->field($model, 'eur') ?>

    <?php // echo $form->field($model, 'rub') ?>

    <?php // echo $form->field($model, 'uah') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
