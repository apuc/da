$(document).ready(function () {

    $(document).on('click', '.js-send-ask-question', function () {
        $('.faq-modal-name-error').text('');
        $('.faq-modal-email-error').text('');
        $('.faq-modal-message-error').text('');

        var content = $('#faq-user-message').val();

        var flagMail = 0;

        if(document.getElementById('faq-user-name') && document.getElementById('faq-user-email'))
        {
            var name = $('#faq-user-name').val();
            var email = $('#faq-user-email').val();
            if(email != '') {
                var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;

                if(pattern.test( $('#faq-user-email').val() )){
                    $('.faq-modal-email-error').text('');
                    flagMail = 1;
                } else {
                    $('.faq-modal-email-error').css('color', 'red').text('Email введен не верно');
                }


            } else {
                $('.faq-modal-email-error').css('color', 'red').text('Введите email');
            }

            /*if(!email)
                $('.faq-modal-email-error').css('color', 'red').text('Введите email');*/
            if(!name)
                $('.faq-modal-name-error').css('color', 'red').text('Введите Имя');
        }else {
            var name = 0;
            var email = 0;
        }
        //console.log(name !=='')
        if(!content) $('.faq-modal-message-error').css('color', 'red').text('Введите сообщение');

        if ((content != '') && (name !== '') && (flagMail != 0)) {

            $.ajax({
                url: '/ajax/ajax/add-contacting',
                type: "POST",
                data: {
                    content: content,
                    name: name,
                    email: email,
                    _csrf: $('meta[name=csrf-token]').attr("content")
                } ,
                success: function (data) {
                    window.location.reload();
                }
            });

        }

        return false;
    });



})