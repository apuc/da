$(document).ready(function () {

    $(document).on('click', '#get-more-faq', function () {


        $.ajax({
            url: '/ajax/ajax/more-faq/',
            type: "POST",
            data: {
                '_csrf': $('meta[name=csrf-token]').attr("content"),
                'offset': parseInt($('#get-more-faq').attr('data-offset')),
            },
            success: function (data) {
                $('#get-more-faq').attr('data-offset', parseInt($('#get-more-faq').attr('data-offset')) + 3);
                $('.ask-question').before(data);
            }
        });

        return false;
    });

    $(document).on('click', '#consulting-more-posts', function () {

        $.ajax({
            url: '/ajax/ajax/consulting-more-posts/',
            type: "POST",
            data: {
                '_csrf': $('meta[name=csrf-token]').attr("content"),
                'offset': parseInt($('#consulting-more-posts').attr('data-offset')),
                'type': $('#consulting-more-posts').attr('data-type')
            },
            success: function (data) {
                console.log(data);
                $('#consulting-more-posts').attr('data-offset', parseInt($('#consulting-more-posts').attr('data-offset')) + 3);
                $('#consulting-more-posts').before(data);
            }
        });

        return false;
    })

})