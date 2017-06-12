<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\InputFile;

/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\SocAvailable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soc-available-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>
    <?php
    echo InputFile::widget([
        'language' => 'ru',
        'controller' => 'elfinder',
        // вставляем название контроллера, по умолчанию равен elfinder
        'filter' => 'image',
        // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
        'name' => 'SocAvailable[icon]',
        'id' => 'news-photo',
        'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
        'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
        'buttonOptions' => ['class' => 'btn btn-primary'],
        'value' => $model->icon,
        'buttonName' => 'Выбрать изображение',
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
