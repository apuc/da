<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\currency\models\CurrencyRateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-rate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'currency_from_id') ?>

    <?= $form->field($model, 'currency_to_id') ?>

    <?= $form->field($model, 'rate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('currency', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('currency', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
