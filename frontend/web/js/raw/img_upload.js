/**
 * Created by apuc0 on 30.05.2018.
 */
$(document).ready(function () {
    var upload = new Uploader();
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
            var img = item.item.querySelector('.productImg');
            var imgThumb = item.item.querySelector('.productImgThumb');
            var data = JSON.parse(response);
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
    }

    $( "#cabinet__add-company-form--images").sortable({
        placeholder: "highlight"
    });
});