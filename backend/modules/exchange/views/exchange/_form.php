<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\exchange\models\Exchange */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exchange-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'num_code')->textInput() ?>

    <?= $form->field($model, 'char_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nominal')->textInput() ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'previous')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            Yii::t('exchange_rates', 'Create') : Yii::t('exchange_rates', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
