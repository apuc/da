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

<section class="home-content">
    <div class="container">

        <div class="home-content__wrap">

            <?= \frontend\widgets\MainSlider::widget(); ?>

            <?= \frontend\widgets\Entertainment::widget(); ?>

            <?= \frontend\widgets\SituationMain::widget() ?>

            <div class="home-content__wrap_komunalka">
                <div class="title_row">
                    <h3>комунальные тарифы</h3>
                    <a href="" class="show-enterprises">все тарифы<span class="red-arrow"></span></a>
                </div>
                <div class="komunalka">

                    <div class="komunalka__item komunalka__line_active">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/energy.png" alt="">
            </span>
                        <a href="" class="komunalka__line ">электричество<span class="red-arrow"></span></a>
                    </div>
                    <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/wind.png" alt="">
            </span>
                        <a href="" class="komunalka__line">отопление <span class="red-arrow"></span></a>
                    </div>
                    <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/gas.png" alt="">
            </span>
                        <a href="" class="komunalka__line">газ <span class="red-arrow"></span></a>
                    </div>
                    <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/home.png" alt="">
            </span>
                        <a href="" class="komunalka__line">жкх <span class="red-arrow"></span></a>
                    </div>
                    <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/water.png" alt="">
            </span>
                        <a href="" class="komunalka__line">вода<span class="red-arrow"></span></a>
                    </div>
                </div>
            </div>

            <div class="home-content__wrap_subscribe">
                <div class="subscribe__wrap">
                    <h3>ПОДПИСАТЬСЯ НА НОВОСТИ</h3>
                    <form action="">
                        <input type="text" placeholder="Выслать на email">
                        <button>подписаться</button>
                    </form>
                    <div class="social-wrap">
                        <h4>мы в социальных сетях</h4>
                        <div class="social-wrap__item vk">
                            <img src="/theme/portal-donbassa/img/soc/vk.png" alt="">
                        </div>
                        <div class="social-wrap__item fb">
                            <img src="/theme/portal-donbassa/img/soc/fb.png" alt="">
                        </div>
                        <div class="social-wrap__item ok">
                            <img src="/theme/portal-donbassa/img/soc/ok-icon.png" alt="">
                        </div>
                        <div class="social-wrap__item insta">
                            <img src="/theme/portal-donbassa/img/soc/insta-icon.png" alt="">
                        </div>
                        <div class="social-wrap__item twitter">
                            <img src="/theme/portal-donbassa/img/soc/twi-icon.png" alt="">
                        </div>
                        <div class="social-wrap__item google">
                            <img src="/theme/portal-donbassa/img/soc/google-icon.png" alt="">
                        </div>
                        <div class="social-wrap__item pinterest">
                            <img src="/theme/portal-donbassa/img/soc/pinter-icon.png" alt="">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="home-content__tape">
            <?= \frontend\widgets\DayFeed::widget(); ?>
        </div>

        <div class="home-content__sidebar">

            <div class="home-content__sidebar_stock">
                <h3 class="main-title">Акции</h3>
                <span class="separator"></span>
                <div class="stock__item">
                    <div class="stock__item_hide">
                        <p>до -50% Карандаши для глаз, Карандаши и тени для бровей, Тени для век, Тушь</p>
                        <a href="">подобнее <span class="red-arrow"></span></a>
                    </div>
                    <div class="stock__item_visible">
                        <div class="thumb">
                            <img src="/theme/portal-donbassa/img/home-content/stock-pic-1.png" alt="">
                        </div>
                        <div class="content">
                            <p> (23 Декабря 2016 - 08 Января 2017)</p>
                        </div>
                        <span class="mouse-area">
              <img src="/theme/portal-donbassa/img/home-content/mouse-area.png" alt="">
            </span>
                    </div>
                </div>
                <div class="stock__item">
                    <div class="stock__item_hide">
                        <p>до -50% Карандаши для глаз, Карандаши и тени для бровей, Тени для век, Тушь</p>
                        <a href="">подобнее <span class="red-arrow"></span></a>
                    </div>
                    <div class="stock__item_visible">
                        <div class="thumb">
                            <img src="/theme/portal-donbassa/img/home-content/stock-pic-1.png" alt="">
                        </div>
                        <div class="content">
                            <p> (23 Декабря 2016 - 08 Января 2017)</p>
                        </div>
                        <span class="mouse-area">
              <img src="/theme/portal-donbassa/img/home-content/mouse-area.png" alt="">
            </span>
                    </div>
                </div>
                <div class="stock__item">
                    <div class="stock__item_hide">
                        <p>до -50% Карандаши для глаз, Карандаши и тени для бровей, Тени для век, Тушь</p>
                        <a href="">подобнее <span class="red-arrow"></span></a>
                    </div>
                    <div class="stock__item_visible">
                        <div class="thumb">
                            <img src="/theme/portal-donbassa/img/home-content/stock-pic-1.png" alt="">
                        </div>
                        <div class="content">
                            <p> (23 Декабря 2016 - 08 Января 2017)</p>
                        </div>
                        <span class="mouse-area">
              <img src="/theme/portal-donbassa/img/home-content/mouse-area.png" alt="">
            </span>
                    </div>
                </div>
            </div>

            <div class="home-content__sidebar_poll">
                <!-- <span class="red-line"></span> -->
                <h3>Голосование</h3>
                <h5>Выбери свой вариант</h5>
                <form action="#">
                    <label><p><input data-id="24" name="answer" type="radio" value="24">1. Готов(а) смотреть по ТВ</p>
                    </label>
                    <label><p><input data-id="25" name="answer" type="radio" value="25">2. Посещаю</p></label>
                    <label><p><input data-id="26" name="answer" type="radio" value="26">3. Не посещаю</p></label>
                    <label><p><input data-id="27" name="answer" type="radio" value="27">4. Ходил(а), если бы были в моем
                            городе</p></label>
                    <label><p><input data-id="28" name="answer" type="radio" value="28">5. Отрицательно</p></label>
                    <button><span class="pencil"></span>Проголосовать</button>
                </form>
                <!--
                <div class="pol-progress-cont">
             <div class="answer"><p>1. Готов(а) смотреть по ТВ</p></div>
             <div data-progress="0" class="poll-progressbar ui-progressbar ui-corner-all ui-widget ui-widget-content" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="ui-progressbar-value ui-corner-left ui-widget-header" style="display: none; width: 4px;"></div></div>
             <span class="result">0</span>
         </div>
         <div class="pol-progress-cont">
             <div class="answer"><p>2. Посещаю</p></div>
             <div data-progress="0" class="poll-progressbar ui-progressbar ui-corner-all ui-widget ui-widget-content" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="ui-progressbar-value ui-corner-left ui-widget-header" style="display: none; width: 4px;"></div></div>
             <span class="result">0</span>
         </div>
         <div class="pol-progress-cont">
             <div class="answer"><p>3. Не посещаю</p></div>
             <div data-progress="33" class="poll-progressbar ui-progressbar ui-corner-all ui-widget ui-widget-content" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="33"><div class="ui-progressbar-value ui-corner-left ui-widget-header" style="width: 65px;"></div></div>
             <span class="result">1</span>
         </div>
         <div class="pol-progress-cont">
             <div class="answer"><p>4. Ходил(а), если бы были в моем городе</p></div>
             <div data-progress="66" class="poll-progressbar ui-progressbar ui-corner-all ui-widget ui-widget-content" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="66"><div class="ui-progressbar-value ui-corner-left ui-widget-header" style="width: 129px;"></div></div>
             <span class="result">2</span>
         </div>
         <div class="pol-progress-cont">
             <div class="answer"><p>5. Отрицательно</p></div>
             <div data-progress="0" class="poll-progressbar ui-progressbar ui-corner-all ui-widget ui-widget-content" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="ui-
                -->

            </div>

            <?= \frontend\widgets\Consultation::widget(); ?>

            <?= \frontend\widgets\ExchangeRatesMain::widget() ?>

            <div class="home-content__sidebar_weather">
                <h3>Погода</h3>
                <div class="main-weather">
                    <div class="main-weather__content">
                        <span class="city">Донецк</span>
                        <span class="date">пятница 20.01</span>
                        <span class="precipitation">Облачно</span>
                    </div>
                    <div class="main-weather__pic">
                        <img src="/theme/portal-donbassa/img/weather/partly_cloudy.png" alt="">
                    </div>
                    <span class="main-weather_temp">-8</span>
                </div>
                <div class="week-weather">
                    <div class="week-weather__item">
                        <span class="week-weather__date">сб 21.01</span>
                        <div class="week-weather__pic">
                            <img src="/theme/portal-donbassa/img/weather/snow_light.png" alt="">
                        </div>
                        <span class="week-weather_temp">-8</span>
                    </div>
                    <div class="week-weather__item">
                        <span class="week-weather__date">сб 21.01</span>
                        <div class="week-weather__pic">
                            <img src="/theme/portal-donbassa/img/weather/snow_light.png" alt="">
                        </div>
                        <span class="week-weather_temp">-8</span>
                    </div>
                    <div class="week-weather__item">
                        <span class="week-weather__date">сб 21.01</span>
                        <div class="week-weather__pic">
                            <img src="/theme/portal-donbassa/img/weather/snow_light.png" alt="">
                        </div>
                        <span class="week-weather_temp">-8</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?= \frontend\widgets\MainPopularSlider::widget(); ?>

