<?php

use yii\widgets\MaskedInput;

?>

<footer class="footer">

    <div class="container">

        <div class="footer__logo">
            <img src="/img/logo.png" alt="Logo">
        </div>


        <div class="footer__main">

            <ul class="footer__nav">
                <li><a href="/all-new">ЧТИВО</a></li>
                <li><a href="/all-poster">АФИША</a></li>
                <li><a href="/stream">ДОСУГ</a></li>
                <li><a href="/all-company">ПРЕДПРИЯТИЯ</a></li>
                <li><a href="/consulting/consulting/index">КОНСУЛЬТАЦИИ</a></li>
                <li><a href="/obyavleniya">ОБЪЯВЛЕНИЯ</a></li>
            </ul>

            <a href="#" class="footer-error-button" id="send-error-message">
                сообщить об ошибке
            </a>

            <div class="footer__links-rules">
                <div class="footer__links-wrap">
                    <a href="http://da-info.pro/page/politika-konfidencialnosti">Политика конфиденциальности</a>
                    <a href="http://da-info.pro/page/pravila-polzovania-sajtom-da-infopro">Правила пользования
                        сайтом</a>
                </div>
                <div class="footer__links-wrap">
                    <a href="http://da-info.pro/page/soglasie-na-obrabotku-personalnyh-dannyh">Согласие на обработку
                        персональных данных</a>
                    <div class="footer__wrap-link">
                        <a href="http://da-info.pro/page/kontakty">Контакты</a>
                        <a class="footer__craft-link"
                           href="https://web-artcraft.com" target="_blank">Разработано CraftGroup</a>
                    </div>
                </div>

            </div>
        </div>


        <div class="footer__social">

            <?= \frontend\widgets\FooterSocial::widget(); ?>

            <a href="#" class="footer__send">написать нам</a>

        </div>

    </div>
    <!--<div class="fix-button">-->

    <!--<span class="fix-button__trigger">-->
    <!--<img src="img/home-content/fix-button.png" alt="">-->
    <!--</span>-->

    <!--<ul class="fix-button__list">-->
    <!--<li><a href="#" class="fix-button__list&#45;&#45;company">Предприятие</a></li>-->
    <!--<li><a href="#" class="fix-button__list&#45;&#45;news">Новость</a></li>-->
    <!--<li><a href="#" class="fix-button__list&#45;&#45;poster">Афиша</a></li>-->
    <!--<li><a href="#" class="fix-button__list&#45;&#45;stock">Акция</a></li>-->
    <!--<li><a href="#" class="fix-button__list&#45;&#45;adds">Объявления</a></li>-->
    <!--</ul>-->


    <!--</div>-->

    <!--<div id="send-error-message" class="fix-button-msg-error">-->
    <!--<div class="fix-button__notice">-->
    <!--<img src="img/home-content/mistake-bg.png" alt="">-->
    <!--</div>-->
    <!--</div>-->

</footer>

<div class="modal-callback" id="modal_promotion_add_comment">
    <?php if (Yii::$app->user->id): ?>
    <h3 class="modal-callback__title">Введите ваш комментарий</h3>

    <div class="separator"></div>

    <form action="" class="modal-callback__form" id = "category_add_form">
        <input type="hidden" name="user_id" value="<?= (empty(Yii::$app->user->id) ? 0 : Yii::$app->user->id) ?>" id="">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
        <input type="hidden" name="url" value="<?= 'https://da-info.pro' . \yii\helpers\Url::to(); ?>">
        <input type="hidden" id = "promo-id" name="promo-id" value="">


        <textarea class="modal-callback__textarea" id="error-user-message" name="text-prom-comment"
                  placeholder="Текст сообщения"></textarea>
        <p class="error-modal-message-error"></p>
        <h3 class="modal-callback__title" id = "promo_response"> </h3>
        <input class="show-more" id="promotion_send_comment" type="submit" value="отправить">
    </form>

    <?php else: ?>
        <h3 class="modal-callback__title">Пожалуйста, авторизуйтесь.</h3>
    <?php endif?>

