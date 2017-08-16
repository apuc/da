$(document).ready(function () {

    $(document).on('click', '.js-send-ask-question', function () {
        $('.faq-modal-name-error').text('');
        $('.faq-modal-email-error').text('');
        $('.faq-modal-message-error').text('');

        var content = $('#faq-user-message').val();

        if(document.getElementById('faq-user-name') && document.getElementById('faq-user-email'))
        {
            var name = $('#faq-user-name').val();
            var email = $('#faq-user-email').val();
            if(!email)
                $('.faq-modal-email-error').css('color', 'red').text('Введите email');
            if(!name)
                $('.faq-modal-name-error').css('color', 'red').text('Введите Имя');
        }else {
            var name = 0;
            var email = 0;
        }
        //console.log(name !=='')
        if(!content) $('.faq-modal-message-error').css('color', 'red').text('Введите сообщение');

        if ((content != '') && (name !== '') && (email !== '')) {

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