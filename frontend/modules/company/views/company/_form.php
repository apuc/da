<?php

use common\models\db\Messenger;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model frontend\modules\company\models\Company
 * @var $form yii\widgets\ActiveForm
 * @var array $categoryCompanyAll
 * @var array $city
 */
$this->registerCssFile('/css/board.min.css');
//$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/company.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
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

    <?= $form->field($model, 'start_page')->label('Главная страница')->dropDownList($model->start_page_items); ?>
    <div class="cabinet__add-company-form--block"></div>

    <div class="cabinet__add-company-form--wrapper" data-iterator="0" style="flex-wrap: wrap; margin-bottom: 40px;">
        <div class="input__wrap" style="position: relative; width: 100%;">
            <?= Html::label('Телефон', 'Phones', ['class' => 'label-name']) ?>
            <?= Html::textInput('Phones[0][phone]', '', ['class' => 'input-name', 'id' => 'Phones']) ?>
            <button type="button" class="cabinet__add-field company__add-phone"
                    style="position: absolute; top: 11px; right: 5px; border: none;" data-iterator="0"
                    max-count="<?= (isset($services['count_phone']) ? $services['count_phone'] : ''); ?>"></button>
        </div>

        <div class="messengers-choice" style="display: flex; flex-wrap: wrap; width: 70%; margin-left: auto;">
            <p style="width: 100%; margin-bottom: -1px">Выберите мессенджеры, если у вас привязан к ним телефон</p>
            <?= Html::checkboxList('Phones[messengeres]', '', ArrayHelper::map(Messenger::find()->all(), "id", "name"),
                [
                    'item' =>
                        function ($index, $label, $name, $checked, $value) {
                            return Html::checkbox("messengeresArray[0][]", $checked, [
                                'value' => $value,
                                'label' => $label
                            ]);
                        },
                    'class' => 'checkbox-wrap',
                    'style' => 'display: flex; justify-content: space-around; width: 100%; margin-top: 5px;'
                ]);
            ?>
        </div>
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


<?= $form->field($model, 'delivery')
    ->textarea([
        'class' => 'cabinet__add-company-form--text jsHint',
    ])
    ->hint('Введите информацию о доставки Вашей компании. Если компания не осуществляет доставку,
        оставьте поле пустым.')
    ->label('Доставка');
?>


<?= $form->field($model, 'payment')
    ->textarea([
        'class' => 'cabinet__add-company-form--text jsHint',
    ])
    ->hint('Введите информацию о возможных способах оплаты в вашей компании')
    ->label('Оплаты');
?>


<?= Html::submitButton('Сохранить', ['class' => 'cabinet__add-company-form--submit']) ?>
<?php ActiveForm::end(); ?>