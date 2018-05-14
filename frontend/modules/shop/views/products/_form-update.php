<?php

use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\news\models\News */
/* @var $userCompany frontend\modules\company\models\Company */
/* @var $categorySelect  */
/* @var $adsField  */

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
<?= $form->field($model, 'title')->textInput(['maxlength' => 70])
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
    <?= $categorySelect; ?>
</span>

<hr class="lineAddAds"/>
<span id="additional_fields">
<?= $adsField; ?>
</span>


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
    ->hint('Введите цену новую цену товара, если товар продается со скидкой.<br>
                    Оставьте это поле пустым, если скидки на товар нет')
    ->label('Новая цена')
?>
<h2 class="soglasie">Фотографии
    <span>(для выбора обложки изображения нажмите на него) </span>
</h2>
<hr class="lineAddAds"/>
<?= $form->field($model, 'cover')->hiddenInput()->label(false); ?>


<?php
//\common\classes\Debug::prn($ads);
        //echo '<label class="control-label">Добавить фото</label>';
        $preview = [];
        $previewConfig = [];
        if(!empty($model['images'])){
            foreach($model['images'] as $i){
                $preview[] = "<img src='/$i->img_thumb' class='file-preview-image'>";
                $previewConfig[] = [
                    'caption' => '',
                    'url' => '/shop/product/delete-img?id=' . $i->id
                ];
            }
        }

echo FileInput::widget([
    'name' => 'file[]',
    'id' => 'input-5',
    'attribute' => 'attachment_1',
    'value' => '@frontend/media/img/1.png',
    'options' => ['multiple' => true, 'accept' => 'image/*'],
    'pluginOptions' => [
        'previewFileType' => 'image',
        'maxFileCount' => 10,
        'maxFileSize' => 2000,
        'language' => "ru",
        'previewClass' => 'hasEdit',
        'initialPreview' => $preview,
        'initialPreviewConfig' => $previewConfig
    ],
    'pluginEvents' => [
        "change" => "function() { $('input[name=\"Products[cover]\"]').val(''); }",
        "filereset" => "function() { 
                    $('input[name=\"Products[cover]\"]').val('');
                 }",
    ]
]);

?>


<?= $form->field($model, 'description')->textarea(
    [
        'class' => 'area-name jsHint',
        'maxlength' => 4096,
    ]
)
    ->hint('<b>Добавьте описание вашего товара,</b> укажите преимущества и важные детали.<br>
                      В описании <b>не допускается указание контактных данных.</b><br>
                      Описание должно соответствовать заголовку и предлагаемому товару.<br>
                      Не допускаются заглавные буквы (кроме аббревиатур).<br>
            ')
    ->label('Описание<span>*</span>'); ?>


<h2 class="soglasie">Оплата и доствка для этого товара</h2>
<span class="description-add-product">По умолчанию будут использованы условия оплаты и доставки из информации о компании</span>
<?php
$chk = false;
$style = 'display: none';
    if(!empty($model->payment || $model->delivery)){
        $chk = true;
        $style = 'display: block';
    }
?>
<label class="edit-product-cabinet">
    <?= Html::checkbox('edit-payment', $chk, ['class' => 'edit-payment', 'id' => 'edit-payment'] ); ?>
    Изменить
</label>


<hr class="lineAddAds"/>

<div class="edit-payment-form-field" style="<?= $style; ?>">
    <?= $form->field($model, 'payment')->textarea(
        [
            'class' => 'area-name jsHint',
            'maxlength' => 4096,
        ]
    )
        ->hint('Добавьте описание оплаты для этого товара.<br>
                <b>Оставьте поле пустым для использования информации из информации о компании.</b><br>
            ')
        ->label('Оплата'); ?>

    <?= $form->field($model, 'delivery')->textarea(
        [
            'class' => 'area-name jsHint',
            'maxlength' => 4096,
        ]
    )
        ->hint('Добавьте описание доставки для этого товара.<br>
                <b>Оставьте поле пустым для использования информации из информации о компании.</b><br>
            ')
        ->label('Доставка'); ?>
</div>

<br>
<h2 class="soglasie">Акция с товаром</h2>
<label class="edit-product-cabinet">
    <?= Html::checkbox('Products[stock]', $model->stockValue, ['class' => 'edit-payment', 'id' => 'add-stock'] ); ?>
    Акционный товар
</label>
<hr class="lineAddAds"/>

<div class="edit-stock-form-field" style="display: <?= $model->stockValue ? 'block' : 'none' ?>">
    <?= $form->field($model, 'stock_descr')->textarea(
        [
            'class' => 'area-name jsHint',
            'maxlength' => 4096,
        ]
    )->hint('Добавьте описание акции.<br>')
        ->label('Описание акции');
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