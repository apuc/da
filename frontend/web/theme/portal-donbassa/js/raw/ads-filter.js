$(document).ready(function () {
    //////ФИЛЬТР ПОИСКА ОБЪЯВЛЕНИЙ
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
        /*$.ajax({
         type: 'POST',
         url: "/site/show_city_list",
         data: 'id=' + regionId,
         success: function (data) {
         $('.city-list').html(data);
         $('.city').css({display: "inline-block"});
         $('.city-list').slideToggle();
         $('.region-list').css({display: "none"});
         }
         });*/
        return false;
    });

    $(document).on('click', '.selectCity', function () {
        var idCity = $(this).attr('city-id');
        console.log(idCity);
        var nameCity = $(this).text();
        $("input[name='cityFilter']").val(idCity);
        $('.textSelectCity').text(nameCity);
        console.log('city');
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

});