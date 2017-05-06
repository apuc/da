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

            <?= \frontend\modules\mainpage\widgets\Stock::widget() ?>

            <div class="home-content__sidebar_poll poll">
                <?= \frontend\widgets\Poll::widget();?>
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

<!--<section class="ads">

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

</section>-->

<?= \frontend\widgets\MainPhotos::widget(); ?>

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

<a href="" class="fix-button"><img src="img/home-content/fix-button.png" alt=""></a>

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

<div class="modal-callback" id="modal-callback">

    <h3 class="modal-callback__title">заказать звонок</h3>

    <p class="modal-callback__subtitle">Оставьте свой контактный номер телефона - мы обязательно
        перезвоним в удобное для Вас время!</p>

    <div class="separator"></div>

    <form action="" class="modal-callback__form">

        <p>Введите ваши данные</p>

        <input class="modal-callback__field" type="text" placeholder="Имя">

        <input class="modal-callback__field" type="text" placeholder="Телефон">

        <input class="modal-callback__field" type="text" placeholder="Удобное время для звонка">

        <input class="show-more" type="submit" value="отправить">

    </form>

</div>

<div class="modal-callback" id="modal-send-message">

    <h3 class="modal-callback__title">Написать нам</h3>

    <p class="modal-callback__subtitle">Напишите нам подробно описав свою ситуацию.
        Мы обязательно свяжемся с Вами!</p>

    <div class="separator"></div>

    <form action="" class="modal-callback__form">

        <p>Введите ваши данные</p>

        <input class="modal-callback__field" type="text" placeholder="Имя">

        <input class="modal-callback__field" type="text" placeholder="Телефон">

        <textarea class="modal-callback__textarea" placeholder="Текст сообщения"></textarea>

        <input class="show-more" type="submit" value="отправить">

    </form>

</div>

<div class="modal-callback" id="modal-order-delivery">

    <h3 class="modal-callback__title">ЗАКАЗАТЬ ДОСТАВКУ</h3>

    <p class="modal-callback__subtitle">Определите ваше местонахождение, чтобы проверить возможность доставки</p>

    <div class="separator"></div>

    <form action="" class="modal-callback__form">

        <div class="modal-callback__first-step">

            <p>Введите ваш адрес</p>

            <input class="modal-callback__field" type="text" placeholder="Город">

            <input class="modal-callback__field" type="text" placeholder="Улица">

            <div class="modal-callback__fields">

                <input class="modal-callback__sm-field" type="text" placeholder="Дом">

                <input class="modal-callback__sm-field" type="text" placeholder="Кв.">

            </div>

            <a href="#" class="show-more">продолжить</a>

        </div>

        <div class="modal-callback__second-step">

            <p>Введите ваши данные</p>

            <input class="modal-callback__field" type="text" placeholder="Город">

            <input class="modal-callback__field" type="text" placeholder="Улица">

            <a href="#" class="modal-callback__trigger">Уточнить время и дату доставки</a>

            <textarea class="modal-callback__textarea" placeholder="Текст сообщения"></textarea>

            <a href="#" class="modal-callback__trigger">Добавить комментарий к заказу</a>

            <textarea class="modal-callback__textarea" placeholder="Текст сообщения"></textarea>

            <input class="show-more" type="submit" value="отправить">

        </div>


    </form>

</div>

<div class="modal-review" id="modal-review">

    <h3 class="modal-review__title">Добавить отзыв</h3>

    <p class="modal-review__subtitle">Будьте правдивы. Пишите и хорошее, и плохое, но ничего не выдумывайте.</p>

    <div class="separator"></div>

    <form action="" class="modal-review__form">

        <p>Ваш отзыв</p>

        <textarea class="modal-review__textarea" placeholder="Текст сообщения"></textarea>

        <input id="modal-review-submit" class="show-more" type="submit" value="отправить">

    </form>

</div>

<div class="modal-review-success" id="modal-review-success">

    <div class="modal-review-success__img">
        <img src="img/icons/confirm-icon.png" alt="">
    </div>

    <p class="modal-review-success__title">Ваш отзыв будет опубликован после прохождения модерации</p>

    <p class="modal-review-success__notice">Пишите только сами!</p>

    <p class="modal-review-success__moder">Автоматическая проверка находит любые копии и рерайты,
        автор блокируется навсегда.</p>

</div>

<div class="modal-review" id="modal-add-comment">

    <h3 class="modal-review__title">Добавить комментарий</h3>

    <p class="modal-review__subtitle">Пишите и хорошее, и плохое.</p>

    <div class="separator"></div>

    <form action="" class="modal-review__form">

        <p>Ваш комментарий</p>

        <textarea class="modal-review__textarea" placeholder="Текст сообщения"></textarea>

        <input id="modal-add-comment-submit" class="show-more" type="submit" value="отправить">

    </form>

</div>

<div id="overlay"></div>

<div id="black-overlay"></div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
