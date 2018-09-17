function Modal() {

    this.modals = [];

    this.init = function (data) {
        this.elem = this.getElement(data);
        this.data = data;
        this.getModalChild();
        this.set();
        this.overlay = document.getElementsByClassName('__overlay')[0];
        //this.overlay.addEventListener('click', this.closeByOverlay.bind(this));
        return this;
    };

    this.set = function (data) {
        this.defaultParams = {
            afterOpen: function () {
            },
            beforeOpen: function () {
            },
            afterClose: function () {
            },
            effect: 'standard',//fade,standard,slide
            duration: 500,
            title: false,
            body: false,
            width: '50%',
            height: '300px',
            top: '50%',
            left: '50%',
            close: true,
            closeBtnTpl: '<a href="#">Закрыть</a>'
        };
        this.finalParams = this.defaultParams;
        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                if (data[key] !== undefined) {
                    this.finalParams[key] = data[key];
                }
            }
        }
        this.options = this.finalParams;
        this.create = false;
        return this;
    };

    this.createModal = function () {
        this.genCloseBtn();
        this.setTitle();
        this.setBody();
        this.setModalSize();
        this.create = true;
        return this;
    };

    this.getElement = function (el) {
        var thisElement;
        this.new = false;

        if (typeof el === 'object') {
            return el;
        }

        this.id = this.makeId(8);
        if (el[0] === '#') {
            thisElement = document.getElementById(el.slice(1));
        }
        else {
            thisElement = document.getElementsByClassName(el.slice(1))[0];
        }
        return thisElement;
    };

    this.closeByOverlay = function () {
        for (var i = 0; i < objPool.length; i++) {
            if (objPool[i].id === this.data) {
                objPool[i].obj.hide();
            }
        }
    };

    this.show = function () {
        if (this.options.effect === 'standard') {
            this.beforeOpen();
            this.elem.style.display = 'block';
            this.overlay.style.display = 'block';
            this.options.afterOpen();
        }
        if (this.options.effect === 'fade') {
            this.fadeIn(this.options.duration, function () {
                this.options.afterOpen();
            }.bind(this));
        }
        if (this.options.effect === 'slide') {
            this.slideDown(this.options.duration, function () {
                this.options.afterOpen();
            }.bind(this));
        }
        return this;
    };

    this.hide = function () {
        if (this.options.effect === 'standard') {
            this.elem.style.display = 'none';
            this.overlay.style.display = 'none';
            this.options.afterClose();
        }
        if (this.options.effect === 'fade') {
            this.fadeOut(this.options.duration, function () {
                this.options.afterClose();
            }.bind(this));
        }
        if (this.options.effect === 'slide') {
            this.slideUp(this.options.duration, function () {
                this.options.afterClose();
            }.bind(this));
        }
        return this;
    };

    this.toggle = function () {
        var curStyle = getComputedStyle(this.elem);
        if (curStyle.display === 'block') {
            this.hide();
        }
        else {
            this.show();
        }
        return this;
    };

    this.genCloseBtn = function () {
        if (this.options.close) {
            var closeBtn = document.createElement('div');
            closeBtn.classList.add('mClose');
            closeBtn.innerHTML = this.options.closeBtnTpl;
            this.closeBtn = closeBtn;
            this.closeBtn.onclick = this.hide.bind(this);
            this.title.appendChild(this.closeBtn);
        }
    };

    this.setTitle = function (title) {
        title = title || false;
        if (title) {
            this.title.innerHTML = title;
            this.genCloseBtn();
        }
        else if (this.options.title) {
            this.title.innerHTML = this.options.title;
            this.genCloseBtn();
        }
        return this;
    };

    this.setBody = function (body) {
        body = body || false;
        if (body) {
            this.body.innerHTML = body;
        }
        else if (this.options.body) {
            this.body.innerHTML = this.options.body;
        }
        return this;
    };

    this.setModalSize = function () {
        this.elem.style.width = this.options.width;
        this.elem.style.height = this.options.height;
        this.elem.style.top = this.options.top;
        this.elem.style.left = this.options.left;
        this.elem.style.transform = 'translate(-'+this.options.left+', -'+this.options.top+')';
    };

    this.getModalChild = function () {
        var elems = this.elem.childNodes;
        elems.forEach(function (elem) { // нет такого метода!
            if (elem.nodeType === 1) {
                if (elem.classList.contains('modal-title')) {
                    this.title = elem;
                }
                if (elem.classList.contains('modal-body')) {
                    this.body = elem;
                }
                if (elem.classList.contains('modal-footer')) {
                    this.footer = elem;
                }
            }
        }.bind(this));
    };

    this.initLink = function (link) {
        if (link.hasAttribute('data-action')) {
            var action = link.getAttribute('data-action');
            if (action === 'hide') {
                link.onclick = this.hide.bind(this);
            }
            if (action === 'show') {
                link.onclick = this.show.bind(this);
            }
        }
        else {
            link.onclick = this.toggle.bind(this);
        }
    };

    this.makeId = function (length) {
        length = length || 8;
        var text = "";
        var possible = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        for (var i = 0; i < length; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    };

    this.beforeOpen = function () {
        if (this.create === false) {
            this.createModal();
        }
        this.overlay.onclick = this.closeByOverlay.bind(this);
        this.options.beforeOpen();
    };

    function animate(options) {
        options.success = options.success || function () {
        };
        var start = performance.now();
        requestAnimationFrame(function animate(time) {
            var timeFraction = (time - start) / options.duration;
            if (timeFraction > 1) timeFraction = 1;
            var progress = options.timing(timeFraction);
            options.draw(progress);
            if (timeFraction < 1) {
                requestAnimationFrame(animate);
            }
            else {
                options.success();
            }
        });
    }

    this.fadeIn = function (duration, callback) {
        this.beforeOpen();
        duration = duration || 500;
        callback = callback || function () {
        };
        this.elem.style.opacity = 0;
        this.elem.style.display = 'block';
        this.overlay.style.display = 'block';
        this.options.effect = 'fade';
        animate({
            duration: duration,
            timing: function (timeFraction) {
                return timeFraction;
            },
            draw: function (progress) {
                this.elem.style.opacity = progress;
            }.bind(this),
            success: function () {
                callback();
            }
        });
        return this;
    };

    this.fadeOut = function (duration, callback) {
        duration = duration || 500;
        callback = callback || function () {
        };
        animate({
            duration: duration,
            timing: function (timeFraction) {
                return timeFraction;
            },
            draw: function (progress) {
                this.elem.style.opacity = 1 - progress;
            }.bind(this),
            success: function () {
                this.elem.style.display = 'none';
                this.overlay.style.display = 'none';
                this.elem.style.opacity = 1;
                callback();
            }.bind(this)
        });
        return this;
    };

    this.slideDown = function (duration, callback) {
        this.beforeOpen();
        duration = duration || 500;
        callback = callback || function () {
        };
        var computedStyle = getComputedStyle(this.elem);
        var h = computedStyle.height;
        h = h.substring(0, h.length - 2);
        this.elem.style.height = 0;
        this.elem.style.display = "block";
        this.overlay.style.display = 'block';
        this.options.effect = 'slide';
        animate({
            duration: duration,
            timing: function (timeFraction) {
                return timeFraction;
            },
            draw: function (progress) {
                this.elem.style.height = progress * h + "px";
            }.bind(this),
            success: function () {
                callback();
            }
        });
        return this;
    };

    this.slideUp = function (duration, callback) {
        duration = duration || 500;
        callback = callback || function () {
        };
        var computedStyle = getComputedStyle(this.elem);
        var h = computedStyle.height;
        h = h.substring(0, h.length - 2);
        animate({
            duration: duration,
            timing: function (timeFraction) {
                return timeFraction;
            },
            draw: function (progress) {
                this.elem.style.height = (1 - progress) * h + "px";
            }.bind(this),
            success: function () {
                this.elem.style.display = 'none';
                this.overlay.style.display = 'none';
                this.elem.style.height = h + 'px';
                callback();
            }.bind(this)
        });
        return this;
    }

}

//var mPool = [];
var objPool = [];

var $m = function (data) {
    var obj = _getObj(data, objPool);
    if (!obj) {
        obj = new Modal();
        obj.init(data);
        objPool.push({id: data, obj: obj});
    }
    return obj
};

function _getObj(id, op) {
    for (var i = 0; i < op.length; i++) {
        if (op[i].id == id) {
            return op[i].obj;
        }
    }
    return false;
}

document.addEventListener("DOMContentLoaded", ready);

function ready() {
    var overlay = document.createElement('div');
    overlay.classList.add('__overlay');
    document.getElementsByTagName('body')[0].appendChild(overlay);
    var links = document.getElementsByTagName('a');
    for (var i = 0; i < links.length; i++) {
        if (links[i].hasAttribute('data-m')) {
            $m('#' + links[i].getAttribute('data-target')).initLink(links[i]);
        }
    }
}