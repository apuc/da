<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\geobase_ip\models\GeobaseIpSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geobase-ip-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ip_begin') ?>

    <?= $form->field($model, 'ip_end') ?>

    <?= $form->field($model, 'country_code') ?>

    <?= $form->field($model, 'city_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
