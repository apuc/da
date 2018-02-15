<?php

use common\models\db\CategoryCompany;
use common\models\db\Lang;
use kartik\file\FileInput;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\company\models\Company */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('/css/board.min.css');
//$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php $form = ActiveForm::begin(
    [
        'id' => 'update_company',
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

<?php
/*echo \kartik\select2\Select2::widget(
    [
        'name' => '1231',
        'attribute' => 'name',
        'data' => $categoryAll,
        'options' => [
            'multiple' => true,
            'placeholder' => 'Select a state ...',
            'class' => 'form-control',
            'size' => '1'
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'showToggleAll' => false,
            'tags' => true,
            'maximumSelectionLength' => 2

        ],
    ]); */ ?>



<?= $form->field($model, 'slug')->hiddenInput()->label(false); ?>
    <input type="hidden" name="photo" id="" value="<?= $model->photo; ?>">

<?php
/*echo Html::dropDownList(
    'categ',
    $selectCat->id,
    ArrayHelper::map(CategoryCompany::find()->where(['lang_id' => 1, 'parent_id' => '0'])->all(), 'id', 'title'),
    ['class' => 'cabinet__add-company-form--field', 'id' => 'categ_company', 'prompt' => 'Выберите категорию']
);
*/ ?>

<?php $model->categ = ArrayHelper::getColumn($companyRel, 'cat_id');?>

<?= $form->field($model, 'categ')->widget(Select2::className(),
    [
        'data' => $categoryCompanyAll,
        'options' => [
            'multiple' => true,
            'placeholder' => 'Select a state ...',
            'class' => 'form-control',
            'size' => '1',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'showToggleAll' => false,
            'tags' => true,
            'maximumSelectionLength' => (isset($services['count_category'])) ? $services['count_category'] : 1,

        ],
    ]);
?>
    <!--<div class="cabinet__add-company-form--block"></div>-->

    <!-- <span class="addParentCategory" style="width: 100%;">

        <div class="cabinet__add-company-form--hover-wrapper">
            <p class="cabinet__add-company-form--title">Категория</p>
            <? /*= Html::dropDownList(
                'categParent',
                $selectParentCat->id,
                ArrayHelper::map(CategoryCompany::find()->where(['parent_id' => $selectCat->id])->all(), 'id', 'title'),
                ['class' => 'cabinet__add-company-form--field selectCateg', 'prompt' => 'Выберите категорию']

            ) */ ?>
            <p class="cabinet__add-company-form--notice"></p>
        </div>
        <br/>

    </span>-->


<?= $form->field($model, 'name')->textInput([
    'maxlength' => true,
])
->hint('Введите название компании')
->label('Название компании')
?>

<?= $form->field($model, 'city_id')->widget(Select2::className(),
    [
        'data' => $city,
        'value' => $model->city_id,
        //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
        'options' => ['placeholder' => 'Начните вводить город ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ->hint('Введите город где находится компания')
    ->label('Город компании')
?>

<?= $form->field($model, 'address')->textInput(['maxlength' => true])
    ->hint('Введите адрес компании без указания города')
    ->label('Адрес компании')
?>
    <!--<div class="cabinet__add-company-form--wrapper">
        <p class="cabinet__add-company-form--title">Адрес компании</p>
        <?/*= $form->field($model, 'address')->textInput([
            'maxlength' => true,
            'class' => 'cabinet__add-company-form--field',
        ])->label(false) */?>

        <!-- <a href="#" class="cabinet__add-field"></a>

    </div>-->




<?php echo $form->field($model, 'photo', [
    'template' => '<label class="cabinet__add-company-form--add-foto">
                                        <span class="button"></span>
                                        {input}
                                        <img id="blah" src="' . $model->photo . '" alt="" width="160px">
                                        </label>'
])->label('Логотип компании')->fileInput();
?>

    <div class="cabinet__add-company-form--block"></div>


    <div class="cabinet__add-company-form--wrapper">

        <p class="cabinet__add-company-form--title">Телефон</p>
        <?php // $phone = explode(' ', $model->phone);
        if (!empty($model->allPhones)) {
            $phone = $model->allPhones;
        }

        if (empty($phone[0])) { ?>
            <input value="" class="cabinet__add-company-form--field" name="mytext[]" type="text">
            <a href="#" class="cabinet__add-field"
               max-count="<?= (isset($services['count_phone']) ? $services['count_phone'] : ''); ?>"></a>
            <!--<a href="#" class="cabinet__remove-pkg"></a>-->
        <?php } else {
            ?>
            <div class="cabinet__add-company-form--hover-wrapper">
                <?php foreach ($phone as $key => $item): ?>
                    <?php if (!empty($item)): ?>

                        <div class="cabinet__add-company-form--hover-elements">
                            <p class="cabinet__add-company-form--title"></p>
                            <input value="<?= $item->phone; ?>" class="cabinet__add-company-form--field" name="mytext[]"
                                   type="text">
                            <?php if ($key != 0): ?>
                                <a href="#" class="cabinet__remove-pkg"></a>
                            <?php else: ?>
                                <a href="#" class="cabinet__add-field"
                                   max-count="<?= (isset($services['count_phone']) ? $services['count_phone'] : ''); ?>"></a>
                            <?php endif; ?>
                            <p class="cabinet__add-company-form--notice"></p>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>
            </div>
        <?php }
        ?>


    </div>

    <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>


    <p class="cabinet__add-company-form--title">Email компании</p>
<?= $form->field($model, 'email')->textInput([
    'maxlength' => true,
    'class' => 'cabinet__add-company-form--field',
])->label(false) ?>
    <div class="cabinet__add-company-form--block"></div>

<?php
if (isset($services['group_link']) && $services['group_link'] == 1) { ?>
    <p class="cabinet__add-company-form--title">Соц. сети компании</p>
    <div class="cabinet__add-company-form--social">

    <?php
            foreach ($typeSeti as $type) {
                ?>
                <div class="cabinet__add-company-form--social-element">
                            <span class="social-wrap__item">
                                <img src="<?= $type->icon ?>" alt="">
                            </span>
                    <span class="social-name"><?= $type->name; ?></span>
                    <input type="text"
                           value="<?= !empty($socCompany[$type->id]->link) ? $socCompany[$type->id]->link : '' ?>"
                           name="socicon[<?= $type->id ?>][]" class="social-way">
                </div>
                <?php
            }
      ?>

    </div>
    <?php
}
?>

    <p class="cabinet__add-company-form--title">О компании</p>
<?php
if (isset($services['count_text'])) {
    if ($services['count_text'] != '-') {
        echo $form->field($model, 'descr')->textarea(
            [
                'class' => 'cabinet__add-company-form--text',
                'maxlength' => $services['count_text'],
            ]
        )->label(false);
    } else {
        echo $form->field($model, 'descr')->widget(CKEditor::className(), [
            //        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            //            'preset' => 'full',
            //            'inline' => false,
            //            'path' => 'frontend/web/media/upload',
            //        ]),
        ])->label(false);
    }

} else {
    echo $form->field($model, 'descr')->textarea(
        [
            'class' => 'cabinet__add-company-form--text',
            'maxlength' => 100,
        ]
    )->label(false);
}

?>


<?php

//echo '<label class="control-label">Добавить фото</label>';
if (isset($services['count_photo'])) {
    ?>
    <p class="cabinet__add-company-form--title">Загрузите фотографии вашей компании</p>
    <?php
    $preview = [];
    $previewConfig = [];
    if (!empty($img)) {
        foreach ($img as $i) {
            $preview[] = "<img src='$i->photo' class='file-preview-image'>";
            $previewConfig[] = [
                'caption' => '',
                'url' => '/company/company/delete-img?id=' . $i->id,
            ];
        }
    }

    echo FileInput::widget([
        'name' => 'fileCompanyPhoto[]',
        'id' => 'input-5',
        'attribute' => 'attachment_1',
        'value' => '@frontend/media/img/1.png',
        'options' => [
            'multiple' => true,
            'showCaption' => false,
            'showUpload' => false,
            'uploadAsync' => false,
        ],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['/site/upload_file']),
            'language' => "ru",
            'previewClass' => 'hasEdit',
            'uploadAsync' => false,
            'showUpload' => false,
            'dropZoneEnabled' => false,
            'overwriteInitial' => false,
            'maxFileCount' => $services['count_photo'],
            'maxFileSize' => 2000,
            'initialPreview' => $preview,
            'initialPreviewConfig' => $previewConfig,
        ],
    ]);
}

?>


<?php /*echo $form->field($model, 'descr')->widget(CKEditor::className(), [
//        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
//            'preset' => 'full',
//            'inline' => false,
//            'path' => 'frontend/web/media/upload',
//        ]),
])->label(false); */ ?>


<?= Html::submitButton('Сохранить', ['class' => 'cabinet__add-company-form--submit']) ?>
<?php ActiveForm::end(); ?>