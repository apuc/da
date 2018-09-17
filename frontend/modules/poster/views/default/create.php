<?php
/**
 * @var Poster $model
 */

$this->title = 'Добавление афиши мероприятия';

$this->registerCssFile('/css/board.min.css');
$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

use common\models\db\Poster;
use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>

<div class="cabinet__container cabinet__container_white cabinet__inner-box">

    <h3><?= $this->title; ?></h3>
    <div class="right">
        <?php $form = ActiveForm::begin(
            [
                'id' => 'create_poster',
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
            ])
            ->hint('<b>Выберите категорию афиши из списка.</b>')
            ->label('Категория<span>*</span>');
        ?>


        <?= $form->field($model, 'title')
            ->textInput(['maxlength' => true])
            ->hint('Введите название мероприятия')
            ->label('Название мероприятия<span>*</span>');
        ?>


        <?= $form->field($model, 'photo')->hiddenInput(['value' => $model->photo])->label(false); ?>
        <?php echo '<label class="control-label">Добавить фото</label>';
        echo FileInput::widget([
            'name' => 'Poster',
            'options' => ['multiple' => false],
            'pluginOptions' => [
                'previewFileType' => 'image',
                'maxFileCount' => 10,
                'maxFileSize' => 2000,
                'language' => "ru",
            ],
        ]); ?>


        <?= $form->field($model, 'price')
            ->textInput(['maxlength' => true])
            ->hint('Укажите цену посещения')
            ->label('Цена посещения'); ?>

        <?= $form->field($model, 'start')
            ->textInput(['maxlength' => true])
            ->hint('Укажите время проведения мероприятия<br>Например: с 8:00 до 18:00 или круглосуточно')
            ->label('Время проведения');
        ?>


        <?= $form->field($model, 'dt_event')->widget(\kartik\datetime\DateTimePicker::className(),
            [
                'options' => ['placeholder' => 'Выберете дату события'],
                'convertFormat' => false,
                'value' => date('d-m-Y H:i', (!empty($model->dt_event) ? $model->dt_event : time())),
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy H:i ',
                    'todayHighlight' => true,
                ]
            ]
        )
            ->hint('Дата начала события')
            ->label('Дата начала события');
        ?>

        <?= $form->field($model, 'dt_event_end')->widget(\kartik\datetime\DateTimePicker::className(), [
            'options' => ['placeholder' => 'Выберете дату окончания события'],
            'convertFormat' => false,
            'value' => date('d-m-Y H:i', (!empty($model->dt_event_end) ? $model->dt_event_end : time())),
            'pluginOptions' => [
                'format' => 'dd-mm-yyyy H:i ',
                'startDate' => '01-Mar-2016 12:00 AM',
                'todayHighlight' => true,
            ],
        ])
            ->hint('Дата окончания события')
            ->label('Дата окончания события');
        ?>

        <?= $form->field($model, 'address')
            ->textInput(['maxlength' => true])
            ->hint('Адрес проведения')
            ->label('Адрес проведения');
        ?>


        <div class="cabinet__add-company-form--wrapper">

            <label class="label-name">Телефон</label>

            <input class="cabinet__add-company-form--field" name="mytext[]" type="text">

            <a href="#" class="cabinet__add-field" max-count="3"></a>

        </div>

        <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>

        <?= $form->field($model, 'descr')
            ->textarea([
                'aria-invalid' => 'false',
                'style' => [
                    'height' => '200px'
                ]
            ])
            ->hint('Введите описание мероприятия')
            ->label('Описание')
        ?>


        <?= Html::submitButton('Сохранить', ['class' => 'cabinet__add-company-form--submit']) ?>
        <?php ActiveForm::end(); ?>

    </div>
</div>
