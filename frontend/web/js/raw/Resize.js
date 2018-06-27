/**
 * Created by apuc0 on 22.01.2018.
 */
function Resize() {

    this.init = function (options, _cg) {
        this._cg = _cg;
        this.startResizinFlag = false;

        this.defaultParams = {
            parentBoxCross: false,
            minWidth: 30,
            maxWidth: false,
            minHeight: 30,
            maxHeight: false,
            step: false,
            top: 0,
            left: 0,
            stopResize: function (elem, w, h) {
            },
            startResize: function (elem, w, h) {
            },
            resizing: function (elem, w, h) {
            }
        };

        this.options = this._cg.setOptions(this.defaultParams, options);

        this.parentBox = this._cg.elem.parentNode;
        this.createResizeElem();
        this.resizeElem.onmousedown = this.resizeHandler.bind(this);
        this.resizeElem.onmouseup = this.stopResize.bind(this);
    };

    this.resizeHandler = function (e) {
        e.stopPropagation(); // остановить всплытие события
        this.startXposition = e.clientX;
        this.startYposition = e.clientY;
        this.startWH = this._cg.getWH(this._cg.elem);
        document.onmousemove = function (e) {
            this.changeSize(e);
        }.bind(this);
    };

    this.changeSize = function (e) {
        var newW = this.startWH.width + (e.clientX - this.startXposition);
        var newH = this.startWH.height + (e.clientY - this.startYposition);
        if(this.isChangeW(newW)){
            this._cg.elem.style.width = newW + 'px';
        }
        if(this.isChangeH(newH)){
            this._cg.elem.style.height = newH + 'px';
        }
        if(!this.startResizinFlag){
            this.options.startResize(this._cg.elem, newW, newH);
            this.startResizinFlag = true;
        }
        this.options.resizing(this._cg.elem, newW, newH);
    };

    this.isChangeW = function (newW) {
        if(!this.options.parentBoxCross){
            var style = this._cg.getStyle(this._cg.elem);
            var parentBoxWH = this._cg.getWH(this.parentBox);
            if(parseInt(style.left) + newW > parentBoxWH.width){
                return false;
            }
        }
        if(this.options.step){
            var currentWH = this._cg.getWH(this._cg.elem);
            if(Math.abs(newW - currentWH.width) < Math.abs(this.options.step)){
                return false;
            }
        }
        if(this.options.minWidth){
            return newW > this.options.minWidth;
        }
        if(this.options.maxWidth){
            return newW < this.options.maxWidth;
        }
        return true;
    };

    this.isChangeH = function (newH) {
        if(!this.options.parentBoxCross){
            var style = this._cg.getStyle(this._cg.elem);
            var parentBoxWH = this._cg.getWH(this.parentBox);
            if(parseInt(style.top) + newH > parentBoxWH.height){
                return false;
            }
        }
        if(this.options.step){
            var currentWH = this._cg.getWH(this._cg.elem);
            if(Math.abs(newH - currentWH.height) < Math.abs(this.options.step)){
                return false;
            }
        }
        if(this.options.minHeight){
            return newH > this.options.minHeight;
        }
        if(this.options.maxHeight){
            return newH < this.options.maxHeight;
        }
        return true;
    };

    this.stopResize = function () {
        document.onmousemove = null;
        var elemWH = this._cg.getWH(this._cg.elem);
        this.options.stopResize(this._cg.elem, elemWH.width, elemWH.height);
        this.startResizinFlag = false;
    };

    this.setWH = function (w, h) {
        this._cg.elem.style.width = w + 'px';
        this._cg.elem.style.height = h + 'px';
    };

    this.createResizeElem = function () {
        this.resizeElem = document.createElement('div');
        this.resizeElem.style.width = '7px';
        this.resizeElem.style.height = '7px';
        this.resizeElem.style.position = 'absolute';
        this.resizeElem.style.backgroundColor = 'black';
        this.resizeElem.style.right = '0';
        this.resizeElem.style.bottom = '0';
        this.resizeElem.style.cursor = 'se-resize';
        this._cg.elem.append(this.resizeElem);
    }

}

_CG.resizable = function (options) {
    if(this.hasExtension('resize')){
        this.resize.options = this.setOptions(this.resize.options, options);
        return this.resize;
    }
    var resize = new Resize();
    this.addExtension('resize', resize);
    return resize.init(options, this);
};