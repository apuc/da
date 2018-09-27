<?php
/**
 * @var Poster $model
 */

$this->title = 'Добавление афиши мероприятия';

$this->registerCssFile('/css/board.min.css');
$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/news.js',['depends' => [\yii\web\JqueryAsset::className()]]);

use common\models\db\Poster;
use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

?>

<div class="cabinet__container cabinet__container_white cabinet__inner-box">

    <h3><?= $this->title; ?></h3>
    <div class="right">
        <?php $form = ActiveForm::begin(
            [
                'id' => 'create_poster',
                'options' =>
                    [
                        'class' => 'content-forma cabinet__add-company-form-product',
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

        <?= $form->field($model, 'categoryId[]')->widget(\kartik\select2\Select2::className(),
            [
                'data' => \yii\helpers\ArrayHelper::map($categoryPoster, 'id', 'title'),
                'options' => [
                    'placeholder' => 'выберите категорию',
                    'multiple' => true
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'pluginEvents' => [
                    "select2:open" => "function() { $('.memo:first').show(); }",
                    "select2:close" => "function() { $('.memo:first').hide(); }",
                ],
            ])
            ->hint('Категория, к которой относится мероприятие.')
            ->label('Категория:');
        ?>


        <?= $form->field($model, 'title')
            ->textInput(['maxlength' => true])
            ->hint('Полное название мероприятия. Не допускается использование заглавных букв (кроме аббревиатур).')
            ->label('Название:');
        ?>


        <?php

        echo $form->field($model, 'photo')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*','class'=>'jsHint','multiple' => false,'onchange'=>
                '$(".field-poster-photo").find(".memo").show(); 
                setTimeout(function(){$(".field-poster-photo").find(".memo").hide();}, 5000);'],
            'pluginOptions' => [
                'previewFileType' => 'image',
                'maxFileCount' => 10,
                'maxFileSize' => 2000,
                'language' => "ru",
            ],


        ])->hint('Изображение, которое соответствует программе мероприятия. Разрешение изображения – не менее 800х600
пикселей. Размер – не более двух мегабайт. Формат – jpg или png. Стандартное соотношение сторон 3х4.
Иллюстрации с нешаблонными пропорциями автоматически обрезаются.')->label("Обложка:");
        ?>
        <p class="file-hint">
            Как правильно подобрать иллюстрацию?
            <a target="_blank" href="http://da-info.pro/page/kak-pravilno-podobrat-izobrazenie-dla-stati-na-sajte-da-info-pro">Читать.</a>
        </p>



        <?= $form->field($model, 'price')
            ->textInput(['maxlength' => true])
            ->hint('Цена билетов или входа на мероприятие. Стоимость указывается в российских рублях.')
            ->label('Цена посещения:'); ?>

        <?= $form->field($model, 'start')
            ->textInput(['maxlength' => true])
            ->hint('Укажите время проведения мероприятия<br>Например: с 8:00 до 18:00 или круглосуточно')
            ->label('Время проведения:');
        ?>


        <?= $form->field($model, 'dt_event')->widget(\kartik\datetime\DateTimePicker::className(),
            [
                'options' => ['placeholder' => 'Выберете дату события','class'=>'jsHint'],
                'convertFormat' => false,
                'value' => date('d-m-Y H:i', (!empty($model->dt_event) ? $model->dt_event : time())),
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy H:i ',
                    'todayHighlight' => true,
                ],
                'pluginEvents' => [
                    "show" => "function(e) { $(this).parent().find('.memo').show();  }",
                    "hide" => "function(e) { $(this).parent().find('.memo').hide();  }",
                ]
            ]
        )
            ->hint('Дата и время начала мероприятия.')
            ->label('Дата начала:');
        ?>

        <?= $form->field($model, 'dt_event_end')->widget(\kartik\datetime\DateTimePicker::className(), [
            'options' => ['placeholder' => 'Выберете дату окончания события','class'=>'jsHint'],
            'convertFormat' => false,
            'value' => date('d-m-Y H:i', (!empty($model->dt_event_end) ? $model->dt_event_end : time())),
            'pluginOptions' => [
                'format' => 'dd-mm-yyyy H:i ',
                'startDate' => '01-Mar-2016 12:00 AM',
                'todayHighlight' => true,
            ],
            'pluginEvents' => [
                "show" => "function(e) { $(this).parent().find('.memo').show();  }",
                "hide" => "function(e) { $(this).parent().find('.memo').hide();  }",
            ]
        ])
            ->hint('Дата и время окончания мероприятия.')
            ->label('Дата окончания:');
        ?>

        <?= $form->field($model, 'address')
            ->textInput(['maxlength' => true])
            ->hint('Страна, населенный пункт, улица и место проведения мероприятия.')
            ->label('Адрес:');
        ?>


        <div class="cabinet__add-company-form--wrapper" data-iterator="0">

            <label class="label-name">Телефон:</label>



            <?=  MaskedInput::widget([
                'name' => 'mytext[]',
                'mask' => '+99-999-999-9999',
                'options'=>[
                    'class' => 'input-name jsHint',
                    'id' => 'phone',
                ],
                'clientOptions' => [
                    'clearIncomplete' => true
                ]
            ]);

            ?>

            <button type="button" class="cabinet__add-field company__add-phone"
                    style="position: absolute; top: 11px; right: 5px; border: none;" data-iterator="0"
                    max-count="3">
            </button>

            <div class="memo" style="display: none">
                <span class="info-icon" style="background-image: url(/theme/portal-donbassa/img/icons/info.png)"></span>
                <span class="triangle-left"></span>
                <div class="">Номер телефона лица, которое отвечает за общение с заинтересованными пользователями портала.</div>
            </div>

        </div>

        <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>

        <?= $form->field($model, 'descr')
            ->textarea([
                'aria-invalid' => 'false',
                'style' => [
                    'height' => '200px'
                ]
            ])
            ->hint('Анонс программы мероприятия, а также уточнение деталей или особенностей его проведения (если
необходимо).')
            ->label('Описание:')
        ?>


        <?= Html::submitButton('ДОБАВИТЬ АФИШУ', ['class' => 'cabinet__add-company-form--submit']) ?>
        <?php ActiveForm::end(); ?>

    </div>
</div>
