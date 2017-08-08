<?php

use common\classes\Debug;
use common\models\db\CategoryNews;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */
/* @var $form yii\widgets\ActiveForm */
/* @var $lang \common\models\db\Lang */
/* @var $cats_arr array */
?>

<div class="news-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'lang_id')->dropDownList(ArrayHelper::map($lang, 'id', 'name')) ?>

    <label for="categ">Категория</label>
    <span id="admin_news_category_box">
        <?php
        echo Html::dropDownList(
            'categ',
            $cats_arr,
            ArrayHelper::map(CategoryNews::find()->where(['lang_id' => 1])->all(), 'id', 'title'),
            ['class' => 'form-control', 'id' => 'categ', 'multiple' => 'multiple', 'required' => 'required']
        );
        ?>
    </span>

    <br>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <label class="control-label" for="company-city_id">Начните вводить теги</label>
    <?= Select2::widget([
        'name' => 'Tags',
        'data' => ArrayHelper::map($tags, 'id', 'tag'),
        'value' => $tags_selected,
        //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
        'options' => ['placeholder' => 'Начните вводить теги ...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <? /*= $form->field($model, 'content')->textarea(['rows' => 6]) */ ?>
    <?php echo $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full',
            'inline' => false,
            'path' => 'frontend/web/media/upload',
        ]),

    ]); ?>

    <? /*= $form->field($model, 'dt_add')->textInput() */ ?>

    <? /*= $form->field($model, 'dt_update')->textInput() */ ?>

    <? /*= $form->field($model, 'slug')->textInput(['maxlength' => true]) */ ?>

    <div class="dt_public_box_link"><a href="#">Отложенная публикация</a></div>
    <div class="dt_public_box">
        <?= $form->field($model, 'dt_public')->input('date', ['class' => 'form-control', 'value' => 123]) ?>
        <?= Html::input('text', 'dt_public_time', date(''),
            ['id' => 'dt_public_time', 'class' => 'form-control', 'placeholder' => 'Время']) ?>
    </div>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'meta_descr')->textInput(['maxlength' => true]) ?>

    <? /*= $form->field($model, 'photo')->textInput(['maxlength' => true]) */ ?>
    <div class="imgUpload">
        <div class="media__upload_img"><img src="<?= $model->photo; ?>" width="100px"/></div>
        <?php
        echo InputFile::widget([
            'language' => 'ru',
            'controller' => 'elfinder',
            // вставляем название контроллера, по умолчанию равен elfinder
            'filter' => 'image',
            // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
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

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'status')->dropDownList([
        '0' => 'Опубликована',
        '1' => 'На модерации',
        '3' => 'Отложена',
    ])->label('Статус') ?>

    <?= $form->field($model, 'exclude_popular')->checkbox() ?>

    <?= $form->field($model, 'rss')->checkbox() ?>

    <?= $form->field($model, 'main_slider')->checkbox(); ?>

    <?= $form->field($model, 'hot_new')->checkbox(); ?>

    <?= $form->field($model, 'show_error')->checkbox(); ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('news', 'Create') : Yii::t('news', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
