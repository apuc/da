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

    $(document).on('click', '.show-more-category-news-js', function () {

        var csrfToken = $(this).attr('csrf-token');

        $.ajax({
            url: '/news/news/more-category-news',
            type: "POST",
            data: {
                '_csrf': csrfToken,
                'offset':$(this).attr('data-offset'),
                'category':$(this).attr('data-category')
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
})