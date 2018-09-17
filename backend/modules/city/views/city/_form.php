<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\city\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region_id')->widget(\kartik\select2\Select2::className(),
        [
            'data' => \yii\helpers\ArrayHelper::map(\common\models\db\GeobaseRegion::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выберите'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([1 => 'Опубликовнно', 0 => 'Не опубликовано']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
