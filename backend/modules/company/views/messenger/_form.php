<?php

use mihaildev\elfinder\InputFile;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\db\Messenger */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="messenger-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= InputFile::widget([
        'language' => 'ru',
        'controller' => 'elfinder',
        // вставляем название контроллера, по умолчанию равен elfinder
        'filter' => 'image',
        // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
        'name' => 'Messenger[icon]',
        'id' => 'messenger-icon',
        'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
        'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
        'buttonOptions' => ['class' => 'btn btn-primary'],
        'value' => $model->icon,
        'buttonName' => 'Выбрать изображение',
    ]);
    ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <br/>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('messenger', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
