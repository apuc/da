<?php

use common\models\db\Currency;
use common\models\db\CurrencyCoin;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Currency */
/* @var $coin CurrencyCoin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'char_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatuses()) ?>

    <?= $form->field($model, 'type')->dropDownList($model->getTypes()) ?>

    <?php if ($model->type == Currency::TYPE_COIN) : ?>

        <h4><?= Yii::t('currency', 'Coin') ?></h4>
        <hr/>

        <?= $form->field($coin, 'url')->textInput(['maxlength' => true]) ?>

        <?= $form->field($coin, 'image_url')->textInput(['maxlength' => true]) ?>

        <?= $form->field($coin, 'symbol')->textInput(['maxlength' => true]) ?>

        <?= $form->field($coin, 'full_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($coin, 'algorithm')->textInput(['maxlength' => true]) ?>

        <?= $form->field($coin, 'proof_type')->textInput(['maxlength' => true]) ?>

        <?= $form->field($coin, 'fully_premined')->textInput() ?>

        <?= $form->field($coin, 'total_coin_supply')->textInput(['maxlength' => true]) ?>

        <?= $form->field($coin, 'pre_mined_value')->textInput() ?>

        <?= $form->field($coin, 'total_coins_free_float')->textInput() ?>

        <?= $form->field($coin, 'sort_order')->textInput() ?>

        <?= $form->field($coin, 'sponsored')->textInput() ?>

    <?php endif; ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            Yii::t('currency', 'Create') :
            Yii::t('currency', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
