$(document).ready(function () {

    $(document).on('click', '.likes', function () {

        var csrfToken = $(this).attr('csrf-token');

        $.ajax({
            url: '/likes/like',
            type: 'POST',
            data: {
                post_id: $(this).attr('data-id'),
                post_type: $(this).attr('data-type'),
                '_csrf': csrfToken,
            },
            success: function (data) {
                $('.like-counter').html(data);
                $('.like-icon, .like-set-icon').toggleClass('like-set-icon').toggleClass('like-icon');
            }
        });
    });

    $(document).on('click', '.show-more-news-js', function () {

        var csrfToken = $(this).attr('csrf-token');

        $.ajax({
            url: '/news/news/more-news',
            type: "POST",
            data: {
                '_csrf': csrfToken,
                'offset':$(this).attr('data-offset')
            },
            success: function (data) {
                $('.show-more-news-js').attr('data-offset',parseInt($('.show-more-news-js').attr('data-offset') )+ 16);
                $('.home-content__wrap_subscribe').before(data);

            }
        });

        return false;
    })

    $('.datepicker-here').datepicker({
        dateFormat: 'yyyy-mm-dd',
        onSelect: function (formattedDate, date, inst) {

            console.log(formattedDate);
            window.location.href = '/news/archive/' + formattedDate;
        }
    });

    /*============================================================
     INTERESTED IN POSTERS
     =============================================================*/
    $(document).on('click', '.js-interested-in-more', function () {
        event.preventDefault();
        var csrfToken = $(this).attr('csrf-token');

        $.post(
            '/poster/default/more-interested-in',
            {'_csrf': csrfToken},
            function(data) {
                $('.js-interested-in-more').prev('.afisha-events__wrap').append(data);
                $('.js-interested-in-more').remove();
            }
        );
    });
})