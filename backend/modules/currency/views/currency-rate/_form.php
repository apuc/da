<?php

use common\models\db\CurrencyRate;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model CurrencyRate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-rate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'currency_from_id')->textInput() ?>

    <?= $form->field($model, 'currency_to_id')->textInput() ?>

    <?= $form->field($model, 'rate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            Yii::t('currency', 'Create') :
            Yii::t('currency', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
