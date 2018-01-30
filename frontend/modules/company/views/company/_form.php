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
$this->registerCssFile('/css/board.min.css');
$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php $form = ActiveForm::begin(
    [
        'id' => 'create_company',
        'options' =>
            [
                'class' => 'content-forma',
                'enctype' => 'multipart/form-data',
            ],
        'fieldConfig' => [
            'template' => '<div class="form-line">{label}{input}<div class="memo-error"><p>{error}</p></div><div class="memo"><span class="info-icon"></span><span class="triangle-left"></span>{hint}</div></div>',
            'inputOptions' => ['class' => 'input-name jsHint'],
            'labelOptions' => ['class' => 'label-name'],
            'errorOptions' => ['class' => 'error'],

            'options' => ['class' => 'form-line'],
            'hintOptions' => ['class' => ''],

        ],
        'errorCssClass' => 'my-error',
    ]);
?>


   <!-- --><?php
/*    echo Html::dropDownList(
        'categ',
        null,
        ArrayHelper::map(CategoryCompany::find()->where(['lang_id' => 1, 'parent_id' => '0'])->all(),'id','title'),
        ['class'=>'cabinet__add-company-form--field', 'id'=>'categ_company', 'prompt' => 'Выберите категорию']
    );
    */?>
    <?= $form->field($model, 'categ')
    ->dropDownList(
        ArrayHelper::map(CategoryCompany::find()->where(['lang_id' => 1, 'parent_id' => '0'])->all(),'id','title'),
        ['id'=>'categ_company', 'prompt' => 'Категория компании']
    )->hint('Выберите категорию')->label()?>
    <div class="cabinet__add-company-form--block"></div>


    <span class="addParentCategory" style="width: 100%;"></span>

    <?= $form->field($model, 'name')
        ->textInput(['maxlength' => true])
        ->hint('Введите название компании')
        ->label('Название компании')
    ?>

    <?= $form->field($model, 'city_id')->widget(Select2::className(),
        [
            'data' => $city,
            'value' => $model->city_id,
            //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
            'options' => ['placeholder' => 'Начните вводить город ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
        ->hint('Введите город где находится компания')
        ->label('Город компании')
    ?>




    <?= $form->field($model, 'address')->textInput(['maxlength' => true])
        ->hint('Введите адрес компании без указания города')
        ->label('Адрес компании') ?>



    <?php echo $form->field($model, 'photo', [
            'template' => '<label class="cabinet__add-company-form--add-foto">
                                        <span class="button"></span>
                                        {input}
                                        <img id="blah" src="" alt="" width="160px">
                                        </label>'
        ])->label('Логотип компании')->fileInput();
    ?>

    <!--<label class="cabinet__add-company-form--add-foto">
        <span class="button"></span>
        <input id="news-photo" class="input-file" type="file">
        <img id="blah" src="" alt="" width="160px">
    </label>-->

    <!--<div class="cabinet__add-company-form--block"></div>-->

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

        <label class="label-name">Телефон</label>

        <input class="cabinet__add-company-form--field" name="mytext[]" type="text">

    </div>

    <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>


   <?php
        echo $form->field($model, 'descr')->textarea(
            [
                'class' => 'cabinet__add-company-form--text',
                'maxlength' => 100
            ]
        )
            ->hint('Введите иныормацию о компании')->label('О компании');
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