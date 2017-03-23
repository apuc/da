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

})