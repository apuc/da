$(document).ready(function(){
    $('#reservation').datepicker({
        format: 'yyyy-mm-dd',
        language: 'ru'
    });

    $(".timepicker").timepicker({
        showInputs: false,
        maxHours: 24,
        showMeridian: false
    });


    $(document).on('change','.itemImg',function(){
        var path = $('.itemImg').val();
        $('.media__upload_img').html('<img src="' +path + '" width="100px"/> <br>');
    });

    $(document).on('change', '.selectLang', function(){
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

    $('#news-lang_id').on('change', function(){
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

    $('#company-lang_id').on('change', function(){
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
});

Share = {
    vkontakte: function(purl, ptitle, pimg, text) {
        url  = 'http://vkontakte.ru/share.php?';
        url += 'url='          + encodeURIComponent(purl);
        url += '&title='       + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&image='       + encodeURIComponent(pimg);
        url += '&noparse=true';
        Share.popup(url);
    },
    odnoklassniki: function(purl, text) {
        url  = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
        url += '&st.comments=' + encodeURIComponent(text);
        url += '&st._surl='    + encodeURIComponent(purl);
        Share.popup(url);
    },
    facebook: function(purl, ptitle, pimg, text) {
        url  = 'http://www.facebook.com/sharer.php?s=100';
        url += '&p[title]='     + encodeURIComponent(ptitle);
        url += '&p[summary]='   + encodeURIComponent(text);
        url += '&p[url]='       + encodeURIComponent(purl);
        url += '&p[images][0]=' + encodeURIComponent(pimg);
        Share.popup(url);
    },
    twitter: function(purl, ptitle) {
        url  = 'http://twitter.com/share?';
        url += 'text='      + encodeURIComponent(ptitle);
        url += '&url='      + encodeURIComponent(purl);
        url += '&counturl=' + encodeURIComponent(purl);
        Share.popup(url);
    },
    mailru: function(purl, ptitle, pimg, text) {
        url  = 'http://connect.mail.ru/share?';
        url += 'url='          + encodeURIComponent(purl);
        url += '&title='       + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&imageurl='    + encodeURIComponent(pimg);
        Share.popup(url)
    },

    popup: function(url) {
        window.open(url,'','toolbar=0,status=0,width=626,height=436');
    }
};