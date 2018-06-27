/**
 * Created by apuc0 on 30.05.2018.
 */
$(document).ready(function () {
    var upload = new Uploader();
    var saveBtn = document.querySelector('#saveCropImg');
    upload.init({
        fileInput: '#fileInput',
        btnSelect: '#btnSel',
        itemContainer: '#cabinet__add-company-form--images',
        itemWrapper: '.cabinet__add-company-form--img',
        itemImg: '.cabinet__add-company-form--img-wrapper',
        itemTitle: '.img-name',
        itemsCount: photoCount,
        dragNDrop: true,
        dropArea: '#dropArea',
        addClassToImg: '__itemImg',
        dragenter: function (dropArea, e) {
            dropArea.style.backgroundColor = '#337ab7';
        },
        dragover: function (dropArea, e) {
            dropArea.style.backgroundColor = '#337ab7';
        },
        dragleave: function (dropArea, e) {
            dropArea.style.backgroundColor = '#f4f4f4';
        },
        drop: function (dropArea, e) {
            dropArea.style.backgroundColor = '#f4f4f4';
        },
        maxCountBox: '#maxCountBox',
        itemsCountBox: '#itemsCountBox',
        uploadUrl: '/ajax/ajax/upload-product-photo',
        beforeUpload: function (item, formData) {
            formData.append('_csrf', $("meta[name=csrf-token]").attr('content'));
        },
        uploadSuccess: function (response, e, item) {
            var jcrop_api;
            var data = JSON.parse(response);
            var editImg = item.item.querySelector('.editImg');
            editImg.onclick = function (e) {
                saveBtn.setAttribute('data-img-id', item.id);
                saveBtn.setAttribute('data-img-name', item.title);
                saveBtn.setAttribute('data-img', data.img);
                $m('#editImgModal').set({
                    close:true,
                    closeBtnTpl: '<span style="cursor: pointer">Закрыть</span>',
                    title: 'Редактировать изображение ' + item.title,
                    body: '<div class="modalImgEditBox"><img src="'+data.img+'" alt="" id="img_'+item.id+'"></div>',
                    effect: 'slide',//fade,standard,slide
                    top: '5%',
                    width: '70%',
                    height: '550px',
                    duration: 200,
                    afterOpen: function () {
                        $('#img_' + item.id).Jcrop({
                            onSelect:   function (e) {
                                saveBtn.setAttribute('data-x', e.x);
                                saveBtn.setAttribute('data-y', e.y);
                                saveBtn.setAttribute('data-w', e.w);
                                saveBtn.setAttribute('data-h', e.h);
                            },
                            aspectRatio: 1/1
                        },function(){
                            jcrop_api = this;
                        });
                    }
                }).show();
            };
            var img = item.item.querySelector('.productImg');
            var imgThumb = item.item.querySelector('.productImgThumb');
            img.value = data.img;
            imgThumb.value = data.img_thumb;
            //console.log(JSON.parse(response));
        },
        uploadError: function(response, e, item) {
            console.log(response, e, item);
        },
        uploadOnprogress: function (progress, item) {
            var progressBar = item.item.querySelector('.progressBar');
            progressBar.setAttribute('value', progress);
        },
        directlyUpload: true,
        delItem: '.arrow-up'
    });
    //console.log(upload);

    if(photoCount > 0){
        upload.indexItems();
        var jcrop_api;
        upload.allItems.forEach(function(item, i, arr) {
            var img = item.item.querySelector('.__itemImg').getAttribute('src');
            var editImg = item.item.querySelector('.editImg');
            editImg.onclick = function (e) {
                saveBtn.setAttribute('data-img-id', item.id);
                saveBtn.setAttribute('data-img-name', item.title);
                saveBtn.setAttribute('data-img', img);
                $m('#editImgModal').set({
                    close:true,
                    closeBtnTpl: '<span style="cursor: pointer">Закрыть</span>',
                    title: 'Редактировать изображение ' + item.title,
                    body: '<div class="modalImgEditBox"><img src="'+img+'" alt="" id="img_'+item.id+'"></div>',
                    effect: 'slide',//fade,standard,slide
                    top: '5%',
                    width: '70%',
                    height: '550px',
                    duration: 200,
                    afterOpen: function () {
                        $('#img_' + item.id).Jcrop({
                            onSelect:   function (e) {
                                saveBtn.setAttribute('data-x', e.x);
                                saveBtn.setAttribute('data-y', e.y);
                                saveBtn.setAttribute('data-w', e.w);
                                saveBtn.setAttribute('data-h', e.h);
                            },
                            aspectRatio: 1/1
                        },function(){
                            jcrop_api = this;
                        });
                    }
                }).show();
            };
            var imgInput = item.item.querySelector('.productImg');
            var imgThumb = item.item.querySelector('.productImgThumb');
            imgInput.value =img;
            imgThumb.value = img;
        });
    }

    saveBtn.onclick = function () {
        $.ajax({
            url: '/ajax/ajax/crop-img',
            type: "POST",
            data: {
                img: $(this).attr('data-img'),
                imgId: $(this).attr('data-img-id'),
                imgName: $(this).attr('data-img-name'),
                x: $(this).attr('data-x'),
                y: $(this).attr('data-y'),
                w: $(this).attr('data-w'),
                h: $(this).attr('data-h')
            },
            success: function(response){
                var data = JSON.parse(response);
                console.log(data);
                $('[data-id="'+data.imgId+'"]').find('.__itemImg').attr('src', data.img);
                $('[data-id="'+data.imgId+'"]').find('.productImg').attr('value', data.img);
                $('[data-id="'+data.imgId+'"]').find('.productImgThumb').attr('value', data.img);
                $m('#editImgModal').hide();
            }
        });
        return false;
    };

    $( "#cabinet__add-company-form--images").sortable({
        placeholder: "highlight"
    });

});