$(document).ready(function(){
    $('.shop__main--categories li').click(function(e){
        e.preventDefault();
        var data_id = $(this).attr('data-id');
        var childs = $('.shop__main--categories').children().removeClass('active');
        childs.removeClass('active');
        $(this).addClass('active');

        $.ajax({
            type: "POST",
            url: "/ajax/ajax/get-products-by-category-id",
            data: {ProdId : data_id},
            dataType: 'json',
            success: function(data){
                $("#you_like_items").empty();
                for(var i = 0; i < data.length; i++) {
                    if(data[i].new_price != null)
                        $("#you_like_items").append("<a href='" + data[i].cover + "' class='shop__top-sales-home-elements--item'>" +
                            "<h3 class='category-name'>" + data[i].category + "</h3>" +
                            "<p class='category-element'>" + data[i].title + "</p>" +
                            "<div class='category-photo'>" +
                            "<img src='img/shop/category-photo-1.png' alt=''>" +
                            "</div>" +
                            "<div class='category-price'>" +
                            "<span class='category-price__old'>" + data[i].price + "<i class='fa fa-rub'" +
                            "aria-hidden='true'></i></span>" +
                            "<span class='category-price__new'>" + data[i].new_price + "<i class='fa fa-rub'" +
                            "aria-hidden='true'></i></span>" +
                            "</div>" +
                            "<button class='category-buy'>Купить</button>" +
                            "</a>");
                    else
                        $("#you_like_items").append("<a href='" + data[i].cover + "' class='shop__top-sales-home-elements--item'>" +
                            "<h3 class='category-name'>" + data[i].category + "</h3>" +
                            "<p class='category-element'>" + data[i].title + "</p>" +
                            "<div class='category-photo'>" +
                            "<img src='img/shop/category-photo-1.png' alt=''>" +
                            "</div>" +
                            "<div class='category-price'>" +
                            "<span class='category-price__new'>" + data[i].price + "<i class='fa fa-rub'" +
                            "aria-hidden='true'></i></span>" +
                            "</div>" +
                            "<button class='category-buy'>Купить</button>" +
                            "</a>");

                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
});