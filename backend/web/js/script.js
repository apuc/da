$(document).ready(function () {
    $('#reservation').datepicker({
        format: 'yyyy-mm-dd',
        language: 'ru'
    });

    $(".timepicker").timepicker({
        showInputs: false,
        maxHours: 24,
        showMeridian: false
    });

    $(".more").on('click', function (e) {
        e.preventDefault();
        var text = $(this).prev('div').text();
        text = text.substring(0, text.length - 3);
        $(this).prev('div').text('');
        $(this).prev('div').text(text + $(this).next().next(".readMore").text());
        $(this).next(".closeMore").css('display', '');
        $(this).css('display', 'none');
    });

    $(".comments-stream").on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var string = '';
        var date = new Date();
        $.ajax({
            type: 'POST',
            url: "/secure/vk/vk_stream/get-comments",
            //dataType: 'json',
            data: {'id': id},
            success: function (html) {
                console.log(html);
                $(".content-comments").html('');
                if (html) {
                    $(".content-comments").append(html);
                } else $(".content-comments").append('<tr><td><h3>Комментариев пока нет..</h3></td></tr>');
                $("#myModal").modal('show');
            }
        });
    });

    $(".closeMore").on('click', function (e) {
        e.preventDefault();
        var i = $(this).next(".readMore").text().length;
        var text = $(this).prev().prev('div').text();
        i = $(this).prev().prev('div').text().length - i;
        $(this).prev().prev('div').text('');
        $(this).prev().prev('div').text(text.slice(0, i) + '...');
        $(this).prev().css('display', '');
        $(this).css('display', 'none');
    });

    $(document).on('click', '.delete_from_basket', function () {
        var id = $(this).data('id');
        var tr = $(this).closest('tr');

        $.ajax({
            type: 'POST',
            url: "/secure/vk/vk_basket/delete",
            data: {'id': id},
            success: function (data) {
                if (data) {
                    tr.html('');
                }
            }
        });

        return false;
    });

    $(document).on('click', '.stream_edit', function () {
        var id = $(this).data('id');
        var status = $(this).data('status');
        var tr = $(this).closest('tr');

        $.ajax({
            type: 'POST',
            url: "/secure/vk/vk_stream/set-status",
            data: {'id': id, 'status': status},
            success: function () {
                tr.html('');
            }
        });
        return false;
    });

    $(document).on('click', '.delete_comments', function () {
        var id = $(this).data('id');
        var tr = $(this).closest('tr');

        $.ajax({
            type: 'POST',
            url: "/secure/vk/vk_stream/del-comment",
            data: {'id': id},
            success: function (data) {
                if (data) {
                    tr.html('');
                }
            }
        });
        return false;
    });

    $(".publish").click(function () {
        var id = $(this).data('id');
        var status = $(this).data('status');
        var a = $(this);

        $.ajax({
            type: 'POST',
            url: "/secure/vk/vk_stream/set-status",
            data: {'id': id, 'status': status},
            success: function () {

                if (a.data('status') == 1) {
                    a.text('Снять публикацию');
                    a.data('status', 0);
                } else {
                    a.text('Опубликовать');
                    a.data('status', 1);
                }
            }
        });
        return false;
    });
    // $(document).on('change','.itemImg',function(){
    //     var path = $('.itemImg').val();
    //     $('.media__upload_img').html('<img src="' +path + '" width="100px"/> <br>');
    // });

    $(document).on('change', '.itemImg', function () {
        var path = $(this).val();
        $(this).closest('.imgUpload').find('.media__upload_img').html('<img src="' + path + '" width="100px"/> <br>')

    });

    $(document).on('change', '.itemImgs', function () {
        var path = $(this).val();
        var arr = path.split(',');
        var box = $(this).closest('.imgUpload').find('.media__upload_img');
        box.html('');
        for (var i = 0; i < arr.length; i++) {
            box.append('<img src="' + arr[i] + '" width="100px"/>');
        }
    });

    $(document).on('change', '.selectLang', function () {
        var langId = $(this).val();
        $.ajax({
            type: 'POST',
            url: "/secure/news/news/get_categ",
            data: 'langId=' + langId,
            success: function (data) {
                $(".selectCat").html(data);
            }
        });
    });

    $('#news-lang_id').on('change', function () {
        var langId = $(this).val();
        $.ajax({
            type: 'POST',
            url: "/secure/news/news/get_categ",
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
            url: "/secure/company/company/get_categ",
            data: 'langId=' + langId,
            success: function (data) {
                $("#admin_company_category_box").html(data);
            }
        });
    });

    $('#dt_public_time').clockpicker({
        autoclose: true,
        'default': 'now'
    });

    $('.dt_public_box_link a').on('click', function (e) {
        e.preventDefault();
        $('.dt_public_box').slideToggle();
    });

    $(document).on('change', '#categ_company', function () {
        var catId = $(this).val();
        var csrf = yii.getCsrfToken();
        console.log(catId);
        $.ajax({
            type: 'POST',
            url: "/secure/company/company/get_sub_categ",
            data: 'catId=' + catId + '&_csrf=' + csrf,
            success: function (data) {
                $("#admin_company_sub_category_box").html(data);
            }
        });
    });

    $(document).on('change', '#sub_categ_company', function () {
        $('#all_cats').tagsinput('add', {value: $(this).val(), text: $('#sub_categ_company option:selected').text()});
        console.log($('#all_cats').val());
    });

    $('#add_pa').on('click', function () {
        $.ajax({
            type: 'POST',
            url: "/secure/polls/polls/get_pa",
            data: {
                _csrf: yii.getCsrfToken(),
            },
            success: function (data) {
                $(data).insertBefore('#add_pa');
            }
        });
        return false;
    });

    var elt = $('#all_cats');
    elt.tagsinput({
        itemValue: 'value',
        itemText: 'text'
    });

    if ($('*').is('#_cats')) {
        var arr = JSON.parse($('#_cats').val());
        for (var i = 0; i < arr.length; i++) {
            elt.tagsinput('add', {value: arr[i].id, text: arr[i].title});
        }
    }

    $(document).on('change', '#poster-dt_event', function () {

        $('#poster-dt_event_end').val($(this).val());

    });


    $(document).on('change', '.itemImg2', function () {
        var path = $(this).val().split(',');
        var images = '';
        $(path).each(function (index) {
            images = images + '<img src="' + this + '" width="100px"/>';
            $('.imgUpload').find('.media__upload_img').html(images);
        });
    });

    /*============================================================
     INTERESTED IN POSTERS
     =============================================================*/
    $(document).on('click', '.js-interested-in-delete', function () {
        if (confirm('Удалить категорию?')) {
            $(this).closest('.panel-primary').remove();
        }
    });


    /*============================================================
     COMMENTS CHECKED AND PUBLISHED
     =============================================================*/
    $(document).on('click', '#btn-multi-moder-checked', function () {
        event.preventDefault();
        var checkedInputs = $('input[name="selection[]"]:checked');
        var type = $('input[name="selection[]"]').data('type');
        var keyList = [];
        $.each(checkedInputs, function () {
            keyList.push($(this).val());
        });
        console.log(keyList);
        $.ajax({
            url: '/secure/comments/comments/multi-moder-checked-ajax',
            data: {
                _csrf: yii.getCsrfToken(),
                keyList: keyList,
                type: type
            },
            type: 'POST',
            success: function (data) {
                console.log(data);
                $.each(data, function () {
                    var post = $('tr[data-key="' + this.id + '"]');
                    if (post.length > 0) {
                        if (this.status == 1) {
                            post.find('.moder_checked').removeClass('btn-success').addClass('btn-info').text('Отмечено');
                        }

                    }
                });
            }
        });
        return false;
    });

    $(document).on('click', '#btn-multi-published', function () {
        event.preventDefault();
        var checkedInputs = $('input[name="selection[]"]:checked');
        var type = $('input[name="selection[]"]').data('type');
        var keyList = [];
        $.each(checkedInputs, function () {
            keyList.push($(this).val());
        });
        console.log(keyList);
        $.ajax({
            url: '/secure/comments/comments/multi-published-ajax',
            data: {
                _csrf: yii.getCsrfToken(),
                keyList: keyList,
                type: type
            },
            type: 'POST',
            success: function (data) {
                console.log(data);
                $.each(data, function () {
                    var post = $('tr[data-key="' + this.id + '"]');
                    if (post.length > 0) {
                        if (this.status == 1) {
                            post.find('.published').removeClass('btn-success').addClass('btn-info').text('Опубликовано');
                        }
                    }
                });
            }
        });
        return false;
    });

    $(document).on('click', '.moder_checked', function (event) {
        event.preventDefault();
        var button = $(this);
        $.ajax({
            url: '/secure/comments/comments/update-moder-checked-ajax',
            data: {
                _csrf: yii.getCsrfToken(),
                id: button.closest('tr').data('key'),
                type: button.closest('tr').find('input').data('type')
            },
            type: 'POST',
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    button.removeClass('btn-success').addClass('btn-info').text('Отмечено');
                } else {
                    button.removeClass('btn-info').addClass('btn-success').text('Не отмечено');
                }
            }
        });
        return false;
    });
    $(document).on('click', '.published', function (event) {
        event.preventDefault();
        var button = $(this);
        $.ajax({
            url: '/secure/comments/comments/update-published-ajax',
            data: {
                _csrf: yii.getCsrfToken(),
                id: button.closest('tr').data('key'),
                type: button.closest('tr').find('input').data('type')
            },
            type: 'POST',
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    button.removeClass('btn-success').addClass('btn-info').text('Опубликовано');
                } else {
                    button.removeClass('btn-info').addClass('btn-success').text('На модерации');
                }
            }
        });
        return false;
    });

    $(document).on('click', '.verified', function (event) {
        event.preventDefault();
        var button = $(this);
        $.ajax({
            url: '/secure/comments/comments/update-verified-ajax',
            data: {
                _csrf: yii.getCsrfToken(),
                id: button.closest('tr').data('key'),
                type: button.closest('tr').find('input').data('type')
            },
            type: 'POST',
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    button.removeClass('btn-danger').addClass('btn-info').text('Проверено');
                } else {
                    button.removeClass('btn-info').addClass('btn-danger').text('Не проверено');
                }
            }
        });
        return false;
    });


    $(document).on('click', '.to_plug--tariff', function () {
        var id = $(this).attr('data-id');
        var companyId = $(this).attr('company-id');
        var tariffId = $(this).attr('tariff-id');

        $('#info--order--tariff').attr('data-id', id);
        $('#info--order--tariff').attr('company-id', companyId);
        $('#info--order--tariff').attr('tariff-id', tariffId);

        return false;
    });

    $(document).on('click', '#info--order--tariff', function () {

        var id = $(this).attr('data-id');
        var companyId = $(this).attr('company-id');
        var tariffId = $(this).attr('tariff-id');
        var timeEnd = $('#dt_end_tariff').val();

        $.ajax({
            url: '/secure/company/order-tariff/to-plug-tariff',
            data: {
                id: id,
                companyId: companyId,
                tariffId: tariffId,
                timeEnd: timeEnd,
                _csrf: yii.getCsrfToken(),
            },
            type: 'POST',
            success: function (data) {
                console.log(data);
            }
        });

    });

    $(document).on('click', '.add-input-phone', function () {
        var html = '';
        html = '<div class="input-group">' +
            '<input value="" class="form-control" name="mytext[]" type="text">' +
            '<a href="#" class="input-group-addon remove-input-phone">' +
            '<span class="glyphicon glyphicon-minus"></span>' +
            '           </a>' +
            '</div>';
        $('.phone-dynamic-input').append(html);
        return false;
    });
    $(document).on('click', '.remove-input-phone', function () {
        $(this).parent().remove();
        return false;
    });

    //Фильтр объявлений по статусу
    $(document).on('change', '.status-ads-filter', function () {
        var status = $(this).val();

        window.location = "/secure/board/default/index?status-ads=" + status;
    });

});

