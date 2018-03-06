$(document).ready(function () {
    $(document).on('click', 'li.date', function () {
        $('input.input-group').val($(this).data('value'));
        $('.submit-stock').click();
    });
});