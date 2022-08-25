<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\MainPageAsset;
use yii\helpers\Html;
use common\widgets\Alert;

MainPageAsset::register($this);
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
    <meta name="yandex-verification" content="e08f0c20c50137da" />
    <?= \frontend\widgets\Metrika::widget() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= Alert::widget() ?>
<?= \frontend\widgets\ShowHeader::widget(); ?>


        <?= $content; ?>

<!--<a href="" class="fix-button"><img src="/theme/portal-donbassa/img/home-content/fix-button.png" alt=""></a>-->

<?= \frontend\widgets\ShowFooter::widget(); ?>

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
<!— BEGIN JIVOSITE CODE {literal} —>
<script type='text/javascript'>
    (function(){ var widget_id = 'B0sW1HAj1V';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
        s.src = '//code.jivosite.com/script/widget/'+widget_id
        ; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}
        if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}
        else{w.addEventListener('load',l,false);}}})();
</script>
<!— {/literal} END JIVOSITE CODE —>
</body>
</html>
<?php $this->endPage() ?>
