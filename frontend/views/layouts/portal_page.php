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
    <meta name="yandex-verification" content="6102a93fabadb2cf"/>
    <?= \frontend\widgets\Metrika::widget() ?>
</head>
<body>
<?php $this->beginBody() ?>

<section class="header">
    <div class="container">

        <a href="/" class="header-logo">

            <img src="/theme/portal-donbassa/img/logo.png" alt="">
        </a>
        <div class="header-ipanel">
            <div class="select">
                <select class="" name="">
                    <option value="">Донецк</option>
                    <option value="">Макеевка</option>
                </select>
            </div>
            <div class="weather">
        <span class="weather-pic">
          <img src="/theme/portal-donbassa/img/header/rain-pic.png" alt="">
        </span>
                <span class="weather-temp">
          +11
        </span>
            </div>
            <?= ExchangeRates::widget() ?>
            <form action="">
                <input class="search-input" type="text" placeholder="Поиск">
                <button>
                    <span class="autoriz-icon"></span>
                    авторизация
                </button>
            </form>
        </div>
        <?php echo \frontend\widgets\MainMenu::widget() ?>

    </div>
</section>

<?= $content;?>
<footer class="footer">

    <div class="container">

        <div class="footer__logo">
            <img src="/theme/portal-donbassa/img/logo.png" alt="Logo">
        </div>


        <div class="footer__main">

            <ul class="footer__nav">
                <li><a href="#">НОВОСТИ</a></li>
                <li><a href="#">АФИША</a></li>
                <li><a href="#">ДОСУГ</a></li>
                <li><a href="#">ПРЕДПРИЯТИЯ</a></li>
                <li><a href="#">КОНСУЛЬТАЦИИ</a></li>
                <li><a href="#">ОБЪЯВЛЕНИЯ</a></li>
            </ul>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicinor incididunt ut labore et dolore magn aliqua. Ut enim
                ad minim veniam, quis nostrud exercitation
                ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor n reprehenderit in
                voluptate velit esse cillum dolor</p>

        </div>


        <div class="footer__social">

            <div class="footer__links">
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
            </div>

            <a href="#" class="footer__send">написать нам</a>

        </div>

    </div>

</footer>
<div class="modal-send">

    <span class="modal-send__close">X</span>

    <form action="" class="modal-send__form">

        <input id="send-message-name" class="modal-send__field valid" type="name" placeholder="Имя" required>

        <input id="send-message-email" class="modal-send__field valid" type="email" placeholder="Электронная почта"
               required>

        <textarea name="" id="send-message-text" class="modal-send__textarea valid" placeholder="Ваше сообщение"
                  required></textarea>

        <input id="send-message-submit" class="modal-send__submit" type="submit" value="Отправить">

    </form>

</div>
<div id="overlay"></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
