$(document).ready(function () {
    $('.menu-link a').on('click', function () {
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: "/mainpage/default/get_news_by_cat",
            data: 'id=' + id,
            success: function (data) {
                $(".content__main_posts").html(data);
            }
        });
    });

    $(document).on('click', '.content__main_posts_items', function () {
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: "/mainpage/default/get_news_by_id",
            data: 'id=' + id,
            success: function (data) {
                $(".content__main_post").html(data);
            }
        });
        return false;
    });

    /*$('.company_list_item a').on('click', function () {
     var id = $(this).attr('data-id');
     $.ajax({
     type: 'POST',
     url: "/mainpage/default/get_company_by_cat",
     data: 'id=' + id,
     success: function (data) {
     $(".category-items").html(data);
     }
     });
     return false;
     });*/

    $('#news-lang_id').on('change', function () {
        var langId = $(this).val();
        $.ajax({
            type: 'POST',
            url: "/news/news/get_categ",
            data: 'langId=' + langId,
            success: function (data) {
                $("#admin_news_category_box").html(data);
            }
        });
    });

    $('#company-lang_id').on('change', function () {
        var langId = $(this).val();
        $.ajax({
            type: 'POST',
            url: "/company/company/get_categ",
            data: 'langId=' + langId,
            success: function (data) {
                $("#admin_company_category_box").html(data);
            }
        });
    });

    $(document).on('change', '.itemImg', function () {
        var path = $('.itemImg').val();
        $('.media__upload_img').html('<img src="' + path + '" width="100px"/> <br>');
    });

    $('.news__post p').find('img').each(function () {
        $(this).addClass('newsImg');
        $(this).wrap('<a href="' + $(this).attr('src') + '" data-lightbox="image-1"></a>')
        if ($(this).width() > 800) {
            $(this).css({width: '100%', height: 'auto'});
        }
    });

    $('.element-title').on('click', function () {
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: "/company/company/get_sub_categ",
            data: 'id=' + id,
            success: function (data) {
                $(".clicked-element[data-id=" + id + "]").html(data).slideToggle();
                $(".element").find('a[data-id="' + id + '"]').find('img').toggle();
                var elem = $(".element");
                $.each(elem, function () {
                    if ($(this).find("a").attr('data-id') != id
                        && $(this).find("a").attr('data-id') != undefined
                        && $(this).find("a").hasClass("main-elem")) {
                        $(this).fadeToggle();
                    }
                    else {
                        $(this).fadeOut().fadeIn();
                    }
                    ;
                })
                updateCompanybyCategory(id);
            }
        });
        return false;
    });

    $(document).on('click', '.element-title', function () {
        var id = $(this).attr('data-id');
        updateCompanybyCategory(id);
        return false;
    });

    function updateCompanybyCategory(id) {
        $.ajax({
            type: 'POST',
            url: "/company/company/get_company_by_categ",
            data: 'id=' + id,
            success: function (data) {
                console.log(data);
                $(".category-items").html(data);
            }
        })
    }

    $('.allNewsPageLink').on('click', function (event) {
        event.preventDefault();

    });
    VK.Widgets.Group("vk_groups", {
        mode: 3,
        width: "auto",
        height: "100",
        color1: 'FFFFFF',
        color2: '000000',
        color3: '5E81A8'
    }, 123860296);
    VK.Widgets.Group("vk_groups_news", {
        mode: 3,
        width: "340",
        height: "154",
        color1: 'FFFFFF',
        color2: '000000',
        color3: '5E81A8'
    }, 123860296);

// $(document).on('click','.parent',function () {
//     $(' .active').removeClass('active');
//     $(this).toggleClass('active');
//     if ($(this).next('.inserted').find('li').length!=0){
//         $(this).next('.inserted').slideToggle();
//     }
//
//     if ($(this).attr('faq-id') && $(this).hasClass('active')){
//         var id = $(this).attr('faq-id');
//         updateConsultcontent(id);
//     }
//
//     return false;
// })

    // function updateConsultcontent(id) {
    //     $.ajax({
    //         //url: "/consulting/consulting/get_faq_by_cat_id",
    //          url: "/consulting/consulting/ajax_faq",
    //         type: "GET",
    //         data: "id=" + id,
    //         success: function (data) {
    //             $(".consult-item-content").html(data);
    //         }
    //     });
    // }
    //Waryataw
    if ($('.active').next('.inserted').find('li').length != 0) {
        $('.active').next('.inserted').slideToggle();
    }
    var el = $('.inserted').find('.active');
    var parent = 0;
    var i = 1;
    OpenCategories(el,i);


});

function OpenCategories(el,i) {
    el.closest('ul').slideDown();
    i++;
    if ($(el).closest('ul').hasClass('end')) {
       return;
    } else {
        OpenCategories(el.parent(),i);
    }
}

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.8";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

