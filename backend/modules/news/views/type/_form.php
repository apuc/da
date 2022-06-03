<?php

use backend\modules\news\models\NewsType;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var NewsType $model*/

?>
<div style="width: 30%">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'label')->textInput(); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