Share = {
    vkontakte: function (purl, ptitle, pimg, text) {
        url = 'http://vkontakte.ru/share.php?';
        url += 'url=' + encodeURIComponent(purl);
        url += '&title=' + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&image=' + encodeURIComponent(pimg);
        url += '&noparse=true';
        Share.popup(url);
    },
    odnoklassniki: function (purl, text) {
        url = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
        url += '&st.comments=' + encodeURIComponent(text);
        url += '&st._surl=' + encodeURIComponent(purl);
        Share.popup(url);
    },
    facebook: function (purl, ptitle, pimg, text) {
        url = 'http://www.facebook.com/sharer.php?s=100';
        url += '&p[title]=' + encodeURIComponent(ptitle);
        url += '&p[summary]=' + encodeURIComponent(text);
        url += '&p[url]=' + encodeURIComponent(purl);
        url += '&p[images][0]=' + encodeURIComponent(pimg);
        Share.popup(url);
    },
    twitter: function (purl, ptitle) {
        url = 'http://twitter.com/share?';
        url += 'text=' + encodeURIComponent(ptitle);
        url += '&url=' + encodeURIComponent(purl);
        url += '&counturl=' + encodeURIComponent(purl);
        Share.popup(url);
    },
    mailru: function (purl, ptitle, pimg, text) {
        url = 'http://connect.mail.ru/share?';
        url += 'url=' + encodeURIComponent(purl);
        url += '&title=' + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&imageurl=' + encodeURIComponent(pimg);
        Share.popup(url)
    },

    popup: function (url) {
        window.open(url, '', 'toolbar=0,status=0,width=626,height=436');
    }


};