$(document).ready(function () {
    $(document).on('click', '.sbm-poll', function () {
        var answer = $('.poll').find('input:checked').attr('data-id');
            console.log(answer);
        if (answer != undefined) {

            $.ajax({
                type: 'POST',
                url: 'ajax/ajax/send_poll',
                data: {
                    answer: answer,
                    _csrf: $('meta[name=csrf-token]').attr("content")
                },
                success: function (data) {
                    $('.poll').html(data);
                    initPollProgressBar();
                },
            });
        }
        return false;
    })
    //poll results progressbar
    initPollProgressBar();
    function initPollProgressBar() {
        var bars = $('div[role = "progressbar"]');
        //console.log(bars);
        var counter = 40;
        for (i = 0; i < bars.length; i++) {

            $(bars[i]).progressbar({
                value: +$(bars[i]).attr('data-progress')
            });

            /*$(bars[i]).progressbar( "value" , counter);*/






           /* console.log($(bars[i]).attr('data-progress'));
            console.log('*-------------------*');*/
           // console.log($(bars[i]));

        }

/*
        $( ".progressbar" ).progressbar({
            value: 50
        }*!/);*/

    }

});


