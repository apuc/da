<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $arraregCity */
/* @var $model \frontend\modules\board\models\AdsModel */

use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\db\Messenger;

$this->registerCssFile('/css/board.min.css');
//$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="cabinet__container cabinet__container_white cabinet__inner-box">

    <h3>Добавление объявления</h3>
    <div class="right">
    <?php $form = ActiveForm::begin([
        'id' => 'add_ads',
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

    ]); ?>

    <h2 class="soglasie">Общая информация</h2>
    <hr class="lineAddAds"/>

    <?= $form->field($model,'title')->textInput(['maxlength' => 70])
        ->hint('Наименование предлагаемого товара, объекта или услуги. В заголовке запрещено размещать контактную
информацию, а также использовать заглавные буквы (кроме аббревиатур).'
        )
        ->label('Заголовок<span>*</span>');
    ?>
    <p class="calc">
        <small>
            <b id="title-count-res" class="counter-placeholder">70</b> знаков осталось
        </small>
    </p>

    <?= $form->field($model, 'category_id',
        ['template' => '<div class=mclass2>{input}<div class="memo-error"><p>{error}</p></div></div>'])
        ->hiddenInput()->label(false);
    ?>

    <label class="label-name">Категория<span>*</span></label>

    <span class="SelectCategory">
                <div class="place-ad__form select-category-add">
                    Выбирите рубрику

                </div>
            </span>

    <hr class="lineAddAds"/>
    <span id="additional_fields"></span>






    <?= $form->field($model, 'content')->textarea(
        [
            'class' => 'area-name jsHint',
            'maxlength' => 4096,
        ]
    )
        ->hint('Описание предлагаемого товара, объекта или услуги с указанием его достоинств и важных деталей. Тематика
текста должна соответствовать заголовку объявления. В описании запрещено размещать контактную
информацию, а также использовать заглавные буквы (кроме аббревиатур).
            ')
        ->label('Описание<span>*</span>'); ?>
    <p class="calc">
        <small>
            <b id="descr-count-res" class="counter-placeholder">4096</b> знаков осталось
        </small>
    </p>

    <?= $form->field($model, 'price')->textInput()->hint('Цена предлагаемого товара, объекта или услуги в российских рублях. Запрещено указывать нереальную или
условную стоимость.')->label('Цена<span>*</span>'); ?>


    <?php

    echo $form->field($model, 'cover')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*','class'=>'jsHint',"name"=>"file[]"],
        'pluginOptions'=>["msgPlaceholder"=>"Выбери файл..."]
    ])->hint('Разрешение изображения – не менее 800х600 пикселей. Размер – не более двух мегабайт. Формат – jpg
        или png. Стандартное соотношение сторон 3х4. Иллюстрации с нешаблонными пропорциями
        автоматически обрезаются.')->label("Иллюстрация")
    ?>





        <div style="float: none;clear: both;width: max-content;margin-left: 225px;" class="field-stock-descr">
            <p class="text-editor-label">Контактная информация</p>
        </div>
    <hr class="lineAddAds"/>


    <?= $form->field($model, 'city_id')->widget(Select2::className(),[
        'attribute' => 'state_2',
        'data' => $arraregCity,
        //'value' => $geoInfo['city_id'],
        //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
        'options' => ['placeholder' => 'Введи город...',
            'class'=>"jsHint"],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        'pluginEvents' => [
            "select2:open" => "function() { $('.memo:eq(4)').show(); }",
            "select2:close" => "function() { $('.memo:eq(4)').hide(); }",
        ],
    ])->hint("Город, в котором продается товар, объект или оказывается услуга.
Имя:");

    ?>
    <!--<div class="form-line field-ads-name required">
        <div class="form-line">
            <label class="label-name">Местонахождение<span>*</span></label>
            <?/*= Select2::widget([
                'name' => 'Ads[city_id]',
                'attribute' => 'state_2',
                'data' => $arraregCity,
                //'value' => $geoInfo['city_id'],
                //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
                'options' => ['placeholder' => 'Начните вводить Ваш город ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            */?>
        </div>
    </div>-->

    <?= $form->field($model, 'name')->textInput()->label('Имя:')->hint('Имя контактного лица, которое будет общаться с заинтересованными пользователями портала.') ?>




    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
        'options' => ['class' => 'input-name jsHint',],
        'mask' => ['+9 (999) 999-9999', '+99(999) 999-99-99'],
    ])->label('Телефон:')->hint('Номер телефона контактного лица, которое будет общаться с заинтересованными пользователями портала.') ?>

        <div class="messengers-choice" style="display: flex; flex-wrap: wrap; width: 70%; margin-left: auto;">
            <?= Html::checkboxList('Phones[messengeres]', '', ArrayHelper::map(Messenger::find()->all(), "id", "name"),
                [
                    'item' =>
                        function ($index, $label, $name, $checked, $value) {

                            $img = ($label == "Viber") ? Html::img("/img/icons/viber.png")." Viber" : Html::img("/img/icons/whatsapp.png_s")." Whatsapp";

                            return Html::checkbox("messengeresArray[0][]", $checked, [
                                'value' => $value,
                                'label' => $img
                            ]);
                        },
                    'class' => 'checkbox-wrap',
                    'style' => 'display: flex; justify-content: space-around; width: 100%;'
                ]);
            ?>
        </div>

    <?= $form->field($model, 'mail')
        ->textInput(
            [
                'readonly' => true,
                'value' => \dektrium\user\models\User::find()->where(['id' => Yii::$app->user->id])->one()->email,
            ]
        )
        ->label('Почта:')->hint('Адрес электронной почты, который был указан во время регистрации профиля.')?>


    <div class="content-dannie">
        <span>
            <input id="dannie-1" type="checkbox" name="option2" value="a2">
            <label for="dannie-1"></label><p>Я согласен с
            <a target="_blank" href="<?= Url::to(['/help/default/view', 'slug' => 'obsie-polozenia']) ?>">
                правилами</a> сервиса DA info pro, разрешаю <a target="_blank" href="<?= Url::to(['/help/default/view', 'slug' => 'obsie-polozenia']) ?>">обработку </a>персональной информации и подтверждаю совершеннолетие.</p>
        </span>
    </div>

    <?= Html::submitButton('Сохранить объявление',
        ['class' => 'cabinet__add-company-form--submit place-ad_publish publish place-ad__publish', 'disabled' => 'disabled', 'id' => 'saveInfo']) ?>


    <?php ActiveForm::end(); ?>
    </div>
</div>


<div class="modal modal-wide fade modal-categories" id="modalType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h2>Выберите категорию</h2>
                <span class="krest close"> &times;</span>
            </div>
            <div class="modal-body modal-flex" id="categoryModal">

            </div>


        </div>
    </div>
</div>

