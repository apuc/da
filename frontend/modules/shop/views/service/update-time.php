<?php

use common\classes\Debug;
use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use common\models\db\ServicePeriods;
use \yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model frontend\modules\news\models\News */
/* @var $userCompany frontend\modules\company\models\Company */

echo '<script>var photoCount = 0;</script>';
$this->title = 'Изменить время';
$this->registerCssFile('/css/board.min.css');
//$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/Uploader.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/raw/img_upload.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$two  =  '0|1|2';
$five =  '0|1|2|3|4|5';

?>
<div class="cabinet__container cabinet__container_white cabinet__inner-box">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="right">
        <?php $form = ActiveForm::begin([
            'id' => 'add_ads',
            'options' =>
                [
                    'class' => 'content-forma cabinet__add-company-form-product cabinet__add-company-form',
                    'enctype' => 'multipart/form-data',
                ],
            'fieldConfig' => [
                'template' => '<div class="form-line">{label}{input}<div class="memo-error"><p>{error}</p></div><div class="memo"><span class="info-icon"></span><span class="triangle-left"></span>{hint}</div></div>',
                'labelOptions' => ['class' => 'label-name'],
                'errorOptions' => ['class' => 'error'],

                'hintOptions' => ['class' => ''],

            ],
            'errorCssClass' => 'my-error',

        ]); ?>

        <?php if (!empty($model->service)): ?>
            <?php $i = 0;
            foreach ($model->service as $service): ?>
                <div class="service_add" data-id="<?= $i ?>">
                    <?= Html::button('-', [
                        'class' => 'cabinet__add-company-form--submit place-ad_publish publish place-ad__publish button_service_delete',
                        'data-id' => $i
                    ])?>
                    <?= $form->field($model, 'service[' . $i . '][start]')->widget(MaskedInput::className(), [
                        'mask' => $two . '9' . ':' . $five . '9' . ':' . $five . '9',
                        'options' => [
                            'class' => 'input-name jsHint'
                        ],
                    ])->hint('<b>Введите время начала оказания услуг </b><br>')
                        ->label('Начало дня<span>*</span>');
                    ?>


                    <?= $form->field($model, 'service[' . $i . '][end]')->widget(MaskedInput::className(), [
                        'mask' => $two . '9' . ':' . $five . '9' . ':' . $five . '9',
                        'options' => [
                            'class' => 'input-name jsHint'
                        ],
                    ])->hint('<b>Введите время окончания оказания услуг </b><br>')
                        ->label('Конец дня<span>*</span>');
                    ?>


                    <?= $form->field($model, 'service[' . $i . '][week_days]')->checkboxList(ServicePeriods::getWeekDaysArray())
                        ->label(''); ?>
                </div>
                <?php $i++;
            endforeach ?>
            <?= Html::button('Ещё', [
                'class' => 'cabinet__add-company-form--submit place-ad_publish publish place-ad__publish',
                'id' => 'more_service',
                'data-count' => $i
            ])?>
        <?php else: ?>
            <div class="service_add" data-id="0">
                <?= Html::button('-', [
                    'class' => 'cabinet__add-company-form--submit place-ad_publish publish place-ad__publish button_service_delete',
                    'data-id' => 0
                ])?>
                <?= $form->field($model, 'service[0][start]')->widget(MaskedInput::className(), [
                    'mask' => $two . '9' . ':' . $five . '9' . ':' . $five . '9',
                    'options' => [
                        'class' => 'input-name jsHint'
                    ],
                ])->hint('<b>Введите время начала оказания услуг </b><br>')
                    ->label('Начало дня<span>*</span>');
                ?>


                <?= $form->field($model, 'service[0][end]')->widget(MaskedInput::className(), [
                    'mask' => $two . '9' . ':' . $five . '9' . ':' . $five . '9',
                    'options' => [
                        'class' => 'input-name jsHint'
                    ],
                ])->hint('<b>Введите время окончания оказания услуг </b><br>')
                    ->label('Конец дня<span>*</span>');
                ?>


                <?= $form->field($model, 'service[0][week_days]')->checkboxList(ServicePeriods::getWeekDaysArray())
                    ->label(''); ?>
            </div>
            <?= Html::button('Ещё', [
                'class' => 'cabinet__add-company-form--submit place-ad_publish publish place-ad__publish',
                'id' => 'more_service',
                'data-count' => 1
            ])?>
        <?php endif ?>

        <?= Html::submitButton('Oпубликовать',
            ['class' => 'cabinet__add-company-form--submit place-ad_publish publish place-ad__publish', 'id' => 'saveInfo']) ?>


        <?php ActiveForm::end(); ?>
    </div>


</div>
