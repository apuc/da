<?php
/**
 * @var Poster $model
 * @var array $categoryPoster
 * @var array $categorySelect
 */
$this->title = 'Редактирование афиши мероприятия';

use backend\modules\poster\models\Poster;
use kartik\datetime\DateTimePicker;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->registerCssFile('/css/board.min.css');
$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

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

        <div class="form-line">
            <label class="label-name">Категория</label>
            <?= Select2::widget(
                [
                    'name' => 'Poster[categoryId]',
                    'data' => ArrayHelper::map($categoryPoster, 'id', 'title'),
                    'value' => ArrayHelper::getColumn($categorySelect, 'cat_id'),
                    'options' => [
                        'placeholder' => 'выберите категорию',
                        'id' => 'form-select',
                        'multiple' => true
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],

                ]) ?>
        </div>


        <?= $form->field($model, 'title')
            ->textInput(['maxlength' => true])
            ->hint('Введите название мероприятия')
            ->label('Название мероприятия<span>*</span>');
        ?>


        <?= $form->field($model, 'photo')->hiddenInput(['value' => $model->photo])->label(false); ?>
        <label class="control-label">Добавить фото</label>
        <?= FileInput::widget([
            'name' => 'Poster',
            'options' => ['multiple' => false],
            'pluginOptions' => [
                'previewFileType' => 'image',
                'maxFileCount' => 10,
                'maxFileSize' => 2000,
                'language' => "ru",
                'previewClass' => 'hasEdit',
                'initialPreview' => "<img src='$model->photo' class='file-preview-image'>",
                'initialPreviewConfig' => [
                    'caption' => '',
                    'url' => '/promotions/promotions/delete?id=' . $model->id
                ]
            ]
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

        <div class="form-line">
            <label class="label-name">Дата начала события</label>
            <?php ?>
            <?= DateTimePicker::widget(
                [
                    'name' => 'Poster[dt_event]',
                    'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                    'options' => ['placeholder' => 'Выберете дату события'],
                    'convertFormat' => false,
                    'value' => date('d-m-Y H:i', !empty($model->dt_event) ? (int)$model->dt_event : time()),
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy H:i ',
                        'startDate' => '01-Mar-2016 12:00 AM',
                        'todayHighlight' => true,
                    ]
                ]);
            ?>
        </div>


        <div class="form-line">
            <label class="label-name">Дата окончания события</label>
            <?= DateTimePicker::widget(
                [
                    'name' => 'Poster[dt_event_end]',
                    'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                    'options' => ['placeholder' => 'Выберете дату окончания события'],
                    'convertFormat' => false,
                    'value' => date('d-m-Y H:i', !empty($model->dt_event_end) ? (int)$model->dt_event_end : time()),
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy H:i ',
                        'startDate' => '01-Mar-2016 12:00 AM',
                        'todayHighlight' => true,
                    ]
                ]);
            ?>
        </div>


        <?= $form->field($model, 'address')
            ->textInput(['maxlength' => true])
            ->hint('Адрес проведения')
            ->label('Адрес проведения');
        ?>


        <?php $phone = explode(' ', $model->phone); ?>
        <div class="cabinet__add-company-form--wrapper">
            <label class="label-name">Телефон</label>
            <input class="cabinet__add-company-form--field" name="mytext[]" value="<?= $phone[0] ?>" type="text">
            <a href="#" class="cabinet__add-field" max-count="3"></a>
        </div>

        <div class="cabinet__add-company-form--hover-wrapper" data-count="<?= count($phone) - 1; ?>">
            <?php
            unset($phone[0]);

            foreach ($phone as $item):?>
                <?php if (!empty($item)): ?>
                    <div class="cabinet__add-company-form--hover-elements">
                        <p class="cabinet__add-company-form--title"></p>
                        <input class="cabinet__add-company-form--field" value="<?= $item; ?>" type="text"
                               name="mytext[]">
                        <a href="#" class="cabinet__remove-pkg"></a>
                        <p class="cabinet__add-company-form--notice"></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>

        <?= $form->field($model, 'descr')
            ->textarea(['aria-invalid' => 'false'])
            ->hint('Введите описание мероприятия')
            ->label('Описание')
        ?>


        <?= Html::submitButton('Сохранить', ['class' => 'cabinet__add-company-form--submit']) ?>
        <?php ActiveForm::end(); ?>

    </div>
</div>