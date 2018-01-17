(function worker() {
    /*$.ajax({
        url: 'company/company/startwidgetcompany',
        success: function(data) {
            $('.category-items').html(data);
        },
        complete: function() {
            // Schedule the next request when the current one's complete
            setTimeout(worker, 20000);
        }
    });*/

    $('#load-more-company').on('click', function () {
        var step = $(this).attr('data-step');
        $.ajax({
            type: 'POST',
            url: "/company/company/get-more-company",
            data: {
                step: step,
                _csrf: $('meta[name=csrf-token]').attr("content")
            },
            success: function (data) {
                $('.business__sidebar').removeClass('absolute');
                $('.business__sidebar').addClass('fixed');
                $('#more-company-box').append(data);
                $('#load-more-company').attr('data-step', parseInt(step) + 1);
            }
        });
        return false;
    })
})();