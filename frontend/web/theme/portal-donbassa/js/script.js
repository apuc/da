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

    $(document).on("click",".tgl_mnu",function () {
      $('.content__main_mnu').slideToggle();
    });
    Share = {
        vkontakte: function(purl, ptitle, pimg, text) {
            url  = 'http://vkontakte.ru/share.php?';
            url += 'url='          + encodeURIComponent(purl);
            url += '&title='       + encodeURIComponent(ptitle);
            url += '&description=' + encodeURIComponent(text);
            url += '&image='       + encodeURIComponent(pimg);
            url += '&noparse=true';
            Share.popup(url);
        },
        odnoklassniki: function(purl, text) {
            url  = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
            url += '&st.comments=' + encodeURIComponent(text);
            url += '&st._surl='    + encodeURIComponent(purl);
            Share.popup(url);
        },
        facebook: function(purl, ptitle, pimg, text) {
            url  = 'http://www.facebook.com/sharer.php?s=100';
            url += '&p[title]='     + encodeURIComponent(ptitle);
            url += '&p[summary]='   + encodeURIComponent(text);
            url += '&p[url]='       + encodeURIComponent(purl);
            url += '&p[images][0]=' + encodeURIComponent(pimg);
            Share.popup(url);
        },
        twitter: function(purl, ptitle) {
            url  = 'http://twitter.com/share?';
            url += 'text='      + encodeURIComponent(ptitle);
            url += '&url='      + encodeURIComponent(purl);
            url += '&counturl=' + encodeURIComponent(purl);
            Share.popup(url);
        },
        mailru: function(purl, ptitle, pimg, text) {
            url  = 'http://connect.mail.ru/share?';
            url += 'url='          + encodeURIComponent(purl);
            url += '&title='       + encodeURIComponent(ptitle);
            url += '&description=' + encodeURIComponent(text);
            url += '&imageurl='    + encodeURIComponent(pimg);
            Share.popup(url)
        },

        popup: function(url) {
            window.open(url,'','toolbar=0,status=0,width=626,height=436');
        }
    };

});