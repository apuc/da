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


    $(document).on('click', '.update-count', function () {
        setTimeout(function () {
            priceCount();
        }, 100);
    });

    $(document).on('change', '.count-add-to-cart', function () {
        priceCount();
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