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
 * @var yii\web\View              $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\Module      $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row register">
    <div class="col-md-7 col-md-offset-3 register-form-container">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id'                     => 'registration-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]); ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'username')->label("Логин") ?>

                <?php if ($module->enableGeneratingPassword == false): ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                <?php endif ?>

                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
            </p>

            <div class="row-soc-text"><p>или войдите через соц.сеть</p></div>
            <div class="soc">
                <?= Connect::widget([
                    'baseAuthUrl' => ['/user/security/auth'],
                ]) ?>


            </div>
        </div>

    </div>
</div>
