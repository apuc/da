$(document).ready(function () {

    $(document).on('click', '#get-more-faq', function () {


        $.ajax({
            url: '/ajax/ajax/more-faq/',
            type: "POST",
            data: {
                '_csrf': $('meta[name=csrf-token]').attr("content"),
                'offset': parseInt($('#get-more-faq').attr('data-offset')),
            },
            success: function (data) {
                $('#get-more-faq').attr('data-offset', parseInt($('#get-more-faq').attr('data-offset')) + 3);
                $('.ask-question').before(data);
            }
        });

        return false;
    });

    $(document).on('click', '#consulting-more-posts', function () {

        $.ajax({
            url: '/ajax/ajax/consulting-more-posts/',
            type: "POST",
            data: {
                '_csrf': $('meta[name=csrf-token]').attr("content"),
                'offset': parseInt($('#consulting-more-posts').attr('data-offset')),
                'type': $('#consulting-more-posts').attr('data-type'),
                'category': $('#consulting-more-posts').attr('data-category'),
                'post-type': $('#consulting-more-posts').attr('data-post-type')
            },
            success: function (data) {
                $('#consulting-more-posts').attr('data-offset', parseInt($('#consulting-more-posts').attr('data-offset')) + 3);
                $('#consulting-more-posts').before(data);
            }
        });

        return false;
    })

    $('a.active').closest('li').find('ul').first().addClass('up-child');
    $('a.active-category').closest('ul').addClass('up-child');


    var el = $('.active-category');
    console.log(el);
    var i = 1;
    OpenCategories(el,i);
    // if ($('.active').next('.inserted').find('li').length != 0) {
    //     $('.active').next('.inserted').slideToggle();
    // }
    // var el = $('.inserted').find('.active');
    // var parent = 0;
    // var i = 1;
    // OpenCategories(el,i);

})


function OpenCategories(el,i) {
    el.closest('ul').slideDown().addClass('up-child');
    i++;
    if ($(el).closest('ul').hasClass('end')) {
        return;
    } else {
        OpenCategories(el.parent(),i);
    }
}
