<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\db\KeyValue;
use common\models\User;

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$user = Yii::$app->user->identity;
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
    <!--<meta property="og:title" content="DA info"/>-->
    <!--<meta property="og:url" content="--><? //= Url::home(true); ?><!--"/>-->
    <meta property="og:image" content="<?= 'http://' . $_SERVER['HTTP_HOST'] ?>/theme/portal-donbassa/img/logo_da.png"/>
    <!--<meta property="og:description" content="Информационный портал города Донецка"/>-->
</head>
<body>
<?php $this->beginBody() ?>

<?= \frontend\widgets\ShowHeader::widget(); ?>

<section class="home-content">
    <div class="container">

        <div class="home-content__wrap">

            <?= \frontend\widgets\MainSlider::widget(); ?>

            <?= \frontend\widgets\Entertainment::widget(); ?>

            <?= \frontend\widgets\SituationMain::widget() ?>

            <div class="home-content__wrap_komunalka">
                <div class="title_row">
                    <h3>комунальные тарифы</h3>
                    <a href="<?= Url::to(['/site/design']); ?>" class="show-enterprises">все тарифы<span
                                class="red-arrow"></span></a>
                </div>
                <div class="komunalka">

                    <div class="komunalka__item komunalka__line_active">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/energy.png" alt="">
            </span>
                        <a href="<?= Url::to(['/consulting/consulting/document', 'slug' => 'elektricestvo']) ?>"
                           class="komunalka__line "><span>электричество</span><span class="red-arrow"></span></a>
                    </div>
                    <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/wind.png" alt="">
            </span>
                        <a href="<?= Url::to(['/consulting/consulting/document', 'slug' => 'otoplenie']) ?>"
                           class="komunalka__line"><span>отопление</span> <span class="red-arrow"></span></a>
                    </div>
                    <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/gas.png" alt="">
            </span>
                        <a href="<?= Url::to(['/consulting/consulting/document', 'slug' => 'gaz']) ?>" class="komunalka__line">
                            <span>газ</span>
                            <span class="red-arrow"></span></a>
                    </div>
                    <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/home.png" alt="">
            </span>
                        <a href="<?= Url::to(['/consulting/consulting/document', 'slug' => 'zkh']) ?>" class="komunalka__line">
                            <span>жкх</span>
                            <span class="red-arrow"></span></a>
                    </div>
                    <div class="komunalka__item">
            <span class="komunalka__icon">
              <img src="/theme/portal-donbassa/img/home-content/water.png" alt="">
            </span>
                        <a href="<?= Url::to(['/consulting/consulting/document', 'slug' => 'voda']) ?>" class="komunalka__line">
                            <span>вода</span>
                            <span class="red-arrow"></span>
                        </a>
                    </div>
                </div>
            </div>

            <?= \frontend\widgets\Subscribe::widget() ?>

        </div>

        <div class="home-content__tape">
            <?= \frontend\widgets\DayFeed::widget(); ?>
        </div>

        <div class="home-content__sidebar">

            <?= \frontend\modules\mainpage\widgets\Stock::widget() ?>

            <div class="home-content__sidebar_poll poll">
                <?= \frontend\widgets\Poll::widget(); ?>
            </div>

            <?= \frontend\widgets\Consultation::widget(); ?>

            <?= \frontend\widgets\ExchangeRatesMain::widget() ?>

            <?= \frontend\widgets\Weather::widget(); ?>

        </div>
</section>

<?= \frontend\widgets\MainPopularSlider::widget(); ?>

<?= \frontend\widgets\MainPosters::widget(); ?>

<?= \frontend\widgets\CompanyMain::widget(); ?>

<?= \frontend\widgets\MainPhotos::widget(); ?>

<?= \frontend\widgets\ShowFooter::widget(); ?>

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

        <textarea id="comment" class="modal-review__textarea" placeholder="Текст сообщения"></textarea>

        <input id="modal-add-comment-submit" class="show-more" type="submit" value="отправить">

    </form>

</div>

<div class="modal-review" id="modal-faq">

    <h3 class="modal-review__title">Добавить комментарий</h3>

    <p class="modal-review__subtitle">Пишите и хорошее, и плохое.</p>

    <div class="separator"></div>

    <form action="" class="modal-review__form">

        <p>Ваш комментарий</p>

        <textarea class="modal-review__textarea" placeholder="Текст сообщения"></textarea>

        <input id="modal-add-comment-submit" class="show-more js-send-ask-question" type="submit" value="отправить">

    </form>

</div>
<a id="Go_Top" style="display: inline;"><img src="/theme/portal-donbassa/img/icons/button_up.svg" alt=""></a>
<div id="overlay"></div>

<div id="black-overlay"></div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
