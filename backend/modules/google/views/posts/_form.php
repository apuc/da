<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\db\GooglePlusPosts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="google-plus-posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'updated')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'published')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
