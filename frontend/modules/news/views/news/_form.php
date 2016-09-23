<?php

use common\models\db\CategoryNews;
use common\models\db\Lang;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\news\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form" style="padding: 20px">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'lang_id')->dropDownList(ArrayHelper::map(Lang::find()->all(), 'id', 'name')) ?>

    <label for="categ">Категория</label>
    <span id="admin_news_category_box">
        <?php
        echo Html::dropDownList(
            'categ',
            null,
            ArrayHelper::map(CategoryNews::find()->where(['lang_id'=>1])->all(),'id','title'),
            ['class'=>'form-control', 'id'=>'categ']
        );
        ?>
    </span>
    <br>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <? /*= $form->field($model, 'content')->textarea(['rows' => 6]) */ ?>
    <?php echo $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full',
            'inline' => false,
            'path' => 'frontend/web/media/upload/users/' . Yii::$app->user->getId(),
        ]),
    ]); ?>

    <? /*= $form->field($model, 'dt_add')->textInput() */ ?>

    <? /*= $form->field($model, 'dt_update')->textInput() */ ?>

    <? /*= $form->field($model, 'slug')->textInput(['maxlength' => true]) */ ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <?/*= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) */?>
    <?/*= $form->field($model, 'meta_descr')->textInput(['maxlength' => true]) */?>

    <? /*= $form->field($model, 'photo')->textInput(['maxlength' => true]) */ ?>
    <div class="imgUpload">
        <div class="media__upload_img"><img src="<?= $model->photo; ?>" width="100px"/></div>
        <?php
        echo InputFile::widget([
            'language' => 'ru',
            'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
            'filter' => 'image', // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
            'name' => 'News[photo]',
            'id' => 'news-photo',
            'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $model->photo,
            'buttonName' => 'Выбрать изображение',
        ]);
        ?>
    </div>

    <? /*= $form->field($model, 'status')->textInput() */ ?>

    <? /*= $form->field($model, 'user_id')->textInput() */ ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('news', 'Create') : Yii::t('news', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
