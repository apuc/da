function(t) {
    t.fn.supermaincarousel = function(e) {
        this.each(function() {
            function i() {
                s("init")
            }
            function n() {
                s("reinit")
            }
            function a(e, i) {
                e.find(".iblock").each(function(e) {
                    var n = t(this)
                      , a = r.find(".slidestorage")
                      , o = t(".iblock:eq(" + (e + i) + ")", a)
                      , s = o.children(".slide").clone(!0);
                    s.addClass("opened").appendTo(n);
                    n.find(".opened .info").on("mouseenter", function() {
                        n.addClass("hover"),
                        n.find(".text").stop().slideDown(300)
                    }).on("mouseleave", function() {
                        n.find(".text").stop().slideUp(200, function() {
                            n.removeClass("hover")
                        })
                    })
                })
            }
            function o(e, i) {
                e.html(""),
                i ? (t('<div class="iblock type0" data-type="type0" />').appendTo(e),
                5 > _columns ? t('<div class="iblock type4" data-type="type4" />').appendTo(e) : t('<div class="iblock type3" data-type="type3" /><div class="iblock type4" data-type="type4" />').appendTo(e)) : 5 > _columns ? t('<div class="iblock type1" data-type="type1" /><div class="iblock type2" data-type="type2" /><div class="iblock type4" data-type="type4" />').appendTo(e) : t('<div class="iblock type1" data-type="type1" /><div class="iblock type2" data-type="type2" /><div class="iblock type3" data-type="type3" /><div class="iblock type4" data-type="type4" />').appendTo(e)
            }
            function s(e) {
                if ("init" == e) {
                    var i = t('<div class="slidesmask" />').appendTo(r)
                      , n = r.children(".iblock")
                      , s = t('<div class="slidestorage" />').appendTo(r);
                    n.appendTo(s),
                    t(".iblock:first", s).hasClass("emergency") ? o(i, !0) : o(i, !1),
                    a(i, 0);
                    var c = t('<div class="slidenav"><a href="#" class="toleft"><span class="wsico">&#x0033;</span></a><a href="#" class="toright"><span class="wsico">&#x0034;</span></a></div>').appendTo(r);
                    c.find(".toright").on("click", function(e) {
                        if (e.preventDefault(),
                        !r.hasClass("inaction")) {
                            r.addClass("inaction");
                            var i = 4 == _columns ? 2 : 3
                              , n = t(".iblock", s).slice(0, i);
                            n.appendTo(s);
                            var c = r.find(".slidesmask")
                              , h = t('<div class="slidesmask" />');
                            c.before(h),
                            t(".iblock:eq(0)", s).hasClass("emergency") ? o(h, !0) : o(h, !1),
                            a(h, 0),
                            h.css({
                                opacity: 0,
                                position: "absolute",
                                top: 0,
                                left: 0,
                                "z-index": 10
                            });
                            var d = h.find(".iblock")
                              , u = c.find(".iblock")
                              , p = t(".section, .info", u)
                              , f = u.find(".photo")
                              , m = d.find(".photo");
                            newtxt = t(".section, .info", d),
                            m.css("margin-left", "100%"),
                            newtxt.css("opacity", 0),
                            p.stop().animate({
                                opacity: 0
                            }, 100, function() {
                                h.stop().animate({
                                    opacity: 1
                                }, 100, l),
                                d.each(function(e) {
                                    var i = t(this)
                                      , n = i.find(".slide")
                                      , a = n.find(".photo")
                                      , o = t(".section, .info", n)
                                      , s = a.data(i.data("type")) ? a.data(i.data("type")) : 0;
                                    n.removeClass("opened"),
                                    window.setTimeout(function() {
                                        a.stop().animate({
                                            "margin-left": s + "px"
                                        }, 550, l, function() {
                                            window.setTimeout(function() {
                                                o.stop().animate({
                                                    opacity: 1
                                                }, 300, l, function() {
                                                    e == d.length - 1 && (h.css({
                                                        position: "",
                                                        "z-index": "",
                                                        left: "",
                                                        top: ""
                                                    }),
                                                    e == d.length - 1 && (r.removeClass("inaction"),
                                                    c.remove()))
                                                })
                                            }, 100)
                                        }),
                                        0 == e && f.each(function() {
                                            var e = t(this);
                                            e.animate({
                                                "margin-left": -e.width()
                                            }, 550, l, function() {})
                                        })
                                    }, 150)
                                })
                            })
                        }
                    }),
                    c.find(".toleft").on("click", function(e) {
                        if (e.preventDefault(),
                        !r.hasClass("inaction")) {
                            r.addClass("inaction");
                            var i = 4 == _columns ? 2 : 3
                              , n = t(".iblock", s).slice(-i);
                            n.length > 0 && n.prependTo(s);
                            var c = r.find(".slidesmask")
                              , h = t('<div class="slidesmask" />');
                            c.before(h),
                            t(".iblock:eq(0)", s).hasClass("emergency") ? o(h, !0) : o(h, !1),
                            a(h, 0),
                            h.css({
                                opacity: .5,
                                position: "absolute",
                                top: 0,
                                left: 0,
                                "z-index": 10
                            });
                            var d = h.find(".iblock")
                              , u = c.find(".iblock")
                              , p = t(".section, .info", u)
                              , f = u.find(".photo")
                              , m = d.find(".photo");
                            newtxt = t(".section, .info", d),
                            newtxt.css("opacity", 0),
                            m.each(function() {
                                var e = t(this);
                                e.css("margin-left", -e.width())
                            }),
                            p.stop().animate({
                                opacity: 0
                            }, 100, function() {
                                h.stop().animate({
                                    opacity: 1
                                }, 100, l),
                                d.each(function(e) {
                                    var i = t(this)
                                      , n = i.find(".slide")
                                      , a = n.find(".photo")
                                      , o = t(".section, .info", n)
                                      , s = a.data(i.data("type")) ? a.data(i.data("type")) : 0;
                                    n.removeClass("opened"),
                                    window.setTimeout(function() {
                                        a.stop().animate({
                                            "margin-left": s + "px"
                                        }, 550, l, function() {
                                            window.setTimeout(function() {
                                                o.stop().animate({
                                                    opacity: 1
                                                }, 300, l, function() {
                                                    e == d.length - 1 && h.css({
                                                        position: "",
                                                        "z-index": "",
                                                        left: "",
                                                        top: ""
                                                    }),
                                                    e == d.length - 1 && (r.removeClass("inaction"),
                                                    c.remove())
                                                })
                                            }, 150)
                                        }),
                                        0 == e && f.stop().animate({
                                            "margin-left": "100%"
                                        }, 550, l, function() {})
                                    }, 150)
                                })
                            })
                        }
                    })
                } else {
                    var i = r.find(".slidesmask")
                      , n = r.children(".iblock")
                      , s = r.find(".slidestorage");
                    t(".iblock:first", s).hasClass("emergency") ? o(i, !0) : o(i, !1),
                    a(i, 0)
                }
            }
            var r = t(this)
              , l = "easeInOutQuad";
            "reinit" == e ? n() : i(),
            t("body").bind("changecolumns", function() {
                n()
            })
        })
    }
}(jQuery),
function(t) {
    t.fn.onaircarousel = function(e) {
        this.each(function() {
            function i() {
                a("init")
            }
            function n() {
                a("reinit")
            }
            function a(e) {
                var i = new Date
                  , n = i.getTimezoneOffset() / 60;
                t.ajax({
                    url: o.data("url"),
                    type: "get",
                    data: {
                        timezone: n
                    },
                    cache: !1
                }).done(function(e) {
                    return t(e).appendTo(o),
                    o.find(".iblock").cleanWS(),
                    o.find(".carousel").notacarousel({
                        slider: !0
                    }),
                    t("#fulldayswitcher a").on("click", function(e) {
                        e.preventDefault();
                        var i = t(this).attr("href")
                          , n = Math.floor((t(i).index() + _columns) / _columns);
                        t(".carouselnav .slide:eq(" + (n - 1 > 0 ? n - 1 : 0) + ")", o).trigger("click")
                    }),
                    !1
                })
            }
            var o = t(this);
            "reinit" == e ? n() : i()
        })
    }
}(jQuery),
function(t) {
    t.fn.initLive = function() {
        this.each(function() {
            var e, i = t(this), n = i.find(".playerbutton");
            n.on("click.firstclick", function(i) {
                i.preventDefault();
                var n = t(this);
                e = window.open(n.attr("href"), "echoliveplayer", "location=no,locationbar=no,chrome=yes,titlebar=yes,menubar=no,toolbar=no,resizable=yes,scrollbars=yes,personalbar=no,directories=no,status=no,width=800,height=820"),
                e.focus()
            })
        })
    }
}(jQuery),
function(t) {
    t.fn.footOpen = function() {
        this.each(function() {
            var e = t(this)
              , i = ["\u043f\u043e\u043a\u0430\u0437\u0430\u0442\u044c", "\u0441\u043a\u0440\u044b\u0442\u044c"]
              , n = t(".info_partner_block");
            n.hide(),
            e.on("click", function(t) {
                return t.preventDefault(),
                e.hasClass("show") ? (e.find("span:last-child").text(i[0]),
                e.removeClass("show"),
                e.closest(".footer").height(400).prev().css({
                    "padding-bottom": "450px"
                }),
                n.slideUp()) : (e.find("span:last-child").text(i[1]),
                e.addClass("show"),
                e.closest(".footer").height(750).prev().css({
                    "padding-bottom": "800px"
                }),
                n.slideDown()),
                popularblFunc(),
                !1
            })
        })
    }
}
