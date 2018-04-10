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
});


function setFilter() {
    var filter = attributesFieldsProductsFilter;

    var state = { 'page_id': 1};
    var title = 'Hello World';
    var url = '?';

    for(var key in filter) {
        if(filter[key].length > 0){
            for (var j = 0; j < filter[key].length; j++ ){
                url += key + '=' + filter[key][j] + '&'
            }
        }
    }
//console.log(attributesFieldsProductsFilter);
    $.ajax({
        type: 'POST',
        url: "/shop/shop/filter",
        //data: attributesFieldsProductsFilter,
        data:
            {
                filter: JSON.stringify(attributesFieldsProductsFilter),
                category: category
            },
        success: function (data) {
            console.log(data);
        }
    });

    history.pushState(state, title, url);
}