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

    $('.content-single p').find('img').each(function () {
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
        width: "auto",
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
    OpenCategories(el, i);

//comments ajax


});

function OpenCategories(el, i) {
    el.closest('ul').slideDown();
    i++;
    if ($(el).closest('ul').hasClass('end')) {
        return;
    } else {
        OpenCategories(el.parent(), i);
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

$(document).on('click', '.parent', function () {

    if ($(this).closest('li').find('ul').length > 0) {
        $(this).parent('li').find('ul').first().slideToggle().toggleClass('active');

        return false;
    }


})

$(document).on('change', '.profile-avatar', function () {

    console.log('ok');
    readURL(this);
})

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.blah').attr('src', e.target.result);

            console.log(input.files);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$('.column-list-js').columnlist({size: 2});

$(document).on('click', '.more-comments', function () {
    $.ajax({
        type: 'POST',
        url: "/ajax/ajax/get_more_comments",
        data: {
            date: $(this).attr('data-time'),
            post_type: $(this).attr('data-type'),
            count: $(this).attr('data-count'),
            limit: $(this).attr('data-limit'),
            post_id: $(this).attr('data-id'),
        },
        success: function (data) {

            $('.comments-content').html($('.comments-content').html() + data);
            $('.more-comments').attr('data-count', +$('.more-comments').attr('data-count') + +$('.more-comments').attr('data-limit'));
        }
    });
})
$(document).on('click', '#send_comment', function () {
    var comment = $('#new-comment').val();
    if (comment != '') {
        $.ajax({
            url: "/ajax/ajax/add_comment",
            type: "POST",
            data: {
                post_id: $('.more-comments').attr('data-id'),
                post_type: $('.more-comments').attr('data-type'),
                content: comment,
            },
            success: function (data) {
                location.reload();
                // console.log(data);
                //$('.comments-content').html( data + $('.comments-content').html() );
            }
        });
    }

    return false;
})