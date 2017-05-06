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
