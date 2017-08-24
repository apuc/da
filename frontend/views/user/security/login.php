<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                   $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module           $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row register">
    <div class="col-md-7 col-md-offset-3 register-form-container">
        <div class="panel panel-default">

            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id'                     => 'login-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validateOnBlur'         => false,
                    'validateOnType'         => false,
                    'validateOnChange'       => false,
                ]) ?>

                <?= $form->field($model, 'login', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]) ?>

                <?= $form->field($model, 'password', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])->passwordInput()->label(Yii::t('user', 'Password') )?>

                <?= Html::submitButton(Yii::t('user', 'Sign in'), ['class' => 'btn btn-primary btn-block', 'tabindex' => '3']) ?>

                <?php ActiveForm::end(); ?>
            </div>
            <p class="text-center mt">
                <?php if ($module->enableRegistration): ?>
                    <?= Html::a(Yii::t('sign', 'Sign up!'), ['/user/registration/register']) ?>
                <?php endif ?>
                <?php if($module->enablePasswordRecovery):; ?>
                    <?= Html::a(Yii::t('user', 'Forgot password?'), ['/user/recovery/request'], ['tabindex' => '5']) ; ?>
                <?php endif; ?>
            </p>
        </div>
        <?php /*if ($module->enableConfirmation): */?><!--
           <p class="text-center">
                <?/*= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) */?>
           </p>
        --><?php /*endif */?>

        <?= Connect::widget([
            'baseAuthUrl' => ['/user/security/auth'],
        ]) ?>
    </div>
</div>
