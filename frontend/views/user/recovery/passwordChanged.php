<?php
use yii\helpers\Url;

$this->title = $title;
?>

<section class="activation">
    <div class="container">
        <h1>Ваш пароль был успешно изменен</h1>

        <a href="<?= Url::to(['/user/login'])?>" class="activation__back">Для продолжения <span>Авторизируйтесь</span></a>
    </div>