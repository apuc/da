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
                var res = JSON.parse(data);
                $('#more-poster-box').append(res.html);
                $('#load-more-posters').attr('data-step', step + 1);
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
                $('#more-kino-box').append(res.html);
                $('#load-more-kino').attr('data-step', step + 1);
                if(res.last === 1){
                    $('#load-more-kino').remove();
                }
            }
        });
        return false;
    });
});