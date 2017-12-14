<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $profile
 */

$this->title = Yii::t('user', 'Profile settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="cabinet__inner-box">

    <h3><?= Html::encode($this->title); ?></h3>

    <ul class="cabinet__tab-links">
        <li class="tab"><a href="<?= \yii\helpers\Url::to('/user/settings/profile')?>" class="active">Настройки профиля</a></li>
        <li class="tab"><a href="<?= \yii\helpers\Url::to('/user/settings/account')?>">Настройки аккаунта</a></li>
        <li class="tab"><a href="#">Настройки соц.сетей</a></li>
    </ul>

    <div class="business__tab-content">

        <?php $form = \yii\widgets\ActiveForm::begin([
                    'id' => 'profile-form',
                    'options' => ['class' => 'cabinet__add-company-form'],
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                ]); ?>

        <p class="cabinet__add-company-form--title">Имя пользователя</p>
        <?= $form->field($model, 'name')->textInput(['class' => 'cabinet__add-company-form--field'])->label(false); ?>

        <p class="cabinet__add-company-form--title">Публичный E-mail</p>
        <?= $form->field($model, 'public_email')->textInput(['class' => 'cabinet__add-company-form--field'])->label(false) ?>

        <p class="cabinet__add-company-form--title">Аватар</p>

            <?php
            if (empty($model->avatar)) {
                echo $form->field($model, 'avatar', [
                    'template' => '<label class="cabinet__add-company-form--add-foto">
                                        <span class="button"></span>
                                        {input}
                                        <img id="blah" src="" alt="" width="160px">
                                </label>'
                ])->label('Загрузить аватар с компютера')->fileInput();
            } else {
                echo $form->field($model, 'avatar', [
                    'template' => '<label class="cabinet__add-company-form--add-foto">
                                        <span class="button"></span>
                                        {input}
                                        <img id="blah" src="' . $model->avatar . '" alt="" width="160px">
                                </label>'
                ])->label('Загрузить аватар с компютера')->fileInput();
            }
            ?>


                <?= \yii\helpers\Html::submitButton(Yii::t('user', 'Save'),
                            ['class' => 'cabinet__add-company-form--submit']) ?>


        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>


</div>