$(document).ready(function () {
    $(document).on('click', '.show-more-stock', function () {
        var a = $(this);
        var page = parseInt(a.attr('data-page'));
        var step, sum = 0;
        $.ajax({
            url: '/promotions/promotions/read-more-stock',
            type: "POST",
            data: {
                '_csrf': yii.getCsrfToken(),
                'page': page
            },
            success: function (html) {
                a.before(html);
                page++;
                a.attr('data-page', page);
                step = parseInt(a.attr('data-step'));
                sum = parseInt(a.attr('data-sum'));
                if (sum - page * step <= 0) {
                    a.remove();
                }
            }
        });
        return false;
    });

    $(document).on('click', 'li.date', function () {
        $('input.input-group').val($(this).data('value'));
        $('.submit-stock').click();
    });

    // $(document).on('click', '.stockView', function () {
    //     $.ajax({
    //         url: '/promotions/promotions/update-view',
    //         type: "POST",
    //         data: {
    //             '_csrf': yii.getCsrfToken(),
    //             'id': $(this).closest('.stockBlock').attr('data-id')
    //         },
    //         success: function (data) {
    //         }
    //     });
    // });
});