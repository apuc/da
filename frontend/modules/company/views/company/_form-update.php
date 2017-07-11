<?php

use common\models\db\CategoryCompany;
use common\models\db\Lang;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\company\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(
    [
        'options' => [
            'class' => 'cabinet__add-company-form',
            'enctype' => 'multipart/form-data',
        ],
    ]);
?>

<?= $form->field($model, 'slug')->hiddenInput()->label(false); ?>
    <input type="hidden" name="photo" id="" value="<?= $model->photo; ?>">
    <p class="cabinet__add-company-form--title">Категория компании</p>
<?php
echo Html::dropDownList(
    'categ',
    $selectCat->id,
    ArrayHelper::map(CategoryCompany::find()->where(['lang_id' => 1, 'parent_id' => '0'])->all(),'id','title'),
    ['class'=>'cabinet__add-company-form--field', 'id'=>'categ_company', 'prompt' => 'Выберите категорию']
);
?>
    <div class="cabinet__add-company-form--block"></div>

    <span class="addParentCategory" style="width: 100%;">

        <div class="cabinet__add-company-form--hover-wrapper" >
            <p class="cabinet__add-company-form--title">Категория</p>
                    <?= Html::dropDownList(
                        'categParent',
                        $selectParentCat->id,
                        ArrayHelper::map(CategoryCompany::find()->where(['parent_id' => $selectCat->id])->all(), 'id', 'title'),
                        ['class' => 'cabinet__add-company-form--field selectCateg', 'prompt' => 'Выберите категорию']

                    )?>
            <p class="cabinet__add-company-form--notice"></p>
        </div>
        <br />

    </span>


    <p class="cabinet__add-company-form--title">Название компании</p>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false) ?>
    <div class="cabinet__add-company-form--block"></div>


    <div class="cabinet__add-company-form--wrapper">
        <p class="cabinet__add-company-form--title">Адрес компании</p>
        <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false) ?>

        <!-- <a href="#" class="cabinet__add-field"></a>-->

    </div>
    <p class="cabinet__add-company-form--title">Логотип компании</p>

<?php
    echo $form->field($model, 'photo', [
        'template' => '<label class="cabinet__add-company-form--add-foto">
                                        <span class="button"></span>
                                        {input}
                                        <img id="blah" src="' . $model->photo . '" alt="" width="160px">
                                        </label>'
    ])->label(false)->fileInput();

?>

    <div class="cabinet__add-company-form--block"></div>


    <div class="cabinet__add-company-form--wrapper">

        <p class="cabinet__add-company-form--title">Телефон</p>
        <?php $phone = explode(' ', $model->phone);
       // \common\classes\Debug::prn($phone);
        foreach ($phone as $item):?>
            <?php if(!empty($item) ):?>
                <input value="<?= $item; ?>" class="cabinet__add-company-form--field" name="mytext[]" type="text">
            <?php endif; ?>

        <?php endforeach; ?>



        <a href="#" class="cabinet__add-field" max-count="<?= (isset($services['count_phone']) ? $services['count_phone'] : ''); ?>"></a>

    </div>

    <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>

    <p class="cabinet__add-company-form--title">О компании</p>
<?php
    if(isset($services['count_text'])) {
        if($services['count_text'] != '-'){
            echo $form->field($model, 'descr')->textarea(
                [
                    'class' => 'cabinet__add-company-form--text',
                    'maxlength' => $services['count_text']
                ]
            )->label(false);
        }else{
            echo $form->field($model, 'descr')->widget(CKEditor::className(), [
            //        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            //            'preset' => 'full',
            //            'inline' => false,
            //            'path' => 'frontend/web/media/upload',
            //        ]),
            ])->label(false);
        }

    }else{
        echo $form->field($model, 'descr')->textarea(
            [
                'class' => 'cabinet__add-company-form--text',
                'maxlength' => 100
            ]
        )->label(false);
    }

?>


<?php

//echo '<label class="control-label">Добавить фото</label>';

if(isset($services['count_photo'])){
    ?>
    <p class="cabinet__add-company-form--title">Загрузите фотографии вашей компании</p>
    <?php
    $preview = [];
    $previewConfig = [];
    if(!empty($img)){
        foreach($img as $i){
            $preview[] = "<img src='$i->photo' class='file-preview-image'>";
            $previewConfig[] = [
                'caption' => '',
                'url' => '/secure/about/default/delete_file?id=' . $i->id
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
            'uploadAsync'=> false,
        ],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['/site/upload_file']),
            'language' => "ru",
            'previewClass' => 'hasEdit',
            'uploadAsync'=> false,
            'showUpload' => false,
            'dropZoneEnabled' => false,
            'overwriteInitial' => false,
            'maxFileCount' => $services['count_photo'],
            'maxFileSize'=> 2000,
            'initialPreview' => $preview,
            'initialPreviewConfig' => $previewConfig
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
])->label(false); */?>


<?= Html::submitButton('Сохранить', ['class' => 'cabinet__add-company-form--submit']) ?>
<?php ActiveForm::end(); ?>