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
                //$('.like-counter').html(data);
                elem.children('.like-counter').html(data);
                if(elem.hasClass('active')){
                    elem.removeClass('active');
                }else{
                    elem.addClass('active');
                }
            }
        });
        return false;
    });

    $(document).on('change', '#company-tariff_id', function () {
        $('.set-services-of-tariff').html('')
       if($(this).val() == 4)
       {
           $.ajax({
               url: '/secure/company/company/get-services',
               type: "get",
               success: function (data) {
                   $('.set-services-of-tariff').append(data);
               }
           });
       }
    });

    $(document).on('click', '.search-consulting-post', function () {
       // console.log('aaa');
       var q = $(this).prev().val();
        $.ajax({
            url: '/consulting/consulting/search-post',
            type: "get",
            data: {
                'q':q
            },
            success: function (data) {
                $('.laws').html('');
                $('.laws').append(data);
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

    $(document).on('click', '.show-more-stream', function (e) {
        var csrfToken = $(this).attr('csrf-token');
        var step = $(this).attr('data-step');
        //console.log($(".parser__wrapper").css('height').slice(0, -2) > 1850);
        $.ajax({
            url: '/stream/default/load-more',
            type: "POST",
            data: {
                '_csrf': csrfToken,
                'step':step
            },
            success: function (data) {
                var res = JSON.parse(data);
                    $('.show-more-stream').attr('data-step', parseInt($('.show-more-stream').attr('data-step') )+ 1);
                    for (result in res.render)
                    {
                        if($("#first-column").css('height').slice(0, -2) > $("#second-column").css('height').slice(0, -2))
                        {
                            $("#second-column").append(res.render[result]);
                        }else $("#first-column").append(res.render[result]);

                        //console.log(res.render[result]);
                    }
                    //$(".parser__wrapper").append(res.render);
                if(!res.count)
                {
                    $(".show-more-stream").hide();
                    $(".counter-stream-new").text('0');
                    timerUpdate('false');
                }
            }
        });
        return false;
    });

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

    $('#poster_archive').datepicker({
        dateFormat: 'yyyy-mm-dd',
        onSelect: function (formattedDate, date, inst) {

            console.log(formattedDate);
            window.location.href = '/poster/archive/' + formattedDate;
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
            console.log(catIdSelect);
            if(i < selects.length && $(lastSelect).val() != ''){
                //$(this).attr('disabled', true);
                //$(this).attr('readonly', true);
                $(this).addClass('disabled');
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
        var catIdSelect = '';
        var elem = $(this).closest('.cabinet__add-company-form--hover-wrapper');
        elem.remove();
        var selects = $('.selectCateg');
        console.log('Selects variable:',selects);
        var lastSelect = selects[selects.length - 1];
        $(lastSelect).removeClass('disabled');
    });

    $(document).on('click', '.delNewsSelectCateg', function () {
        var catIdSelect = '';
        var elem = $(this).closest('.cabinet__add-company-form--hover-wrapper');
        elem.remove();
        var selects = $('.selectCateg');
        var lastSelect = selects[selects.length - 1];
        var last_select = $('.selectCateg:last');
       // console.log(last_select);
        last_select.removeClass('disabled');
        $('.selectCateg').each(function (i,e) {
            catIdSelect += $(this).val() + ',';
        });
       /* $.ajax({
            url: '/ajax/ajax/add-category-select',
            type: "POST",
            data: {
                '_csrf': $("input[name='_csrf']").val(),
                'catId': catIdSelect
            },
            success: function (data) {
                $('.addSelectCateg').before(data);
            }
        });*/
        return false;
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
    $("#poster-photo").change(function () {
        readURL(this);
    });
    $("#stock-photo").change(function () {
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


    //Калькулятор тарифа
    $(document).on('click', '.services-select', function () {
        var price = 0;
        var count = 0;
        var id = '';
        var url = $('.servise-individual-order').attr('data-href');
        $('.services-select').each(function () {
            if ($(this).prop('checked')) {
                price += parseInt($(this).attr('price'));
                count++;
                id += $(this).attr('service-id') + ',';
            }
        });

        $('.summ-select-services').html(price);
        $('.count-select-services').html(count);

        url += '&price=' + price + '&servicesId=' + id;

        $('.servise-individual-order').attr('href', url);
    });

    //Отправка сообщения об ошибке
    $(document).on('click', '#send-error-site', function () {
        event.preventDefault();
        $.ajax({
            url: '/ajax/ajax/send-error-msg',
            type: "POST",
            data: {
                '_csrf': $("input[name='_csrf']").val(),
                'url': $("input[name='url']").val(),
                'user_id': $("input[name='user_id']").val(),
                'text': $("textarea[name='text-error']").val()
            },
            success: function (data) {
                if(data == 1){
                    $('#error-message').html('<h3 class="modal-callback__title">Спасибо. Мы исправим все ближайшее время</h3>')
                }else{
                    $('#error-message').html('<h3 class="modal-callback__title">Ваше сообщени об ошибке не отправлено.</h3>')
                }

                /*$('.addParentCategory').html(data);*/
                //$('.addSelectCateg').before(data);
            }
        });
        return false;
    });

    //Получение данных о компани и передача их в форму для отправки коментария
    $(document).on('click', '#add-review', function () {
        var id = $(this).attr('data-id'),
            name = $(this).attr('data-name');
        $("input[name='company_name']").val(name);
        $("input[name='company_id']").val(id);

    });
    //Отправка коментария о компании
    $(document).on('click', '#modal-review-submit', function (e) {
        var text = $("textarea[name='text_feedback']").val(),
            id = $("input[name='company_id']").val(),
            name = $("input[name='company_name']").val();
        if(text != ''){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "/company/default/feedback/",
                data: {
                    '_csrf': $("input[name='_csrf']").val(),
                    'id': id,
                    'name' : name,
                    'text' : text
                },
                success: function (data) {
                    //console.log(data);
                    /*$('.form').html(data);*/
                    $('#modal-review').animate({opacity: 0}, 200,
                        function () {
                            $(this).css('display', 'none');
                            $('#modal-review-success').css('display', 'block').animate({opacity: 1}, 200);
                        }
                    );
                }
            });
            return false;
        }else{
            $('.feedback_error').text('Вы не оставили отзыв');
            return false;
        }
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