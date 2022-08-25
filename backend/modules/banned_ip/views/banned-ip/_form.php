<?php

use backend\modules\banned_ip\BannedIp;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model BannedIp
 */
?>

<div style="width: 30%">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ip_mask')->textInput(); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
