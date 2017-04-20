<?php

use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use common\models\db\Lang;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\Company */
/* @var $form yii\widgets\ActiveForm */
/* @var $companyPhotos array */
/* @var $companyPhotosStr string */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lang_id')->dropDownList(ArrayHelper::map(Lang::find()->all(), 'id', 'name')) ?>

    <span id="admin_company_category_box">
        <?php
        echo Html::dropDownList(
            'categ',
            null,
            ArrayHelper::map(CategoryCompany::find()->where(['lang_id' => 1, 'parent_id' => 0])->all(), 'id', 'title'),
            ['class' => 'form-control', 'id' => 'categ_company']
        );
        ?>

        <span id="admin_company_sub_category_box"></span>
    </span>
    <div style="margin-top: 20px;margin-bottom: 20px">
        <?= Html::textInput('cats', null, [
            'class' => 'form-control',
            'id' => 'all_cats',
        ]) ?>
    </div>

    <?php if (Yii::$app->controller->action->id === 'update'): ?>
        <?php
        $cat = CategoryCompanyRelations::find()
            ->leftJoin('category_company', '`category_company_relations`.`cat_id` = `category_company`.`id`')
            ->where(['company_id' => $model->id])
            ->with('category_company')
            ->all();
        $arr = [];
        $i = 0;

        foreach ($cat as $c) {
            $arr[$i]['id'] = (!empty($c['category_company'])) ? $c['category_company']->id : "";
            $arr[$i]['title'] = (!empty($c['category_company'])) ? $c['category_company']->title : "";
            $i++;
        }
        echo Html::hiddenInput('_cats', json_encode($arr, JSON_UNESCAPED_UNICODE), ['id' => '_cats']);
        ?>
    <?php endif ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

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
            'name' => 'Company[photo]',
            'id' => 'company-photo',
            'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $model->photo,
            'buttonName' => 'Выбрать логотип',
        ]);
        ?>
    </div>
    <br>
    <?= Html::label('Фото компании', 'input-5', ['class' => 'control-label']) ?>
    <div class="imgUpload">
        <div class="media__upload_img">
            <?php if (!$model->isNewRecord): ?>
                <?php foreach ($companyPhotos as $companyPhoto): ?>
                    <img src="<?= $companyPhoto ?>" alt="" width="100px">
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
        echo InputFile::widget([
            'language' => 'ru',
            'controller' => 'elfinder',
            // вставляем название контроллера, по умолчанию равен elfinder
            'filter' => 'image',
            // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
            'name' => 'company-photos',
            'id' => 'company-photos',
            'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImgs', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $model->isNewRecord ? '' : $companyPhotosStr,
            'buttonName' => 'Выбрать фотографии организации',
            'multiple' => true,
        ]);
        ?>
    </div>

    <? /*= $form->field($model, 'dt_add')->textInput() */ ?>

    <? /*= $form->field($model, 'dt_update')->textInput() */ ?>

    <? /*= $form->field($model, 'descr')->textarea(['rows' => 6]) */ ?>
    <?php echo $form->field($model, 'descr')->widget(CKEditor::className(), [
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full',
            'inline' => false,
            'path' => 'frontend/web/media/upload',
        ]),
    ]); ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'meta_descr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vip')->dropDownList([0 => 'Стандарт', 1 => 'VIP'], ['class' => 'form-control']) ?>

    <?= $form->field($model, 'status')->dropDownList([
        0 => 'Опубликована',
        1 => 'На модерации',
    ]) ?>

    <? /*= $form->field($model, 'slug')->textInput(['maxlength' => true]) */ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('company', 'Create') : Yii::t('company', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
