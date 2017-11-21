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

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?php if(!$model->isNewRecord): ?>
        <?= $form->field($model, 'title')->textInput() ?>

        <?= $form->field($model, 'meta_descr')->textInput() ?>

        <?= $form->field($model, 'comment_status')->checkbox() ?>
    <?php endif; ?>

    <?= $form->field($model, 'status')->dropDownList([
        0 => 'На модерации',
        1 => 'Опубликовано',
        2 => 'На публикации',
        3 => 'В корзине']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
