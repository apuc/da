<?php

use kartik\color\ColorInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\situation\models\SituationStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="situation-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'circle')->widget(ColorInput::classname(), [
        'options' => ['placeholder' => 'Выберите цвет ...'],
    ]); ?>

    <?= $form->field($model, 'border')->widget(ColorInput::classname(), [
        'options' => ['placeholder' => 'Выберите цвет ...'],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
