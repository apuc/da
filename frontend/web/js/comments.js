$(document).ready(function () {

    $(document).on('click', '.add-comment', function () {
        $('#modal-add-comment-submit').attr('data-post-type', $(this).attr('data-post-type'));
        $('#modal-add-comment-submit').attr('data-post-id', $(this).attr('data-post-id'));
        $('#modal-add-comment-submit').attr('data-parent-id', $(this).attr('data-parent-id'));
        $('#comment').val('');
    })

    $(document).on('click', '#modal-add-comment-submit', function () {

        var comment = $('#comment').val();
        if (comment != '') {
            $.ajax({
                url: '/ajax/ajax/add-comment',
                type: "POST",
                data: {
                    _csrf: $('meta[name=csrf-token]').attr("content"),
                    comment: comment,
                    post_type: $(this).attr('data-post-type'),
                    post_id: $(this).attr('data-post-id'),
                    parent_id: $(this).attr('data-parent-id'),
                },
                success: function (data) {
                    $('#modal-add-comment').html(data);
                }
            });
        }

        return false;
    })

})