$(document).ready(function () {

    $(document).on('click', '.likes', function () {

        var csrfToken = $(this).attr('csrf-token');
        var elem = $(this);
        $.ajax({
            url: '/likes/like',
            type: 'POST',
            data: {
                post_id: $(this).attr('data-id'),
                post_type: $(this).attr('data-type'),
                '_csrf': csrfToken,
            },
            success: function (data) {
                $('.like-counter').html(data);
                if(elem.hasClass('active')){
                    elem.removeClass('active');
                }else{
                    elem.addClass('active');
                }
            }
        });
    });

    $(document).on('click', '.show-more-news-js', function () {

        var csrfToken = $(this).attr('csrf-token');

        $.ajax({
            url: '/news/news/more-news',
            type: "POST",
            data: {
                '_csrf': csrfToken,
                'offset':$(this).attr('data-offset')
            },
            success: function (data) {
                $('.show-more-news-js').attr('data-offset',parseInt($('.show-more-news-js').attr('data-offset') )+ 16);
                $('.home-content__wrap_subscribe').before(data);

            }
        });

        return false;
    })

    $(document).on('click', '.show-more-category-news-js', function () {

        var csrfToken = $(this).attr('csrf-token');

        $.ajax({
            url: '/news/news/more-category-news',
            type: "POST",
            data: {
                '_csrf': csrfToken,
                'offset':$(this).attr('data-offset'),
                'category':$(this).attr('data-category')
            },
            success: function (data) {
                $('.show-more-news-js').attr('data-offset',parseInt($('.show-more-news-js').attr('data-offset') )+ 16);
                $('.home-content__wrap_subscribe').before(data);

            }
        });

        return false;
    })

    $('.datepicker-here').datepicker({
        dateFormat: 'yyyy-mm-dd',
        onSelect: function (formattedDate, date, inst) {

            console.log(formattedDate);
            window.location.href = '/news/archive/' + formattedDate;
        }
    });

    //Загрузить больше популярных афиш в виджете
    $(document).on('click', '.load-more-popular-poster-w', function () {
        var page = $(this).attr('data-page');
        $(this).attr('data-page',+page+1);
        $.ajax({
            url: '/poster/default/more-poster',
            type: "POST",
            data: {
                '_csrf': $(this).attr('csrf-token'),
                'page':$(this).attr('data-page'),
                'limit':$(this).attr('data-limit'),
                'count':$(this).attr('data-count-post')
            },
            success: function (data) {
               /* $('.show-more-news-js').attr('data-offset',parseInt($('.show-more-news-js').attr('data-offset') )+ 16);
                $('.home-content__wrap_subscribe').before(data);*/
               var res = JSON.parse(data)
                $('.afisha-events__wrap').append(res.html);
                if(res.last === 1){
                    $('.load-more-popular-poster-w').remove();
                }
            }
        });
        return false;
    })

    $(document).on('click', '.addCategAddNewsUser', function () {
        $('.error_cat').text('');
        var catIdSelect = '';
        var selects = $('.selectCateg');
        var lastSelect = selects[selects.length - 1];

        $('.selectCateg').each(function (i,e) {
            catIdSelect += $(this).val() + ',';
            if(i < selects.length && $(lastSelect).val() != ''){
                //$(this).attr('disabled', true);
                $(this).attr('readonly', true);
            }
        });

        if($(lastSelect).val() == ''){
            $('.error_cat').text('Выберите категорию');
            return false;
        }

        $.ajax({
            url: '/ajax/ajax/add-category-select',
            type: "POST",
            data: {
                '_csrf': $("input[name='_csrf']").val(),
                'catId': catIdSelect
            },
            success: function (data) {
                $('.addSelectCateg').before(data);
            }
        });
        return false;
    });

    $(document).on('click', '.delselectCateg', function () {
        var elem = $(this).closest('.cabinet__add-company-form--hover-wrapper');
        elem.remove();

        var selects = $('.selectCateg');
        var lastSelect = selects[selects.length - 1];
        $(lastSelect).attr('readonly', false);

    });


    $("#news-photo").change(function () {
        readURL(this);
    });
    $("#profile-avatar").change(function () {
        readURL(this);
    });
    $("#company-photo").change(function () {
        readURL(this);
    });
    $(document).on('change', '#categ_company', function () {
        var catId = $('#categ_company').val();
        console.log(catId);
        $.ajax({
            url: '/ajax/ajax/add-parent-category',
            type: "POST",
            data: {
                '_csrf': $("input[name='_csrf']").val(),
                'catId': catId
            },
            success: function (data) {
                $('.addParentCategory').html(data);
                //$('.addSelectCateg').before(data);
            }
        });
    });



})

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}