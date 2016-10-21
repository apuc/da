<?php

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\modules\faq\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>
    <?php echo $form->field($model, 'answer')->widget(CKEditor::className(), [
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full',
            'inline' => false,
            'path' => 'frontend/web/media/upload',
        ]),
    ]); ?>
<!--    --><?//= $form->field($model, 'dt_add')->textInput() ?>

<!--    --><?//= $form->field($model, 'dt_update')->textInput() ?>

<!--    --><?//= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'views')->textInput() ?>

<!--    --><?//= $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'user_id')->dropDownList( ArrayHelper::map( User::find()->all(),'id','username'),[ 'prompt' =>'Нет']) ?>

<!--    --><?//= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_id')->dropDownList(ArrayHelper::map(\common\models\db\Company::find()->all(),'id','name'),['prompt'=>'Нет']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('faq', 'Create') : Yii::t('faq', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
