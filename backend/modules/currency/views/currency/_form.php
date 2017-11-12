<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\currency\models\Currency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'num_code')->textInput() ?>

    <?= $form->field($model, 'char_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        0 => 'Скрыта',
        1 => 'Доступна для показа',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            Yii::t('exchange_rates', 'Create') : Yii::t('exchange_rates', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
