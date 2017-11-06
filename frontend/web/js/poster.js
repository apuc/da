$(document).ready(function () {
    $('#load-more-posters').on('click', function () {
        var step = parseInt($(this).attr('data-step'));
        $.ajax({
            type: 'POST',
            url: "/poster/default/get-more-poster",
            data: {
                step: step,
                _csrf: $('meta[name=csrf-token]').attr("content")
            },
            success: function (data) {
                console.log(data);
                var res = JSON.parse(data);
                $('.news__wrap_buttons').before(res.html);
                $('#load-more-posters').attr('data-step', step + 12);
                if(res.last === 1){
                    $('#load-more-posters').remove();
                }
            }
        });
        return false;
    });

    $('#load-more-kino').on('click', function () {
        var step = parseInt($(this).attr('data-step'));
        $.ajax({
            type: 'POST',
            url: "/poster/default/get-more-kino",
            data: {
                step: step,
                _csrf: $('meta[name=csrf-token]').attr("content")
            },
            success: function (data) {
                var res = JSON.parse(data);
                $(res.html).insertBefore('#more-kino-box');
                //$('#more-kino-box').append(res.html);
                $('#load-more-kino').attr('data-step', step + 1);
                if(res.last === 1){
                    $('#load-more-kino').remove();
                }
            }
        });
        return false;
    });
    /*============================================================
     INTERESTED IN POSTERS
     =============================================================*/
    $(document).on('click', '.js-interested-in-more', function () {
        event.preventDefault();

        $.post(
            '/poster/default/more-interested-in',
            {
                _csrf : $('meta[name=csrf-token]').attr("content")
            },
            function(data) {
                $('.js-interested-cats').append(data);
                $('.js-interested-in-more').remove();
            }
        );
    });
    // показываем афиши категории
    $(document).on('click','.interested__item',function(){
        event.preventDefault();
        var posterCatID = parseInt($(this).attr('data-interested-index'));

        $.post(
            '/poster/default/interested-in-posters',
            {
                posterID: posterCatID,
                _csrf : $('meta[name=csrf-token]').attr("content"),
            },
            function(data) {
                $('.js-interested-posters').html(data);
                $('.js-interested-cats').fadeOut(200);
                $('.js-interested-posters').fadeIn(200);
                $('.js-interested-posters-back').show();
                $('.js-interested-in-more').hide();
            }
        );
    });

    $(document).on('click','.js-interested-posters-back',function(){
        event.preventDefault();

        $(this).hide();
        $('.js-interested-posters').fadeOut(200).html('');
        $('.js-interested-cats').fadeIn(200);
        $('.js-interested-in-more').show();
    });

    /*single afisha countdown*/
    if ($('#countdown').length > 0){

        var date = $('#countdown').attr('data-date');

        $("#countdown").countdown({
                date: date,
                //date: "16 august 2017 12:00:00",
                format: "on",
                languge: 'ru'
            },
            function () {});
    }

    /*close single afisha countdown*/
});