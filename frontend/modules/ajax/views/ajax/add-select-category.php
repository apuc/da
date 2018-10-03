<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$form = ActiveForm::begin(
    [
        'id' => 'create_news',
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

<div class="cabinet__add-company-form--hover-wrapper" >
    <!--<p class="cabinet__add-company-form--title">Категория</p>-->
    <?php $items= ArrayHelper::map($category, 'id', 'title');
    $param = ['class' => 'input-name selectCateg', 'prompt' => 'Выберите категорию'];
    echo $form->field($model, 'categoryId[]')
        ->dropDownList($items, $param)
        ->label('Категория'); ?>
    <a href="" class="cabinet__remove-pkg delselectCateg" style="z-index: 1;position: absolute;top: 16px;right: -30px;"></a>
    <!--<p class="cabinet__add-company-form--notice"></p>-->
</div>
<br />
