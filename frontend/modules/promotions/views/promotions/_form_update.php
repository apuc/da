<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\company\models\Company;

/* @var $this yii\web\View */
/* @var $model frontend\modules\company\models\Company */
/* @var $form yii\widgets\ActiveForm */
/* @var $beforeCreate array */
?>

<? if ($beforeCreate): ?>
    <?php

    $form = ActiveForm::begin(
        [
            'options' => [
                'class' => 'cabinet__add-company-form',
                'enctype' => 'multipart/form-data',
            ],
        ]);
    ?>

    <?php
    /*
    if($beforeCreate)
    {

        echo Html::dropDownList(
            'Stock[company_id]',
            null,
            ArrayHelper::map(Company::find()->where(['in', 'id', $company_id])->all(),'id','name'),
            ['class'=>'cabinet__add-company-form--field', 'id'=>'promotions', 'prompt' => 'Выберите предприятие']
        );
    }*/

    $company_id = array_keys($beforeCreate);
    ?>

    <p class="cabinet__add-company-form--title">Ваши предприятия</p>
    <?= $form->field($model, 'company_id')->dropDownList(
        ArrayHelper::map(Company::find()->where(['in', 'id', $company_id])->all(), 'id', 'name'),
        ['class' => 'cabinet__add-company-form--field', 'id' => 'promotions', 'prompt' => 'Выберите предприятие'])
        ->label(false) ?>

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Заголовок акции</p>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false) ?>

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Ссылка</p>
    <?= $form->field($model, 'link')->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false) ?>

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Дата акции</p>
    <?= $form->field($model, 'dt_event')->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false) ?>

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Фото акции</p>
    <input type="hidden" name="photo" id="" value="<?= $model->photo; ?>">
    <?php echo $form->field($model, 'photo', [
        'template' => '<label class="cabinet__add-company-form--add-foto">
                                        <span class="button"></span>
                                        {input}
                                        <img id="blah" src="' . $model->photo . '" alt="" width="160px">
                                        </label>'
    ])->label(false)->fileInput();
    ?>

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Акционное предложение</p>
    <?= $form->field($model, 'short_descr')->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false) ?>

    <div class="cabinet__add-company-form--block"></div>

    <div class="cabinet__add-company-form--block"></div>
    <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>

    <p class="cabinet__add-company-form--title">Подробное описание</p>
    <div style="width: calc(100% - 165px)">
        <?php echo $form->field($model, 'descr')
            ->widget(CKEditor::className(), [
                'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
                    'preset' => 'basic',
                    'inline' => false,
                    'path' => 'frontend/web/media/upload',
                ]),
            ])
            ->label(false); ?>
    </div>

    <?= Html::submitButton('Сохранить', ['class' => 'cabinet__add-company-form--submit']) ?>
    <?php ActiveForm::end(); ?>
<? else: ?>
    <div class="blanket__content">
        <div class="blanket__content__wrap">
            <img src="/theme/portal-donbassa/img/blanket/ban.png" alt="">
            <h2>У Вас нет приедприятий для
                добавления акции</h2>
        </div>
        <a href="<?= \yii\helpers\Url::to(['/company/company/create']) ?>">Добавить предприятие</a>
        <p>После прохождения модерации вашей компании, вы сможете добавить новые акции</p>
    </div>
<? endif; ?>
