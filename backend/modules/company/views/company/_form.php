<?php

use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use common\models\db\Lang;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\Company */
/* @var $form yii\widgets\ActiveForm */
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
            'id' => 'all_cats'
        ]) ?>
    </div>

    <?php if (Yii::$app->controller->action->id == 'update'): ?>
        <?php
        $cat = CategoryCompanyRelations::find()
            ->leftJoin('category_company', '`category_company_relations`.`cat_id` = `category_company`.`id`')
            ->where(['company_id' => $model->id])
            ->with('category_company')
            ->all();
        $arr = [];
        $i=0;
        foreach($cat as $c){
            $arr[$i]['id'] = $c['category_company']->id;
            $arr[$i]['title'] = $c['category_company']->title;
            $i++;
        }
        echo Html::hiddenInput('_cats',json_encode($arr, JSON_UNESCAPED_UNICODE),['id'=>'_cats']);
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
            'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
            'filter' => 'image', // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
            'name' => 'Company[photo]',
            'id' => 'company-photo',
            'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $model->photo,
            'buttonName' => 'Выбрать изображение',
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

    <? /*= $form->field($model, 'status')->textInput() */ ?>

    <? /*= $form->field($model, 'slug')->textInput(['maxlength' => true]) */ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('company', 'Create') : Yii::t('company', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
