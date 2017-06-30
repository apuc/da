<?php

use common\models\db\CategoryCompany;
use common\models\db\Lang;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\company\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form" style="padding: 20px">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lang_id')->dropDownList(ArrayHelper::map(Lang::find()->all(), 'id', 'name')) ?>

    <span id="admin_company_category_box">
        <?php
        echo Html::dropDownList(
            'categ',
            null,
            ArrayHelper::map(CategoryCompany::find()->where(['lang_id'=>1])->all(),'id','title'),
            ['class'=>'form-control', 'id'=>'categ_company']
        );
        ?>
    </span>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?/*= $form->field($model, 'photo')->textInput(['maxlength' => true]) */?>
    <div class="imgUpload">
<!--        <div class="media__upload_img"><img src="--><?//= $model->photo; ?><!--" width="100px"/></div>-->
<!--        --><?php
//        echo InputFile::widget([
//            'language' => 'ru',
//            'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
//            'filter' => 'image', // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
//            'name' => 'Company[photo]',
//            'id' => 'company-photo',
//            'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
//            'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
//            'buttonOptions' => ['class' => 'choose-img btn btn-primary'],
//            'value' => $model->photo,
//            'buttonName' => 'Выбрать изображение',
//        ]);
//        ?>
        <?php

        echo $form->field( $model, 'photo', [
            'template' => '{label}<div class="selectAvatar">
                    <span>Нажмите для выбора</span>
                    <img style="margin-top: 21px;" class="blah" src="/theme/portal-donbassa/img/picture.svg" alt="" width="160px"> {input}</div>',

        ] )->label( 'Загрузить аватар с компютера' )->fileInput(['class'=>'profile-avatar','id'=>'profile-avatar']);

        ?>
    </div>

    <?/*= $form->field($model, 'dt_add')->textInput() */?>

    <?/*= $form->field($model, 'dt_update')->textInput() */?>

    <?/*= $form->field($model, 'descr')->textarea(['rows' => 6]) */?>
    <?php echo $form->field($model, 'descr')->widget(CKEditor::className(), [
//        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
//            'preset' => 'full',
//            'inline' => false,
//            'path' => 'frontend/web/media/upload',
//        ]),
    ]); ?>

    <?/*= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) */?><!--
    --><?/*= $form->field($model, 'meta_descr')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'status')->textInput() */?>

    <?/*= $form->field($model, 'slug')->textInput(['maxlength' => true]) */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('company', 'Create') : Yii::t('company', 'Update'), ['class' => $model->isNewRecord ? 'company-add btn btn-success' : 'company-add btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<form class="cabinet__add-company-form">

    <p class="cabinet__add-company-form--title">Категория компании</p>

    <select class="cabinet__add-company-form--field" name="" id="form-select">
        <option value="1"></option>
        <option value="2"></option>
        <option value="3"></option>
        <option value="4"></option>
        <option value="5"></option>
    </select>

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Название компании</p>

    <input class="cabinet__add-company-form--field" type="text">

    <div class="cabinet__add-company-form--block"></div>

    <div class="cabinet__add-company-form--wrapper">

        <p class="cabinet__add-company-form--title">Адрес компании</p>

        <input class="cabinet__add-company-form--field" type="text">

        <a href="#" class="cabinet__add-field"></a>

    </div>

    <div class="cabinet__add-company-form--hover-wrapper" data-count="1">

    </div>

    <p class="cabinet__add-company-form--title">Логотип компании</p>

    <label class="cabinet__add-company-form--add-foto">
        <span class="button"></span>
        <input id="news-photo" class="input-file" type="file">
        <img id="blah" src="" alt="" width="160px">
    </label>

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Сайт компании</p>

    <input class="cabinet__add-company-form--field" type="text">

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Соц. сети</p>

    <div class="cabinet__add-company-form--social">
        <a href="" class="social-wrap__item vk">
            <img src="img/soc/vk.png" alt="">
        </a>
        <a href="" class="social-wrap__item fb">
            <img src="img/soc/fb.png" alt="">
        </a>
        <a href="" class="social-wrap__item ok">
            <img src="img/soc/ok-icon.png" alt="">
        </a>
        <a href="" class="social-wrap__item vk">
            <img src="img/soc/vk.png" alt="">
        </a>
        <a href="" class="social-wrap__item fb">
            <img src="img/soc/fb.png" alt="">
        </a>
        <a href="" class="social-wrap__item ok">
            <img src="img/soc/ok-icon.png" alt="">
        </a>
    </div>

    <div class="cabinet__add-company-form--block"></div>

    <div class="cabinet__add-company-form--wrapper">

        <p class="cabinet__add-company-form--title">Телефон</p>

        <input class="cabinet__add-company-form--field" type="text">

        <a href="#" class="cabinet__add-field"></a>

    </div>

    <div class="cabinet__add-company-form--hover-wrapper" data-count="1">


    </div>

    <p class="cabinet__add-company-form--title">О компании</p>

    <textarea class="cabinet__add-company-form--text"></textarea>

    <input type="submit" class="cabinet__add-company-form--submit" value="сохранить">

</form>