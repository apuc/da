<?php

use common\models\db\Company;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;

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
    <div class="imgUpload">
        <div class="media__upload_img"><img src="<?= $model->icon; ?>" width="100px"/></div>
        <?php
        echo InputFile::widget([
            'language' => 'ru',
            'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
            'filter' => 'image', // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
            'name' => 'Consulting[icon]',
            'id' => 'consulting-icon',
            'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $model->icon,
            'buttonName' => 'Выбрать изображение',
        ]);
        ?>
    </div>

<!--    --><?//= $form->field( $model, 'views' )->textInput() ?>

    <?= $form->field( $model, 'company_id' )->dropDownList( ArrayHelper::map( Company::find()->all(),'id','name'),['prompt'=>'Нет']) ?>

    <div class="form-group">
        <?= Html::submitButton( $model->isNewRecord ? Yii::t( 'consulting', 'Create' ) : Yii::t( 'consulting', 'Update' ), [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
