<?php

use common\models\db\CategoryCompany;
use common\models\db\Lang;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\company\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(
    [
        'options' => [
            'class' => 'cabinet__add-company-form',
            'enctype' => 'multipart/form-data',
        ],
    ]);
?>
    <p class="cabinet__add-company-form--title">Категория компании</p>
    <?php
    echo Html::dropDownList(
        'categ',
        null,
        ArrayHelper::map(CategoryCompany::find()->where(['lang_id' => 1, 'parent_id' => '0'])->all(),'id','title'),
        ['class'=>'cabinet__add-company-form--field', 'id'=>'categ_company', 'prompt' => 'Выберите категорию']
    );
    ?>
    <div class="cabinet__add-company-form--block"></div>


    <span class="addParentCategory" style="width: 100%;"></span>


    <p class="cabinet__add-company-form--title">Название компании</p>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false) ?>
    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Город компании</p>
    <div class="cabinet__add-company-form--select-wrapper">
        <?= Select2::widget([
            'name' => 'Company[city_id]',
            'attribute' => 'state_2',
            'data' => $city,
            'value' => $model->city_id,
            //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
            'options' => ['placeholder' => 'Начните вводить город ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>

    <div class="cabinet__add-company-form--wrapper">
        <p class="cabinet__add-company-form--title">Адрес компании</p>
        <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false) ?>

       <!-- <a href="#" class="cabinet__add-field"></a>-->

    </div>
    <p class="cabinet__add-company-form--title">Логотип компании</p>

    <?php echo $form->field($model, 'photo', [
            'template' => '<label class="cabinet__add-company-form--add-foto">
                                        <span class="button"></span>
                                        {input}
                                        <img id="blah" src="" alt="" width="160px">
                                        </label>'
        ])->label(false)->fileInput();
    ?>

    <!--<label class="cabinet__add-company-form--add-foto">
        <span class="button"></span>
        <input id="news-photo" class="input-file" type="file">
        <img id="blah" src="" alt="" width="160px">
    </label>-->

    <div class="cabinet__add-company-form--block"></div>

    <!--<p class="cabinet__add-company-form--title">Сайт компании</p>

    <input class="cabinet__add-company-form--field" type="text">

    <div class="cabinet__add-company-form--block"></div>-->

   <!-- <p class="cabinet__add-company-form--title">Соц. сети</p>

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
    </div>-->

    <div class="cabinet__add-company-form--block"></div>

    <div class="cabinet__add-company-form--wrapper">

        <p class="cabinet__add-company-form--title">Телефон</p>

        <input class="cabinet__add-company-form--field" name="mytext[]" type="text">

    </div>

    <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>

    <p class="cabinet__add-company-form--title">О компании</p>
   <?php
        echo $form->field($model, 'descr')->textarea(
            [
                'class' => 'cabinet__add-company-form--text',
                'maxlength' => 100
            ]
        )->label(false);
    ?>

<?php /*echo $form->field($model, 'descr')->widget(CKEditor::className(), [
//        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
//            'preset' => 'full',
//            'inline' => false,
//            'path' => 'frontend/web/media/upload',
//        ]),
])->label(false); */?>


<?= Html::submitButton('Сохранить', ['class' => 'cabinet__add-company-form--submit']) ?>
<?php ActiveForm::end(); ?>