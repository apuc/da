<?php

use common\models\db\CategoryCompany;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(
    [
        'id' => 'create_company',
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

echo $form->field($model, 'parentCateg')
    ->dropDownList(
        ArrayHelper::map(CategoryCompany::find()->where(['lang_id' => 1, 'parent_id' => $catId])->all(), 'id',
            'title'),
        ['prompt' => 'Выберите категорию']
    )->hint('Выберите категорию')->label();