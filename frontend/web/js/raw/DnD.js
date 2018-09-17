/**
 * Created by apuc0 on 19.01.2018.
 */
function DnD() {

    this.init = function (options, _cg) {
        this._cg = _cg;
        this.startDragFlag = false;

        this.defaultParams = {
            top: 0,
            left: 0,
            parentBoxCross: false,
            changeX: true,
            changeY: true,
            targetBox: false,
            stopDrag: function (elem, x, y) {
            },
            startDrag: function (elem, x, y) {
            },
            dragging: function (elem, x, y) {
            }
        };

        this._cg.elem.style.position = 'absolute';
        this._cg.elem.style.userSelect = 'none';
        this.options = this._cg.setOptions(this.defaultParams, options);
        this.parentBox = this._cg.elem.parentNode;
        this.startElemCoords = this._cg.getXY(this._cg.elem);
        this._cg.elem.onmousedown = this.dragHandler.bind(this);
        this._cg.elem.onmouseup = this.stopDrag.bind(this);
        this._cg.elem.ondragstart = function () {
            return false;
        };
        this._cg.elem.onselectstart = function () {
            return false;
        };
        return this;
    };

    this.dragHandler = function (e) {
        this._cg.elem.style.cursor = 'move';
        var coords = this.getCoords(this._cg.elem);
        var shiftX = e.pageX - coords.left;
        var shiftY = e.pageY - coords.top;
        this.moveAt(e, {shiftX: shiftX, shiftY: shiftY});
        document.onmousemove = function (e) {
            this.moveAt(e, {shiftX: shiftX, shiftY: shiftY});
        }.bind(this);
    };

    this.stopDrag = function () {
        document.onmousemove = null;
        this.options.stopDrag(this._cg.elem, parseInt(this._cg.elem.style.left), parseInt(this._cg.elem.style.top));
        this.startDragFlag = false;
        this._cg.elem.style.cursor = 'default';
        if (this.options.targetBox) {
            var targetBox = this._cg.getElement(this.options.targetBox);
            var targetBoxStyle = this._cg.getStyle(targetBox);
            var elemXY = this._cg.getXY(this._cg.elem);
            var elemWH = this._cg.getWH(this._cg.elem);
            var elemCoords = {
                x1: elemXY.x,
                y1: elemXY.y,
                x2: elemXY.x + elemWH.width,
                y2: elemXY.y + elemWH.height
            };
            var targetBoxCoords = {
                x1: parseInt(targetBoxStyle.left),
                y1: parseInt(targetBoxStyle.top),
                x2: parseInt(targetBoxStyle.left) + parseInt(targetBoxStyle.width),
                y2: parseInt(targetBoxStyle.top) + parseInt(targetBoxStyle.height)
            };
            var includes = {
                topLeft: this.checkInclude(elemCoords.x1, elemCoords.y1, targetBoxCoords),
                topRight: this.checkInclude(elemCoords.x2, elemCoords.y1, targetBoxCoords),
                bottomLeft: this.checkInclude(elemCoords.x1, elemCoords.y2, targetBoxCoords),
                bottomRight: this.checkInclude(elemCoords.x2, elemCoords.y2, targetBoxCoords)
            };
            if(!this.checkAngleIncludes(includes)){
                this.setCoordinates(this.startElemCoords.x, this.startElemCoords.y);
            }
            console.log(this.checkAngleIncludes(includes));
        }
        //this._cg.elem.onmouseup = null;
    };

    this.checkInclude = function (elemX, elemY, targetBoxCoords) {
        return elemX > targetBoxCoords.x1 && elemX < targetBoxCoords.x2
            && elemY > targetBoxCoords.y1 && elemY < targetBoxCoords.y2;
    };

    this.checkAngleIncludes = function (includes) {
        for (var prop in includes) {
            if(includes[prop]){
                return true;
            }
        }
        return false;
    };

    this.moveAt = function (e, data) {
        if (!this.startDragFlag) {
            this.options.startDrag(this._cg.elem, parseInt(this._cg.elem.style.left), parseInt(this._cg.elem.style.top));
            this.startDragFlag = true;
        }
        var forcedStop = this.forcedStop(e, data);
        this.options.dragging(this._cg.elem, parseInt(this._cg.elem.style.left), parseInt(this._cg.elem.style.top));
        if (!forcedStop.x && this.options.changeX) {
            this._cg.elem.style.left = e.pageX - data.shiftX + 'px';
        }
        if (!forcedStop.y && this.options.changeY) {
            this._cg.elem.style.top = e.pageY - data.shiftY + 'px';
        }
    };

    this.getCoords = function (elem) {
        return {
            top: elem.offsetTop,
            left: elem.offsetLeft
        };
    };

    this.forcedStop = function (e, data) {
        var res = {x: false, y: false};
        if (!this.options.parentBoxCross) {
            var elemParams = getComputedStyle(this._cg.elem);
            var parentElemParams = getComputedStyle(this.parentBox);
            var elW = parseInt(elemParams.width);
            var elH = parseInt(elemParams.height);
            var boxW = parseInt(parentElemParams.width);
            var boxH = parseInt(parentElemParams.height);

            if (this.options.changeX) {
                if (e.pageX - data.shiftX < 0) {
                    this._cg.elem.style.left = 0;
                    res.x = true;
                }
                if (e.pageX - data.shiftX + elW > boxW) {
                    this._cg.elem.style.left = boxW - elW;
                    res.x = true;
                }
            }

            if (this.options.changeY) {
                if (e.pageY - data.shiftY < 0) {
                    this._cg.elem.style.top = 0;
                    res.y = true;
                }
                if (e.pageY - data.shiftY + elH > boxH) {
                    this._cg.elem.style.top = boxH - elH;
                    res.y = true;
                }
            }
        }
        return res;
    };

    this.setCoordinates = function (x, y) {
        this._cg.elem.style.left = x + 'px';
        this._cg.elem.style.top = y + 'px';
    };

    this.test = function () {
        var per = 'Vasya';
        var obj = {name: 'Vasya', lastName: 'B'}
        var newPer = per;
        var newObj = obj;
        console.log(per);
    }

}

_CG.draggable = function (options) {
    if (this.hasExtension('dnd')) {
        this.dnd.options = this.setOptions(this.dnd.options, options);
        return this.dnd;
    }
    var dnd = new DnD();
    this.addExtension('dnd', dnd);
    return dnd.init(options, this);
};

