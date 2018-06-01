/**
 * Created by apuc0 on 17.05.2018.
 */
function Uploader() {

    this.init = function (options) {
        var defaultOptions = {
            maxCount: 8,
            maxCountBox: null,
            maxSize: 5,
            itemsCount: 0,
            itemsCountBox: null,
            multiple: false,
            btnSelect: null,
            btnCancel: null,
            btnLoad: null,
            fileInput: null,
            itemContainer: null,
            itemWrapper: null,
            itemImg: null,
            itemTitle: null,
            itemSize: null,
            uploadUrl: null,
            delItem: null,
            uploadItem: null,
            dragNDrop: false,
            dropArea: null,
            directlyUpload: false,
            dragenter: function (dropArea, e) {
            },
            dragleave: function (dropArea, e) {
            },
            dragover: function (dropArea, e) {
            },
            drop: function (dropArea, e) {
            },
            beforeUpload: function (item, formData) {
            },
            uploadOnprogress: function (progress, item) {
            },
            uploadSuccess: function (response, e, item) {
            },
            uploadError: function (response, e, item) {
            },
            maxSizeError: function (fileName, fileSize) {
            }
        };

        this.allItems = [];

        this.options = setOptions(defaultOptions, options);
        this.itemsCount = this.options.itemsCount;
        this.checkOptions();
        this.printParams();
        this.btnSelect = this.getElement(this.options.btnSelect);
        if(this.options.btnLoad){
            this.btnLoad = this.getElement(this.options.btnLoad);
        }
        this.fileInput = this.getElement(this.options.fileInput);
        this.itemContainer = this.getElement(this.options.itemContainer);
        this.itemWrapper = this.getElement(this.options.itemWrapper);
        this.itemWrapperDisplay = getComputedStyle(this.itemWrapper).display;
        this.itemWrapper.style.display = 'none';

        this.btnSelect.onclick = function (e) {
            e.preventDefault();
            this.fileInput.click();
        }.bind(this);

        if(this.btnLoad){
            this.btnLoad.onclick = this.uploadFiles.bind(this);
        }

        this.fileInput.onchange = this.changeFileInput.bind(this);

        if (this.options.dragNDrop) {
            if (isAdvancedUpload()) {
                if (this.options.dropArea) {
                    this.dropArea = this.getElement(this.options.dropArea);
                    this.dropArea.addEventListener('dragenter', this.dragenter.bind(this), false)
                    this.dropArea.addEventListener('dragleave', this.dragleave.bind(this), false)
                    this.dropArea.addEventListener('dragover', this.dragover.bind(this), false)
                    this.dropArea.addEventListener('drop', this.drop.bind(this), false)
                }
                //console.log(123);
            }
        }
    };

    this.changeFileInput = function (event) {
        var files = event.target.files; // FileList object
        // Loop through the FileList and render image files as thumbnails.
        this.renderItems(files);
    };

    this.renderItems = function (files) {
        this.filesCount = files.length;
        if (this.filesCount + this.itemsCount > this.options.maxCount) {
            console.log('Максимальное кол-во изображений');
        }
        else {
            this.fileLoadCount = 0;
            for (var i = 0, f; f = files[i]; i++) {
                // Only process image files.
                if (!f.type.match('image.*')) {
                    alert("Image only please....");
                }
                var reader = new FileReader();
                // Closure to capture the file information.
                reader.onload = (function (theFile) {
                    return function (e) {
                        if (theFile.size > this.options.maxSize * 1024 * 1024) {
                            this.options.maxSizeError(theFile.name, theFile.size);
                        }
                        else {
                            this.renderItem({
                                title: theFile.name,
                                file: e.target.result,
                                size: theFile.size,
                                type: theFile.type,
                                fileObj: theFile
                            });
                            if (this.fileLoadCount === this.filesCount) {
                                this.loadedCallback();
                            }
                            // Render thumbnail.
                            //console.log(e.target.result);
                        }
                    }.bind(this);
                }).bind(this)(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
            }
        }
    };

    this.renderItem = function (data) {
        var id = makeid(8);
        var item = this.itemWrapper.cloneNode(true);
        item.style.display = this.itemWrapperDisplay;
        var title = item.querySelector(this.options.itemTitle);
        var img = item.querySelector(this.options.itemImg);
        var size = item.querySelector(this.options.itemSize);
        var del = item.querySelector(this.options.delItem);
        var upload = item.querySelector(this.options.uploadItem);
        if (title) {
            title.innerHTML = data.title;
        }
        if (img) {
            var imgEl = document.createElement('img');
            imgEl.setAttribute('src', data.file);
            img.appendChild(imgEl);
        }
        if (size) {
            size.innerHTML = data.size;
        }
        if (del) {
            del.onclick = function () {
                item.parentNode.removeChild(item);
                delete this.allItems[id];
                this.itemsCount--;
                this.printParams();
            }.bind(this)
        }
        if (upload) {
            upload.onclick = function () {
                this.uploadFile(data);
            }.bind(this)
        }
        this.fileLoadCount++;
        this.itemsCount++;
        this.itemContainer.appendChild(item);
        item.setAttribute('data-id', id);
        data.item = item;
        if(this.options.directlyUpload){
            this.uploadFile(data);
        }
        this.allItems[id] = data;
    };

    this.indexItems = function () {
        var items = this.getElement(this.options.itemWrapper, true);
        console.log(items);
        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            var del = item.querySelector(this.options.delItem);
            console.log(del);
            if (del) {
                del.onclick = function () {
                    item.parentNode.removeChild(item);
                    //delete this.allItems[id];
                    this.itemsCount--;
                    this.printParams();
                }.bind(this)
            }
        }
    };

    this.dragenter = function (e) {
        e.preventDefault();
        e.stopPropagation();
        this.options.dragenter(this.dropArea, e);
    };

    this.dragleave = function (e) {
        e.preventDefault();
        e.stopPropagation();
        this.options.dragleave(this.dropArea, e);
    };

    this.dragover = function (e) {
        e.preventDefault();
        e.stopPropagation();
        this.options.dragover(this.dropArea, e);
    };

    this.drop = function (e) {
        e.preventDefault();
        e.stopPropagation();
        this.options.drop(this.dropArea, e);
        var dt = e.dataTransfer;
        var files = dt.files;
        this.renderItems(files);
    };

    this.loadedCallback = function () {
        this.printParams();
        //console.log(this.allItems);
    };

    this.checkOptions = function () {
        var params = this.requiredParams();
        for (var i = 0; i < params.length; i++) {
            if (!this.options[params[i]]) {
                throw new Error('Укажите обязательные параметры');
            }
        }
        return true;
    };

    this.printParams = function () {
        if (this.options.maxCountBox) {
            var maxCount = this.getElement(this.options.maxCountBox);
            maxCount.innerHTML = this.options.maxCount;
        }
        if (this.options.itemsCountBox) {
            var itemsCount = this.getElement(this.options.itemsCountBox);
            itemsCount.innerHTML = this.itemsCount;
        }

    };

    this.uploadFile = function (item) {
        var xhr = new XMLHttpRequest();

        // обработчик для закачки
        xhr.upload.onprogress = function (event) {
            this.options.uploadOnprogress(Math.round((event.loaded / event.total) * 100), item);
            //console.log(event.loaded + ' / ' + event.total);
        }.bind(this);

        // обработчики успеха и ошибки
        // если status == 200, то это успех, иначе ошибка
        xhr.onload = function (e) {
            this.options.uploadSuccess(e.target.response, e, item)

        }.bind(this);

        xhr.onerror = function (e) {
            this.options.uploadError(e.target.response, e, item);
        }.bind(this);

        xhr.open("POST", this.options.uploadUrl, true);
        var formData = new FormData();
        formData.append("file", item.fileObj);
        this.options.beforeUpload(item, formData);
        xhr.send(formData);
    };

    this.uploadFiles = function () {
        for (var key in this.allItems) {
            this.uploadFile(this.allItems[key]);
        }
    };

    function setOptions(defaultOptions, options) {
        var finalParams = defaultOptions;
        for (var key in options) {
            if (typeof options[key] === "object" && key !== "class") {
                finalParams[key] = setOptions(finalParams[key], options[key]);
            }
            else {
                if (options.hasOwnProperty(key)) {
                    if (options[key] !== undefined) {
                        finalParams[key] = options[key];
                    }
                }
            }
        }

        return finalParams;
    }

    this.getElement = function (el, allEl) {
        allEl = allEl || false;
        var thisElement;
        if (el[0] === '#') {
            thisElement = document.getElementById(el.slice(1));
        }
        else {
            if (allEl) {
                thisElement = document.getElementsByClassName(el.slice(1));
            }
            else {
                thisElement = document.querySelector(el);
            }
        }
        return thisElement;
    };

    this.getElementsByAttr = function (attr) {
        var elems = document.getElementsByTagName('*');
        var arr = [];
        for (var i = 0; elems.length; i++) {
            if (typeof elems[i] === "object") {
                if (elems[i].hasAttribute(attr)) {
                    arr.push(elems[i]);
                }
            }
            else {
                break;
            }
        }
        return arr;
    };

    this.requiredParams = function () {
        return [
            'btnSelect',
            'fileInput',
            'itemContainer',
            'itemWrapper'
        ];
    };

    function makeid(count) {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < count; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }

    var isAdvancedUpload = function () {
        var div = document.createElement('div');
        return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
    };

}