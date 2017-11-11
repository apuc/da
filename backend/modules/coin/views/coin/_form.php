<?php

use common\models\db\Coin;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\coin\models\Coin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'coin_id')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'symbol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coin_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'algorithm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proof_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fully_premined')->textInput() ?>

    <?= $form->field($model, 'total_coin_supply')->textInput() ?>

    <?= $form->field($model, 'pre_mined_value')->textInput() ?>

    <?= $form->field($model, 'total_coins_free_float')->textInput() ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'sponsored')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([
        Coin::STATUS_NO_ACTIVE => 'Скрыта',
        Coin::STATUS_ACTIVE => 'Доступна для показа',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            Yii::t('coin', 'Create') : Yii::t('coin', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
