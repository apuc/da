$(document).ready(function() {
    var clock;

    clock = $('.countback').FlipClock({
        clockFace: 'DailyCounter',
        autoStart: false,
        callbacks: {
            stop: function() {
                $('.message').html('The clock has stopped!')
            }
        },
        showSeconds: false
    });

    clock.setTime(220880);
    clock.setCountdown(true);
    clock.start();

    $(window).scroll(function () {
        var scrollDiv = $('#Go_Top');
        $(this).hide().removeAttr("href");
        if ($(window).scrollTop() >= "250") $(this).fadeIn("slow") /*показывать при прокрутке вниз показывать медленно #Go_Top*/

        if ($(window).scrollTop() <= "250") $(scrollDiv).fadeOut("slow")/*при прокрутке ввверх медленно скрывать #Go_Top*/
        else $(scrollDiv).fadeIn("slow")
    });
    $('#Go_Top').click(function () {/*функция плавной прокрутки вверх при клике на стрелку "вверх"*/
        $("html, body").animate({scrollTop: 0}, "slow");
        return false;
    });

    $('.date-picker div').datepicker({
        dateFormat:'yyyy-mm-dd',
        onSelect: function(formattedDate, date, inst){
            console.log(formattedDate);
            window.location.href = '/news/archive/' + formattedDate;
        }
    });

});