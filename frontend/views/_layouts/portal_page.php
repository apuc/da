<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\ExchangeRates;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta name="yandex-verification" content="6102a93fabadb2cf" />
    <?= \frontend\widgets\Metrika::widget() ?>
    <style>
        .mnu-link a {
            color: whitesmoke !important;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<section class="header__top">
    <div class="container">
        <div class="city">
            <p class="city-string"><span class="geo-city"></span></p>
            <div class="delivery_block">
                <div class="delivery_list">
                    <span>Донецк</span></div>
                <ul class="cities_list">
                    <li>Макеевка</li>
                    <li>Луганск</li>
                    <li>Транпорт</li>
                    <li>Казань</li>
                </ul>
            </div>
<!--            <p class="weather"><span class="sun"></span>+25</p>-->
            <ul class="social-head">
                <li><a href="https://www.facebook.com/da.info.pro/" class="circle"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="https://vk.com/da_info_pro" class="circle"><i class="fa fa-vk" aria-hidden="true"></i></a></li>
                <li><a href="https://www.facebook.com/da.info.pro/" class="circle"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="https://www.instagram.com/da.info.pro/" class="circle"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="https://ok.ru/da...infor" class="circle"><i class="fa fa-odnoklassniki" aria-hidden="true"></i> </a></li>
                <!--<li><a href="" class="circle"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                <li><a href="" class="circle"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>-->
            </ul>
        </div>
        <?= ExchangeRates::widget() ?>
        <div class="search">
            <form action="">
                <span class="search-icon"></span>
                <input type="search" placeholder="поиск">
            </form>
        </div>
        <?= \frontend\widgets\Sign::widget() ?>
    </div>
</section>
<section class="header__main">
    <div>
        <a href="/" class="header__main_logo"><img width="72%" src="/theme/portal-donbassa/img/logo3.png" alt=""></a>
        <div class="header__main_panel" style="width: 70%">
            <?php echo \frontend\widgets\MainMenu::widget() ?>
        </div>
    </div>
</section>
<section class="header__menu">
    <div class="container">
        <button class="toggle_mnu">
        <span class="sandwich">
          <span class="sw-topper"></span>
          <span class="sw-bottom"></span>
          <span class="sw-footer"></span>
        </span>
        </button>

    </div>
</section>
<!--<section class="header-menu-bot">-->
<!--    --><?//= \frontend\widgets\MainSubMenu::widget() ?>
<!--</section>-->
<!--<section class="header__banner">-->
<!--    <img src="/theme/portal-donbassa/img/banner.png" alt="">-->
<!--    </div>-->
<!--</section>-->
<section class="title">
    <div class="container">
        <div class="title-left-side">
            <h1><?= \frontend\widgets\GenerateH1::widget() ?></h1>
            <div class="title-right">
                <?= \frontend\widgets\GenerateTitleMenu::widget(); ?>
            </div>
        </div>
        <div class="popular-container">
            <a href="" class="popular"><span></span>Популярные заведения</a>
        </div>
    </div>
</section>
<section class="content">
    <div class="container">
        <div class="content__main">

            <?= $content ?>

            <!--<div class="banner-bottom">
                <img src="/theme/portal-donbassa/img/banner-bottom.png" alt="">
            </div>-->
        </div>

        <div class="right-bar">
            <div class="poll">
                <?= \frontend\widgets\Poll::widget() ?>
            </div>
            <h2>топ лучших</h2>
            <!--<a href="<?/*= Url::to(['/company/company/create']) */?>" class="add-ad">Добавить предприятие </a>-->

            <div class="right-bar__ad">
                <?= \frontend\widgets\TopCompanyWidget::widget() ?>
                <div class="white-overlay">
                    <a class="add-ad" href="">ДОБАВИТЬ ОБЪЯВЛЕНИЕ</a>
                </div>
                <?= \frontend\modules\news\widgets\NewsArchive::widget() ?>
            </div>

    </div>
</section>

<section class="footer">
    <div class="container">
        <a href="http://da-info.pro/" class="footer-main_logo"><img width="122px" src="/theme/portal-donbassa/img/logo3.png" alt=""></a>
<!--        <div class="footer__menu">-->
<!--            <ul class="footer__menu_mnu">-->
<!--                <li class=""><a href="">Главная</a></li>-->
<!--                <li class=""><a href="">Новости </a></li>-->
<!--                <li class=""><a href="">Предприятия</a></li>-->
<!--                <li class=""><a href="">Объявления </a></li>-->
<!--                <li class=""><a href="">Досуг</a></li>-->
<!--                <li class=""><a href="">О нас</a></li>-->
<!--            </ul>-->
<!--        </div>-->
        <ul class="social">
            <li><a href="https://www.facebook.com/da.info.pro/" class="circle"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="https://vk.com/da_info_pro" class="circle"><i class="fa fa-vk" aria-hidden="true"></i></a></li>
            <li><a href="https://www.facebook.com/da.info.pro/" class="circle"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="https://www.instagram.com/da.info.pro/" class="circle"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="https://ok.ru/da...infor" class="circle"><i class="fa fa-odnoklassniki" aria-hidden="true"></i> </a></li>
            <!--<li><a href="" class="circle"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
            <li><a href="" class="circle"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>-->
        </ul>
<!--        <div class="info"><p><a href="mailto:da.info.pro@gmail.com">da.info.pro@gmail.com</a>,<br> колл центр - +38(099)671-71-72, +38(071)310-09-54,<br> отдел продаж - +38(099)671-71-73, +38(099)620-45-85, +38(099)625-76-07</p></div>-->
        <div class="info"><p><a href="mailto:da.info.pro@gmail.com">da.info.pro@gmail.com</a>,<br> колл центр - +38(099)671-71-72</p></div>
        <!--        <div class="footer-copyright-cont">-->
        <!--            <p class="footer-copyright">2017 © da-info.pro- Сайт города Донецка</p>-->
        <!--            <p class="footer-copyright">info@da-info, (071) 210-80-54, (093) 998-49-04</p>-->
        <!--        </div>-->
        <!--        <div class="info">-->
        <!--            <a href="#">Реклама на сайте</a><a href="#">Правила пользования сайтом</a><a href="#">Договор пользования сайтом</a>-->
        <!--        </div>-->

        <!--        <div class="header__main_logo"></div>-->


<!--        <div class="footer-alert-top">-->
<!--            <p>Допускается цитирование материалов без получения предварительного согласия при условии размещения в тексте обязательной ссылки на da-info.pro. </p>-->
<!--        </div>-->
    </div>

    <div class="footer-alert-container">
        <div class="container">
            <p class="footer-alert">
                2017 © <a href="http://da-info.pro/">da-info.pro</a> - Портал города Донецка.Допускается цитирование материалов без получения предварительного согласия при условии размещения в тексте обязательной ссылки на da-info.pro.
            </p>
        </div>
    </div>
    <div class="bottom-footer">
    </div>

    <div id="Go_Top">
        <img  src="/theme/portal-donbassa/img/button_up.svg" alt="">
    </div>

</section>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
