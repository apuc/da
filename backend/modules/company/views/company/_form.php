<?php

use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use common\models\db\Lang;
use kartik\file\FileInput;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\Company */
/* @var $form yii\widgets\ActiveForm */
/* @var $companyPhotos array */
/* @var $companyPhotosStr string */
//$this->registerJsFile('/theme/portal-donbassa/js/ajax.js', ['depends' => \yii\web\JqueryAsset::className()]);
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lang_id')->dropDownList(ArrayHelper::map(Lang::find()->all(), 'id', 'name')) ?>

    <span id="admin_company_category_box">
        <?php
        echo Html::dropDownList(
            'categ',
            null,
            ArrayHelper::map(CategoryCompany::find()->where(['lang_id' => 1, 'parent_id' => 0])->all(), 'id', 'title'),
            ['class' => 'form-control', 'id' => 'categ_company', 'prompt' => 'Выберите категорию']
        );
        ?>

        <span id="admin_company_sub_category_box"></span>
    </span>
    <div style="margin-top: 20px;margin-bottom: 20px">
        <?= Html::textInput('cats', null, [
            'class' => 'form-control',
            'id' => 'all_cats',
        ]) ?>
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
        ArrayHelper::map(\common\models\db\Tariff::find()->all(), 'id', 'name'),
        ['prompt' => 'Выберите тариф']) ?>

    <div class="set-services-of-tariff">
        <?php if ($model->tariff_id == 4): ?>
            <?php $serviceChecked = \common\models\db\ServicesCompanyRelations::find()->where(['company_id' => $model->id])
                ->asArray()
                ->all() ?>
            <?php $checked = ArrayHelper::getColumn($serviceChecked, 'services_id') ?>
            <?php $services = \common\models\db\Services::find()->asArray()->all() ?>

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
    <?= Html::label('Старый телефон', 'mytext', ['class' => 'control-label']) ?>
    <textarea class="form-control"><?= $model->phone ?></textarea>
    <div class="phone-dynamic-input">

        <?= Html::label('Телефон', 'mytext', ['class' => 'control-label']) ?>
        <?php if (Yii::$app->controller->action->id == 'create'): ?>
            <div class="input-group multiply-field">
                <input value="" class="form-control" name="mytext[]" type="text">
                <a href="#" class="input-group-addon add-input-phone"><span class="glyphicon glyphicon-plus"></span></a>
            </div>

        <?php elseif (Yii::$app->controller->action->id == 'update'): ?>

            <?php if (!empty($phones)): ?>

                <?php foreach ($phones as $key => $phone): ?>
                    <div class="input-group <?= ($key == 0) ? 'multiply-field' : '' ?> ">
                        <input value="<?= $phone->phone ?>" class="form-control" name="mytext[]" type="text">
                        <a href="#" class="input-group-addon <?= ($key == 0) ? 'add' : 'remove' ?>-input-phone"><span
                                    class="glyphicon glyphicon-<?= ($key == 0) ? 'plus' : 'minus' ?> "></span></a>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="input-group multiply-field">
                    <input value="" class="form-control" name="mytext[]" type="text">
                    <a href="#" class="input-group-addon add-input-phone"><span class="glyphicon glyphicon-plus"></span></a>
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
    <br>
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

    <?php echo $form->field($model, 'descr')->widget(CKEditor::className(), [
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
    <p class="cabinet__add-company-form--title"><b>Соц. сети компании</b></p>
    <div class="cabinet__add-company-form--social">

        <?php foreach ($typeSeti as $type): ?>
            <div class="cabinet__add-company-form--social-element">
                            <span class="social-wrap__item">
                                <img src="<?= $type->icon ?>" alt="">
                            </span>
                <span class="social-name"><?= $type->name; ?></span>
                <input type="text"
                       value="<?= !empty($socCompany[$type->id]->link) ? $socCompany[$type->id]->link : '' ?>"
                       name="socicon[<?= $type->id ?>][]" class="social-way">
            </div>
        <?php endforeach; ?>
    </div>

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
