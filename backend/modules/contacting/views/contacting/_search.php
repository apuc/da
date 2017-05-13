<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\contacting\models\ContactingSeacrh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'dt_add') ?>

    <?php // echo $form->field($model, 'dt_update') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('contacting', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('contacting', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
