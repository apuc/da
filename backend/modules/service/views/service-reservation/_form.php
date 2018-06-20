<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\widgets\MaskedInput;
use \common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\db\ServiceReservation */
/* @var $form yii\widgets\ActiveForm */
/* @var $services common\models\db\Products[] */

?>

<div class="service-reservation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList(\yii\helpers\ArrayHelper::map(
            $services, 'id', 'title'
    ))?>

    <?= $form->field($model, 'start')->widget(MaskedInput::className(), [
        'mask' => '99:99:99',
    ])?>

    <?= $form->field($model, 'end')->widget(MaskedInput::className(), [
        'mask' => '99:99:99',
    ])?>

    <?= $form->field($model, 'date')->widget(MaskedInput::className(), [
        'mask' => '9999-99-99',
    ])?>

    <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(User::find()->all(), 'id', 'username'))?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