</div>

<div class="modal-callback" id="category_add_message">

    <h3 class="modal-callback__title">Предложите нам добавить категорию</h3>

    <div class="separator"></div>

    <form action="" class="modal-callback__form" id = "category_add_form">
        <input type="hidden" name="user_id" value="<?= (empty(Yii::$app->user->id) ? 0 : Yii::$app->user->id) ?>" id="">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
        <input type="hidden" name="url" value="<?= 'https://da-info.pro' . \yii\helpers\Url::to(); ?>">

        <?php if (!Yii::$app->user->id): ?>

            <input class="form-control" id="error-user-name" type="text" name="name" placeholder="Ваше имя">
            <p class="error-modal-name-error"></p>
            <input class="form-control" id="error-user-email" type="email" name="email" placeholder="Ваш email">
            <p class="error-modal-email-error"></p>

        <?php endif; ?>

        <textarea class="modal-callback__textarea" id="error-user-message" name="text-cat-add"
                  placeholder="Текст сообщения"></textarea>
        <p class="error-modal-message-error"></p>
        <input class="show-more" id="send-category-add" type="submit" value="отправить">

    </form>

</div>

<div class="modal-callback" id="error-message">

    <h3 class="modal-callback__title">Сообщите нам об ошибке на сайте</h3>

    <div class="separator"></div>

    <form action="" class="modal-callback__form">
        <input type="hidden" name="user_id" value="<?= (empty(Yii::$app->user->id) ? 0 : Yii::$app->user->id) ?>" id="">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
        <input type="hidden" name="url" value="<?= 'https://da-info.pro' . \yii\helpers\Url::to(); ?>">

        <?php if (!Yii::$app->user->id): ?>

            <input class="form-control" id="error-user-name" type="text" name="name" placeholder="Ваше имя">
            <p class="error-modal-name-error"></p>
            <input class="form-control" id="error-user-email" type="email" name="email" placeholder="Ваш email">
            <p class="error-modal-email-error"></p>

        <?php endif; ?>

        <textarea class="modal-callback__textarea" id="error-user-message" name="text-error"
                  placeholder="Текст сообщения"></textarea>
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

        <textarea class="modal-review__textarea" name="text_feedback" maxlength="1000"
                  placeholder="Текст сообщения"></textarea>

        <input type="hidden" name="company_name">
        <input type="hidden" name="company_id">
        <span class="feedback_error"></span>
        <input id="modal-review-submit" class="show-more" type="submit" value="отправить">
    </form>

</div>

<div class="modal-review" id="modal-review-promotions">

    <h3 class="modal-review__title">Добавить отзыв</h3>

    <p class="modal-review__subtitle">Будьте правдивы. Пишите и хорошее, и плохое, но ничего не выдумывайте.</p>

    <div class="separator"></div>

    <form action="" class="modal-review__form">

        <p>Ваш отзыв</p>

        <textarea class="modal-review__textarea" name="text_promotions_feedback" maxlength="1000"
                  placeholder="Текст сообщения"></textarea>

        <input type="hidden" name="promotion_name">
        <input type="hidden" name="promotion_id">
        <span class="feedback_error"></span>
        <input id="modal-review-promotions-submit" class="show-more" type="submit" value="отправить">
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
        <?php if (!Yii::$app->user->id): ?>

            <input class="form-control" id="faq-user-name" type="text" name="name" placeholder="Ваше имя">
            <p class="faq-modal-name-error"></p>
            <?php echo MaskedInput::widget([
                'name' => 'email',
                'class' => 'form-control',
                'id' => 'faq-user-email',

                'clientOptions' => [
                    'alias' => 'email',
                    'pattern' => '/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i',
                ],
            ]); ?>

            <p class="faq-modal-email-error"></p>

        <?php endif; ?>

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