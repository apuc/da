$(document).ready(function () {

    $('.content-single p').find('img').each(function () {
        $(this).addClass('newsImg');
        $(this).wrap('<a href="' + $(this).attr('src') + '" data-lightbox="image-1"></a>')
        if ($(this).width() > 800) {
            $(this).css({width: '100%', height: '100%'});
        }
    });

    $(document).on('click', '.company__add-phone', function (event) {
        var iterator = parseInt($('.cabinet__add-company-form--wrapper').attr('data-iterator'));
        iterator = iterator + 1;
        $.ajax({
            url: '/poster/default/add-phone',
            data: {
                iterator: iterator,
                _csrf: yii.getCsrfToken()
            },
            type: 'POST',
            success: function (html) {

                $('.cabinet__add-company-form--wrapper').attr('data-iterator', iterator);
                $('.cabinet__add-company-form--wrapper').append(html);
            }
        });
        return false;
    });

    $(document).on('click', '.company__remove-phone', function () {
        $(this).closest('.phones__wrap').remove();
    });

});