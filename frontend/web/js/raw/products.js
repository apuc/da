$(document).ready(function () {

    //Добавление в корзину товара
    $(document).on('click', '.add-to-cart', function () {

        var id = $(this).data('id');
        var shopId = $(this).attr('shop-id');
        var count = $('.count-add-to-cart').val();
        $.ajax({
            type: 'POST',
            url: "/shop/cart/add-in-cart",
            data: {
                product_id: id,
                count: count,
                shop_id: shopId,
                _csrf: $('meta[name=csrf-token]').attr("content")
            },
            success: function (data) {
                //alert(data);
                //console.log(data);

                var res = JSON.parse(data);

                $('.basket-counter').html(res.cartCount);
                $('.modal-count-cart').html(res.cartCount);
                $('#modal_close').after(res.cart);
            }
        });


        return false;
    });

    $(document).on('click', '.delete-product-cart', function () {
        var product = $(this).attr('product-id');
        var shop = $(this).attr('shop-id');

        $.ajax({
            type: 'POST',
            url: "/shop/cart/delete-from-cart",
            data: {
                product_id: product,
                shop_id: shop,
                _csrf: $('meta[name=csrf-token]').attr("content")
            },
            success: function (data) {
                //alert(data);
                console.log(data);

                /*var res = JSON.parse(data);
                $('.basket-counter').html(res.cartCount);*/
            }
        });

        return false;
    });

    /*$('.update-count-cart').on('click', function () {
        var product = $(this).attr('product-id');
        var shop = $(this).attr('shop-id');
        var count;
        setTimeout(function () {
            count = $('#js-product-quantity' + product).val();
            $.ajax({
                type: 'POST',
                url: "/shop/cart/set-count",
                data: {
                    product_id: product,
                    shop_id: shop,
                    count: count,
                    _csrf: $('meta[name=csrf-token]').attr("content")
                },
                success: function (data) {
                    $('.shop__content').html(data);

                }
            });
        }, 100);
    });*/

    //Изменение кол-ва товара в корзине
    $(document).on('click', '.update-count-cart', function () {
        var product = $(this).attr('product-id');
        var shop = $(this).attr('shop-id');
        var count;
        setTimeout(function () {
            count = $('#js-product-quantity' + product).val();
            $.ajax({
                type: 'POST',
                url: "/shop/cart/set-count",
                data: {
                    product_id: product,
                    shop_id: shop,
                    count: count,
                    _csrf: $('meta[name=csrf-token]').attr("content")
                },
                success: function (data) {
                    $('.shop__content').html(data);

                }
            });
        }, 100);
    });

    $(document).on('click', '.update-count', function () {
        setTimeout(function () {
            priceCount();
        }, 1000);
    });
    $('.update-count').on( "click", function() {
        setTimeout(function () {
            priceCount();
        }, 100);
    });


    $(document).on('change', '.count-add-to-cart', function () {
        priceCount();
    });


    //Добавить товар в с писок желаний
    $('.add-product-like').on('click', function () {

        var elem = $(this);
        var productId = elem.data('id');

        $.ajax({
            type: 'POST',
            url: "/shop/shop/like",
            data: {
                product_id: productId,
                _csrf: $('meta[name=csrf-token]').attr("content")
            },
            success: function (data) {
                if(data == 1){
                    elem.addClass('active');
                }else{
                    elem.removeClass('active');
                }
            }
        });

        return false;
    });


    //Рейтинг
    $('#stars_select li').on('click', function() {
       $('.product-rating').val($(this).attr('data-value'));
    });


    //Добавление отзыва
    $(document).on('submit', '#addReviewsProducts', function(e){
        e.preventDefault();
        var comments = $(".shop__usefull-comments");
        var data = $(this).serialize();
        $.ajax({
            url: '/ajax/ajax/add-reviews-products',
            type: 'POST',
            data: data,
            success: function(res){
                comments.append(res);
                $('#addReviewsProducts')[0].reset();
            },
            error: function(){
                alert('Error!');
            }
        });
        return false;
    });


    //Добавление комментария
    $(document).on('submit', '#addQuestionProducts', function(e){
        e.preventDefault();
        var comments = $(".shop__usefull-comments");
        var data = $(this).serialize();
        $.ajax({
            url: '/ajax/ajax/add-question-products',
            type: 'POST',
            data: data,
            success: function(res){
                comments.append(res);
                $('#addQuestionProducts')[0].reset();
            },

        });
        return false;
    });


    // Очистка форм комментариев
    $(".review-product-cancel").on('click', function(){
        $('#addReviewsProducts')[0].reset();
        $('#addQuestionProducts')[0].reset();
    });


    if($("input").is("#input-2-xs")) {
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

});
function priceCount()
{
    var id = $('.add-to-cart').attr('data-id');
    var count =  $('.count-add-to-cart').val();
    //alert(id);
    $.ajax({
        type: 'POST',
        url: "/shop/cart/price-count",
        data: {
            product_id: id,
            count: count,
            _csrf: $('meta[name=csrf-token]').attr("content")
        },
        success: function (data) {
            $('.total-cost').html(data);

        }
    });
}