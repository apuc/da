<?php

/**
 * @var $this yii\web\View
 * @var $model backend\modules\company\models\CompanyForm
 * @var $form yii\widgets\ActiveForm
 * @var $companyPhotos array
 * @var $companyPhotosStr string
 * @var $socials array
 * @var $soc SocCompany
 * @var $phone Phones
 */

use common\classes\Debug;
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use common\models\db\Lang;
use common\models\db\Messenger;
use common\models\db\Phones;
use common\models\db\Services;
use common\models\db\ServicesCompanyRelations;
use common\models\db\SocCompany;
use common\models\db\Tariff;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

//$this->registerJsFile('/theme/portal-donbassa/js/ajax.js', ['depends' => \yii\web\JqueryAsset::className()]);
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lang_id')->dropDownList(ArrayHelper::map(Lang::find()->all(), 'id', 'name')) ?>

    <span id="admin_company_category_box">
       <?php
       if (Yii::$app->controller->action->id === 'update' && isset($model->categories[0])): ?>
           <?= Html::dropDownList(
               'categ',
               $model->categories[0]->parent_id,
               ArrayHelper::map(CategoryCompany::find()->where(['lang_id' => 1, 'parent_id' => 0])->all(), 'id', 'title'),
               ['class' => 'form-control', 'id' => 'categ_company', 'prompt' => 'Выберите категорию']
           );?>
            <span id="admin_company_sub_category_box">
                <?= Html::dropDownList(
                    'sub_categ',
                    $model->categories[0]->id,
                    ArrayHelper::map(CategoryCompany::find()->where(['parent_id' => $model->categories[0]->parent_id])->all(), 'id', 'title'),
                    ['class' => 'form-control', 'id' => 'sub_categ_company', 'prompt' => 'Выберите категорию']
                ); ?>
            </span>

        <?php elseif(Yii::$app->controller->action->id === 'create' || !isset($model->categories[0])): ?>

               <?= Html::dropDownList(
                   'categ',
                   null,
                   ArrayHelper::map(CategoryCompany::find()->where(['lang_id' => 1, 'parent_id' => 0])->all(), 'id', 'title'),
                   ['class' => 'form-control', 'id' => 'categ_company', 'prompt' => 'Выберите категорию']
               ); ?>
           <span id="admin_company_sub_category_box"></span>
        <?php endif?>


    </span>
    <div style="margin-top: 20px;margin-bottom: 20px">


        <?= $form->field($model, 'cats')->textInput(['id' => 'all_cats', 'class' => 'form-control']) ?>
    </div>

    <?php if (Yii::$app->controller->action->id === 'update'): ?>
    <?php
    $cat = CategoryCompanyRelations::find()
        ->leftJoin('category_company', '`category_company_relations`.`cat_id` = `category_company`.`id`')
        ->where(['company_id' => $model->id])
        ->with('category_company')
        ->all();
    $arr = [];
    $i = 0;

    foreach ($cat as $c) {
        $arr[$i]['id'] = (!empty($c['category_company'])) ? $c['category_company']->id : "";
        $arr[$i]['title'] = (!empty($c['category_company'])) ? $c['category_company']->title : "";
        $i++;
    }
    echo Html::hiddenInput('_cats', json_encode($arr, JSON_UNESCAPED_UNICODE), ['id' => '_cats']);
    ?>
    <?php endif ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <label class="control-label" for="company-city_id">Начните вводить теги</label>
    <?= Select2::widget([
        'name' => 'Tags',
        'data' => ArrayHelper::map($tags, 'id', 'tag'),
        'value' => $tags_selected,
        //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
        'options' => ['placeholder' => 'Начните вводить теги ...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <label class="control-label" for="company-city_id">Начните вводить Ваш город</label>
    <?= Select2::widget([
        'name' => 'Company[city_id]',
        'attribute' => 'state_2',
        'data' => $city,
        'value' => $model->city_id,
        //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
        'options' => ['placeholder' => 'Начните вводить Ваш город ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'tariff_id')->dropDownList(
        ArrayHelper::map(Tariff::find()->all(), 'id', 'name'),
        ['prompt' => 'Выберите тариф']) ?>

    <div class="set-services-of-tariff">
        <?php if ($model->tariff_id == Tariff::ID_CUSTOM): ?>
            <?php $serviceChecked = ServicesCompanyRelations::find()->where(['company_id' => $model->id])
                ->asArray()
                ->all() ?>
            <?php $checked = ArrayHelper::getColumn($serviceChecked, 'services_id') ?>
            <?php $services = Services::find()->asArray()->all() ?>

            <?php foreach ($services as $service): ?>
                <div class="checkbox">
                    <label><input type="checkbox" name="services[][services_id]" value="<?= $service['id'] ?>"
                            <?php if (in_array($service['id'], $checked)): ?>
                                checked
                            <?php endif; ?>
                        ><?= $service['name'] ?></label>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <label>Дата окончания тарифа</label>
    <?php if (Yii::$app->controller->action->id === 'create'): ?>
    <?= DatePicker::widget([
        //'model' => $model,
        'name' => 'dt_end_tariff',
        'id' => 'dt_end_tariff',
        'attribute' => 'from_date',
        'language' => 'ru',
        'dateFormat' => 'dd-MM-yyyy',
    ]);
    ?>
    <?php else: ?>
    <?= DatePicker::widget([
        //'model' => $model,
        'name' => 'dt_end_tariff',
        'id' => 'dt_end_tariff',
        'attribute' => 'from_date',
        'language' => 'ru',
        'value' => $model->dt_end_tariff,
        'dateFormat' => 'dd-MM-yyyy',
    ]);
    ?>
    <?php endif; ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="phone-dynamic-input">
        <?= Html::label('Телефон', 'Phones', ['class' => 'control-label']) ?>
        <?php if (Yii::$app->controller->action->id == 'create'): ?>
            <div class="input-group multiply-field" data-id="0">
                <?= Html::textInput('Phones[0][phone]', '', ['class' => 'form-control']) ?>
                <?= Html::checkboxList('Phones[0][messengeres]', '', ArrayHelper::map(Messenger::find()->all(), "id", "name"),
                    [
                        'item' =>
                            function ($index, $label, $name, $checked, $value) {
                                return Html::checkbox("Phones[0][messengeresArray][]", $checked, [
                                    'value' => $value,
                                    'label' => $label,
                                    'labelOptions' => [
                                        'class' => 'ckbox ckbox-primary col-md-2',
                                    ],
                                ]);
                            },
                    ]);
                ?>
                <a href="#"
                   class="input-group-addon add-input-phone"
                   data-iterator="0">
                            <span class="glyphicon glyphicon-plus">
                            </span>
                </a>
            </div>
        <?php elseif (Yii::$app->controller->action->id == 'update'): ?>

            <?php if (!empty($phones)): ?>

                <?php foreach ($phones as $key => $phone): ?>
                    <div class="input-group <?= ($key == 0) ? 'multiply-field' : '' ?> " data-id="<?= $phone->id ?>">
                        <?= Html::hiddenInput('Phones[' . $phone->id . '][id]', $phone->id) ?>
                        <?= Html::textInput('Phones[' . $phone->id . '][phone]', $phone->phone, ['class' => 'form-control']) ?>
                        <?= Html::checkboxList('Phones[][messengeres]', $phone->messengeresArray, ArrayHelper::map(Messenger::find()->all(), "id", "name"),
                            [
                                'item' =>
                                    function ($index, $label, $name, $checked, $value) use ($phone) {
                                        return Html::checkbox("Phones[" . $phone->id . "][messengeresArray][]", $checked, [
                                            'value' => $value,
                                            'label' => $label,
                                            'labelOptions' => [
                                                'class' => 'ckbox ckbox-primary col-md-2',
                                            ],
                                        ]);
                                    },
                            ]);
                        ?>
                        <a href="#"
                           class="input-group-addon <?= ($key == 0) ? 'add' : 'remove' ?>-input-phone"
                           data-iterator="0">
                            <span class="glyphicon glyphicon-<?= ($key == 0) ? 'plus' : 'minus' ?> ">
                            </span>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="input-group multiply-field" data-id="0">
                    <?= Html::hiddenInput('Phones[0][id]', 0) ?>
                    <?= Html::textInput('Phones[0][phone]', '', ['class' => 'form-control']) ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


    <div class="imgUpload">
        <div class="media__upload_img"><img src="<?= $model->photo; ?>" width="100px"/></div>
        <?php
        echo InputFile::widget([
            'language' => 'ru',
            'controller' => 'elfinder',
            // вставляем название контроллера, по умолчанию равен elfinder
            'filter' => 'image',
            // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
            'name' => 'Company[photo]',
            'id' => 'company-photo',
            'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $model->photo,
            'buttonName' => 'Выбрать логотип',
        ]);
        ?>
    </div>
    <br/>


    <?= Html::label('Фото компании', 'input-5', ['class' => 'control-label']) ?>
    <div class="imgUpload">
        <div class="media__upload_img">
            <?php if (!$model->isNewRecord): ?>
                <?php foreach ($companyPhotos as $companyPhoto): ?>
                    <img src="<?= $companyPhoto ?>" alt="" width="100px">
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
        echo InputFile::widget([
            'language' => 'ru',
            'controller' => 'elfinder',
            // вставляем название контроллера, по умолчанию равен elfinder
            'filter' => 'image',
            // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
            'name' => 'company-photos',
            'id' => 'company-photos',
            'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImgs', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $model->isNewRecord ? '' : $companyPhotosStr,
            'buttonName' => 'Выбрать фотографии организации',
            'multiple' => true,
        ]);
        ?>
    </div>


    <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'descr')->widget(CKEditor::className(), [
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full',
            'inline' => false,
            'path' => 'frontend/web/media/upload',
        ]),
    ]); ?>


    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'meta_descr')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'vip')->dropDownList([0 => 'Стандарт', 1 => 'VIP'], ['class' => 'form-control']) ?>

    <?php
    if ($model->isNewRecord) {
        $model->user_id = 1;
    }
    ?>

    <?= $form->field($model, 'user_id')->widget(Select2::className(),
        [
            'attribute' => 'state_2',
            'data' => ArrayHelper::map(\dektrium\user\models\User::find()->all(), 'id', 'username'),
            'options' => ['placeholder' => 'Начните вводить логин пользователя ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]
    ); ?>
    <?php if ($model->tariff_id >= Tariff::ID_MAXIMUM): ?>
    <p class="cabinet__add-company-form--title"><b>Соц. сети компании</b></p>
    <div class="cabinet__add-company-form--social">
        <?php foreach ($socials as $key => $soc): ?>
            <div class="cabinet__add-company-form--social-element">
                <?= $form->field($soc, "[$key]link",
                    [
                        'template' => '<span class="social-wrap__item">
                                           <img src=' . "{$soc->getSocType()->one()->icon}" . ' alt="">
                                       </span>
                                   {label}
                                   {input}'
                    ])
                    ->textInput()
                    ->label($soc->getSocType()->one()->name); ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?= $form->field($model, 'recommended')->dropDownList([
        0 => 'Нет',
        1 => 'Да',
    ]) ?>

    <?= $form->field($model, 'main')->dropDownList([
        0 => 'Нет',
        1 => 'Да',
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        0 => 'Опубликована',
        1 => 'На модерации',
    ]) ?>

    <?= $form->field($model, 'verifikation')->checkbox(); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('company', 'Create') : Yii::t('company', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
