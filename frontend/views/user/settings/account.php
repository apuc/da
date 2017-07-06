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

<!--<div class="row profile-account-settings">
    <div class="col-md-4 toggle-menu">
        <?/*= $this->render('_menu') */?>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default settings">
            <div class="panel-heading">
                <?/*= Html::encode($this->title) */?>
            </div>
            <div class="panel-body">
                <?php /*$form = ActiveForm::begin([
                    'id'          => 'account-form',
                    'options'     => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template'     => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]); */?>

                <?/*= $form->field($model, 'email') */?>

                <?/*= $form->field($model, 'username') */?>

                <?/*= $form->field($model, 'new_password')->passwordInput() */?>

                <hr />

                <?/*= $form->field($model, 'current_password')->passwordInput() */?>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <?/*= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-block btn-success']) */?><br>
                    </div>
                </div>

                <?php /*ActiveForm::end(); */?>
            </div>
        </div>
    </div>
</div>-->

<div class="cabinet__inner-box">

    <h3><?= Html::encode($this->title); ?></h3>

    <ul class="cabinet__tab-links">
        <li class="tab"><a href="<?= \yii\helpers\Url::to('/user/settings/profile')?>">Настройки профиля</a></li>
        <li class="tab"><a href="<?= \yii\helpers\Url::to('/user/settings/account')?>" class="active">Настройки аккаунта</a></li>
        <li class="tab"><a href="#">Настройки соц.сетей</a></li>
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
        <div class="cabinet__add-company-form--block"></div>
        <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'cabinet__add-company-form--submit']) ?><br>

        <?php ActiveForm::end(); ?>



        <!--<form class="cabinet__add-company-form">

            <p class="cabinet__add-company-form--title">Логин</p>

            <input class="cabinet__add-company-form--field" type="text">

            <div class="cabinet__add-company-form--block"></div>

            <p class="cabinet__add-company-form--title">E-mail</p>

            <input class="cabinet__add-company-form--field" type="text">

            <div class="cabinet__add-company-form--block"></div>

            <p class="cabinet__add-company-form--title">Новый пароль</p>

            <input class="cabinet__add-company-form--field" type="text">

            <div class="cabinet__add-company-form--block"></div>

            <div class="separator"></div>

            <p class="cabinet__add-company-form--title">Текущий пароль</p>

            <input class="cabinet__add-company-form--field" type="text">

            <div class="cabinet__add-company-form--block"></div>

            <input type="submit" class="cabinet__add-company-form--submit" value="сохранить">

        </form>-->

        <!--  </div>-->

        <!--<div id="setting-socials" class="business__tab-content&#45;&#45;wrapper">-->

        <!--<div class="cabinet__container">

            <p>Вы можете подключить несколько аккаунтов, чтобы использовать их для входа</p>

            <div class="row-soc">
                                <span class="social-wrap__item vk">
                                  <img src="img/soc/vk.png" alt="">
                                </span>
                <a href="#" class="row-soc__add">
                    <span>подключить</span>
                </a>

            </div>

            <div class="row-soc">
                                <span class="social-wrap__item fb">
                                  <img src="img/soc/fb.png" alt="">
                                </span>
                <a href="#" class="row-soc__add">
                    <span>подключить</span>
                </a>
            </div>

            <div class="row-soc">
                                <span class="social-wrap__item ok">
                                  <img src="img/soc/ok-icon.png" alt="">
                                </span>
                <a href="#" class="check-button"><span class="black-check"></span>Подключено</a>
            </div>


        </div>-->

        <!--</div>-->

    </div>


</div>