<?php
/**
 * @var \common\models\db\Poster $model
 */

$this->title = 'Добавление афиши мероприятия';

$this->registerCssFile('/css/board.min.css');
$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>

<div class="cabinet__container cabinet__container_white cabinet__inner-box">

    <h3>Добавление афиши мероприятия</h3>
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
           <!-- <p class="cabinet__add-company-form--title">Категория</p>
            <div class="cabinet__add-company-form--select-wrapper-cat">
                <?/*= \kartik\select2\Select2::widget(
                    [
                        'model' => $model,
                        'attribute' => 'categoryId',
                       // 'name' => 'cat[]',
                        'data' => \yii\helpers\ArrayHelper::map($categoryPoster, 'id', 'title'),
                        'options' => [
                            'placeholder' => 'выберите категорию',
                            'id' => 'form-select',
                            'multiple' => true
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],

                    ])*/?>
            </div>-->

        <?= $form->field( $model, 'title' )
            ->textInput(['maxlength' => true])
            ->hint('Введите название мероприятия')
            ->label('Название мероприятия<span>*</span>');
        ?>


            <!--<div class="cabinet__add-company-form--block"></div>-->

            <!--<p class="cabinet__add-company-form--title">Логотип компании</p>-->

           <!-- <label class="cabinet__add-company-form--add-foto">
                <span class="button"></span>
                <input id="news-photo" class="input-file" type="file">
                <img id="blah" src="" alt="" width="160px">
            </label>-->
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
<!--        --><?php
//        if (empty($model->photo)) {
//            echo $form->field($model, 'photo', [
//                'template' => '<label class="label-name cabinet__add-company-form--add-foto">
//                                        <span class="button"></span>
//                                        Загрузете изображение
//                                        {input}
//                                        <img id="blah" src="" alt="" width="160px">
//                                        </label>'
//            ])->label(false)->fileInput();
//        } else {
//            echo $form->field($model, 'photo', [
//                'template' => '{label}<div class="selectAvatar">
//                                        <span>Нажмите для выбора</span>
//
//                                        <img id="blah" src="' . $model->photo . '" alt="" width="160px">
//                                        {input}</div>'
//            ])->label('Загрузете изображение')->fileInput();
//        }
//        ?>


        <?= $form->field( $model, 'price' )
            ->textInput(['maxlength' => true])
            ->hint('Укажите цену посещения')
            ->label('Цена посещения'); ?>

        <?= $form->field( $model, 'start' )
            ->textInput(['maxlength' => true])
            ->hint('Укажите время проведения мероприятия<br>Например: с 8:00 до 18:00 или круглосуточно')
            ->label('Время проведения');
        ?>


        <?=
            $form->field($model, 'dt_event')->widget(\kartik\datetime\DateTimePicker::className(),
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

        <?= $form->field($model, 'dt_event_end')->widget(\kartik\datetime\DateTimePicker::className(),[
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

        <?= $form->field( $model, 'address' )
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

        <?= $form->field($model, 'descr')->textarea(
            [
                'aria-invalid' => 'false',
            ])
        ->hint('Введите описание мероприятия')
        ->label('Описание')
        ?>
        <!--<p class="label-name">Описание</p>
        <textarea id="poster-descr" class="cabinet__add-company-form--text" name="Poster[descr]" aria-invalid="false"></textarea>-->
            <!--<div class="cabinet__add-company-form--block"></div>-->

        <?= Html::submitButton( 'Сохранить', [ 'class' => 'cabinet__add-company-form--submit' ] ) ?>
        <?php ActiveForm::end(); ?>

    </div>
</div>
