/**
 * Created by waryataw on 21.10.2016.
 */

$(document).ready(function(){

    $('#faq-type').change(function () {
        var faqtype = $("#faq-type").val();

        if (faqtype){
            $.ajax({
                type: "POST",
                url: "/secure/category_faq/category_faq/get_catfaq_by_type",
                data: "slug=" + faqtype,
                success: function (data) {
                    $('#faq-cat_id').html(data).slideDown();
                    $('.field-faq-cat_id').slideDown();
                    $('.field-faq-cat_id label').slideDown();
                }
            });
        } else $('.field-faq-cat_id').slideUp();
    });

});