<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\metal\models\MetalRates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="metal-rates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'metal_id')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            Yii::t('metal', 'Create') :
            Yii::t('metal', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
