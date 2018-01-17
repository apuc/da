$(document).ready(function () {
    $(document).on('click', '.show-more-stock', function () {
        var page = parseInt($(this).attr('data-page'));
        $(this).attr('data-page', page+1);
        $.ajax({
            url: '/promotions/promotions/read-more-stock',
            type: "POST",
            data: {
                '_csrf': $("input[name='_csrf']").val(),
                'page': page
            },
            success: function (data) {
                $('.news__wrap_buttons').before(data);

                /*$('.addParentCategory').html(data);*/
                //$('.addSelectCateg').before(data);
            }
        });
        return false;
    });

    $(document).on('click', '.stockView', function () {
        //console.log($(this).closest('.stockBlock').attr('data-id'));
        $.ajax({
            url: '/promotions/promotions/update-view',
            type: "POST",
            data: {
                '_csrf': $("input[name='_csrf']").val(),
                'id': $(this).closest('.stockBlock').attr('data-id')
            },
            success: function (data) {}
        });

    });
});