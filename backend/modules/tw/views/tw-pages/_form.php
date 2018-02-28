<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\tw\models\TwPages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tw-pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'screen_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([1 => 'Активна', 0 => 'Не активна']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
