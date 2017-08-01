$(document).ready(function(){

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