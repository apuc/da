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

    <h3 class="modal-callback__title">Сообщите нам об ошибке на сайте</h3>

    <div class="separator"></div>

    <form action="" class="modal-callback__form">
        <input type="hidden" name="user_id" value="<?= (empty(Yii::$app->user->id) ? 0 : Yii::$app->user->id)?>" id="">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
        <input type="hidden" name="url" value="<?= 'https://da-info.pro'.\yii\helpers\Url::to();  /*=  \yii\helpers\Url::canonical();*/ ?>">

        <?if (!Yii::$app->user->id):?>

            <input class="form-control" id="error-user-name" type="text" name="name" placeholder="Ваше имя">
            <p class="error-modal-name-error"></p>
            <input class="form-control" id="error-user-email" type="email" name="email" placeholder="Ваш email">
            <p class="error-modal-email-error"></p>

        <?endif;?>

        <textarea class="modal-callback__textarea" id="error-user-message" name="text-error" placeholder="Текст сообщения"></textarea>
        <p class="error-modal-message-error"></p>
        <input class="show-more" id="send-error-site" type="submit" value="отправить">

    </form>

</div>

<div class="modal-review" id="modal-review">

    <h3 class="modal-review__title">Добавить отзыв</h3>

    <p class="modal-review__subtitle">Будьте правдивы. Пишите и хорошее, и плохое, но ничего не выдумывайте.</p>

    <div class="separator"></div>

    <form action="" class="modal-review__form">

        <p>Ваш отзыв</p>

        <textarea class="modal-review__textarea" name="text_feedback" maxlength="1000" placeholder="Текст сообщения"></textarea>

        <input type="hidden" name="company_name">
        <input type="hidden" name="company_id">
        <span class="feedback_error"></span>
        <input id="modal-review-submit" class="show-more" type="submit" value="отправить">
    </form>

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
        <?if (!Yii::$app->user->id):?>

            <input class="form-control" id="faq-user-name" type="text" name="name" placeholder="Ваше имя">
            <p class="faq-modal-name-error"></p>
            <input class="form-control" id="faq-user-email" type="email" name="email" placeholder="Ваш email">
            <p class="faq-modal-email-error"></p>

        <?endif;?>

        <textarea class="modal-review__textarea" id="faq-user-message" placeholder="Текст сообщения"></textarea>
        <p class="faq-modal-message-error"></p>

        <input id="modal-add-comment-submit" class="show-more js-send-ask-question" type="submit" value="отправить">

    </form>

</div>

<div class="modal-review-success" id="modal-review-success">

    <div class="modal-review-success__img">
        <img src="/theme/portal-donbassa/img/icons/confirm-icon.png" alt="">
    </div>

    <p class="modal-review-success__title">Ваш отзыв будет опубликован после прохождения модерации</p>

    <p class="modal-review-success__notice">Пишите только сами!</p>

    <p class="modal-review-success__moder">Автоматическая проверка находит любые копии и рерайты,
        автор блокируется навсегда.</p>

</div>