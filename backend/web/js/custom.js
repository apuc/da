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
                    console.log(data);
                }
            });
        }
    });

});