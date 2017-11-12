<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\exchange\models\ExchangeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exchange-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'num_code') ?>

    <?= $form->field($model, 'char_code') ?>

    <?= $form->field($model, 'nominal') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'value') ?>

    <?php // echo $form->field($model, 'previous') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('exchange_rates', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('exchange_rates', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
