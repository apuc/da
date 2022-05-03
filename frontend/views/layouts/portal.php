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
</head>
<body>
<?php $this->beginBody() ?>

<?php echo \frontend\widgets\ShowHeader::widget(); ?>

<section class="home-content">
    <div class="container">

        <div class="home-content__wrap">

            <?= \frontend\widgets\MainSlider::widget(); ?>

            <?= \frontend\widgets\Entertainment::widget(); ?>

            <?= \frontend\widgets\SituationMain::widget() ?>
            <?php
            if ($this->beginCache('communal_rates_widget', ['duration' => Yii::$app->params['hours-for-cache']])) {
                echo \frontend\modules\mainpage\widgets\CommunalRates::widget();
                $this->endCache();
            }
            if ($this->beginCache('subscribe_widget', ['duration' => Yii::$app->params['hours-for-cache']])) {
                echo \frontend\widgets\Subscribe::widget();
                $this->endCache();
            }
            ?>

        </div>


        <?= \frontend\widgets\DayFeed::widget(['useReg' => 21, 'page' => 'dnr']); ?>

        <?= \frontend\widgets\Consultation::widget(); ?>
        <div class="home-content__sidebar">

            <?= \frontend\modules\mainpage\widgets\Stock::widget() ?>

        </div>
        <!--<div class="home-content__sidebar_poll">
            <?/*= \frontend\widgets\Poll::widget(); */?>
        </div>-->



       <!-- --><?/*= \frontend\widgets\ExchangeRatesMain::widget() */?>

        <?/*= \frontend\widgets\Weather::widget(); */?>
</section>
<?php
/*echo \frontend\widgets\MainPopularSlider::widget(['useReg' => 21]);

if ($this->beginCache('main_posters_widget', ['duration' => Yii::$app->params['hours-for-cache']])) {
    echo \frontend\widgets\MainPosters::widget(['useReg' => 21]);
    $this->endCache();
}

echo \frontend\widgets\StreamMain::widget();

if ($this->beginCache('company_main_widget', ['duration' => Yii::$app->params['hours-for-cache']])) {
    echo \frontend\widgets\CompanyMain::widget(['useReg' => 21]);
    $this->endCache();
}

if ($this->beginCache('main_photos_widget', ['duration' => Yii::$app->params['hours-for-cache']])) {
    echo \frontend\widgets\MainPhotos::widget(['useReg' => 21]);
    $this->endCache();
}*/

if ($this->beginCache('show_footer_widget', ['duration' => Yii::$app->params['hours-for-cache']])) {
    echo \frontend\widgets\ShowFooter::widget();
    $this->endCache();
}
?>


<!--<a href="" class="fix-button"><img src="/theme/portal-donbassa/img/home-content/fix-button.png" alt=""></a>-->


<!-- Модалка "Напишите нам"-->
<?= \frontend\widgets\WriteToUsModal::widget(); ?>

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


<a id="Go_Top" style="display: inline;"><img src="/theme/portal-donbassa/img/icons/button_up.svg" alt=""></a>
<div id="overlay"></div>

<div id="black-overlay"></div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
