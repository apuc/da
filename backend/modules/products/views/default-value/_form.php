<?php

use backend\modules\products\models\ProductFields;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\DefaultFieldsValue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="default-fields-value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_field_id')->widget(\kartik\select2\Select2::class,
        [
            'data' => \yii\helpers\ArrayHelper::map(ProductFields::find()->where(['type_id' => [4, 7]])->all(), 'id', 'label'),
            'options' => ['placeholder' => 'Начните вводить ...', 'multiple' => false],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
