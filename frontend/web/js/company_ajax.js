(function worker() {
    $.ajax({
        url: 'company/company/startwidgetcompany',
        success: function(data) {
            $('.category-items').html(data);
        },
        complete: function() {
            // Schedule the next request when the current one's complete
            setTimeout(worker, 20000);
        }
    });
})();