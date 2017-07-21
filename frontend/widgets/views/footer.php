<footer class="footer">
    <div class="container">
        <div class="footer__logo">
            <img src="/theme/portal-donbassa/img/logo.png" alt="Logo">
        </div>
        <div class="footer__main">
            <ul class="footer__nav">
                <li><a href="/all-new">НОВОСТИ</a></li>
                <li><a href="/all-poster">АФИША</a></li>
                <li><a href="/all-company">ПРЕДПРИЯТИЯ</a></li>
                <li><a href="/consulting">КОНСУЛЬТАЦИИ</a></li>
                <li><a href="/site/design">ОБЪЯВЛЕНИЯ</a></li>
            </ul>
            <p><!--Lorem ipsum dolor sit amet, consectetur adipisicinor incididunt ut labore et dolore magn aliqua. Ut enim
                ad minim veniam, quis nostrud exercitation
                ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor n reprehenderit in
                voluptate velit esse cillum dolor--></p>

        </div>
        <div class="footer__social">
            <?= \frontend\widgets\FooterSocial::widget() ?>
            <a href="#" class="footer__send">написать нам</a>

            <a href="mailto:da.info.pro@gmail.com" class="footer__send-mail">Наша почта: da.info.pro@gmail.com</a>
        </div>
    </div>

    <?= \frontend\widgets\ShowAddToSitePanel::widget(); ?>
</footer>


<div class="modal-callback" id="error-message">

    <h3 class="modal-callback__title">Сооощите нам об ошибке на сайте</h3>

    <div class="separator"></div>

    <form action="" class="modal-callback__form">
        <input type="hidden" name="user_id" value="<?= (empty(Yii::$app->user->id) ? 0 : Yii::$app->user->id)?>" id="">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
        <input type="hidden" name="url" value="<?=  \yii\helpers\Url::canonical(); ?>">

        <textarea class="modal-callback__textarea" name="text-error" placeholder="Текст сообщения"></textarea>

        <input class="show-more" id="send-error-site" type="submit" value="отправить">

    </form>

</div>