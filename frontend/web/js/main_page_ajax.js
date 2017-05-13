$(document).ready(function () {

    $(document).on('click', '.js-send-ask-question', function () {
        var content = $(this).prev('textarea').val();

        if (content != '') {

            $.ajax({
                url: '/ajax/ajax/add-contacting',
                type: "POST",
                data: {
                    content: content,
                    _csrf: $('meta[name=csrf-token]').attr("content")
                } ,
                success: function (data) {
                    window.location.reload();
                }
            });

        }

        return false;
    });

})