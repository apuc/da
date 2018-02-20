<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\modules\company\models\Company;
use \mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model frontend\modules\promotions\models\Stock */
/* @var $form yii\widgets\ActiveForm */
/* @var $beforeCreate array */

$this->registerCssFile('/css/board.min.css');
//$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="right">
    <?php if ($beforeCreate): ?>

        <?php $form = ActiveForm::begin([
            'id' => 'add_ads',
            'options' =>
                [
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
        <div class="content-forma">
            <?php $company_id = array_keys($beforeCreate); ?>

            <?= $form->field($model, 'company_id')->widget(Select2::className(), [
                'attribute' => 'state_2',
                'data' => ArrayHelper::map(Company::find()->where(['in', 'id', $company_id])->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Начните вводить Вашу компанию ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => 70])
                ->hint('<b>Введите заголовок,</b><br>который будет отображаться в списке акций')
                ->label('Заголовок акции'); ?>

            <?= $form->field($model, 'link')->textInput()
                ->hint('<b>Вставьте ссылку.</b><br>Сссылка может вести на сайт вашей компании или же на страницу в соцсетях')
                ->label('Ссылка'); ?>

            <?= $form->field($model, 'dt_event')->textInput()
                ->hint('<b>Примеры:</b><br>
                        До конца месяца, с 1 по 10 февраля...')
                ->label('Длительность акции'); ?>

            <?= $form->field($model, 'photo')->hiddenInput(['value' => $model->photo])->label(false); ?>
            <?php echo '<label class="control-label">Добавить фото</label>';
            echo FileInput::widget([
                'name' => 'Stock',
                'options' => ['multiple' => false],
                'pluginOptions' => [
                    'previewFileType' => 'image',
                    'maxFileCount' => 10,
                    'maxFileSize' => 2000,
                    'language' => "ru",
                ],
            ]); ?>

            <div class="cabinet__add-company-form--block"></div>
            <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>
            <?= $form->field($model, 'short_descr')->textInput()
                ->hint('<b>Введите краткое описание акции.</b>')
                ->label('Акционное предложение'); ?>
        </div>

        <div style="float: none; clear: both;">
            <?= $form->field($model, 'descr',
                ['template' => '<label class="label-name" style="width: 19%" for="stock-descr">Подробное описание</label><div class="description-action" style="width: 81%!important; float: left!important; ">{input}</div>'])
                ->widget(CKEditor::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                        'preset' => 'basic',
                        'inline' => false,
                        'path' => 'frontend/web/media/upload',
                    ]),
                ])
                ->label(false); ?>
        </div>
        <div class="content-forma">
            <?= Html::submitButton('Сохранить',
                ['class' => 'cabinet__add-company-form--submit place-ad_publish publish place-ad__publish', 'id' => 'saveInfo']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    <?php else: ?>
        <div class="blanket__content">
            <div class="blanket__content__wrap">
                <img src="/theme/portal-donbassa/img/blanket/ban.png" alt="">
                <h2>У Вас нет приедприятий для
                    добавления акции или Вы исчермали лимит акций</h2>
            </div>
            <a href="<?= Url::to(['/company/company/create']) ?>">Добавить предприятие</a>
            <p>После прохождения модерации вашей компании, вы сможете добавить новые акции</p>
        </div>
    <?php endif; ?>
</div>
