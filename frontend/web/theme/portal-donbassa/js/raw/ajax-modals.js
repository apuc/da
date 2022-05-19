$(document).ready(function () {
    /* Модалка "Написать нам" */
    $('#write_to_us_form').submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: '/ajax/ajax/send-user-msg',
            type: "POST",
            data: {
                '_csrf': $("input[name='_csrf']").val(),
                'url': $("input[name='url']").val(),
                'user_id': $("input[name='user_id']").val(),
                'name': $('#write_to_us_name').val(),
                'email': $('#write_to_us_email').val(),
                'message': $('#write_to_us_message').val()
            },
            success: function (data) {
                if (data == true) {
                    $('#write_to_us_form').html('<h3 class="modal-callback__title">Спасибо. Мы с вами свяжемся в ближайшее время</h3>')
                } else {
                    $('#write_to_us_form').html('<h3 class="modal-callback__title">Произошла ошибка, ваше сообщение не отправлено. Попробуйте позже.</h3>')
                }
            }
        });
    });

    /* TODO Отобразить "Написать нам" */
    // $('#write_to_us_button').click(function ( event ) {
    //     event.preventDefault();
    //
    //     $("#overlay").fadeIn(400, function () {
    //         $(".modal-send").css("display", "block").animate({opacity: 1}, 200)
    //     });
    // });
    $(document).on("click", "#write_to_us_button", function () {
        return $("#overlay").fadeIn(400, function () {
            $(".modal-send").css("display", "block").animate({opacity: 1}, 200)
        }), !1
    });

    /* TODO Скрыть */
    $(document).on("click", "#write_to_us_button, #overlay", function () {
        $(".modal-send").animate({opacity: 0}, 200, function () {
            $(this).css("display", "none"), $("#overlay").fadeOut(400);
        });
    });

    /* Модалка "сообщить об ошибке" */
    $('#error_feedback_form').submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: '/ajax/ajax/send-user-msg',
            type: "POST",
            data: {
                '_csrf': $("input[name='_csrf']").val(),
                'url': $("input[name='url']").val(),
                'user_id': $("input[name='user_id']").val(),
                'name': $('#error_feedback_name').val(),
                'email': $('#error_feedback_email').val(),
                'message': $('#error_feedback_message').val()
            },
            success: function (data) {
                if (data == true) {
                    $('#error_feedback_form').html('<h3 class="modal-callback__title">Спасибо. Мы исправим все в ближайшее время!</h3>')
                } else {
                    $('#error_feedback_form').html('<h3 class="modal-callback__title">Произошла ошибка, ваше сообщение не отправлено. Попробуйте позже.</h3>')
                }
            }
        });
    });

    /* TODO Отобразить и скрыть */
    $(document).on("click", "#error_feedback_button, #overlay", function () {
        $(".modal-send").animate({opacity: 0}, 200, function () {
            $(this).css("display", "none"), $("#overlay").fadeOut(400);
        });
    });
});