<?= \frontend\widgets\MainPosters::widget(); ?>

<?= \frontend\widgets\CompanyMain::widget(); ?>

<section class="ads">

    <div class="container">

        <h3 class="main-title">объявления</h3>
        <span class="separator"></span>

        <a href="#" class="ads__trigger">объявления</a>

        <div class="ads__box">

            <div class="ads__item">

                <h3 class="ads__item--title">Снять посуточно</h3>

                <a href="#" class="ads__item--link">Квартиры посуточно <span>2409</span></a>
                <a href="#" class="ads__item--link">Коттеджи на сутки <span>780</span></a>
                <a href="#" class="ads__item--link">Комнаты на сутки <span>134</span></a>
                <a href="#" class="ads__item--link">Хостелы <span>311</span></a>

            </div>

            <div class="ads__descr">

                <span class="ads__descr--img">
                    <img src="/theme/portal-donbassa/img/home-content/apartment-img.png" alt="">
                </span>

                <p class="name">Коттедж 270 м² на участке 5 сот.</p>
                <p class="price">12 000 руб. за сутки</p>
                <span class="place">Донецк</span>

            </div>

            <div class="ads__item">

                <h3 class="ads__item--title">Новостройки</h3>

                <a href="#" class="ads__item--link">Каталог ЖКХ <span>1038</span></a>
                <a href="#" class="ads__item--link">Сданные новостройки <span>369</span></a>
                <a href="#" class="ads__item--link">Строящиеся новостройки <span>653</span></a>

            </div>

            <div class="ads__descr">

                <span class="ads__descr--img">
                    <img src="/theme/portal-donbassa/img/home-content/apartment-img.png" alt="">
                </span>

                <p class="name">Коттедж 270 м² на участке 5 сот.</p>
                <p class="price">12 000 руб. за сутки</p>
                <span class="place">Донецк</span>

            </div>

            <div class="ads__descr">

                <span class="ads__descr--img">
                    <img src="/theme/portal-donbassa/img/home-content/apartment-img.png" alt="">
                </span>

                <p class="name">Коттедж 270 м² на участке 5 сот.</p>
                <p class="price">12 000 руб. за сутки</p>
                <span class="place">Донецк</span>

            </div>

            <div class="ads__item">

                <h3 class="ads__item--title">Коммерческая недвижимость</h3>

                <a href="#" class="ads__item--link">Купить склад <span>161</span></a>
                <a href="#" class="ads__item--link">Купить гараж <span>1270</span></a>
                <a href="#" class="ads__item--link">Купить офис <span>4769</span></a>
                <a href="#" class="ads__item--link">Арендовать офис <span>32292</span></a>
                <a href="#" class="ads__item--link">Арендовать помещение <span>8619</span></a>
                <a href="#" class="ads__item--link">Арендовать торговоу площадь <span>6986</span></a>

            </div>

            <div class="ads__map">

                <h3 class="ads__map--title">Поиск на карте</h3>

                <p class="ads__map--subtitle">Ищите объявления с работой, парком
                    или родственниками</p>

                <a href="#" class="ads__map--link">найти на карте</a>

            </div>

        </div>

        <a href="#" class="more">посмотреть больше <i class="fa fa-chevron-right" aria-hidden="true"></i></a>

    </div>

</section>

<?= \frontend\widgets\MainPhotos::widget();?>

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

<a href="" class="fix-button"><img src="/theme/portal-donbassa/img/home-content/fix-button.png" alt=""></a>
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
