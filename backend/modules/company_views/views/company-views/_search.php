<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\company_views\models\CompanyViewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-views-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'ip_address') ?>

    <?php // echo $form->field($model, 'count') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('company_views', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('company_views', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
