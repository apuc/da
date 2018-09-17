<?php

use common\models\db\Company;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\company_feedback\models\CompanyFeedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(User::getList()) ?>

    <?= $form->field($model, 'company_id')->dropDownList(Company::getList()) ?>

    <?= $form->field($model, 'feedback')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['0' => 'Не опубликовано', '1' => 'Опубликовано']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
