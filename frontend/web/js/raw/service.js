$(document).ready(function () {

    $(document).on('focusout', '.reservation_date', function () {
        var date = $(this).val();
        var id = $(this).attr('data-id');
        $.ajax({
            url: "/shop/shop/get-period",
            type: "POST",
            data: {
                date: date,
                id: id
            },
            success: function (data) {
                $('.service-blocks').html(data);
            }
        });
    });

    $(document).on('click', '.service-reserve', function () {
        var info = $('.reservation_date');
        var id = info.attr('data-id');
        var count = parseInt(info.attr('data-count'));
        if ($(this).hasClass('btn-info')) {
            $(this).removeClass('btn-info');//class('btn btn-danger service-reserve');
            $(this).addClass('btn-success');
            count++;
        }
        else if ($(this).hasClass('btn-success')) {
            $(this).removeClass('btn-success');//class('btn btn-danger service-reserve');
            $(this).addClass('btn-info');
            count--;
        }
        info.attr('data-count', count);
        $.ajax({
            type: 'POST',
            url: "/shop/cart/price-count",
            data: {
                product_id: id,
                count: count,
            },
            success: function (data) {
                $('.total-cost').html(data);

            }
        });
    });

    $(document).on('click', '.reserve-service', function (e) {
        e.preventDefault();
        var date = $('.reservation_date').val();
        var id = $('.reservation_date').attr('data-id');
        var success = true;
        var flag = false;

        $('.service-reserve').each(function () {
            if ($(this).hasClass('btn-success')) {
                flag = true;
                $.ajax({
                    url: "/shop/shop/add-reservation",
                    type: "POST",
                    data: {
                        date: date,
                        id: id,
                        time: $(this).html()
                    },
                    success: function (data) {
                        if(!data)
                            success = false;
                    }
                });
            }
        });
        if(!flag)
            $('#error_message').html("Вы не выбрали время");
        else{
            if (success)
                location.reload();
            else
                $('#error_message').html('ошибка');
        }


    });

});