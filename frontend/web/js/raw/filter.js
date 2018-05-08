$(document).ready(function () {

    $(document).on('click', '.filter-search', function () {

        if($($(this)).prop('checked')) {
            attributesFieldsProductsFilter[$(this).attr('name')].push($(this).val());
        }
        else{
            attributesFieldsProductsFilter[$(this).attr('name')].splice(attributesFieldsProductsFilter[$(this).attr('name')].indexOf($(this).val()), 1);
        }

        setFilter();
    });

    $(document).on('click', '.saleFilter', function () {
        console.log(attributesFieldsProductsFilter);
        if($($(this)).prop('checked')) {
            attributesFieldsProductsFilter['saleFilter'] = $("input[name='saleFilter']").val();
        }
        else{
            attributesFieldsProductsFilter['saleFilter'] = '';
        }

        setFilter();
    });


    $(document).on('change', '.sortFilter', function () {
        attributesFieldsProductsFilter['sort'] = $(this).val();
        console.log(attributesFieldsProductsFilter);
        setFilter();
    });

    $(document).on('change', '.price-filter', function () {
        //console.log(attributesFieldsProductsFilter);
        attributesFieldsProductsFilter['minPrice'] = $("input[name='minPrice']").val();
        attributesFieldsProductsFilter['maxPrice'] = $("input[name='maxPrice']").val();
        setFilter();
    });
});


function setFilter() {
    var filter = attributesFieldsProductsFilter;

    var state = { 'page_id': 1};
    var title = 'Hello World';
    var url = '?';

    /*var minPrice = attributesFieldsProductsFilter[$(this).attr('name')].splice(attributesFieldsProductsFilter['minPrice']);*/
    /*var maxPrice = $("input[name='maxPrice']").val()*/

    for(var key in filter) {
        console.log(filter[key]);
        if(filter[key].length > 0 ){
            if(Array.isArray(filter[key])){
                for (var j = 0; j < filter[key].length; j++ ){
                    url += key + '=' + filter[key][j] + '&'
                }
            }
            else{
                url += key + '=' + filter[key] + '&'
            }

        }
    }
    /*if(minPrice){
        url += 'minPrice=' + minPrice + '&';
    }*/
    /*if(maxPrice){
        url += 'maxPrice=' + maxPrice + '&';
    }*/
//console.log(attributesFieldsProductsFilter);
    $.ajax({
        type: 'POST',
        url: "/shop/shop/filter",
        //data: attributesFieldsProductsFilter,
        data:
            {
                filter: JSON.stringify(attributesFieldsProductsFilter),
                category: category
                /*minPrice: minPrice,
                maxPrice: maxPrice,*/
            },
        success: function (data) {
            console.log(data);
            $('.shop__top-sales-elements').html(data);
        }
    });

    history.pushState(state, title, url);
}