/**
 * Created by apuc0 on 20.01.2018.
 */
function CG() {

    this.set = function (el) {
        this.elem = this.getElement(el);
        return this;
    };

    this.getElement = function (el) {
        var thisElement;
        if (el[0] === '#') {
            thisElement = document.getElementById(el.slice(1));
        }
        else {
            thisElement = document.getElementsByClassName(el.slice(1));
        }
        return thisElement;
    };

    this.getElementByAttr = function (attr, value) {
        var elems = document.getElementsByTagName('*');
        for (var i = 0; elems.length; i++) {
            if (elems[i].getAttribute(attr) == value) {
                return elems[i];
            }
        }
    };

    this.setOptions = function (defaultOptions, options) {
        var finalParams = defaultOptions;
        for (var key in options) {
            if (options.hasOwnProperty(key)) {
                if (options[key] !== undefined) {
                    finalParams[key] = options[key];
                }
            }
        }

        return finalParams;
    };

    this.getWH = function (elem) {
        var size = getComputedStyle(elem);
        return {
            width: parseInt(size.width),
            height: parseInt(size.height)
        };
    };

    this.getXY = function (elem) {
        var xy = getComputedStyle(elem);
        return {
            x: parseInt(xy.left),
            y: parseInt(xy.top)
        }
    };

    this.getStyle = function (elem) {
        return window.getComputedStyle ? getComputedStyle(elem, "") : elem.currentStyle;
    };

    this.addExtension = function (name, obj) {
        this[name] = obj;
    };

    this.hasExtension = function (name) {
        return typeof this[name] !== 'undefined';
    }
}

var _CG = new CG();
var _cgPool = [];

function makeClone(obj) {
    var clone = {}; // Создаем новый пустой объект
    for (var prop in obj) { // Перебираем все свойства копируемого объекта
        if (obj.hasOwnProperty(prop)) { // Только собственные свойства
            if ("object" === typeof obj[prop]) // Если свойство так же объект
                clone[prop] = makeClone(obj[prop]); // Делаем клон свойства
            else
                clone[prop] = obj[prop]; // Или же просто копируем значение
        }
    }
    return clone;
}

function getFromPool(el, pool) {
    for (var i = 0; i < pool.length; i++) {
        if (pool[i].el == el) {
            return pool[i].obj;
        }
    }
    return false;
}

function $cg(el) {
    var obj = getFromPool(el, _cgPool);
    if (!obj) {
        obj = makeClone(_CG);
        _cgPool.push({el: el, obj: obj});
        return obj.set(el);
    }
    return obj;
}