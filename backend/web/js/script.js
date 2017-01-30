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


    // $(document).on('change','.itemImg',function(){
    //     var path = $('.itemImg').val();
    //     $('.media__upload_img').html('<img src="' +path + '" width="100px"/> <br>');
    // });

    $(document).on('change','.itemImg',function(){
        var path = $(this).val();
        $(this).closest('.imgUpload').find('.media__upload_img').html('<img src="' +path + '" width="100px"/> <br>')

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

    $('#dt_public_time').clockpicker({
        autoclose: true,
        'default': 'now'
    });

    $('.dt_public_box_link a').on('click', function(e){
        e.preventDefault();
        $('.dt_public_box').slideToggle();
    });

    $('#categ_company').on('change', function(){
        var catId = $(this).val();
        var csrf = $("input[name='_csrf']").val();
        console.log(csrf);
        $.ajax({
            type: 'POST',
            url: "/secure/company/company/get_sub_categ",
            data: 'catId=' + catId + '&_csrf=' + csrf,
            success: function (data) {
                $("#admin_company_sub_category_box").html(data);
            }
        });
    });

    $(document).on('change', '#sub_categ_company', function(){
        $('#all_cats').tagsinput('add', { value: $(this).val() , text: $('#sub_categ_company option:selected').text()  });
        console.log($('#all_cats').val());
    });

    $('#add_pa').on('click', function(){
        $.ajax({
            type: 'POST',
            url: "/secure/polls/polls/get_pa",
            data: {
                _csrf:$('[name = _csrf]').val()
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

    if($('*').is('#_cats')){
        var arr = JSON.parse($('#_cats').val());
        for (var i=0;i<arr.length;i++){
            elt.tagsinput('add', { value: arr[i].id , text: arr[i].title});
        }
    }

    $(document).on('change','#poster-dt_event',function () {

        $('#poster-dt_event_end').val($(this).val());
        
    })

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