<?php

use common\models\db\Messenger;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\widgets\MaskedInput;

/**
 * @var $this yii\web\View
 * @var $model frontend\modules\company\models\Company
 * @var $form yii\widgets\ActiveForm
 * @var array $categoryCompanyAll
 * @var array $city
 */

echo '<script>var photoCount = 0;</script>';
$this->registerCssFile('/css/board.min.css');
$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/Uploader.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/raw/img_upload.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/company.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php $form = ActiveForm::begin(
    [
        'id' => 'create_company',
        'options' =>
            [
                'class' => 'content-forma cabinet__add-company-form-product cabinet__add-company-form',
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
            'placeholder' => 'Выбери категорию',
            'class' => ['form-control','jsHint'],
            'size' => '1'
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'showToggleAll' => false,
            'tags' => true,
            'maximumSelectionLength' => 1

        ],
        'pluginEvents' => [
            "select2:open" => "function() { $('.memo:first').show(); }",
            "select2:close" => "function() { $('.memo:first').hide(); }",
        ],

    ])->hint('Категория, которая указывает на сферу деятельности компании.');
?>



<?= $form->field($model, 'name')
    ->textInput(['maxlength' => true])
    ->hint('Полное название компании, которое после регистрации отобразится в визитке предприятия.')
    ->label('Название')
?>

<?= $form->field($model, 'city_id')->widget(Select2::className(),
    [
        'data' => $city,
        'value' => $model->city_id,
        //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
        'options' => ['placeholder' => 'Начните вводить город ...','class'=>'jsHint'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'pluginEvents' => [
            "select2:open" => "function() { $('.memo:eq(2)').show(); }",
            "select2:close" => "function() { $('.memo:eq(2)').hide(); }",
        ],
    ])
    ->hint('Город, в котором находится центральный офис компании.')
    ->label('Город')
?>


<?= $form->field($model, 'address')->textInput(['maxlength' => true])
    ->hint('Адрес центрального офиса компании без упоминания города.')
    ->label('Адрес') ?>



<?= ""//$form->field($model, 'photo', [
//    'template' => '<label class="cabinet__add-company-form--add-foto">
//                                        <span class="button"></span>
//                                        {input}
//                                        <img id="blah" src="" alt="" width="160px">
//                                        </label>'
//])->hint('Разрешение изображения – не менее 800х600 пикселей. Размер – не более двух мегабайт. Формат – jpg
//        или png. Стандартное соотношение сторон 3х4. Иллюстрации с нешаблонными пропорциями
//        автоматически обрезаются.')->label('Логотип компании')->fileInput();
?>



<?php

echo $form->field($model, 'photo')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*','class'=>'jsHint'],
])->hint('Разрешение изображения – не менее 800х600 пикселей. Размер – не более двух мегабайт. Формат – jpg
        или png. Стандартное соотношение сторон 3х4. Иллюстрации с нешаблонными пропорциями
        автоматически обрезаются.')->label("Добавить изображение");

//$form->field($model, 'photo')->hiddenInput(['value' => $model->photo])->label(false);

?>

<?php //echo '<label class="control-label">Добавить фото</label>';
//echo FileInput::widget([
//    'name' => 'Poster',
//    'options' => ['multiple' => false,'placeholder'=>'Выбрать файл'],
//    'pluginOptions' => [
//        'previewFileType' => 'image',
//        'maxFileCount' => 10,
//        'maxFileSize' => 2000,
//        'language' => "ru",
//    ],
//]); ?>

    <p class="file-hint">
        Как правильно подобрать изображение?
        <a href="http://da-info.pro/page/kak-pravilno-podobrat-izobrazenie-dla-stati-na-sajte-da-info-pro">Перейти к четению.</a>

    </p>





    <?= $form->field($model, 'start_page')->label('Главная страница')
    ->dropDownList($model->start_page_items)->hint('Раздел профиля компании, который будет стартовым после перехода пользователем на визитку
предприятия.');
    ?>


    <div class="cabinet__add-company-form--block"></div>

    <div class="cabinet__add-company-form--wrapper" data-iterator="0" style="flex-wrap: wrap; margin-bottom: 40px;">

        <div class="input__wrap" style="position: relative; width: 100%;">

            <?= Html::label('Телефон', 'phone', ['class' => 'label-name']) ?>

            <?=  MaskedInput::widget([
                'name' => 'Phones[0][phone]',
                'mask' => '999-999-9999',
                'options'=>[
                    'class' => 'input-name jsHint',
                    'id' => 'phone',
                ],
                'clientOptions' => [
                    'clearIncomplete' => true
                ]
            ]);



            //Html::textInput('Phones[0][phone]', '', ['class' => 'input-name jsHint', 'id' => 'Phones'])

            ?>

            <button type="button" class="cabinet__add-field company__add-phone"
                    style="position: absolute; top: 11px; right: 5px; border: none;" data-iterator="0"
                    max-count="<?= (isset($services['count_phone']) ? $services['count_phone'] : ''); ?>">
            </button>

            <div class="memo" style="display: none">
                <span class="info-icon" style="background-image: url(/theme/portal-donbassa/img/icons/info.png)"></span>
                <span class="triangle-left"></span>
                <div class="">Номер телефона лица, которое отвечает за работу с клиентами.</div>
            </div>

        </div>

        <div class="messengers-choice" style="display: flex; flex-wrap: wrap; width: 70%; margin-left: auto;">
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
                    'style' => 'display: flex; justify-content: space-around; width: 100%;'
                ]);
            ?>
        </div>

    </div>

    <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>

 <p class="sym-count"></p>
