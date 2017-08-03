setInterval(function () {
    $.ajax({
        url: '/stream/default/get-new-post',
        data:{
            '_csrf': $(".counter-stream-new").attr('csrf-token'),
            'count': $(".counter-stream-new").data('count'),
        },
        type: 'post',
        success: function (data) {
            $(".counter-stream-new").text(data);
        }
    });
}, 30000);
