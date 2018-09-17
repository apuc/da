<?php
use yii\helpers\Url;

$this->title = "Пользователя не существует";
?>

<section class="activation">

    <div class="container">

        <h1>Пользователя с таким Email не существует на нашем сайте!</h1>

        <p class="activation__subtitle">Зарегистрируйтесь или войдите под своими данными</p>

        <div class="activation__actions">

            <a href="<?= Url::toRoute('/user/register') ?>" class="more_type">регистрация</a>

            <a href="<?= Url::toRoute(['/user/login'])?>" class="more_type">вход</a>

        </div>

    </div>

</section>