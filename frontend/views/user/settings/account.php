<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/*
 * @var $this  yii\web\View
 * @var $form  yii\widgets\ActiveForm
 * @var $model dektrium\user\models\SettingsForm
 */

$this->title = Yii::t('user', 'Account settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>



<div class="cabinet__inner-box">

    <h3><?= Html::encode($this->title); ?></h3>

    <ul class="cabinet__tab-links">
        <li class="tab"><a href="<?= \yii\helpers\Url::to('/user/settings/profile')?>">Настройки профиля</a></li>
        <li class="tab"><a href="<?= \yii\helpers\Url::to('/user/settings/account')?>" class="active">Настройки аккаунта</a></li>
        <li class="tab"><a href="<?= \yii\helpers\Url::to('/user/settings/networks')?>">Настройки соц.сетей</a></li>
    </ul>

    <div class="business__tab-content">

        <?php $form = ActiveForm::begin([
                    'id'          => 'account-form',
                    'options'     => ['class' => 'cabinet__add-company-form'],
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]); ?>

        <p class="cabinet__add-company-form--title">Логин</p>
        <?= $form->field($model, 'username')->textInput(['class' => 'cabinet__add-company-form--field'])->label(false) ?>


        <p class="cabinet__add-company-form--title">E-mail</p>
        <?= $form->field($model, 'email')->textInput(['class' => 'cabinet__add-company-form--field'])->label(false) ?>


        <p class="cabinet__add-company-form--title">Новый пароль</p>
        <?= $form->field($model, 'new_password')->passwordInput(['class' => 'cabinet__add-company-form--field'])->label(false) ?>

        <div class="separator"></div>

        <p class="cabinet__add-company-form--title">Текущий пароль</p>
        <?= $form->field($model, 'current_password')->passwordInput(['class' => 'cabinet__add-company-form--field'])->label(false) ?>

        <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'cabinet__add-company-form--submit']) ?><br>

        <?php ActiveForm::end(); ?>

    </div>


</div>