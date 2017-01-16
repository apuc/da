<?php

use common\models\db\CategoryPoster;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\poster\models\Poster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="poster-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= Html::dropDownList('cat',null, ArrayHelper::map(CategoryPoster::find()->all(), 'id', 'title'),[
        'class'=>'form-control',
        'id'=>'categ',
        'multiple'=>'multiple'
    ]) ?>

    <?/*= $form->field($model, 'slug')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'dt_add')->textInput() */?>

    <?/*= $form->field($model, 'dt_update')->textInput() */?>

    <?/*= $form->field($model, 'descr')->textarea(['rows' => 6]) */?>
    <?php echo $form->field($model, 'descr')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full',
            'inline' => false,
            'path' => 'frontend/web/media/upload',
        ]),
    ]); ?>

    <?= $form->field($model, 'short_descr')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start')->textInput(['maxlength' => true]) ?>

    <div class="imgUpload">
        <div class="media__upload_img"><img src="<?= $model->photo; ?>" width="100px"/></div>
        <?php
        echo InputFile::widget([
            'language' => 'ru',
            'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
            'filter' => 'image', // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
            'name' => 'Poster[photo]',
            'id' => 'poster-photo',
            'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $model->photo,
            'buttonName' => 'Выбрать изображение',
        ]);
        ?>
    </div>

    <?/*= $form->field($model, 'views')->textInput() */?>

    <?/*= $form->field($model, 'status')->textInput() */?>

<?php if (!empty($model->dt_event)): ?>
    <?= $form->field($model, 'dt_event')->input('date', ['class'=>'form-control', 'value'=>date('Y-m-d',$model->dt_event)])?>
<?php else: ?>
    <?= $form->field($model, 'dt_event')->input('date', ['class'=>'form-control', 'value'=>date('Y-m-d',time())])?>
<?php endif; ?>

<?php if (!empty($model->dt_event_end)): ?>
    <?= $form->field($model, 'dt_event_end')->input('date', ['class'=>'form-control', 'value'=>date('Y-m-d',$model->dt_event_end)])->label('Дата окончания события')?>
    <?php else: ?>
    <?= $form->field($model, 'dt_event_end')->input('date', ['class'=>'form-control', 'value'=>date('Y-m-d',time())])->label('Дата окончания события')?>
<?php endif; ?>
    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_descr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rss')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('poster', 'Create') : Yii::t('poster', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
