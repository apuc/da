<?php

use common\models\db\ExchangeRatesType;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\exchange_rates\models\ExchangeRates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exchange-rates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currencies')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sale')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')
        ->dropDownList(ArrayHelper::map(ExchangeRatesType::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'up')->dropDownList([1=>'Вверх',2=>'Вниз',0=>'На месте']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
