<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\classes\Debug;

/* @var $this yii\web\View */
/* @var $model backend\modules\vk\models\VkStream */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vk-stream-form">

    <?php $form = ActiveForm::begin(); ?>

    <?/*= $form->field($model, 'vk_id')->textInput(['maxlength' => true]) */?><!--

    <?/*= $form->field($model, 'from_id')->textInput() */?>

    <?/*= $form->field($model, 'owner_id')->textInput() */?>

    <?/*= $form->field($model, 'owner_type')->textInput() */?>

    --><?/*= $form->field($model, 'dt_add')->textInput() */?>

    <?/*= $form->field($model, 'post_type')->textInput(['maxlength' => true]) */?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="dt_public_box_link"><a href="#">Отложенная публикация</a></div>
    <div class="dt_public_box">
        <?= $form->field($model, 'dt_publish')->input('date', ['class' => 'form-control', 'value' => 123]) ?>
        <?= Html::input('text', 'dt_publish_time', date(''),
            ['id' => 'dt_public_time', 'class' => 'form-control', 'placeholder' => 'Время']) ?>
    </div>

    <? if(!$model->isNewRecord): ?>
        <?= $form->field($model, 'title')->textInput() ?>

        <?= $form->field($model, 'meta_descr')->textInput() ?>

        <?= $form->field($model, 'comment_status')->checkbox() ?>

        <?= $form->field($model, 'rss')->checkbox() ?>
    <? endif; ?>

    <?/*= $form->field($model, 'from_type')->textInput() */?>

    <?= $form->field($model, 'status')->dropDownList([
        0 => 'На модерации',
        1 => 'Опубликовано',
        2 => 'На публикации',
        3 => 'В корзине']) ?>

    <?/*= $form->field($model, 'views')->textInput() */?><!--

    --><?/*= $form->field($model, 'likes')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
