<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\news\models\News */

$this->registerCssFile('/css/board.min.css');
//$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

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
    ->hint('<b>Введите наименование товара.</b><br>
                        В заголовке <b>не допускается: номер телефона, электронный адрес, ссылки</b><br>
                        Не допускаются заглавные буквы (кроме аббревиатур).'
    )
    ->label('Название товара<span>*</span>');
?>

<?= $form->field($model, 'category_id',
    ['template' => '<div class=mclass2>{input}<div class="memo-error"><p>{error}</p></div></div>'])
    ->hiddenInput()->label(false);
?>

<label class="label-name">Категория<span>*</span></label>

<span class="SelectCategory">
                <div class="place-ad__form select-category-add" datatype="product">
                    Выбирите рубрику

                </div>
            </span>

<hr class="lineAddAds"/>
<span id="additional_fields"></span>


<?= Html::submitButton('Oпубликовать',
    ['class' => 'cabinet__add-company-form--submit place-ad_publish publish place-ad__publish', 'id' => 'saveInfo']) ?>
<?php ActiveForm::end(); ?>
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