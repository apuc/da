<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\polls\models\Polls */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="polls-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


    <div class="pa">
        <p>Варианты ответов</p>
        <?= Html::textInput('pa[]', null, [
            'class' => 'form-control'
        ]) ?>

        <?= Html::textInput('pa[]', null, [
            'class' => 'form-control'
        ]) ?>
        <a href="#" id="add_pa" class="btn btn-primary">Добавить вариант</a>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
