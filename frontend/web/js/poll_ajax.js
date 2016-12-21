;$(document).ready(function () {

    $(document).on('click', '.sbm-poll', function () {
        var answer = $('.poll').find('input:checked').attr('data-id');
        if (answer != undefined) {

            $.ajax({
                type: 'POST',
                url: 'ajax/ajax/send_poll',
                data: 'answer=' + answer,
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
        var bars = $(".poll-progressbar");
        for (i = 0; i < bars.length; i++) {
            $(bars[i]).progressbar({
                value: + $(bars[i]).attr('data-progress')
            });
            console.log($(bars[i]).attr('data-progress'));

        }


        // $( ".progressbar" ).progressbar({
        //     value: 50
        // });

    }

});


