$(document).ready(function () {

    //Клик по глвной категории
    $(document).on('click', '.commercial__category-list li', function () {
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

    //Испенение подкатегории
    $(document).on('change', '.childrenCategorySelect', function () {
        $.ajax({
            url: '/board/default/get-children-category',
            type: 'POST',
            data: {
                catId: $(this).val()
            },
            success: function(data) {
                $('.commercial__sidebar-filter--children-category').append(data);
                console.log(data);
            }
        });

    });
});