<div class="modal-send"  id="write_to_us_modal">
    <span class="modal-send__close">X</span>

    <h3 class="modal-callback__title">Написать нам</h3>

    <form action="" class="modal-send__form" id="write_to_us_form">

        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>">
        <input type="hidden" name="user_id" value="<?= (empty(Yii::$app->user->id) ? 0 : Yii::$app->user->id) ?>" id="">
        <input type="hidden" name="url" value="<?= 'https://da-info.pro' . \yii\helpers\Url::to(); ?>">
        <input id="write_to_us_name" class="modal-send__field valid" type="name" placeholder="Имя" required>
        <input id="write_to_us_email" class="modal-send__field valid" type="email" placeholder="Электронная почта"
               required>
        <textarea name="" id="write_to_us_message" class="modal-send__textarea valid" placeholder="Ваше сообщение"
                  required></textarea>
        <input id="write_to_us_submit" class="modal-send__submit" type="submit" value="Отправить">
    </form>

</div>