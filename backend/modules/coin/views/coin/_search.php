<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\coin\models\CoinSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'coin_id') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'image_url') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'symbol') ?>

    <?php // echo $form->field($model, 'coin_name') ?>

    <?php // echo $form->field($model, 'full_name') ?>

    <?php // echo $form->field($model, 'algorithm') ?>

    <?php // echo $form->field($model, 'proof_type') ?>

    <?php // echo $form->field($model, 'fully_premined') ?>

    <?php // echo $form->field($model, 'total_coin_supply') ?>

    <?php // echo $form->field($model, 'pre_mined_value') ?>

    <?php // echo $form->field($model, 'total_coins_free_float') ?>

    <?php // echo $form->field($model, 'sort_order') ?>

    <?php // echo $form->field($model, 'sponsored') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
