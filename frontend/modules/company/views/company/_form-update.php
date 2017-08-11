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

    <p class="cabinet__add-company-form--title">Город компании</p>
    <div class="cabinet__add-company-form--select-wrapper">
        <?= Select2::widget([
            'name' => 'Company[city_id]',
            'attribute' => 'state_2',
            'data' => $city,
            'value' => $model->city_id,
            //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
            'options' => ['placeholder' => 'Начните вводить город ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>

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
        <?php // $phone = explode(' ', $model->phone);
                if (!empty($model->allPhones))
                {
                    $phone = $model->allPhones;
                }

        if(empty($phone[0])){ ?>
            <input value="" class="cabinet__add-company-form--field" name="mytext[]" type="text">
            <a href="#" class="cabinet__add-field" max-count="<?= (isset($services['count_phone']) ? $services['count_phone'] : ''); ?>"></a>
                <!--<a href="#" class="cabinet__remove-pkg"></a>-->
        <?php }
        else{?>
            <div class="cabinet__add-company-form--hover-wrapper">
            <?foreach ($phone as $key => $item):?>
                <?php if(!empty($item) ):?>

                    <div class="cabinet__add-company-form--hover-elements">
                        <p class="cabinet__add-company-form--title"></p>
                    <input value="<?= $item->phone; ?>" class="cabinet__add-company-form--field" name="mytext[]" type="text">
                    <?if($key != 0):?>
                    <a href="#" class="cabinet__remove-pkg"></a>
                        <?else:?>
                        <a href="#" class="cabinet__add-field" max-count="<?= (isset($services['count_phone']) ? $services['count_phone'] : ''); ?>"></a>
                        <?endif;?>
                    <p class="cabinet__add-company-form--notice"></p>
                    </div>
                <?php endif; ?>

            <?php endforeach;?>
            </div>
       <? }
        ?>



    </div>

    <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>


    <p class="cabinet__add-company-form--title">Email компании</p>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false) ?>
    <div class="cabinet__add-company-form--block"></div>


    <p class="cabinet__add-company-form--title">Соц. сети компании</p>
    <div class="cabinet__add-company-form--social">
        <?php
        if(isset($services['group_link']) && $services['group_link'] == 1){

            foreach ($typeSeti as $type){
                ?>
                <div class="cabinet__add-company-form--social-element">
                            <span class="social-wrap__item">
                                <img src="<?= $type->icon ?>" alt="">
                            </span>
                    <span class="social-name"><?= $type->name; ?></span>
                    <input type="text" value="<?= !empty($socCompany[$type->id]->link) ? $socCompany[$type->id]->link : ''?>" name="socicon[<?= $type->id?>][]" class="social-way">
                </div>
                <?php
            }
        }
        ?>

    </div>



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
                'url' => '/company/company/delete-img?id=' . $i->id
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