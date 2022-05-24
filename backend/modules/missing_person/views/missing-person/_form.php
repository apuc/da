<?php

use backend\modules\missing_person\MissingPerson;
use common\models\db\GeobaseCity;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;


/** @var $model MissingPerson */
?>
<div style="width: 30%">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fio')->textInput(); ?>
    <?= $form->field($model, 'date_of_birth')->widget(
        DatePicker::class,
        [
            'model' => $model,
            'attribute' => 'date_of_birth',
            'value' => $model->date_of_birth,
            'clientOptions' => [
                'language' => 'ru',
                'format' => 'dd.mm.yyyy',
            ],
        ]
    ) ?>
    <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(GeobaseCity::find()->orderBy('name')->all(), 'id', 'name')) ?>
    <?= $form->field($model, 'additional_info')->textarea(); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>