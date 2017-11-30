$(document).ready(function () {
    var from = $('#convert-sum');
    var to = $('#convert-result');
    var fromDropDown = $('#currency-selection');
    var toDropDown = $('#convert-to');
    var arrow = $('#arrow');
    var isRUB = true;

    from.on('focus', function () {
        isRUB = true;
        changeArrow();
    });
    to.on('focus', function () {
        isRUB = false;
        changeArrow();
    });
    from.on('input', function () {
        isRUB = true;
        Calc();
    });
    to.on('input', function () {
        isRUB = false;
        Calc();
    });
    toDropDown.on('change', function () {
        Calc();
    });

    function Calc() {
        $.ajax({
            url: '/currency/default/calculate',
            type: 'POST',
            data: {
                rub: isRUB,
                fromVal: from.val(),
                toVal: to.val(),
                fromCurrency: fromDropDown.find(':selected').val(),
                toCurrency: toDropDown.find(':selected').val()
            },
            success: function (data) {
                if (isRUB) {
                    to.val(data);
                } else {
                    from.val(data);
                }
            }
        })
    }

    function changeArrow() {
        if (isRUB) {
            arrow.removeClass("fa-angle-left");
            arrow.addClass("fa-angle-right");
        } else {
            arrow.removeClass("fa-angle-right");
            arrow.addClass("fa-angle-left");
        }
    }
});