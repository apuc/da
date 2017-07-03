<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\tariff\models\Tariff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tariff-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descr')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'published')->textInput() ?>

    <?= Html::label('Услуги доступные в тарифе')?>
    <?= Html::dropDownList(
        'services_id',
        $select_arr,
        \yii\helpers\ArrayHelper::map($services, 'id', 'name'),
        ['class' => 'form-control', 'multiple' => 'multiple', 'size' => 20]
    );
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
