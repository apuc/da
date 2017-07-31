$(document).ready(function(){
    /*business sidebar script*/
    $('.business__sidebar--items ul li a').on('click', function (event) {
        event.preventDefault();
        if ($(this)[0].hasAttribute('data-id')) {
            var dataId = $(this).attr('data-id'),
                mainBlock = $('#business-sidebar-main'),
                hoverBlock = $('#business-sidebar-hover-' + dataId);
            if (hoverBlock.length > 0) {
                mainBlock.animate({width: "toggle"}, 400, function () {
                    hoverBlock.animate({width: "toggle"}, 400, function () {
                        hoverBlock.css({height: "auto"});
                    });
                });
            }
        }
    });
    $('.business__sidebar--hover-trigger').on('click', function (event) {
        event.preventDefault();
        var mainBlock = $('#business-sidebar-main'),
            hoverBlock = $(this).closest('.business__sidebar--hover-items');
        /*console.log(hoverBlock);*/
        hoverBlock.animate({width: "toggle"}, 400, function () {
            mainBlock.animate({width: "toggle"}, 400, function () {
                mainBlock.css({height: "auto"});
            });
        });
    });
    /*close business sidebar script*/
});