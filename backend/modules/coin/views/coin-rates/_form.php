<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\coin\models\CoinRates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coin-rates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'coin_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'usd')->textInput() ?>

    <?= $form->field($model, 'eur')->textInput() ?>

    <?= $form->field($model, 'rub')->textInput() ?>

    <?= $form->field($model, 'uah')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            Yii::t('coin', 'Create') : Yii::t('coin', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
