<?php

use common\models\db\Company;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\modules\consulting\models\Consulting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consulting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field( $model, 'title' )->textInput( [ 'maxlength' => true ] ) ?>

    <!--    --><? //= $form->field($model, 'descr')->textarea(['rows' => 6]) ?>
    <?= $form->field( $model, 'descr' )->widget( CKEditor::className(), [
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions( 'elfinder', [
            'preset' => 'full',
            'inline' => false,
            'path'   => 'frontend/web/media/upload',
        ] )
    ] ) ?>

<!--    --><?//= $form->field( $model, 'dt_add' )->textInput() ?>

<!--    --><?//= $form->field( $model, 'dt_update' )->textInput() ?>

<!--    --><?//= $form->field( $model, 'slug' )->textInput( [ 'maxlength' => true ] ) ?>

<!--    --><?//= $form->field( $model, 'icon' )->textInput( [ 'maxlength' => true ] ) ?>

<!--    --><?//= $form->field( $model, 'views' )->textInput() ?>

    <?= $form->field( $model, 'company_id' )->dropDownList( ArrayHelper::map( Company::find()->all(),'id','name'),['prompt'=>'Нет']) ?>

    <div class="form-group">
        <?= Html::submitButton( $model->isNewRecord ? Yii::t( 'consulting', 'Create' ) : Yii::t( 'consulting', 'Update' ), [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
