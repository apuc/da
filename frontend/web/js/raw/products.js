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
                console.log(data);

                var res = JSON.parse(data);
                $('.basket-counter').html(res.cartCount);
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

    $('.update-count-cart').click(function () {
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
        }, 100);
    });

    $(document).on('change', '.count-add-to-cart', function () {
        priceCount();
    });


    //Добавить товар в с писок желаний
    $(document).on('click', '.single-shop__desires', function () {
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