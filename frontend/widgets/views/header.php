<?php
use frontend\widgets\ExchangeRates;
use yii\helpers\Url;
use common\models\User;
?>
<section class="header">
    <div class="container">

        <?php if(Yii::$app->controller->module->id == 'mainpage'): ?>
            <h1 class="header-logo">
                <img src="/theme/portal-donbassa/img/logo.png" alt="">
            </h1>
        <?php else:?>
            <a href="/" class="header-logo">

                <img src="/theme/portal-donbassa/img/logo.png" alt="">
            </a>
        <?php endif;?>
        <div class="header-ipanel">
            <div class="select">
                <select class="" name="">
                    <option value="">Донецк</option>
                    <option value="">Макеевка</option>
                </select>
            </div>
            <?= \frontend\widgets\WeatherHeader::widget(); ?>
            <?= ExchangeRates::widget() ?>
            <form action="<?= Url::to(['/search/search/index'])?>" method="get">
                <input class="search-input" type="text" placeholder="Поиск" name="request">
                <!--<input type="hidden" name="_csrf" value="<?/*= Yii::$app->request->csrfToken; */?>">-->
                <?php if (Yii::$app->user->isGuest): ?>
                    <a href="<?= Url::to(['/user/login']) ?>">
                        <span class="autoriz-icon"></span>
                        авторизация
                    </a>
                <?php else: ?>
                    <a id="authorized-user-profile" href="<?= Url::to(['/personal_area/default/index']) ?>">
                        <span class="autoriz-icon"></span>
                        <?= Yii::$app->user->identity->username; ?>
                    </a>

                    <div class="currency-panel__submenu">
                        <a href="<?= Url::to('/personal_area/default/index')?>">ПРОФИЛЬ</a>
                        <a href="<?= \yii\helpers\Url::to(['/personal_area/user-news'])?>">НОВОСТИ</a>
                        <a href="#">АФИШИ</a>
                        <a href="#">АКЦИИ</a>
                        <a href="<?= \yii\helpers\Url::to(['/personal_area/user-company'])?>">ПРЕДПРИЯТИЯ</a>
                        <a href="<?= \yii\helpers\Url::to(['/personal_area/user-comments'])?>">КОМЕНТАРИИ</a>
                        <!--<a href="#">Настройки</a>-->
                        <a data-method="post" href="<?= Url::to(['/site/logout']) ?>">выход</a>
                    </div>
                <?php endif; ?>
            </form>
        </div>
        <?php echo \frontend\widgets\MainMenu::widget() ?>

    </div>
</section>