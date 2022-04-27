<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\instagram\models\InstAccountsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inst-accounts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'account_id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'profile_img') ?>

    <?= $form->field($model, 'iprofile_link') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
