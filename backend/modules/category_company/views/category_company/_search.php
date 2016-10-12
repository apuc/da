<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\category_company\models\CategoryCompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'descr') ?>

    <?= $form->field($model, 'dt_add') ?>

    <?php // echo $form->field($model, 'dt_update') ?>

    <?php // echo $form->field($model, 'icon') ?>

    <?php // echo $form->field($model, 'meta_title') ?>

    <?php // echo $form->field($model, 'meta_descr') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'lang_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('company', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('company', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
