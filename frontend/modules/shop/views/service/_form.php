<?php

use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\news\models\News */
/* @var $userCompany frontend\modules\company\models\Company */

echo '<script>var photoCount = 0;</script>';

$this->registerCssFile('/css/board.min.css');
//$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/Uploader.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/raw/img_upload.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<?php $form = ActiveForm::begin([
    'id' => 'add_ads',
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

]); ?>

<h2 class="soglasie">Общая информация</h2>
<hr class="lineAddAds"/>
<?= $form->field($model, 'title')->textInput(['maxlength' => 70])
    ->hint('<b>Введите наименование услуги.</b><br>
                        В заголовке <b>не допускается: номер телефона, электронный адрес, ссылки</b><br>
                        Не допускаются заглавные буквы (кроме аббревиатур).'
    )
    ->label('Название услуги<span>*</span>');
?>

<?= $form->field($model, 'category_id',
    ['template' => '<div class=mclass2>{input}<div class="memo-error"><p>{error}</p></div></div>'])
    ->hiddenInput()->label(false);
?>

<label class="label-name">Категория<span>*</span></label>

<span class="SelectCategory">
                <div class="place-ad__form select-category-add" datatype="service">
                    Выбирите рубрику

                </div>
            </span>

<hr class="lineAddAds"/>
<span id="additional_fields"></span>


<?= $form->field($model, 'company_id')
    ->dropDownList(\yii\helpers\ArrayHelper::map($userCompany, 'id', 'name'),
        [
            'prompt' => 'Выберите компанию',
        ])
    ->hint('Выберите компанию которой принадлежит товар')
    ->label('Компания<span>*</span>')
?>

<?= $form->field($model, 'price')->textInput()
    ->hint('Введите цену товара')
    ->label('Цена<span>*</span>')
?>

<?= $form->field($model, 'new_price')->textInput()
    ->hint('Введите новую цену услуги, если услуга продается со скидкой.<br>
                    Оставьте это поле пустым, если скидки на услугу нет')
    ->label('Новая цена')
?>
<div class="cabinet__add-company-img-block form-line">
    <h2>Фотографии <span>(для выбора обложки изображения нажмите на него)</span></h2>

    <p class="cabinet__add-company-form--count">количество загружаемых файлов<span class="col">
        <span id="itemsCountBox">5</span> из <span id="maxCountBox">10</span></span>
        <span></span></p>
    <input type="file" id="fileInput" style="display: none" multiple>
    <div class="cabinet__add-company-form--drop" id="dropArea">
        <img src="/img/icons/cloud.png" alt="">
        <p>Перетащите сюда файлы, чтобы прикрепить их как документ</p>
    </div>

    <input type="button" class="cabinet__add-company-form--submit" id="btnSel" value="Добавить">

    <div class="cabinet__add-company-form--images" id="cabinet__add-company-form--images">
        <div class="cabinet__add-company-form--img">
            <div class="cabinet__add-company-form--img-wrapper">

            </div>
            <p class="cabinet__add-company-form--img-name"><span class="arrow-up"><img src="/img/icons/Rectangl.png"
                                                                                       alt=""></span><span
                        class="img-name"></span></p>
            <input type="hidden" name="productImg[]" class="productImg">
            <input type="hidden" name="productImgThumb[]" class="productImgThumb">
            <progress class="progressBar" value="0" max="100"></progress>
        </div>
    </div>
</div>

<?= $form->field($model, 'description')->textarea(
    [
        'class' => 'area-name jsHint',
        'maxlength' => 4096,
    ]
)
    ->hint('<b>Добавьте описание вашей услуги,</b> укажите преимущества и важные детали.<br>
                      В описании <b>не допускается указание контактных данных.</b><br>
                      Описание должно соответствовать заголовку и предлагаемому товару.<br>
                      Не допускаются заглавные буквы (кроме аббревиатур).<br>
            ')
    ->label('Описание<span>*</span>'); ?>

<h2 class="soglasie">Оплата и доствка для этой услуги</h2>
<span class="description-add-product">По умолчанию будут использованы условия оплаты и доставки из информации о компании</span>
<label class="edit-product-cabinet">
    <?= Html::checkbox('edit-payment', false, ['class' => 'edit-payment', 'id' => 'edit-payment']); ?>
    Изменить
</label>
<hr class="lineAddAds"/>

<div class="edit-payment-form-field" style="display: none">
    <?= $form->field($model, 'payment')->textarea(
        [
            'class' => 'area-name jsHint',
            'maxlength' => 4096,
        ]
    )
        ->hint('Добавьте описание оплаты для этой услуги.<br>
                <b>Оставьте поле пустым для использования информации из информации о компании.</b><br>
            ')
        ->label('Оплата'); ?>

    <?= $form->field($model, 'delivery')->textarea(
        [
            'class' => 'area-name jsHint',
            'maxlength' => 4096,
        ]
    )
        ->hint('Добавьте описание доставки для этой услуги.<br>
                <b>Оставьте поле пустым для использования информации из информации о компании.</b><br>
            ')
        ->label('Доставка'); ?>
</div>
<br>
<h2 class="soglasie">Акция с услугой</h2>
<label class="edit-product-cabinet">
    <?= Html::checkbox('Products[stock]', false, ['class' => 'edit-payment', 'id' => 'add-stock']); ?>
    Акционная услуга
</label>
<hr class="lineAddAds"/>

<div class="edit-stock-form-field" style="display: none">
    <?= $form->field($model, 'stock_descr')->textarea(
        [
            'class' => 'area-name jsHint',
            'maxlength' => 4096,
        ]
    )->hint('Добавьте описание акции.<br>')
        ->label('Описание акции');
    ?>
</div>

<label class="edit-product-cabinet">
    <?= Html::checkbox('is_durable', false, ['class' => 'edit-payment', 'id' => 'add-durability']); ?>
    Услуга имеет распиание
</label>
<hr class="lineAddAds"/>

<div class="edit-durability-form-field" style="display: none">
    <?= $form->field($model, 'durability')->textInput(
        [
            'class' => 'area-durability jsHint',
        ]
    )->hint('Добавьте длительность оказания услуги.<br>')
        ->label('Длительность')
    ?>
</div>

<?= Html::submitButton('Oпубликовать',
    ['class' => 'cabinet__add-company-form--submit place-ad_publish publish place-ad__publish', 'id' => 'saveInfo']) ?>
<?php ActiveForm::end(); ?>
<div class="modal modal-wide fade modal-categories" id="modalType" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
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