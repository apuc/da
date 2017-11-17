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

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descr')->widget(CKEditor::className(), [
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full',
            'inline' => false,
            'path' => 'frontend/web/media/upload',
        ]),
    ]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true])->label('Класс Font Awesome') ?>

    <?= $form->field($model,
        'title_digest')->textInput(['maxlength' => true])->label('Наименование раздела: Документы') ?>

    <?= $form->field($model, 'company_id')->dropDownList(ArrayHelper::map(Company::find()->all(), 'id', 'name'),
        ['prompt' => 'Нет']) ?>


    <?= Html::label('Разделы консалтинга:');
    if (Yii::$app->controller->action->id == 'create') {
        $checked = ['checked ' => true];
    } else {
        $checked = [];
    }
    ?>
    <hr>

    <?= $form->field($model, 'about_company')->checkbox($checked, false)->label('О компании'); ?>
    <?= $form->field($model, 'documents')->checkbox($checked, false)->label('Документы'); ?>
    <?= $form->field($model, 'posts')->checkbox($checked, false)->label('Статьи'); ?>
    <?= $form->field($model, 'faq')->checkbox($checked, false)->label('Вопрос / ответ'); ?>
    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'meta_descr')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'main_slider')->checkbox(); ?>
    <?= $form->field($model, 'sidebar')->checkbox(); ?>
    <div class="imgUpload">
        <div class="media__upload_img"><img src="<?= $model->photo; ?>" width="100px"/></div>
        <?php
        echo InputFile::widget([
            'language' => 'ru',
            'controller' => 'elfinder',
            // вставляем название контроллера, по умолчанию равен elfinder
            'filter' => 'image',
            // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
            'name' => 'Consulting[photo]',
            'id' => 'news-photo',
            'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $model->photo,
            'buttonName' => 'Выбрать изображение',
        ]);
        ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('consulting', 'Create') : Yii::t('consulting', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
