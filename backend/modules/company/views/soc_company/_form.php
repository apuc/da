<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\company\models\Company;
use backend\modules\company\models\SocAvailable;
/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\SocCompany */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soc-company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'company_id')->textInput() ?>

    <?php echo \kartik\select2\Select2::widget([
        'name' => 'SocCompany[company_id]',
        'data' => ArrayHelper::map(Company::find()->all(),'id','name'),
        'value'=>$model->company_id,
        'options' => ['prompt' => 'Выбрать'],
    ]);?>
    <?php //echo $form->field($model, 'company_id')->dropDownList(ArrayHelper::map(Company::find()->all(),'id','name')) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'soc_type')->textInput() ?>

    <?php echo $form->field($model, 'soc_type')->dropDownList(ArrayHelper::map(SocAvailable::find()->all(),'id','name'))?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
