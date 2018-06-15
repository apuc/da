<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use \yii\widgets\MaskedInput;
use \common\models\db\ServicePeriods;

/* @var $this yii\web\View */
/* @var $model common\models\db\ServicePeriods */
/* @var $form yii\widgets\ActiveForm */
/* @var $services common\models\db\Products[] */
?>

<div class="service-periods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map($services, 'id', 'title')) ?>

    <?= $form->field($model, 'start')->widget(MaskedInput::className(), [
        'mask' => '99:99:99',
    ])?>

    <?= $form->field($model, 'end')->widget(MaskedInput::className(), [
        'mask' => '99:99:99',
    ])?>

    <?= $form->field($model, 'week_days')->checkboxList(ServicePeriods::getWeekDaysArray()); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
