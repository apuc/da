<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\instagram\models\InstPhoto */
/* @var $form yii\widgets\ActiveForm */
?>


<?= Html::img($model->photo_url) ?>

<div class="inst-photo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'photo_url')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'author_name')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'author_img')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'pub_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'caption')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
