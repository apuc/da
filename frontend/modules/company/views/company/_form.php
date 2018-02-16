<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\company\models\Company */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('/css/board.min.css');
//$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
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


<?= $form->field($model, 'categ')->widget(Select2::className(),
    [
        'data' => $categoryCompanyAll,
        'options' => [
            'multiple' => true,
            'placeholder' => 'Select a state ...',
            'class' => 'form-control',
            'size' => '1'
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'showToggleAll' => false,
            'tags' => true,
            'maximumSelectionLength' => 1

        ],
    ]);
?>


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


<?= $form->field($model, 'photo', [
    'template' => '<label class="cabinet__add-company-form--add-foto">
                                        <span class="button"></span>
                                        {input}
                                        <img id="blah" src="" alt="" width="160px">
                                        </label>'
])->label('Логотип компании')->fileInput();
?>

    <div class="cabinet__add-company-form--block"></div>

    <div class="cabinet__add-company-form--wrapper">

        <label class="label-name">Телефон</label>

        <input class="cabinet__add-company-form--field" name="mytext[]" type="text">

    </div>

    <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>


<?= $form->field($model, 'descr')
    ->textarea([
        'class' => 'cabinet__add-company-form--text',
        'maxlength' => 100
    ])
    ->hint('Введите информацию о компании')
    ->label('О компании');
?>


<?= Html::submitButton('Сохранить', ['class' => 'cabinet__add-company-form--submit']) ?>
<?php ActiveForm::end(); ?>