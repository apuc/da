<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\currency\models\CurrencySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'char_code') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'type') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('currency', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('currency', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
