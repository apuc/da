<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\vk\models\VkStream */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vk-stream-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vk_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'from_id')->textInput() ?>

    <?= $form->field($model, 'owner_id')->textInput() ?>

    <?= $form->field($model, 'owner_type')->textInput() ?>

    <?= $form->field($model, 'dt_add')->textInput() ?>

    <?= $form->field($model, 'post_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'from_type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
