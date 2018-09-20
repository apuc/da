$(document).ready(function () {
    if (document.getElementById('subscribeForm')) {
        var valid = new Validation();
        valid.init({
            classItem: 'vItem',
            eventElement: '#subm',
            items: [
                {
                    item: 'email',
                    tpl:'email'
                }
            ],
            submitSuccess: function (err, form) {
                if (!err) {
                    //form.submit();
                    $.ajax({
                        type: 'GET',
                        url: "/ajax/ajax/subscribe",
                        data: {
                            email: $('#subscribe-email').val()
                        },
                        success: function (data) {
                            alert('Подписка успешно оформлена');
                        }
                    });
                }
            }
        })
    }

    $(document).on('change', '#regionSelectUser', function () {
        var regId = $(this).val();

        $.ajax({
            type: 'POST',
            url: "/ajax/ajax/select-region",
            data: {
                regId: regId
            },
            success: function (data) {
                //console.log(data);
                location.reload();
            }
        });
    });

});