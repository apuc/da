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

    $('.element-title').on('click', function(){
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: "/company/company/get_sub_categ",
            data: 'id=' + id,
            success: function (data) {
                $(".clicked-element").html(data);
            }
        });
        return false;
    });

    $('.allNewsPageLink').on('click', function(event){
        event.preventDefault();

    });
});
