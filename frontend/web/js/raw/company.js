$(document).ready(function () {
    $('.business__descr p').find('img').each(function () {
        $(this).addClass('newsImg');
        $(this).wrap('<a href="' + $(this).attr('src') + '" data-lightbox="image-1"></a>')
        /*if ($(this).width() > 800) {*/
        $(this).css({width: '100%', height: '100%'});
        /*}*/
    });


    $(".input__wrap input").on("click",function () {
        $(this).parent().find(".memo").show();
    });

    $(".field-company-photo").on("click",function () {
         $(this).find(".memo").show();
    });

    $("body").on("click",function (event) {

         var name = event.target.className;

         if(name.indexOf("file") == -1 && name.indexOf("hidden-xs") == -1 && name.indexOf("jsHint") == -1)
         {
             $(".field-company-photo").find(".memo").hide();
         }

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
    $(document).on('click', '.company__add-phone', function (event) {
        var iterator = parseInt($('.cabinet__add-company-form--wrapper').attr('data-iterator'));
        iterator = iterator + 1;
        $.ajax({
            url: '/company/company/add-phone',
            data: {
                iterator: iterator,
                _csrf: yii.getCsrfToken()
            },
            type: 'POST',
            success: function (html) {

                $('.cabinet__add-company-form--wrapper').attr('data-iterator', iterator);
                $('.cabinet__add-company-form--wrapper').append(html);
            }
        });
        return false;
    });

    $(document).on('click', '.company__remove-phone', function () {
        $(this).closest('.phones__wrap').remove();
    });

    $(document).on('click', '#slider_checkbox', function () {
        $('#slider_images').toggle();
    });

    $('#input-1-xs').on('rating:change', function (event, value, caption) {
        $("#companyfeedback-rating").val(value);
    });

    $(document).on('submit', '#addCompanyReviews', function () {
        $.pjax.reload({
            container: ".business__reviews",
            url: '/company/company/add-feedback',
            data: $(this).serialize(),
            replace: false,
            timeout: 10000
        });
        return false;
    });

    $('#addCompanyReviews').on('beforeSubmit', function () {
        var data = $(this).serialize();
        $.ajax({
            url: '/company/company/add-feedback',
            type: 'POST',
            data: data,
            success: function (res) {
                console.log(res);
                console.log(data);
                $('#addCompanyReviews').html(res);
            },
            error: function () {
                alert('Error!');
            }
        });
        return false;
    });

    if ($("input").is("#input-2-xs")) {
        $('#input-1-xs').rating({
                theme: "",
                language: "ru",
                stars: 5,
                filledStar: '<i class="fa fa-star fa-fw"></i>',
                emptyStar: '<i class="fa fa-star fa-fw"></i>',
                containerClass: "",
                size: "xs",
                animate: !0,
                displayOnly: !1,
                rtl: !1,
                showClear: 0,
                showCaption: !0,
                starCaptionClasses: {
                    1: "label label-danger badge-danger",
                    2: "label label-warning badge-warning",
                    3: "label label-info badge-info",
                    4: "label label-primary badge-primary",
                    5: "label label-success badge-success"
                },
                clearButton: '<i class="glyphicon glyphicon-minus-sign"></i>',
                clearButtonBaseClass: "clear-rating",
                clearButtonActiveClass: "clear-rating-active",
                clearCaptionClass: "label label-default",
                clearValue: null,
                captionElement: null,
                clearElement: null,
                hoverEnabled: !0,
                hoverChangeCaption: !0,
                hoverChangeStars: !0,
                hoverOnClear: !0,
                zeroAsNull: !0,
                defaultCaption: "Stars {rating}",
                starCaptions: {
                    1: "1",
                    2: "2",
                    3: "3",
                    4: "4",
                    5: "5"
                },
                clearCaption: "Нет оценки"
            }
        );
    }

    if ($("input").is("#input-2-xs")) {
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
    $('input#input-user-xs').each(function (indx, element) {
        $(element).rating({
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
                step: '1'
            }
        );
    });
    /*close business sidebar script*/
});