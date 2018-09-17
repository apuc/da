$(document).ready(function () {
    $('.content-single p').find('img').each(function () {
        $(this).addClass('newsImg');
        $(this).wrap('<a href="' + $(this).attr('src') + '" data-lightbox="image-1"></a>')
        if ($(this).width() > 800) {
            $(this).css({width: '100%', height: '100%'});
        }
    });
});