<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\poster\models\PosterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="poster-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'dt_add') ?>

    <?= $form->field($model, 'dt_update') ?>

    <?php // echo $form->field($model, 'descr') ?>

    <?php // echo $form->field($model, 'short_descr') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'start') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'meta_title') ?>

    <?php // echo $form->field($model, 'meta_descr') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('poster', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('poster', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
