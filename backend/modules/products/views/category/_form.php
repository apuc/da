<?php

use kartik\select2\Select2;
use mihaildev\elfinder\InputFile;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\CategoryProduct */
/* @var $form yii\widgets\ActiveForm */
/* @var $category \backend\modules\products\models\CategoryProduct */
?>

<div class="category-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->widget(Select2::className(),
        [
            'data' => \yii\helpers\ArrayHelper::map($category, 'id', 'name'),
            'options' => ['placeholder' => 'Начните вводить...', 'class' => 'form-control'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]
    ); ?>

    <?= Html::label('Изображение', 'category-icon'); ?>
    <div class="imgUpload">
        <div class="media__upload_img"><img src="<?= $model->icon; ?>" width="100px"/></div>
        <?php
        echo InputFile::widget([
            'language' => 'ru',
            'controller' => 'elfinder',
            // вставляем название контроллера, по умолчанию равен elfinder
            'filter' => 'image',
            // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
            'name' => 'CategoryProduct[icon]',
            'id' => 'categoryproduct-icon',
            'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $model->icon,
            'buttonName' => 'Выбрать изображение',
        ]);
        ?>
    </div>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <?php if (isset($fields)): ?>
        <h4><strong>Дополнительные поля:</strong></h4>
        <?php foreach ($fields as $field): ?>
            <p><a href="/secure/products/fields/update?id=<?= $field->id ?>"><?= $field->label ?></a></p>
        <?php endforeach ?>
    <?php endif ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
