<div class="modal-send" id="error-message">

    <span class="modal-send__close">X</span>

    <form action="" class="modal-send__form" id="error_feedback_form">
        <h3 class="modal-callback__title">Сообщите нам об ошибке на сайте</h3>

        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
        <input type="hidden" name="user_id" value="<?= (empty(Yii::$app->user->id) ? 0 : Yii::$app->user->id) ?>" id="">
        <input type="hidden" name="url" value="<?= 'https://da-info.pro' . \yii\helpers\Url::to(); ?>">

        <?php if (!Yii::$app->user->id): ?>
            <input id="error_feedback_name" class="modal-send__field valid" type="name" placeholder="Имя" required>

            <input id="error_feedback_email" class="modal-send__field valid" type="email"
                   placeholder="Электронная почта"
                   required>
        <?php endif; ?>

        <textarea name="" id="error_feedback_message" class="modal-send__textarea valid" placeholder="Опишите ошибку"
                  required></textarea>

        <input id="error_feedback_submit" class="modal-send__submit" type="submit" value="Отправить">

    </form>

</div>