<?= $form->field($model, 'descr')
    ->textarea([
        'class' => 'cabinet__add-company-form--text jsHint',
        'maxlength' => 800,
        'id'=>'cabinet__add-company-form-about_field'
    ])
    ->hint('Информация о специализации предприятия. Объем текста для неверифицированных пользователей – не
более 800 символов.')
    ->label('О компании');
?>

<br/>
<?= $form->field($model, 'delivery')
    ->textarea([
        'class' => 'cabinet__add-company-form--text jsHint',
    ])
    ->hint('Варианты доставки, которые предлагает компания. Если транспортировка товаров не осуществляется,
тогда необходимо оставить поле пустым.')
    ->label('Доставка');
?>
    <br/>
<?= $form->field($model, 'payment')
    ->textarea([
        'class' => 'cabinet__add-company-form--text jsHint',
    ])
    ->hint('Способы оплаты, которые доступны клиентам компании.')
    ->label('Способы оплаты');
?>
<?= $form->field($model, 'slider')->checkbox(['class' => 'checkbox-wrap', 'id' => 'slider_checkbox'])
     ?>


    <div class="cabinet__add-company-img-block form-line" id = "slider_images" style = "display: none;">



        <input type="file" id="fileInput" style="display: none" multiple>
        <div class="cabinet__add-company-form--drop" id="dropArea">
            <img src="/img/icons/cloud.png" alt="">
            <p>Перетащите сюда файлы, чтобы прикрепить их как документ</p>
        </div>
        <p class="cabinet__add-company-form--count"><span>Количество  файлов<span class="col">
    <span id="itemsCountBox">5</span> из <span id="maxCountBox">10</span></span></span>


            <input type="button" class="cabinet__add-company-form--submit" id="btnSel" value="Добавить">
        </p>



        <div class="cabinet__add-company-form--images" id="cabinet__add-company-form--images">
            <div class="cabinet__add-company-form--img">
                <div class="cabinet__add-company-form--img-wrapper">

                </div>
                <p class="cabinet__add-company-form--img-name"><span class="arrow-up"><img src="/img/icons/Rectangl.png"
                                                                                           alt=""></span><span
                            class="img-name"></span></p>
                <input type="hidden" name="sliderImg[]" class="productImg">
                <input type="hidden" name="sliderImgThumb[]" class="productImgThumb">
                <progress class="progressBar" value="0" max="100"></progress>
            </div>
        </div>
    </div>



<?= Html::submitButton('Сохранить информацию о компании', ['class' => 'cabinet__add-company-form--submit']) ?>
<?php ActiveForm::end(); ?>