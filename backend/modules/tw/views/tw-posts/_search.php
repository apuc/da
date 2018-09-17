<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\tw\models\TwPostsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tw-posts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'meta_descr') ?>

    <?= $form->field($model, 'tw_id') ?>

    <?= $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'media_url') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'page_id') ?>

    <?php // echo $form->field($model, 'page_title') ?>

    <?php // echo $form->field($model, 'page_icon') ?>

    <?php // echo $form->field($model, 'dt_add') ?>

    <?php // echo $form->field($model, 'dt_public') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
