<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\consulting\models\ConsultingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consulting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'descr') ?>

    <?= $form->field($model, 'dt_add') ?>

    <?= $form->field($model, 'dt_update') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'icon') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('consulting', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('consulting', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
