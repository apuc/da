$(document).ready(function () {
    $(document).on('click', 'li.date', function () {
        $('input.date-input').val($(this).data('value'))
    })
});