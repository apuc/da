<?php

$this->title = "Регистрация";
use yii\helpers\Html;
?>

        <div class="row">

            <div class="reg__content">

                <h3 class="reg__content--subtitle">Сейчас вы должны активировать ваш аккаунт!</h3>

            </div>

            <p class="reg--reminder">Перейдите по ссылке, которую мы Вам только что выслали. Если не найдёте письма в
                почте, проверьте Спам.</p>

            <a href="http://www.<?= $link; ?>" target="_blank" class="reg__form--btn">проверить e-mail</a>

            <p class="reg--back">Назад на <a href="/">главную страницу</a></p>
            <p class="reg--reminder">Не получили письмо?</p>
            <?= Html::a('Отправить еще раз', \yii\helpers\Url::toRoute('/resend'),['class' => 'reg__form--btn']) ?>
        </div>
