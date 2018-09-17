<?php
use yii\helpers\Url;

?>
<section class="activation">

    <div class="container">

        <h1><?= Yii::t('user', 'Recovery link is invalid or expired. Please try requesting a new one.'); ?></h1>

        <!--<p class="activation__subtitle">Зарегистрируйтесь или войдите под своими данными</p>-->

        <div class="activation__actions">

            <a href="/" class="more_type">Главная</a>

            <a href="<?= Url::toRoute(['/user/recovery/request'])?>" class="more_type">Востановить пароль</a>

        </div>

    </div>

</section>