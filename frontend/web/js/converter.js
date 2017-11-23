$(document).ready(function () {
    var from = $('#convert-sum');
    var to = $('#convert-result');
    var fromDropDown = $('#currency-selection');
    var toDropDown = $('#convert-to');
    var arrow = $('#arrow');

    var fromVal = parseInt(from.val());
    var toVal = parseInt(to.val());

    var fromCurrency = fromDropDown.find(':selected').val();
    var toCurrency = toDropDown.find(':selected').val();
    var isRUB = true;

    from.on('focus', function () {
        isRUB = true;
        changeArrow();
    });
    to.on('focus', function () {
        isRUB = false;
        changeArrow();
    });
    from.on('keyup', function () {
        isRUB = true;
        Calc();
    });
    to.on('keyup', function () {
        isRUB = false;
        Calc();
    });
    $(document).on('change', toDropDown, function () {
        Calc();
    });

    function Calc() {
        fromVal = parseInt(from.val());
        toVal = parseInt(to.val());
        toCurrency = toDropDown.find(':selected').val();

        $.ajax({
            url: '/currency/default/calculate',
            type: 'POST',
            data: {
                rub: isRUB,
                fromVal: fromVal,
                toVal: toVal,
                fromCurrency: fromCurrency,
                toCurrency: toCurrency
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