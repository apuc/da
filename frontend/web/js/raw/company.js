$(document).ready(function () {
    $('.business__descr p').find('img').each(function () {
        $(this).addClass('newsImg');
        $(this).wrap('<a href="' + $(this).attr('src') + '" data-lightbox="image-1"></a>')
        /*if ($(this).width() > 800) {*/
        $(this).css({width: '100%', height: '100%'});
        /*}*/
    });

    /*business sidebar script*/
    $('.business__sidebar--items ul li a').on('click', function (event) {
        event.preventDefault();
        if ($(this)[0].hasAttribute('data-id')) {
            var dataId = $(this).attr('data-id'),
                mainBlock = $('#business-sidebar-main'),
                hoverBlock = $('#business-sidebar-hover-' + dataId);
                /*$.ajax({
                    url: 'company/company/get-company',
                    type: 'GET',
                    data: {
                        catId: dataId,
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });*/
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

    if($("input").is("#input-2-xs")) {
        $('#input-2-xs').rating({
                theme: "",
                language: "ru",
                stars: 5,
                filledStar: '<i class="fa fa-star fa-fw"></i>',
                emptyStar: '<i class="fa fa-star fa-fw"></i>',
                containerClass: "",
                size: "xs",
                animate: !0,
                displayOnly: 1,
                rtl: !1,
                showClear: 0,
                showCaption: 0,
                hoverEnabled: 0,
                hoverChangeCaption: !0,
                hoverChangeStars: !0,
                hoverOnClear: !0,
                zeroAsNull: !0,
                defaultCaption: "Stars {rating}",
                step: '0.1'
            }
        );
    }
    /*close business sidebar script*/
});