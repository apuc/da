$(document).ready(function () {
    if('input[name="Ads[cover]"]'.length > 0){
        var cover = $('input[name="Ads[cover]"]').val();
        if(typeof cover != "undefined"){
            /*var img = $('.file-preview-image');
            console.log(img);*/
            setTimeout(function () {
                $.each($('.file-preview-image'), function () {
                    var img = $(this).attr('src');
                    /*console.log(img);
                    console.log(cover);*/
                    if(img == cover){
                        $(this).closest('.file-preview-frame').css('box-shadow', '1px 1px 5px 0 #f34942');
                    }
                });
            }, 1000);
        }
    }
    if('input[name="Products[cover]"]'.length > 0){
        var cover = $('input[name="Products[cover]"]').val();
        if(typeof cover != "undefined"){
            /*var img = $('.file-preview-image');
            console.log(img);*/
            setTimeout(function () {
                $.each($('.file-preview-image'), function () {
                    var img = $(this).attr('src');
                    /*console.log(img);
                    console.log(cover);*/
                    if(img == cover){
                        $(this).closest('.file-preview-frame').css('box-shadow', '1px 1px 5px 0 #f34942');
                    }
                });
            }, 1000);
        }
    }
//Выбор обложки объявления
    $(document).on('click', '.file-preview-frame', function(){
        //alert(123);
        var img = $(this).find('.file-preview-image');
        var imgName = img.attr('title');
        //console.log('-----------------------');

        $(this).css('box-shadow', '1px 1px 5px 0 #f34942');
        $('.file-preview-frame').not($(this)).css('box-shadow', '1px 1px 5px 0 #a2958a');

        $('input[name="Ads[cover]"]').val(img.attr('src'));
        if(typeof imgName == "undefined" ){
            $('input[name="Ads[cover]"]').val(img.attr('src'));
        }else{
            $('input[name="Ads[cover]"]').val(imgName);
        }
    });

    //Выбор обложки товара
    $(document).on('click', '.file-preview-frame', function(){
        //alert(123);
        var img = $(this).find('.file-preview-image');
        var imgName = img.attr('title');
        //console.log('-----------------------');

        $(this).css('box-shadow', '1px 1px 5px 0 #f34942');
        $('.file-preview-frame').not($(this)).css('box-shadow', '1px 1px 5px 0 #a2958a');
        $('input[name="Products[cover]"]').val(img.attr('src'));
        if(typeof imgName == "undefined" ){
            $('input[name="Products[cover]"]').val(img.attr('src'));
        }else{
            $('input[name="Products[cover]"]').val(imgName);
        }
    });

    //Клик по глвной категории
    $(document).on('click', '.commercial__category-list li', function () {
        var idCat = $(this).data('id');
        $("input[name='mainCat']").val(idCat);
        $.ajax({
            url: '/board/default/get-children-category',
            type: 'POST',
            data: {
                catId: $(this).attr('data-id')
            },
            success: function(data) {
                $('.commercial__sidebar-filter--children-category').html(data);
                console.log(data);
            }
        });

    });

    //Изменение подкатегории
    $(document).on('change', '.childrenCategorySelect', function () {
        $(this).nextAll().remove();
        $.ajax({
            url: '/board/default/get-children-category',
            type: 'POST',
            data: {
                catId: $(this).val()
            },
            success: function(data) {
                $('.commercial__sidebar-filter--children-category').append(data);
                //console.log(data);
            }
        });

    });

    //////ФИЛЬТР ПОИСКА ОБЪЯВЛЕНИЙ
    //Выбор региона
    $('.region').click(function (event) {//при клике на элемент с классом "регион"
        var RegionList = $(this).next('.region-list');//находим ближайший список регионов
        if (RegionList.is(':visible')) {//при видимости списка регионов
            $('.city-list').hide('slow');//мы скрываем все элементы с нужным классом
        }
        RegionList.slideToggle();//показываем нужный нам список
        return false;
    });
    $('.russia').click(function (event) {//при клике на элемент с классом "Россия"
        var RussiaList = $(this).next('.russia-list');//находим ближайший список регионов
        RussiaList.slideToggle();//показываем его
        return false;
    });

    $('.city').click(function (event) {
        var CityList = $(this).next('.city-list');
        $('.region-list').hide('slow');
        if(CityList.is(':visible')){
            CityList.hide("slow");
        } else {
            CityList.slideToggle();
        }
    });

    jQuery(function($){
        $(document).mouseup(function (e){ // событие клика по веб-документу
            var city = $('.city'); // тут указываем ID элемента
            //var region = $(".region"); // тут указываем ID элемента
            if (!city.is(e.target) // если клик был не по нашему блоку
                && city.has(e.target).length === 0) { // и не по его дочерним элементам
                $('.city-list').hide('slow'); // скрываем его
            }
            /*if (!region.is(e.target) // если клик был не по нашему блоку
             && region.has(e.target).length === 0) { // и не по его дочерним элементам
             $('.region-list').hide("slow"); // скрываем его
             }*/
        });
    });

    /*$("body").click(function (e) {
     if ($(".region-list, .russia-list, .city-list").is(':visible')) {
     $(".region-list, .russia-list, .city-list").hide("slow");
     }
     console.log('body');
     });*/


    /*$(document).on('click', '.selectRegion', function(){*/

    //Отправляем всегда левую форму фильтра
    $(document).on('click', '.searchForm', function () {
        document.getElementById('filterform').submit();
        return false;
    });

    $(document).on('change', '.textSearch', function () {
        var text = $(this).val();
        $("input[name='textFilter']").val(text);
    });


    //Выбор региона
    $('.selectRegion').click(function () {
        var City = $(this).closest('.region-list').next('.city'),
            CityList = $(this).closest('.region-list').next('.city').find('.city-list'),
            regionId = $(this).attr('reg-id'),
            regionName = $(this).text();

        $("input[name='cityFilter']").val('');
        $('.textSelectCity').text('Выберите город');
        $('.textSelectRegion').text(regionName);
        $('input[name="regionFilter"]').val(regionId);
        City.css({display: "inline-block"});
        CityList.slideToggle();
        // $('.city').css({display: "inline-block"});
        // $('.city-list').slideToggle();
        $('.region-list').css({display: "none"});
        $.ajax({
             type: 'POST',
             url: "/board/default/show-city-list",
             data: 'id=' + regionId,
             success: function (data) {
                 $('.city-list').html(data);
                 $('.city').css({display: "inline-block"});
                 $('.city-list').slideToggle();
                 $('.region-list').css({display: "none"});
             }
         });
        return false;
    });

    $(document).on('click', '.selectCity', function () {
        var idCity = $(this).attr('city-id');
        //console.log(idCity);
        var nameCity = $(this).text();
        $("input[name='cityFilter']").val(idCity);
        $('.textSelectCity').text(nameCity);
        //console.log('city');
        $('.city').css({display: "inline-block"});
        $('.region-list').css({display: "none"});
        return false;
    });


    $(function () {

        var min = parseInt($("input[name='minPrice']").val(), 10);
        var max = parseInt($("input[name='maxPrice']").val(), 10);
        var selMin = $("input[name='minPrice']").attr('selprice');
        var selMax = parseInt($("input[name='maxPrice']").attr('selprice'), 10);
        /*console.log(formatNumber(selMin));*/
        var number = 3500;

        /*console.log(new Intl.NumberFormat().format(selMin));*/
        if(document.getElementById('slider_price')) {
            $("#slider_price").slider({
                range: true,
                min: min,
                max: max,
                values: [selMin, selMax],
                //values: [formatNumber(selMin), selMax],
                slide: function (event, ui) {
                    //Поле минимального значения
                    $("#price").val(ui.values[0]);
                    //Поле максимального значения
                    $("#price2").val(ui.values[1]);
                },
                stop: function (event, ui) {
                    $("input[name='minPrice']").val(ui.values[0]).change();
                    $("input[name='maxPrice']").val(ui.values[1]).change();
                    /* var obj = $(this).closest('div');
                     filterSearchCount(obj);*/

                }

            });

            //Записываем значения ползунков в момент загрузки страницы
            //То есть значения по умолчанию
            $("#price").val($("#slider_price").slider("values", 0));
            $("#price2").val($("#slider_price").slider("values", 1));
        }
    });

    $('#price').change(function () {
        var val = $(this).val();
        var obj = $(this).closest('div');
        $('#slider_price').slider("values", 0, val);
        filterSearchCount(obj);
    });
    $('#price2').change(function () {
        var val1 = $(this).val();
        var obj = $(this).closest('div');
        $('#slider_price').slider("values", 1, val1);

        filterSearchCount(obj);
    });

    function filterSearchCount(obj) {
        $.ajax({
            type: 'POST',
            url: "/site/filter_search_count",
            data: search(),
            success: function (data) {

                if (obj == null) {
                    $('.parentCategoryFieldsFilter').append('<div id="jsfilter_ajax_cont"> <div id="sel_block_arrow"></div>Найдено объявлений: <span id="jsfilter_ajax_output">' + data + '</span>\. <a class="filterSearchView" href="#">Показать</a> </div>');
                    $("#jsfilter_ajax_cont").show("slow");
                }
                else {
                    $(obj).append('<div id="jsfilter_ajax_cont"> <div id="sel_block_arrow"></div>Найдено объявлений: <span id="jsfilter_ajax_output">' + data + '</span>\. <a class="filterSearchView"  href="#">Показать</a> </div>');
                    $("#jsfilter_ajax_cont").show("slow");
                }
            }
        });

        //console.log(id);
    }


    /**********************************************************************************/
    /****************************ДОБАВЛЕНИЕ ОБЪЯВЛЕНИЯ*********************************/
    /**********************************************************************************/
    //Показать подсказку
    $(document).on('focusin', '.jsHint', function () {
        var parent = $(this).parent();
        var hint = parent.children('.memo').fadeIn();
    });
    //Скрыть подсказку
    $(document).on('focusout', '.jsHint', function () {
        var parent = $(this).parent();
        var hint = parent.children('.memo').fadeOut();
    });

    //Открываем модлку для выбора главной категории
    $(document).on('click', '.select-category-add', function () {
        var type = $(this).attr('datatype');
        var url;
        //alert(type);
        if(type === 'product' ){
            url = '/shop/products/general-modal';
        }
        else{
            url = '/board/default/general-modal';
        }
        $.ajax({
            type: 'POST',
            url: url,
            data: '',
            success: function (data) {
                //console.log(data);
                $('.modal-body,.modal-flex').html(data);
                 $('#modalType').modal('show');
                /* $('#black-overlay').fadeIn(400);*/
                /*$('#black-overlay').fadeIn(400,
                    function () {
                        $('#modalType').css('display', 'block').animate({opacity: 1}, 200);
                    });*/
            }
        });
    });

    //Скрыть модалку
    $(document).on('click', '.close', function () {
        $('#modalType').modal('hide')
    });

    //выбор главной категории
    $(document).on('click', '.modal-body__container', function () {
        var catId = $(this).data('category');
        var type = $(this).attr('datatype');
        var url;

        if(type === 'product' ){
            url = '/shop/products/show-category';
            $('#products-category_id').val(catId);
        }
        else{
            url = '/board/default/show-category';
            $('#ads-category_id').val(catId);
        }
        //alert(url);


        $.ajax({
            type: 'POST',
            url: url,
            data: 'id=' + catId,
            success: function (data) {
                /*$('.modal-body,.modal-flex').html(data);*/

                if (data) {
                    console.log(data);
                    $('#categoryModal').html(data);
                } else {
                    if(type === 'product' ){
                        url = '/shop/products/show-category-end';
                    }
                    else{
                        url = '/board/default/show-category-end';
                    }
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: 'id=' + catId,
                        success: function (data) {
                            $('.SelectCategory').html(data);
                        }
                    });
                    $('#modalType').modal('hide');
                }

            }
        });
        return false;
    });


    //Выбор категорий и подкатегорий
    $(document).on('click', '.heading-change', function () {
        $('div[data-parent="2"]').html('');
        var category = $(this).data('category');


        var column = $(this).parent().parent().data('parent');
        if(column == 0){
            $('.heading-change').removeClass('active');
        }
        if(column == 1){
            $('div[data-parent="1"] .heading-change').removeClass('active');
        }


        $(this).addClass('active');

        //console.log(column);
        var type = $(this).attr('datatype');
        var url;
        //alert(type);
        console.log(category);
        if(type === 'product' ){
            url = '/shop/products/show-parent-modal-category';
            $('#products-category_id').val(category);
        }
        else{
            url = '/board/default/show-parent-modal-category';
            $('#ads-category_id').val(category);
        }
        $.ajax({
            type: 'POST',
            url: url,
            data: 'id=' + category,
            success: function (data) {
                //console.log(data);
                if (data) {
                    if (column == 0) {
                        $('div[data-parent="1"]').html(data);
                    }
                    if (column == 1) {
                        $('div[data-parent="2"]').html(data);
                    }
                }
                else {
                    if(type === 'product' ){
                        url = '/shop/products/show-category-end';
                    }
                    else{
                        url = '/board/default/show-category-end';
                    }
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: 'id=' + category,
                        success: function (data) {
                            //console.log(data);
                            $('.SelectCategory').html(data);
                        }
                    });
                    $('#modalType').modal('hide');

                    if(type === 'product' ){
                        url = '/shop/products/show-additional-fields';
                    }
                    else{
                        url = '/board/default/show-additional-fields';
                    }
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: 'id=' + category,
                        success: function (data) {
                            console.log(data);
                            $('#additional_fields').html(data);
                        }
                    });
                }


            }
        });
        return false;

    });

    //Согласие на обработку данных
    $(document).on('click', '#dannie-1', function () {
        if ($(this).prop('checked')) {
            $('.place-ad__publish').prop('disabled', false);
        } else {
            $('.place-ad__publish').prop('disabled', true);
        }
    });


    //Изменение оплаты и доставки товара
    $(document).on('click', '#edit-payment', function () {
        if ($(this).prop('checked')) {
            $('.edit-payment-form-field').css('display', 'block');
        } else {
            $('#products-payment').val('');
            $('#products-delivery').val('');
            $('.edit-payment-form-field').css('display', 'none');
        }
    });


});