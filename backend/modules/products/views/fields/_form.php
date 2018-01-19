<?php

use backend\modules\products\models\CategoryProduct;
use common\models\db\ProductFieldsType;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\ProductFields */
/* @var $form yii\widgets\ActiveForm */

$model->category = \yii\helpers\ArrayHelper::getColumn($model['fieldsCategory'], 'category_id');
?>

<div class="product-fields-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')
        ->dropDownList(
            \yii\helpers\ArrayHelper::map(
                ProductFieldsType::find()->all(), 'id', 'type'),
            ['prompt' => 'Выберите тип поля']
            )

    ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'template')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interval')->checkbox() ?>

    <?= $form->field($model, 'category')->widget(\kartik\select2\Select2::className(),
        [
            'data' => \yii\helpers\ArrayHelper::map(CategoryProduct::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Начните вводить ...', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
