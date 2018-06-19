$(document).ready(function () {


    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    if (day < 10)
        day = '0' + day;
    if (month < 10)
        month = '0' + month;
    $('.reservation_date').val(day + '-' + month + '-' + date.getFullYear());


    $(document).on('click', '.datepicker--cell-day', function () {
        setTimeout(function () {
            var date = $('.reservation_date').val();
            var id = $('.reservation_date').attr('data-id');
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
        }, 100);
    });

    $(document).on('click', '.service-reserve', function () {
        var info = $('.reservation_date');
        var id = info.attr('data-id');
        var count = parseInt(info.attr('data-count'));
        if ($(this).hasClass('btn-info')) {
            $(this).removeClass('btn-info');
            $(this).addClass('btn-success');
            count++;
        }
        else if ($(this).hasClass('btn-success')) {
            $(this).removeClass('btn-success');
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
        var user_id = $('.reservation_date').attr('data-user-id');

        if (user_id == 0) {
            window.location.pathname = '/user/login';
        }
        else {
            $('.service-reserve').each(function () {
                var button = $(this);
                if (button.hasClass('btn-success')) {
                    flag = true;
                    $.ajax({
                        url: "/shop/shop/add-reservation",
                        type: "POST",
                        data: {
                            date: date,
                            id: id,
                            time: $(this).html(),
                            user_id: user_id
                        },
                        success: function () {
                            button.removeClass('btn-success');
                            button.addClass('btn-warning');
                        },
                        error: function () {
                            $('#error_message').html("Ошибка");
                        }
                    });
                }
            });
        }
    });

    $(document).on('submit', '#addTimes', function () {

});