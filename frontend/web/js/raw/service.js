$(document).ready(function () {


    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    if (day < 10)
        day = '0' + day;
    if (month < 10)
        month = '0' + month;
    $('.reservation_date').val(day + '-' + month + '-' + date.getFullYear());
    $('.reservation_date_change').val(day + '-' + month + '-' + date.getFullYear());

    function getReservations(){
        setTimeout(function () {
            var date = $('.reservation_date_change').val();
            var id = $('.reservation_date_change').attr('data-id');
            $.ajax({
                url: "/shop/service/get-reservations",
                type: "POST",
                data: {
                    date: date,
                    id: id
                },
                success: function (data) {
                    $('.test').html(data);
                    $('.datepicker').css('left', '-100000px');
                    $('.reservation_date_change').blur();
                }
            });
        }, 100);
    }

    $(document).on('click', '.datepicker--cell-day', function () {

        if($('.reservation_date').length) {
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
                        $('.datepicker').css('left', '-100000px');
                        $('.reservation_date').blur();
                    }
                });
            }, 100);
        }

        else if ($('.reservation_date_change').length){
            getReservations();
        }
    });

    $(document).on('click', '.service-reserve', function () {
        var info = $('.reservation_date');
        var id = info.attr('data-id');
        var date = info.val();
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
        var text = [];
        $('.service-reserve').each(function () {
            if ($(this).hasClass('btn-success')) {
                text.push($(this).html());
            }
        });
        $.ajax({
            type: 'POST',
            url: "/shop/shop/get-person-count",
            data: {
                text: text,
                date: date,
                product_id: id
            },
            success: function (data) {
                $('.person_count_block').html(data);
            }
        });

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
                        success: function (data) {
                            if (data === 'full') {
                                button.removeClass('btn-success');
                                button.addClass('btn-warning');
                            } else {
                                button.removeClass('btn-success');
                                button.addClass('btn-info');
                            }
                            $('#error_message').html("Периоды забронированы");
                            $('.person_count_block').html('');
                        },
                        error: function () {
                            $('#error_message').html("Ошибка");
                        }
                    });
                }
            });
        }
    });

    $(document).on('click', '.delete-reservation', function (e) {
        e.preventDefault();
        if (confirm('Вы уверены что хотите удалить это бронирование?')) {
            var res = $(this);
            var id = res.attr('data-id');
            $.ajax({
                type: 'POST',
                url: "/shop/service/delete-reservation",
                data: {
                    id:id
                },
                success: function (data) {
                    if(data === 'ok')
                        res.parent().remove();
                    else
                        alert('Ошибка');
                }
            });
        }
    });

    $(document).on('click', '.create-reservation', function (e) {
        e.preventDefault();
        var value = $("[name=chosen_period]").val();
        var id = $('.reservation_date_change').attr('data-id');
        var date = $('.reservation_date_change').val();
        $.ajax({
            type: 'POST',
            url: "/shop/service/create-reservation",
            data: {
                id:id,
                value: value,
                date:date
            },
            success: function () {
                getReservations();
            }
        });
    });

});