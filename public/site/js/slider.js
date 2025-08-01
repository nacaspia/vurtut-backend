/**
 * Owl carousel
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 * @todo Lazy Load Icon
 * @todo prevent animationend bubling
 * @todo itemsScaleUp
 * @todo Test Zepto
 * @todo stagePadding calculate wrong active classes
 */
!function (a, b, c, d) {
    function e(b, c) {
        this.settings = null, this.options = a.extend({}, e.Defaults, c), this.$element = a(b), this.drag = a.extend({}, m), this.state = a.extend({}, n), this.e = a.extend({}, o), this._plugins = {}, this._supress = {}, this._current = null, this._speed = null, this._coordinates = [], this._breakpoint = null, this._width = null, this._items = [], this._clones = [], this._mergers = [], this._invalidated = {}, this._pipe = [], a.each(e.Plugins, a.proxy(function (a, b) {
            this._plugins[a[0].toLowerCase() + a.slice(1)] = new b(this)
        }, this)), a.each(e.Pipe, a.proxy(function (b, c) {
            this._pipe.push({filter: c.filter, run: a.proxy(c.run, this)})
        }, this)), this.setup(), this.initialize()
    }

    function f(a) {
        if (a.touches !== d) return {x: a.touches[0].pageX, y: a.touches[0].pageY};
        if (a.touches === d) {
            if (a.pageX !== d) return {x: a.pageX, y: a.pageY};
            if (a.pageX === d) return {x: a.clientX, y: a.clientY}
        }
    }

    function g(a) {
        var b, d, e = c.createElement("div"), f = a;
        for (b in f) if (d = f[b], "undefined" != typeof e.style[d]) return e = null, [d, b];
        return [!1]
    }

    function h() {
        return g(["transition", "WebkitTransition", "MozTransition", "OTransition"])[1]
    }

    function i() {
        return g(["transform", "WebkitTransform", "MozTransform", "OTransform", "msTransform"])[0]
    }

    function j() {
        return g(["perspective", "webkitPerspective", "MozPerspective", "OPerspective", "MsPerspective"])[0]
    }

    function k() {
        return "ontouchstart" in b || !!navigator.msMaxTouchPoints
    }

    function l() {
        return b.navigator.msPointerEnabled
    }

    var m, n, o;
    m = {
        start: 0,
        startX: 0,
        startY: 0,
        current: 0,
        currentX: 0,
        currentY: 0,
        offsetX: 0,
        offsetY: 0,
        distance: null,
        startTime: 0,
        endTime: 0,
        updatedX: 0,
        targetEl: null
    }, n = {isTouch: !1, isScrolling: !1, isSwiping: !1, direction: !1, inMotion: !1}, o = {
        _onDragStart: null,
        _onDragMove: null,
        _onDragEnd: null,
        _transitionEnd: null,
        _resizer: null,
        _responsiveCall: null,
        _goToLoop: null,
        _checkVisibile: null
    }, e.Defaults = {
        items: 3,
        loop: !1,
        center: !1,
        mouseDrag: !0,
        touchDrag: !0,
        pullDrag: !0,
        freeDrag: !1,
        margin: 0,
        stagePadding: 0,
        merge: !1,
        mergeFit: !0,
        autoWidth: !1,
        startPosition: 0,
        rtl: !1,
        smartSpeed: 250,
        fluidSpeed: !1,
        dragEndSpeed: !1,
        responsive: {},
        responsiveRefreshRate: 200,
        responsiveBaseElement: b,
        responsiveClass: !1,
        fallbackEasing: "swing",
        info: !1,
        nestedItemSelector: !1,
        itemElement: "div",
        stageElement: "div",
        themeClass: "owl-theme",
        baseClass: "owl-carousel",
        itemClass: "owl-item",
        centerClass: "center",
        activeClass: "active"
    }, e.Width = {
        Default: "default",
        Inner: "inner",
        Outer: "outer"
    }, e.Plugins = {}, e.Pipe = [{
        filter: ["width", "items", "settings"], run: function (a) {
            a.current = this._items && this._items[this.relative(this._current)]
        }
    }, {
        filter: ["items", "settings"], run: function () {
            var a = this._clones, b = this.$stage.children(".cloned");
            (b.length !== a.length || !this.settings.loop && a.length > 0) && (this.$stage.children(".cloned").remove(), this._clones = [])
        }
    }, {
        filter: ["items", "settings"], run: function () {
            var a = this._clones, b = this.$stage.children(".cloned");
            (b.length !== a.length || !this.settings.loop && a.length > 0) && (this.$stage.children(".cloned").remove(), this._clones = [])
        }
    }, {
        filter: ["width", "items", "settings"], run: function () {
            var a, b, c, d = this.settings.rtl ? 1 : -1, e = (this.width() / this.settings.items).toFixed(3), f = 0;
            for (this._coordinates = [], b = 0, c = this._clones.length + this._items.length; c > b; b++) a = this._mergers[this.relative(b)], a = this.settings.mergeFit && Math.min(a, this.settings.items) || a, f += (this.settings.autoWidth ? this._items[this.relative(b)].width() + this.settings.margin : e * a) * d, this._coordinates.push(f)
        }
    }, {
        filter: ["width", "items", "settings"], run: function () {
            var b, c, d = (this.width() / this.settings.items).toFixed(3), e = {
                width: Math.abs(this._coordinates[this._coordinates.length - 1]) + 2 * this.settings.stagePadding,
                "padding-left": this.settings.stagePadding || "",
                "padding-right": this.settings.stagePadding || ""
            };
            if (this.$stage.css(e), e = {width: this.settings.autoWidth ? "auto" : d - this.settings.margin}, e[this.settings.rtl ? "margin-left" : "margin-right"] = this.settings.margin, !this.settings.autoWidth && a.grep(this._mergers, function (a) {
                return a > 1
            }).length > 0) for (b = 0, c = this._coordinates.length; c > b; b++) e.width = Math.abs(this._coordinates[b]) - Math.abs(this._coordinates[b - 1] || 0) - this.settings.margin, this.$stage.children().eq(b).css(e); else this.$stage.children().css(e)
        }
    }, {
        filter: ["width", "items", "settings"], run: function (a) {
            a.current && this.reset(this.$stage.children().index(a.current))
        }
    }, {
        filter: ["position"], run: function () {
            this.animate(this.coordinates(this._current))
        }
    }, {
        filter: ["width", "position", "items", "settings"], run: function () {
            var a, b, c, d, e = this.settings.rtl ? 1 : -1, f = 2 * this.settings.stagePadding,
                g = this.coordinates(this.current()) + f, h = g + this.width() * e, i = [];
            for (c = 0, d = this._coordinates.length; d > c; c++) a = this._coordinates[c - 1] || 0, b = Math.abs(this._coordinates[c]) + f * e, (this.op(a, "<=", g) && this.op(a, ">", h) || this.op(b, "<", g) && this.op(b, ">", h)) && i.push(c);
            this.$stage.children("." + this.settings.activeClass).removeClass(this.settings.activeClass), this.$stage.children(":eq(" + i.join("), :eq(") + ")").addClass(this.settings.activeClass), this.settings.center && (this.$stage.children("." + this.settings.centerClass).removeClass(this.settings.centerClass), this.$stage.children().eq(this.current()).addClass(this.settings.centerClass))
        }
    }], e.prototype.initialize = function () {
        if (this.trigger("initialize"), this.$element.addClass(this.settings.baseClass).addClass(this.settings.themeClass).toggleClass("owl-rtl", this.settings.rtl), this.browserSupport(), this.settings.autoWidth && this.state.imagesLoaded !== !0) {
            var b, c, e;
            if (b = this.$element.find("img"), c = this.settings.nestedItemSelector ? "." + this.settings.nestedItemSelector : d, e = this.$element.children(c).width(), b.length && 0 >= e) return this.preloadAutoWidthImages(b), !1
        }
        this.$element.addClass("owl-loading"), this.$stage = a("<" + this.settings.stageElement + ' class="owl-stage"/>').wrap('<div class="owl-stage-outer">'), this.$element.append(this.$stage.parent()), this.replace(this.$element.children().not(this.$stage.parent())), this._width = this.$element.width(), this.refresh(), this.$element.removeClass("owl-loading").addClass("owl-loaded"), this.eventsCall(), this.internalEvents(), this.addTriggerableEvents(), this.trigger("initialized")
    }, e.prototype.setup = function () {
        var b = this.viewport(), c = this.options.responsive, d = -1, e = null;
        c ? (a.each(c, function (a) {
            b >= a && a > d && (d = Number(a))
        }), e = a.extend({}, this.options, c[d]), delete e.responsive, e.responsiveClass && this.$element.attr("class", function (a, b) {
            return b.replace(/\b owl-responsive-\S+/g, "")
        }).addClass("owl-responsive-" + d)) : e = a.extend({}, this.options), (null === this.settings || this._breakpoint !== d) && (this.trigger("change", {
            property: {
                name: "settings",
                value: e
            }
        }), this._breakpoint = d, this.settings = e, this.invalidate("settings"), this.trigger("changed", {
            property: {
                name: "settings",
                value: this.settings
            }
        }))
    }, e.prototype.optionsLogic = function () {
        this.$element.toggleClass("owl-center", this.settings.center), this.settings.loop && this._items.length < this.settings.items && (this.settings.loop = !1), this.settings.autoWidth && (this.settings.stagePadding = !1, this.settings.merge = !1)
    }, e.prototype.prepare = function (b) {
        var c = this.trigger("prepare", {content: b});
        return c.data || (c.data = a("<" + this.settings.itemElement + "/>").addClass(this.settings.itemClass).append(b)), this.trigger("prepared", {content: c.data}), c.data
    }, e.prototype.update = function () {
        for (var b = 0, c = this._pipe.length, d = a.proxy(function (a) {
            return this[a]
        }, this._invalidated), e = {}; c > b;) (this._invalidated.all || a.grep(this._pipe[b].filter, d).length > 0) && this._pipe[b].run(e), b++;
        this._invalidated = {}
    }, e.prototype.width = function (a) {
        switch (a = a || e.Width.Default) {
            case e.Width.Inner:
            case e.Width.Outer:
                return this._width;
            default:
                return this._width - 2 * this.settings.stagePadding + this.settings.margin
        }
    }, e.prototype.refresh = function () {
        if (0 === this._items.length) return !1;
        (new Date).getTime();
        this.trigger("refresh"), this.setup(), this.optionsLogic(), this.$stage.addClass("owl-refresh"), this.update(), this.$stage.removeClass("owl-refresh"), this.state.orientation = b.orientation, this.watchVisibility(), this.trigger("refreshed")
    }, e.prototype.eventsCall = function () {
        this.e._onDragStart = a.proxy(function (a) {
            this.onDragStart(a)
        }, this), this.e._onDragMove = a.proxy(function (a) {
            this.onDragMove(a)
        }, this), this.e._onDragEnd = a.proxy(function (a) {
            this.onDragEnd(a)
        }, this), this.e._onResize = a.proxy(function (a) {
            this.onResize(a)
        }, this), this.e._transitionEnd = a.proxy(function (a) {
            this.transitionEnd(a)
        }, this), this.e._preventClick = a.proxy(function (a) {
            this.preventClick(a)
        }, this)
    }, e.prototype.onThrottledResize = function () {
        b.clearTimeout(this.resizeTimer), this.resizeTimer = b.setTimeout(this.e._onResize, this.settings.responsiveRefreshRate)
    }, e.prototype.onResize = function () {
        return this._items.length ? this._width === this.$element.width() ? !1 : this.trigger("resize").isDefaultPrevented() ? !1 : (this._width = this.$element.width(), this.invalidate("width"), this.refresh(), void this.trigger("resized")) : !1
    }, e.prototype.eventsRouter = function (a) {
        var b = a.type;
        "mousedown" === b || "touchstart" === b ? this.onDragStart(a) : "mousemove" === b || "touchmove" === b ? this.onDragMove(a) : "mouseup" === b || "touchend" === b ? this.onDragEnd(a) : "touchcancel" === b && this.onDragEnd(a)
    }, e.prototype.internalEvents = function () {
        var c = (k(), l());
        this.settings.mouseDrag ? (this.$stage.on("mousedown", a.proxy(function (a) {
            this.eventsRouter(a)
        }, this)), this.$stage.on("dragstart", function () {
            return !1
        }), this.$stage.get(0).onselectstart = function () {
            return !1
        }) : this.$element.addClass("owl-text-select-on"), this.settings.touchDrag && !c && this.$stage.on("touchstart touchcancel", a.proxy(function (a) {
            this.eventsRouter(a)
        }, this)), this.transitionEndVendor && this.on(this.$stage.get(0), this.transitionEndVendor, this.e._transitionEnd, !1), this.settings.responsive !== !1 && this.on(b, "resize", a.proxy(this.onThrottledResize, this))
    }, e.prototype.onDragStart = function (d) {
        var e, g, h, i;
        if (e = d.originalEvent || d || b.event, 3 === e.which || this.state.isTouch) return !1;
        if ("mousedown" === e.type && this.$stage.addClass("owl-grab"), this.trigger("drag"), this.drag.startTime = (new Date).getTime(), this.speed(0), this.state.isTouch = !0, this.state.isScrolling = !1, this.state.isSwiping = !1, this.drag.distance = 0, g = f(e).x, h = f(e).y, this.drag.offsetX = this.$stage.position().left, this.drag.offsetY = this.$stage.position().top, this.settings.rtl && (this.drag.offsetX = this.$stage.position().left + this.$stage.width() - this.width() + this.settings.margin), this.state.inMotion && this.support3d) i = this.getTransformProperty(), this.drag.offsetX = i, this.animate(i), this.state.inMotion = !0; else if (this.state.inMotion && !this.support3d) return this.state.inMotion = !1, !1;
        this.drag.startX = g - this.drag.offsetX, this.drag.startY = h - this.drag.offsetY, this.drag.start = g - this.drag.startX, this.drag.targetEl = e.target || e.srcElement, this.drag.updatedX = this.drag.start, ("IMG" === this.drag.targetEl.tagName || "A" === this.drag.targetEl.tagName) && (this.drag.targetEl.draggable = !1), a(c).on("mousemove.owl.dragEvents mouseup.owl.dragEvents touchmove.owl.dragEvents touchend.owl.dragEvents", a.proxy(function (a) {
            this.eventsRouter(a)
        }, this))
    }, e.prototype.onDragMove = function (a) {
        var c, e, g, h, i, j;
        this.state.isTouch && (this.state.isScrolling || (c = a.originalEvent || a || b.event, e = f(c).x, g = f(c).y, this.drag.currentX = e - this.drag.startX, this.drag.currentY = g - this.drag.startY, this.drag.distance = this.drag.currentX - this.drag.offsetX, this.drag.distance < 0 ? this.state.direction = this.settings.rtl ? "right" : "left" : this.drag.distance > 0 && (this.state.direction = this.settings.rtl ? "left" : "right"), this.settings.loop ? this.op(this.drag.currentX, ">", this.coordinates(this.minimum())) && "right" === this.state.direction ? this.drag.currentX -= (this.settings.center && this.coordinates(0)) - this.coordinates(this._items.length) : this.op(this.drag.currentX, "<", this.coordinates(this.maximum())) && "left" === this.state.direction && (this.drag.currentX += (this.settings.center && this.coordinates(0)) - this.coordinates(this._items.length)) : (h = this.coordinates(this.settings.rtl ? this.maximum() : this.minimum()), i = this.coordinates(this.settings.rtl ? this.minimum() : this.maximum()), j = this.settings.pullDrag ? this.drag.distance / 5 : 0, this.drag.currentX = Math.max(Math.min(this.drag.currentX, h + j), i + j)), (this.drag.distance > 8 || this.drag.distance < -8) && (c.preventDefault !== d ? c.preventDefault() : c.returnValue = !1, this.state.isSwiping = !0), this.drag.updatedX = this.drag.currentX, (this.drag.currentY > 16 || this.drag.currentY < -16) && this.state.isSwiping === !1 && (this.state.isScrolling = !0, this.drag.updatedX = this.drag.start), this.animate(this.drag.updatedX)))
    }, e.prototype.onDragEnd = function (b) {
        var d, e, f;
        if (this.state.isTouch) {
            if ("mouseup" === b.type && this.$stage.removeClass("owl-grab"), this.trigger("dragged"), this.drag.targetEl.removeAttribute("draggable"), this.state.isTouch = !1, this.state.isScrolling = !1, this.state.isSwiping = !1, 0 === this.drag.distance && this.state.inMotion !== !0) return this.state.inMotion = !1, !1;
            this.drag.endTime = (new Date).getTime(), d = this.drag.endTime - this.drag.startTime, e = Math.abs(this.drag.distance), (e > 3 || d > 300) && this.removeClick(this.drag.targetEl), f = this.closest(this.drag.updatedX), this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed), this.current(f), this.invalidate("position"), this.update(), this.settings.pullDrag || this.drag.updatedX !== this.coordinates(f) || this.transitionEnd(), this.drag.distance = 0, a(c).off(".owl.dragEvents")
        }
    }, e.prototype.removeClick = function (c) {
        this.drag.targetEl = c, a(c).on("click.preventClick", this.e._preventClick), b.setTimeout(function () {
            a(c).off("click.preventClick")
        }, 300)
    }, e.prototype.preventClick = function (b) {
        b.preventDefault ? b.preventDefault() : b.returnValue = !1, b.stopPropagation && b.stopPropagation(), a(b.target).off("click.preventClick")
    }, e.prototype.getTransformProperty = function () {
        var a, c;
        return a = b.getComputedStyle(this.$stage.get(0), null).getPropertyValue(this.vendorName + "transform"), a = a.replace(/matrix(3d)?\(|\)/g, "").split(","), c = 16 === a.length, c !== !0 ? a[4] : a[12]
    }, e.prototype.closest = function (b) {
        var c = -1, d = 30, e = this.width(), f = this.coordinates();
        return this.settings.freeDrag || a.each(f, a.proxy(function (a, g) {
            return b > g - d && g + d > b ? c = a : this.op(b, "<", g) && this.op(b, ">", f[a + 1] || g - e) && (c = "left" === this.state.direction ? a + 1 : a), -1 === c
        }, this)), this.settings.loop || (this.op(b, ">", f[this.minimum()]) ? c = b = this.minimum() : this.op(b, "<", f[this.maximum()]) && (c = b = this.maximum())), c
    }, e.prototype.animate = function (b) {
        this.trigger("translate"), this.state.inMotion = this.speed() > 0, this.support3d ? this.$stage.css({
            transform: "translate3d(" + b + "px,0px, 0px)",
            transition: this.speed() / 1e3 + "s"
        }) : this.state.isTouch ? this.$stage.css({left: b + "px"}) : this.$stage.animate({left: b}, this.speed() / 1e3, this.settings.fallbackEasing, a.proxy(function () {
            this.state.inMotion && this.transitionEnd()
        }, this))
    }, e.prototype.current = function (a) {
        if (a === d) return this._current;
        if (0 === this._items.length) return d;
        if (a = this.normalize(a), this._current !== a) {
            var b = this.trigger("change", {property: {name: "position", value: a}});
            b.data !== d && (a = this.normalize(b.data)), this._current = a, this.invalidate("position"), this.trigger("changed", {
                property: {
                    name: "position",
                    value: this._current
                }
            })
        }
        return this._current
    }, e.prototype.invalidate = function (a) {
        this._invalidated[a] = !0
    }, e.prototype.reset = function (a) {
        a = this.normalize(a), a !== d && (this._speed = 0, this._current = a, this.suppress(["translate", "translated"]), this.animate(this.coordinates(a)), this.release(["translate", "translated"]))
    }, e.prototype.normalize = function (b, c) {
        var e = c ? this._items.length : this._items.length + this._clones.length;
        return !a.isNumeric(b) || 1 > e ? d : b = this._clones.length ? (b % e + e) % e : Math.max(this.minimum(c), Math.min(this.maximum(c), b))
    }, e.prototype.relative = function (a) {
        return a = this.normalize(a), a -= this._clones.length / 2, this.normalize(a, !0)
    }, e.prototype.maximum = function (a) {
        var b, c, d, e = 0, f = this.settings;
        if (a) return this._items.length - 1;
        if (!f.loop && f.center) b = this._items.length - 1; else if (f.loop || f.center) if (f.loop || f.center) b = this._items.length + f.items; else {
            if (!f.autoWidth && !f.merge) throw "Can not detect maximum absolute position.";
            for (revert = f.rtl ? 1 : -1, c = this.$stage.width() - this.$element.width(); (d = this.coordinates(e)) && !(d * revert >= c);) b = ++e
        } else b = this._items.length - f.items;
        return b
    }, e.prototype.minimum = function (a) {
        return a ? 0 : this._clones.length / 2
    }, e.prototype.items = function (a) {
        return a === d ? this._items.slice() : (a = this.normalize(a, !0), this._items[a])
    }, e.prototype.mergers = function (a) {
        return a === d ? this._mergers.slice() : (a = this.normalize(a, !0), this._mergers[a])
    }, e.prototype.clones = function (b) {
        var c = this._clones.length / 2, e = c + this._items.length, f = function (a) {
            return a % 2 === 0 ? e + a / 2 : c - (a + 1) / 2
        };
        return b === d ? a.map(this._clones, function (a, b) {
            return f(b)
        }) : a.map(this._clones, function (a, c) {
            return a === b ? f(c) : null
        })
    }, e.prototype.speed = function (a) {
        return a !== d && (this._speed = a), this._speed
    }, e.prototype.coordinates = function (b) {
        var c = null;
        return b === d ? a.map(this._coordinates, a.proxy(function (a, b) {
            return this.coordinates(b)
        }, this)) : (this.settings.center ? (c = this._coordinates[b], c += (this.width() - c + (this._coordinates[b - 1] || 0)) / 2 * (this.settings.rtl ? -1 : 1)) : c = this._coordinates[b - 1] || 0, c)
    }, e.prototype.duration = function (a, b, c) {
        return Math.min(Math.max(Math.abs(b - a), 1), 6) * Math.abs(c || this.settings.smartSpeed)
    }, e.prototype.to = function (c, d) {
        if (this.settings.loop) {
            var e = c - this.relative(this.current()), f = this.current(), g = this.current(), h = this.current() + e,
                i = 0 > g - h ? !0 : !1, j = this._clones.length + this._items.length;
            h < this.settings.items && i === !1 ? (f = g + this._items.length, this.reset(f)) : h >= j - this.settings.items && i === !0 && (f = g - this._items.length, this.reset(f)), b.clearTimeout(this.e._goToLoop), this.e._goToLoop = b.setTimeout(a.proxy(function () {
                this.speed(this.duration(this.current(), f + e, d)), this.current(f + e), this.update()
            }, this), 30)
        } else this.speed(this.duration(this.current(), c, d)), this.current(c), this.update()
    }, e.prototype.next = function (a) {
        a = a || !1, this.to(this.relative(this.current()) + 1, a)
    }, e.prototype.prev = function (a) {
        a = a || !1, this.to(this.relative(this.current()) - 1, a)
    }, e.prototype.transitionEnd = function (a) {
        return a !== d && (a.stopPropagation(), (a.target || a.srcElement || a.originalTarget) !== this.$stage.get(0)) ? !1 : (this.state.inMotion = !1, void this.trigger("translated"))
    }, e.prototype.viewport = function () {
        var d;
        if (this.options.responsiveBaseElement !== b) d = a(this.options.responsiveBaseElement).width(); else if (b.innerWidth) d = b.innerWidth; else {
            if (!c.documentElement || !c.documentElement.clientWidth) throw "Can not detect viewport width.";
            d = c.documentElement.clientWidth
        }
        return d
    }, e.prototype.replace = function (b) {
        this.$stage.empty(), this._items = [], b && (b = b instanceof jQuery ? b : a(b)), this.settings.nestedItemSelector && (b = b.find("." + this.settings.nestedItemSelector)), b.filter(function () {
            return 1 === this.nodeType
        }).each(a.proxy(function (a, b) {
            b = this.prepare(b), this.$stage.append(b), this._items.push(b), this._mergers.push(1 * b.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)
        }, this)), this.reset(a.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0), this.invalidate("items")
    }, e.prototype.add = function (a, b) {
        b = b === d ? this._items.length : this.normalize(b, !0), this.trigger("add", {
            content: a,
            position: b
        }), 0 === this._items.length || b === this._items.length ? (this.$stage.append(a), this._items.push(a), this._mergers.push(1 * a.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)) : (this._items[b].before(a), this._items.splice(b, 0, a), this._mergers.splice(b, 0, 1 * a.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)), this.invalidate("items"), this.trigger("added", {
            content: a,
            position: b
        })
    }, e.prototype.remove = function (a) {
        a = this.normalize(a, !0), a !== d && (this.trigger("remove", {
            content: this._items[a],
            position: a
        }), this._items[a].remove(), this._items.splice(a, 1), this._mergers.splice(a, 1), this.invalidate("items"), this.trigger("removed", {
            content: null,
            position: a
        }))
    }, e.prototype.addTriggerableEvents = function () {
        var b = a.proxy(function (b, c) {
            return a.proxy(function (a) {
                a.relatedTarget !== this && (this.suppress([c]), b.apply(this, [].slice.call(arguments, 1)), this.release([c]))
            }, this)
        }, this);
        a.each({
            next: this.next,
            prev: this.prev,
            to: this.to,
            destroy: this.destroy,
            refresh: this.refresh,
            replace: this.replace,
            add: this.add,
            remove: this.remove
        }, a.proxy(function (a, c) {
            this.$element.on(a + ".owl.carousel", b(c, a + ".owl.carousel"))
        }, this))
    }, e.prototype.watchVisibility = function () {
        function c(a) {
            return a.offsetWidth > 0 && a.offsetHeight > 0
        }

        function d() {
            c(this.$element.get(0)) && (this.$element.removeClass("owl-hidden"), this.refresh(), b.clearInterval(this.e._checkVisibile))
        }

        c(this.$element.get(0)) || (this.$element.addClass("owl-hidden"), b.clearInterval(this.e._checkVisibile), this.e._checkVisibile = b.setInterval(a.proxy(d, this), 500))
    }, e.prototype.preloadAutoWidthImages = function (b) {
        var c, d, e, f;
        c = 0, d = this, b.each(function (g, h) {
            e = a(h), f = new Image, f.onload = function () {
                c++, e.attr("src", f.src), e.css("opacity", 1), c >= b.length && (d.state.imagesLoaded = !0, d.initialize())
            }, f.src = e.attr("src") || e.attr("data-src") || e.attr("data-src-retina")
        })
    }, e.prototype.destroy = function () {
        this.$element.hasClass(this.settings.themeClass) && this.$element.removeClass(this.settings.themeClass), this.settings.responsive !== !1 && a(b).off("resize.owl.carousel"), this.transitionEndVendor && this.off(this.$stage.get(0), this.transitionEndVendor, this.e._transitionEnd);
        for (var d in this._plugins) this._plugins[d].destroy();
        (this.settings.mouseDrag || this.settings.touchDrag) && (this.$stage.off("mousedown touchstart touchcancel"), a(c).off(".owl.dragEvents"), this.$stage.get(0).onselectstart = function () {
        }, this.$stage.off("dragstart", function () {
            return !1
        })), this.$element.off(".owl"), this.$stage.children(".cloned").remove(), this.e = null, this.$element.removeData("owlCarousel"), this.$stage.children().contents().unwrap(), this.$stage.children().unwrap(), this.$stage.unwrap()
    }, e.prototype.op = function (a, b, c) {
        var d = this.settings.rtl;
        switch (b) {
            case"<":
                return d ? a > c : c > a;
            case">":
                return d ? c > a : a > c;
            case">=":
                return d ? c >= a : a >= c;
            case"<=":
                return d ? a >= c : c >= a
        }
    }, e.prototype.on = function (a, b, c, d) {
        a.addEventListener ? a.addEventListener(b, c, d) : a.attachEvent && a.attachEvent("on" + b, c)
    }, e.prototype.off = function (a, b, c, d) {
        a.removeEventListener ? a.removeEventListener(b, c, d) : a.detachEvent && a.detachEvent("on" + b, c)
    }, e.prototype.trigger = function (b, c, d) {
        var e = {item: {count: this._items.length, index: this.current()}},
            f = a.camelCase(a.grep(["on", b, d], function (a) {
                return a
            }).join("-").toLowerCase()),
            g = a.Event([b, "owl", d || "carousel"].join(".").toLowerCase(), a.extend({relatedTarget: this}, e, c));
        return this._supress[b] || (a.each(this._plugins, function (a, b) {
            b.onTrigger && b.onTrigger(g)
        }), this.$element.trigger(g), this.settings && "function" == typeof this.settings[f] && this.settings[f].apply(this, g)), g
    }, e.prototype.suppress = function (b) {
        a.each(b, a.proxy(function (a, b) {
            this._supress[b] = !0
        }, this))
    }, e.prototype.release = function (b) {
        a.each(b, a.proxy(function (a, b) {
            delete this._supress[b]
        }, this))
    }, e.prototype.browserSupport = function () {
        if (this.support3d = j(), this.support3d) {
            this.transformVendor = i();
            var a = ["transitionend", "webkitTransitionEnd", "transitionend", "oTransitionEnd"];
            this.transitionEndVendor = a[h()], this.vendorName = this.transformVendor.replace(/Transform/i, ""), this.vendorName = "" !== this.vendorName ? "-" + this.vendorName.toLowerCase() + "-" : ""
        }
        this.state.orientation = b.orientation
    }, a.fn.owlCarousel = function (b) {
        return this.each(function () {
            a(this).data("owlCarousel") || a(this).data("owlCarousel", new e(this, b))
        })
    }, a.fn.owlCarousel.Constructor = e
}(window.Zepto || window.jQuery, window, document), function (a, b) {
    var c = function (b) {
        this._core = b, this._loaded = [], this._handlers = {
            "initialized.owl.carousel change.owl.carousel": a.proxy(function (b) {
                if (b.namespace && this._core.settings && this._core.settings.lazyLoad && (b.property && "position" == b.property.name || "initialized" == b.type)) for (var c = this._core.settings, d = c.center && Math.ceil(c.items / 2) || c.items, e = c.center && -1 * d || 0, f = (b.property && b.property.value || this._core.current()) + e, g = this._core.clones().length, h = a.proxy(function (a, b) {
                    this.load(b)
                }, this); e++ < d;) this.load(g / 2 + this._core.relative(f)), g && a.each(this._core.clones(this._core.relative(f++)), h)
            }, this)
        }, this._core.options = a.extend({}, c.Defaults, this._core.options), this._core.$element.on(this._handlers)
    };
    c.Defaults = {lazyLoad: !1}, c.prototype.load = function (c) {
        var d = this._core.$stage.children().eq(c), e = d && d.find(".owl-lazy");
        !e || a.inArray(d.get(0), this._loaded) > -1 || (e.each(a.proxy(function (c, d) {
            var e, f = a(d), g = b.devicePixelRatio > 1 && f.attr("data-src-retina") || f.attr("data-src");
            this._core.trigger("load", {
                element: f,
                url: g
            }, "lazy"), f.is("img") ? f.one("load.owl.lazy", a.proxy(function () {
                f.css("opacity", 1), this._core.trigger("loaded", {element: f, url: g}, "lazy")
            }, this)).attr("src", g) : (e = new Image, e.onload = a.proxy(function () {
                f.css({"background-image": "url(" + g + ")", opacity: "1"}), this._core.trigger("loaded", {
                    element: f,
                    url: g
                }, "lazy")
            }, this), e.src = g)
        }, this)), this._loaded.push(d.get(0)))
    }, c.prototype.destroy = function () {
        var a, b;
        for (a in this.handlers) this._core.$element.off(a, this.handlers[a]);
        for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.Lazy = c
}(window.Zepto || window.jQuery, window, document), function (a) {
    var b = function (c) {
        this._core = c, this._handlers = {
            "initialized.owl.carousel": a.proxy(function () {
                this._core.settings.autoHeight && this.update()
            }, this), "changed.owl.carousel": a.proxy(function (a) {
                this._core.settings.autoHeight && "position" == a.property.name && this.update()
            }, this), "loaded.owl.lazy": a.proxy(function (a) {
                this._core.settings.autoHeight && a.element.closest("." + this._core.settings.itemClass) === this._core.$stage.children().eq(this._core.current()) && this.update()
            }, this)
        }, this._core.options = a.extend({}, b.Defaults, this._core.options), this._core.$element.on(this._handlers)
    };
    b.Defaults = {autoHeight: !1, autoHeightClass: "owl-height"}, b.prototype.update = function () {
        this._core.$stage.parent().height(this._core.$stage.children().eq(this._core.current()).height()).addClass(this._core.settings.autoHeightClass)
    }, b.prototype.destroy = function () {
        var a, b;
        for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
        for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.AutoHeight = b
}(window.Zepto || window.jQuery, window, document), function (a, b, c) {
    var d = function (b) {
        this._core = b, this._videos = {}, this._playing = null, this._fullscreen = !1, this._handlers = {
            "resize.owl.carousel": a.proxy(function (a) {
                this._core.settings.video && !this.isInFullScreen() && a.preventDefault()
            }, this), "refresh.owl.carousel changed.owl.carousel": a.proxy(function () {
                this._playing && this.stop()
            }, this), "prepared.owl.carousel": a.proxy(function (b) {
                var c = a(b.content).find(".owl-video");
                c.length && (c.css("display", "none"), this.fetch(c, a(b.content)))
            }, this)
        }, this._core.options = a.extend({}, d.Defaults, this._core.options), this._core.$element.on(this._handlers), this._core.$element.on("click.owl.video", ".owl-video-play-icon", a.proxy(function (a) {
            this.play(a)
        }, this))
    };
    d.Defaults = {video: !1, videoHeight: !1, videoWidth: !1}, d.prototype.fetch = function (a, b) {
        var c = a.attr("data-vimeo-id") ? "vimeo" : "youtube", d = a.attr("data-vimeo-id") || a.attr("data-youtube-id"),
            e = a.attr("data-width") || this._core.settings.videoWidth,
            f = a.attr("data-height") || this._core.settings.videoHeight, g = a.attr("href");
        if (!g) throw new Error("Missing video URL.");
        if (d = g.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/), d[3].indexOf("youtu") > -1) c = "youtube"; else {
            if (!(d[3].indexOf("vimeo") > -1)) throw new Error("Video URL not supported.");
            c = "vimeo"
        }
        d = d[6], this._videos[g] = {
            type: c,
            id: d,
            width: e,
            height: f
        }, b.attr("data-video", g), this.thumbnail(a, this._videos[g])
    }, d.prototype.thumbnail = function (b, c) {
        var d, e, f, g = c.width && c.height ? 'style="width:' + c.width + "px;height:" + c.height + 'px;"' : "",
            h = b.find("img"), i = "src", j = "", k = this._core.settings, l = function (a) {
                e = '<div class="owl-video-play-icon"></div>', d = k.lazyLoad ? '<div class="owl-video-tn ' + j + '" ' + i + '="' + a + '"></div>' : '<div class="owl-video-tn" style="opacity:1;background-image:url(' + a + ')"></div>', b.after(d), b.after(e)
            };
        return b.wrap('<div class="owl-video-wrapper"' + g + "></div>"), this._core.settings.lazyLoad && (i = "data-src", j = "owl-lazy"), h.length ? (l(h.attr(i)), h.remove(), !1) : void ("youtube" === c.type ? (f = "http://img.youtube.com/vi/" + c.id + "/hqdefault.jpg", l(f)) : "vimeo" === c.type && a.ajax({
            type: "GET",
            url: "http://vimeo.com/api/v2/video/" + c.id + ".json",
            jsonp: "callback",
            dataType: "jsonp",
            success: function (a) {
                f = a[0].thumbnail_large, l(f)
            }
        }))
    }, d.prototype.stop = function () {
        this._core.trigger("stop", null, "video"), this._playing.find(".owl-video-frame").remove(), this._playing.removeClass("owl-video-playing"), this._playing = null
    }, d.prototype.play = function (b) {
        this._core.trigger("play", null, "video"), this._playing && this.stop();
        var c, d, e = a(b.target || b.srcElement), f = e.closest("." + this._core.settings.itemClass),
            g = this._videos[f.attr("data-video")], h = g.width || "100%", i = g.height || this._core.$stage.height();
        "youtube" === g.type ? c = '<iframe width="' + h + '" height="' + i + '" src="http://www.youtube.com/embed/' + g.id + "?autoplay=1&v=" + g.id + '" frameborder="0" allowfullscreen></iframe>' : "vimeo" === g.type && (c = '<iframe src="http://player.vimeo.com/video/' + g.id + '?autoplay=1" width="' + h + '" height="' + i + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'), f.addClass("owl-video-playing"), this._playing = f, d = a('<div style="height:' + i + "px; width:" + h + 'px" class="owl-video-frame">' + c + "</div>"), e.after(d)
    }, d.prototype.isInFullScreen = function () {
        var d = c.fullscreenElement || c.mozFullScreenElement || c.webkitFullscreenElement;
        return d && a(d).parent().hasClass("owl-video-frame") && (this._core.speed(0), this._fullscreen = !0), d && this._fullscreen && this._playing ? !1 : this._fullscreen ? (this._fullscreen = !1, !1) : this._playing && this._core.state.orientation !== b.orientation ? (this._core.state.orientation = b.orientation, !1) : !0
    }, d.prototype.destroy = function () {
        var a, b;
        this._core.$element.off("click.owl.video");
        for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
        for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.Video = d
}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
    var e = function (b) {
        this.core = b, this.core.options = a.extend({}, e.Defaults, this.core.options), this.swapping = !0, this.previous = d, this.next = d, this.handlers = {
            "change.owl.carousel": a.proxy(function (a) {
                "position" == a.property.name && (this.previous = this.core.current(), this.next = a.property.value)
            }, this), "drag.owl.carousel dragged.owl.carousel translated.owl.carousel": a.proxy(function (a) {
                this.swapping = "translated" == a.type
            }, this), "translate.owl.carousel": a.proxy(function () {
                this.swapping && (this.core.options.animateOut || this.core.options.animateIn) && this.swap()
            }, this)
        }, this.core.$element.on(this.handlers)
    };
    e.Defaults = {animateOut: !1, animateIn: !1}, e.prototype.swap = function () {
        if (1 === this.core.settings.items && this.core.support3d) {
            this.core.speed(0);
            var b, c = a.proxy(this.clear, this), d = this.core.$stage.children().eq(this.previous),
                e = this.core.$stage.children().eq(this.next), f = this.core.settings.animateIn,
                g = this.core.settings.animateOut;
            this.core.current() !== this.previous && (g && (b = this.core.coordinates(this.previous) - this.core.coordinates(this.next), d.css({left: b + "px"}).addClass("animated owl-animated-out").addClass(g).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", c)), f && e.addClass("animated owl-animated-in").addClass(f).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", c))
        }
    }, e.prototype.clear = function (b) {
        a(b.target).css({left: ""}).removeClass("animated owl-animated-out owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut), this.core.transitionEnd()
    }, e.prototype.destroy = function () {
        var a, b;
        for (a in this.handlers) this.core.$element.off(a, this.handlers[a]);
        for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.Animate = e
}(window.Zepto || window.jQuery, window, document), function (a, b, c) {
    var d = function (b) {
        this.core = b, this.core.options = a.extend({}, d.Defaults, this.core.options), this.handlers = {
            "translated.owl.carousel refreshed.owl.carousel": a.proxy(function () {
                this.autoplay()
            }, this), "play.owl.autoplay": a.proxy(function (a, b, c) {
                this.play(b, c)
            }, this), "stop.owl.autoplay": a.proxy(function () {
                this.stop()
            }, this), "mouseover.owl.autoplay": a.proxy(function () {
                this.core.settings.autoplayHoverPause && this.pause()
            }, this), "mouseleave.owl.autoplay": a.proxy(function () {
                this.core.settings.autoplayHoverPause && this.autoplay()
            }, this)
        }, this.core.$element.on(this.handlers)
    };
    d.Defaults = {
        autoplay: !1,
        autoplayTimeout: 5e3,
        autoplayHoverPause: !1,
        autoplaySpeed: !1
    }, d.prototype.autoplay = function () {
        this.core.settings.autoplay && !this.core.state.videoPlay ? (b.clearInterval(this.interval), this.interval = b.setInterval(a.proxy(function () {
            this.play()
        }, this), this.core.settings.autoplayTimeout)) : b.clearInterval(this.interval)
    }, d.prototype.play = function () {
        return c.hidden === !0 || this.core.state.isTouch || this.core.state.isScrolling || this.core.state.isSwiping || this.core.state.inMotion ? void 0 : this.core.settings.autoplay === !1 ? void b.clearInterval(this.interval) : void this.core.next(this.core.settings.autoplaySpeed)
    }, d.prototype.stop = function () {
        b.clearInterval(this.interval)
    }, d.prototype.pause = function () {
        b.clearInterval(this.interval)
    }, d.prototype.destroy = function () {
        var a, c;
        b.clearInterval(this.interval);
        for (a in this.handlers) this.core.$element.off(a, this.handlers[a]);
        for (c in Object.getOwnPropertyNames(this)) "function" != typeof this[c] && (this[c] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.autoplay = d
}(window.Zepto || window.jQuery, window, document), function (a) {
    "use strict";
    var b = function (c) {
        this._core = c, this._initialized = !1, this._pages = [], this._controls = {}, this._templates = [], this.$element = this._core.$element, this._overrides = {
            next: this._core.next,
            prev: this._core.prev,
            to: this._core.to
        }, this._handlers = {
            "prepared.owl.carousel": a.proxy(function (b) {
                this._core.settings.dotsData && this._templates.push(a(b.content).find("[data-dot]").andSelf("[data-dot]").attr("data-dot"))
            }, this), "add.owl.carousel": a.proxy(function (b) {
                this._core.settings.dotsData && this._templates.splice(b.position, 0, a(b.content).find("[data-dot]").andSelf("[data-dot]").attr("data-dot"))
            }, this), "remove.owl.carousel prepared.owl.carousel": a.proxy(function (a) {
                this._core.settings.dotsData && this._templates.splice(a.position, 1)
            }, this), "change.owl.carousel": a.proxy(function (a) {
                if ("position" == a.property.name && !this._core.state.revert && !this._core.settings.loop && this._core.settings.navRewind) {
                    var b = this._core.current(), c = this._core.maximum(), d = this._core.minimum();
                    a.data = a.property.value > c ? b >= c ? d : c : a.property.value < d ? c : a.property.value
                }
            }, this), "changed.owl.carousel": a.proxy(function (a) {
                "position" == a.property.name && this.draw()
            }, this), "refreshed.owl.carousel": a.proxy(function () {
                this._initialized || (this.initialize(), this._initialized = !0), this._core.trigger("refresh", null, "navigation"), this.update(), this.draw(), this._core.trigger("refreshed", null, "navigation")
            }, this)
        }, this._core.options = a.extend({}, b.Defaults, this._core.options), this.$element.on(this._handlers)
    };
    b.Defaults = {
        nav: !1,
        navRewind: !0,
        navText: ["prev", "next"],
        navSpeed: !1,
        navElement: "div",
        navContainer: !1,
        navContainerClass: "owl-nav",
        navClass: ["owl-prev", "owl-next"],
        slideBy: 1,
        dotClass: "owl-dot",
        dotsClass: "owl-dots",
        dots: !0,
        dotsEach: !1,
        dotData: !1,
        dotsSpeed: !1,
        dotsContainer: !1,
        controlsClass: "owl-controls"
    }, b.prototype.initialize = function () {
        var b, c, d = this._core.settings;
        d.dotsData || (this._templates = [a("<div>").addClass(d.dotClass).append(a("<span>")).prop("outerHTML")]), d.navContainer && d.dotsContainer || (this._controls.$container = a("<div>").addClass(d.controlsClass).appendTo(this.$element)), this._controls.$indicators = d.dotsContainer ? a(d.dotsContainer) : a("<div>").hide().addClass(d.dotsClass).appendTo(this._controls.$container), this._controls.$indicators.on("click", "div", a.proxy(function (b) {
            var c = a(b.target).parent().is(this._controls.$indicators) ? a(b.target).index() : a(b.target).parent().index();
            b.preventDefault(), this.to(c, d.dotsSpeed)
        }, this)), b = d.navContainer ? a(d.navContainer) : a("<div>").addClass(d.navContainerClass).prependTo(this._controls.$container), this._controls.$next = a("<" + d.navElement + ">"), this._controls.$previous = this._controls.$next.clone(), this._controls.$previous.addClass(d.navClass[0]).html(d.navText[0]).hide().prependTo(b).on("click", a.proxy(function () {
            this.prev(d.navSpeed)
        }, this)), this._controls.$next.addClass(d.navClass[1]).html(d.navText[1]).hide().appendTo(b).on("click", a.proxy(function () {
            this.next(d.navSpeed)
        }, this));
        for (c in this._overrides) this._core[c] = a.proxy(this[c], this)
    }, b.prototype.destroy = function () {
        var a, b, c, d;
        for (a in this._handlers) this.$element.off(a, this._handlers[a]);
        for (b in this._controls) this._controls[b].remove();
        for (d in this.overides) this._core[d] = this._overrides[d];
        for (c in Object.getOwnPropertyNames(this)) "function" != typeof this[c] && (this[c] = null)
    }, b.prototype.update = function () {
        var a, b, c, d = this._core.settings, e = this._core.clones().length / 2, f = e + this._core.items().length,
            g = d.center || d.autoWidth || d.dotData ? 1 : d.dotsEach || d.items;
        if ("page" !== d.slideBy && (d.slideBy = Math.min(d.slideBy, d.items)), d.dots || "page" == d.slideBy) for (this._pages = [], a = e, b = 0, c = 0; f > a; a++) (b >= g || 0 === b) && (this._pages.push({
            start: a - e,
            end: a - e + g - 1
        }), b = 0, ++c), b += this._core.mergers(this._core.relative(a))
    }, b.prototype.draw = function () {
        var b, c, d = "", e = this._core.settings,
            f = (this._core.$stage.children(), this._core.relative(this._core.current()));
        if (!e.nav || e.loop || e.navRewind || (this._controls.$previous.toggleClass("disabled", 0 >= f), this._controls.$next.toggleClass("disabled", f >= this._core.maximum())), this._controls.$previous.toggle(e.nav), this._controls.$next.toggle(e.nav), e.dots) {
            if (b = this._pages.length - this._controls.$indicators.children().length, e.dotData && 0 !== b) {
                for (c = 0; c < this._controls.$indicators.children().length; c++) d += this._templates[this._core.relative(c)];
                this._controls.$indicators.html(d)
            } else b > 0 ? (d = new Array(b + 1).join(this._templates[0]), this._controls.$indicators.append(d)) : 0 > b && this._controls.$indicators.children().slice(b).remove();
            this._controls.$indicators.find(".active").removeClass("active"), this._controls.$indicators.children().eq(a.inArray(this.current(), this._pages)).addClass("active")
        }
        this._controls.$indicators.toggle(e.dots)
    }, b.prototype.onTrigger = function (b) {
        var c = this._core.settings;
        b.page = {
            index: a.inArray(this.current(), this._pages),
            count: this._pages.length,
            size: c && (c.center || c.autoWidth || c.dotData ? 1 : c.dotsEach || c.items)
        }
    }, b.prototype.current = function () {
        var b = this._core.relative(this._core.current());
        return a.grep(this._pages, function (a) {
            return a.start <= b && a.end >= b
        }).pop()
    }, b.prototype.getPosition = function (b) {
        var c, d, e = this._core.settings;
        return "page" == e.slideBy ? (c = a.inArray(this.current(), this._pages), d = this._pages.length, b ? ++c : --c, c = this._pages[(c % d + d) % d].start) : (c = this._core.relative(this._core.current()), d = this._core.items().length, b ? c += e.slideBy : c -= e.slideBy), c
    }, b.prototype.next = function (b) {
        a.proxy(this._overrides.to, this._core)(this.getPosition(!0), b)
    }, b.prototype.prev = function (b) {
        a.proxy(this._overrides.to, this._core)(this.getPosition(!1), b)
    }, b.prototype.to = function (b, c, d) {
        var e;
        d ? a.proxy(this._overrides.to, this._core)(b, c) : (e = this._pages.length, a.proxy(this._overrides.to, this._core)(this._pages[(b % e + e) % e].start, c))
    }, a.fn.owlCarousel.Constructor.Plugins.Navigation = b
}(window.Zepto || window.jQuery, window, document), function (a, b) {
    "use strict";
    var c = function (d) {
        this._core = d, this._hashes = {}, this.$element = this._core.$element, this._handlers = {
            "initialized.owl.carousel": a.proxy(function () {
                "URLHash" == this._core.settings.startPosition && a(b).trigger("hashchange.owl.navigation")
            }, this), "prepared.owl.carousel": a.proxy(function (b) {
                var c = a(b.content).find("[data-hash]").andSelf("[data-hash]").attr("data-hash");
                this._hashes[c] = b.content
            }, this)
        }, this._core.options = a.extend({}, c.Defaults, this._core.options), this.$element.on(this._handlers), a(b).on("hashchange.owl.navigation", a.proxy(function () {
            var a = b.location.hash.substring(1), c = this._core.$stage.children(),
                d = this._hashes[a] && c.index(this._hashes[a]) || 0;
            return a ? void this._core.to(d, !1, !0) : !1
        }, this))
    };
    c.Defaults = {URLhashListener: !1}, c.prototype.destroy = function () {
        var c, d;
        a(b).off("hashchange.owl.navigation");
        for (c in this._handlers) this._core.$element.off(c, this._handlers[c]);
        for (d in Object.getOwnPropertyNames(this)) "function" != typeof this[d] && (this[d] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.Hash = c
}(window.Zepto || window.jQuery, window, document);

/* SlickSlider */
!function (i) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], i) : "undefined" != typeof exports ? module.exports = i(require("jquery")) : i(jQuery)
}(function (i) {
    "use strict";
    var e = window.Slick || {};
    (e = function () {
        var e = 0;
        return function (t, o) {
            var s, n = this;
            n.defaults = {
                accessibility: !0,
                adaptiveHeight: !1,
                appendArrows: i(t),
                appendDots: i(t),
                arrows: !0,
                asNavFor: null,
                prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
                nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
                autoplay: !1,
                autoplaySpeed: 3e3,
                centerMode: !1,
                centerPadding: "50px",
                cssEase: "ease",
                customPaging: function (e, t) {
                    return i('<button type="button" />').text(t + 1)
                },
                dots: !1,
                dotsClass: "slick-dots",
                draggable: !0,
                easing: "linear",
                edgeFriction: .35,
                fade: !1,
                focusOnSelect: !1,
                focusOnChange: !1,
                infinite: !0,
                initialSlide: 0,
                lazyLoad: "ondemand",
                mobileFirst: !1,
                pauseOnHover: !0,
                pauseOnFocus: !0,
                pauseOnDotsHover: !1,
                respondTo: "window",
                responsive: null,
                rows: 1,
                rtl: !1,
                slide: "",
                slidesPerRow: 1,
                slidesToShow: 1,
                slidesToScroll: 1,
                speed: 500,
                swipe: !0,
                swipeToSlide: !1,
                touchMove: !0,
                touchThreshold: 5,
                useCSS: !0,
                useTransform: !0,
                variableWidth: !1,
                vertical: !1,
                verticalSwiping: !1,
                waitForAnimate: !0,
                zIndex: 1e3
            }, n.initials = {
                animating: !1,
                dragging: !1,
                autoPlayTimer: null,
                currentDirection: 0,
                currentLeft: null,
                currentSlide: 0,
                direction: 1,
                $dots: null,
                listWidth: null,
                listHeight: null,
                loadIndex: 0,
                $nextArrow: null,
                $prevArrow: null,
                scrolling: !1,
                slideCount: null,
                slideWidth: null,
                $slideTrack: null,
                $slides: null,
                sliding: !1,
                slideOffset: 0,
                swipeLeft: null,
                swiping: !1,
                $list: null,
                touchObject: {},
                transformsEnabled: !1,
                unslicked: !1
            }, i.extend(n, n.initials), n.activeBreakpoint = null, n.animType = null, n.animProp = null, n.breakpoints = [], n.breakpointSettings = [], n.cssTransitions = !1, n.focussed = !1, n.interrupted = !1, n.hidden = "hidden", n.paused = !0, n.positionProp = null, n.respondTo = null, n.rowCount = 1, n.shouldClick = !0, n.$slider = i(t), n.$slidesCache = null, n.transformType = null, n.transitionType = null, n.visibilityChange = "visibilitychange", n.windowWidth = 0, n.windowTimer = null, s = i(t).data("slick") || {}, n.options = i.extend({}, n.defaults, o, s), n.currentSlide = n.options.initialSlide, n.originalSettings = n.options, void 0 !== document.mozHidden ? (n.hidden = "mozHidden", n.visibilityChange = "mozvisibilitychange") : void 0 !== document.webkitHidden && (n.hidden = "webkitHidden", n.visibilityChange = "webkitvisibilitychange"), n.autoPlay = i.proxy(n.autoPlay, n), n.autoPlayClear = i.proxy(n.autoPlayClear, n), n.autoPlayIterator = i.proxy(n.autoPlayIterator, n), n.changeSlide = i.proxy(n.changeSlide, n), n.clickHandler = i.proxy(n.clickHandler, n), n.selectHandler = i.proxy(n.selectHandler, n), n.setPosition = i.proxy(n.setPosition, n), n.swipeHandler = i.proxy(n.swipeHandler, n), n.dragHandler = i.proxy(n.dragHandler, n), n.keyHandler = i.proxy(n.keyHandler, n), n.instanceUid = e++, n.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, n.registerBreakpoints(), n.init(!0)
        }
    }()).prototype.activateADA = function () {
        this.$slideTrack.find(".slick-active").attr({"aria-hidden": "false"}).find("a, input, button, select").attr({tabindex: "0"})
    }, e.prototype.addSlide = e.prototype.slickAdd = function (e, t, o) {
        var s = this;
        if ("boolean" == typeof t) o = t, t = null; else if (t < 0 || t >= s.slideCount) return !1;
        s.unload(), "number" == typeof t ? 0 === t && 0 === s.$slides.length ? i(e).appendTo(s.$slideTrack) : o ? i(e).insertBefore(s.$slides.eq(t)) : i(e).insertAfter(s.$slides.eq(t)) : !0 === o ? i(e).prependTo(s.$slideTrack) : i(e).appendTo(s.$slideTrack), s.$slides = s.$slideTrack.children(this.options.slide), s.$slideTrack.children(this.options.slide).detach(), s.$slideTrack.append(s.$slides), s.$slides.each(function (e, t) {
            i(t).attr("data-slick-index", e)
        }), s.$slidesCache = s.$slides, s.reinit()
    }, e.prototype.animateHeight = function () {
        var i = this;
        if (1 === i.options.slidesToShow && !0 === i.options.adaptiveHeight && !1 === i.options.vertical) {
            var e = i.$slides.eq(i.currentSlide).outerHeight(!0);
            i.$list.animate({height: e}, i.options.speed)
        }
    }, e.prototype.animateSlide = function (e, t) {
        var o = {}, s = this;
        s.animateHeight(), !0 === s.options.rtl && !1 === s.options.vertical && (e = -e), !1 === s.transformsEnabled ? !1 === s.options.vertical ? s.$slideTrack.animate({left: e}, s.options.speed, s.options.easing, t) : s.$slideTrack.animate({top: e}, s.options.speed, s.options.easing, t) : !1 === s.cssTransitions ? (!0 === s.options.rtl && (s.currentLeft = -s.currentLeft), i({animStart: s.currentLeft}).animate({animStart: e}, {
            duration: s.options.speed,
            easing: s.options.easing,
            step: function (i) {
                i = Math.ceil(i), !1 === s.options.vertical ? (o[s.animType] = "translate(" + i + "px, 0px)", s.$slideTrack.css(o)) : (o[s.animType] = "translate(0px," + i + "px)", s.$slideTrack.css(o))
            },
            complete: function () {
                t && t.call()
            }
        })) : (s.applyTransition(), e = Math.ceil(e), !1 === s.options.vertical ? o[s.animType] = "translate3d(" + e + "px, 0px, 0px)" : o[s.animType] = "translate3d(0px," + e + "px, 0px)", s.$slideTrack.css(o), t && setTimeout(function () {
            s.disableTransition(), t.call()
        }, s.options.speed))
    }, e.prototype.getNavTarget = function () {
        var e = this, t = e.options.asNavFor;
        return t && null !== t && (t = i(t).not(e.$slider)), t
    }, e.prototype.asNavFor = function (e) {
        var t = this.getNavTarget();
        null !== t && "object" == typeof t && t.each(function () {
            var t = i(this).slick("getSlick");
            t.unslicked || t.slideHandler(e, !0)
        })
    }, e.prototype.applyTransition = function (i) {
        var e = this, t = {};
        !1 === e.options.fade ? t[e.transitionType] = e.transformType + " " + e.options.speed + "ms " + e.options.cssEase : t[e.transitionType] = "opacity " + e.options.speed + "ms " + e.options.cssEase, !1 === e.options.fade ? e.$slideTrack.css(t) : e.$slides.eq(i).css(t)
    }, e.prototype.autoPlay = function () {
        var i = this;
        i.autoPlayClear(), i.slideCount > i.options.slidesToShow && (i.autoPlayTimer = setInterval(i.autoPlayIterator, i.options.autoplaySpeed))
    }, e.prototype.autoPlayClear = function () {
        var i = this;
        i.autoPlayTimer && clearInterval(i.autoPlayTimer)
    }, e.prototype.autoPlayIterator = function () {
        var i = this, e = i.currentSlide + i.options.slidesToScroll;
        i.paused || i.interrupted || i.focussed || (!1 === i.options.infinite && (1 === i.direction && i.currentSlide + 1 === i.slideCount - 1 ? i.direction = 0 : 0 === i.direction && (e = i.currentSlide - i.options.slidesToScroll, i.currentSlide - 1 == 0 && (i.direction = 1))), i.slideHandler(e))
    }, e.prototype.buildArrows = function () {
        var e = this;
        !0 === e.options.arrows && (e.$prevArrow = i(e.options.prevArrow).addClass("slick-arrow"), e.$nextArrow = i(e.options.nextArrow).addClass("slick-arrow"), e.slideCount > e.options.slidesToShow ? (e.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.prependTo(e.options.appendArrows), e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.appendTo(e.options.appendArrows), !0 !== e.options.infinite && e.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true")) : e.$prevArrow.add(e.$nextArrow).addClass("slick-hidden").attr({
            "aria-disabled": "true",
            tabindex: "-1"
        }))
    }, e.prototype.buildDots = function () {
        var e, t, o = this;
        if (!0 === o.options.dots) {
            for (o.$slider.addClass("slick-dotted"), t = i("<ul />").addClass(o.options.dotsClass), e = 0; e <= o.getDotCount(); e += 1) t.append(i("<li />").append(o.options.customPaging.call(this, o, e)));
            o.$dots = t.appendTo(o.options.appendDots), o.$dots.find("li").first().addClass("slick-active")
        }
    }, e.prototype.buildOut = function () {
        var e = this;
        e.$slides = e.$slider.children(e.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), e.slideCount = e.$slides.length, e.$slides.each(function (e, t) {
            i(t).attr("data-slick-index", e).data("originalStyling", i(t).attr("style") || "")
        }), e.$slider.addClass("slick-slider"), e.$slideTrack = 0 === e.slideCount ? i('<div class="slick-track"/>').appendTo(e.$slider) : e.$slides.wrapAll('<div class="slick-track"/>').parent(), e.$list = e.$slideTrack.wrap('<div class="slick-list"/>').parent(), e.$slideTrack.css("opacity", 0), !0 !== e.options.centerMode && !0 !== e.options.swipeToSlide || (e.options.slidesToScroll = 1), i("img[data-lazy]", e.$slider).not("[src]").addClass("slick-loading"), e.setupInfinite(), e.buildArrows(), e.buildDots(), e.updateDots(), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), !0 === e.options.draggable && e.$list.addClass("draggable")
    }, e.prototype.buildRows = function () {
        var i, e, t, o, s, n, r, l = this;
        if (o = document.createDocumentFragment(), n = l.$slider.children(), l.options.rows > 1) {
            for (r = l.options.slidesPerRow * l.options.rows, s = Math.ceil(n.length / r), i = 0; i < s; i++) {
                var d = document.createElement("div");
                for (e = 0; e < l.options.rows; e++) {
                    var a = document.createElement("div");
                    for (t = 0; t < l.options.slidesPerRow; t++) {
                        var c = i * r + (e * l.options.slidesPerRow + t);
                        n.get(c) && a.appendChild(n.get(c))
                    }
                    d.appendChild(a)
                }
                o.appendChild(d)
            }
            l.$slider.empty().append(o), l.$slider.children().children().children().css({
                width: 100 / l.options.slidesPerRow + "%",
                display: "inline-block"
            })
        }
    }, e.prototype.checkResponsive = function (e, t) {
        var o, s, n, r = this, l = !1, d = r.$slider.width(), a = window.innerWidth || i(window).width();
        if ("window" === r.respondTo ? n = a : "slider" === r.respondTo ? n = d : "min" === r.respondTo && (n = Math.min(a, d)), r.options.responsive && r.options.responsive.length && null !== r.options.responsive) {
            s = null;
            for (o in r.breakpoints) r.breakpoints.hasOwnProperty(o) && (!1 === r.originalSettings.mobileFirst ? n < r.breakpoints[o] && (s = r.breakpoints[o]) : n > r.breakpoints[o] && (s = r.breakpoints[o]));
            null !== s ? null !== r.activeBreakpoint ? (s !== r.activeBreakpoint || t) && (r.activeBreakpoint = s, "unslick" === r.breakpointSettings[s] ? r.unslick(s) : (r.options = i.extend({}, r.originalSettings, r.breakpointSettings[s]), !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e)), l = s) : (r.activeBreakpoint = s, "unslick" === r.breakpointSettings[s] ? r.unslick(s) : (r.options = i.extend({}, r.originalSettings, r.breakpointSettings[s]), !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e)), l = s) : null !== r.activeBreakpoint && (r.activeBreakpoint = null, r.options = r.originalSettings, !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e), l = s), e || !1 === l || r.$slider.trigger("breakpoint", [r, l])
        }
    }, e.prototype.changeSlide = function (e, t) {
        var o, s, n, r = this, l = i(e.currentTarget);
        switch (l.is("a") && e.preventDefault(), l.is("li") || (l = l.closest("li")), n = r.slideCount % r.options.slidesToScroll != 0, o = n ? 0 : (r.slideCount - r.currentSlide) % r.options.slidesToScroll, e.data.message) {
            case"previous":
                s = 0 === o ? r.options.slidesToScroll : r.options.slidesToShow - o, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide - s, !1, t);
                break;
            case"next":
                s = 0 === o ? r.options.slidesToScroll : o, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide + s, !1, t);
                break;
            case"index":
                var d = 0 === e.data.index ? 0 : e.data.index || l.index() * r.options.slidesToScroll;
                r.slideHandler(r.checkNavigable(d), !1, t), l.children().trigger("focus");
                break;
            default:
                return
        }
    }, e.prototype.checkNavigable = function (i) {
        var e, t;
        if (e = this.getNavigableIndexes(), t = 0, i > e[e.length - 1]) i = e[e.length - 1]; else for (var o in e) {
            if (i < e[o]) {
                i = t;
                break
            }
            t = e[o]
        }
        return i
    }, e.prototype.cleanUpEvents = function () {
        var e = this;
        e.options.dots && null !== e.$dots && (i("li", e.$dots).off("click.slick", e.changeSlide).off("mouseenter.slick", i.proxy(e.interrupt, e, !0)).off("mouseleave.slick", i.proxy(e.interrupt, e, !1)), !0 === e.options.accessibility && e.$dots.off("keydown.slick", e.keyHandler)), e.$slider.off("focus.slick blur.slick"), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow && e.$prevArrow.off("click.slick", e.changeSlide), e.$nextArrow && e.$nextArrow.off("click.slick", e.changeSlide), !0 === e.options.accessibility && (e.$prevArrow && e.$prevArrow.off("keydown.slick", e.keyHandler), e.$nextArrow && e.$nextArrow.off("keydown.slick", e.keyHandler))), e.$list.off("touchstart.slick mousedown.slick", e.swipeHandler), e.$list.off("touchmove.slick mousemove.slick", e.swipeHandler), e.$list.off("touchend.slick mouseup.slick", e.swipeHandler), e.$list.off("touchcancel.slick mouseleave.slick", e.swipeHandler), e.$list.off("click.slick", e.clickHandler), i(document).off(e.visibilityChange, e.visibility), e.cleanUpSlideEvents(), !0 === e.options.accessibility && e.$list.off("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().off("click.slick", e.selectHandler), i(window).off("orientationchange.slick.slick-" + e.instanceUid, e.orientationChange), i(window).off("resize.slick.slick-" + e.instanceUid, e.resize), i("[draggable!=true]", e.$slideTrack).off("dragstart", e.preventDefault), i(window).off("load.slick.slick-" + e.instanceUid, e.setPosition)
    }, e.prototype.cleanUpSlideEvents = function () {
        var e = this;
        e.$list.off("mouseenter.slick", i.proxy(e.interrupt, e, !0)), e.$list.off("mouseleave.slick", i.proxy(e.interrupt, e, !1))
    }, e.prototype.cleanUpRows = function () {
        var i, e = this;
        e.options.rows > 1 && ((i = e.$slides.children().children()).removeAttr("style"), e.$slider.empty().append(i))
    }, e.prototype.clickHandler = function (i) {
        !1 === this.shouldClick && (i.stopImmediatePropagation(), i.stopPropagation(), i.preventDefault())
    }, e.prototype.destroy = function (e) {
        var t = this;
        t.autoPlayClear(), t.touchObject = {}, t.cleanUpEvents(), i(".slick-cloned", t.$slider).detach(), t.$dots && t.$dots.remove(), t.$prevArrow && t.$prevArrow.length && (t.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.remove()), t.$nextArrow && t.$nextArrow.length && (t.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.remove()), t.$slides && (t.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function () {
            i(this).attr("style", i(this).data("originalStyling"))
        }), t.$slideTrack.children(this.options.slide).detach(), t.$slideTrack.detach(), t.$list.detach(), t.$slider.append(t.$slides)), t.cleanUpRows(), t.$slider.removeClass("slick-slider"), t.$slider.removeClass("slick-initialized"), t.$slider.removeClass("slick-dotted"), t.unslicked = !0, e || t.$slider.trigger("destroy", [t])
    }, e.prototype.disableTransition = function (i) {
        var e = this, t = {};
        t[e.transitionType] = "", !1 === e.options.fade ? e.$slideTrack.css(t) : e.$slides.eq(i).css(t)
    }, e.prototype.fadeSlide = function (i, e) {
        var t = this;
        !1 === t.cssTransitions ? (t.$slides.eq(i).css({zIndex: t.options.zIndex}), t.$slides.eq(i).animate({opacity: 1}, t.options.speed, t.options.easing, e)) : (t.applyTransition(i), t.$slides.eq(i).css({
            opacity: 1,
            zIndex: t.options.zIndex
        }), e && setTimeout(function () {
            t.disableTransition(i), e.call()
        }, t.options.speed))
    }, e.prototype.fadeSlideOut = function (i) {
        var e = this;
        !1 === e.cssTransitions ? e.$slides.eq(i).animate({
            opacity: 0,
            zIndex: e.options.zIndex - 2
        }, e.options.speed, e.options.easing) : (e.applyTransition(i), e.$slides.eq(i).css({
            opacity: 0,
            zIndex: e.options.zIndex - 2
        }))
    }, e.prototype.filterSlides = e.prototype.slickFilter = function (i) {
        var e = this;
        null !== i && (e.$slidesCache = e.$slides, e.unload(), e.$slideTrack.children(this.options.slide).detach(), e.$slidesCache.filter(i).appendTo(e.$slideTrack), e.reinit())
    }, e.prototype.focusHandler = function () {
        var e = this;
        e.$slider.off("focus.slick blur.slick").on("focus.slick blur.slick", "*", function (t) {
            t.stopImmediatePropagation();
            var o = i(this);
            setTimeout(function () {
                e.options.pauseOnFocus && (e.focussed = o.is(":focus"), e.autoPlay())
            }, 0)
        })
    }, e.prototype.getCurrent = e.prototype.slickCurrentSlide = function () {
        return this.currentSlide
    }, e.prototype.getDotCount = function () {
        var i = this, e = 0, t = 0, o = 0;
        if (!0 === i.options.infinite) if (i.slideCount <= i.options.slidesToShow) ++o; else for (; e < i.slideCount;) ++o, e = t + i.options.slidesToScroll, t += i.options.slidesToScroll <= i.options.slidesToShow ? i.options.slidesToScroll : i.options.slidesToShow; else if (!0 === i.options.centerMode) o = i.slideCount; else if (i.options.asNavFor) for (; e < i.slideCount;) ++o, e = t + i.options.slidesToScroll, t += i.options.slidesToScroll <= i.options.slidesToShow ? i.options.slidesToScroll : i.options.slidesToShow; else o = 1 + Math.ceil((i.slideCount - i.options.slidesToShow) / i.options.slidesToScroll);
        return o - 1
    }, e.prototype.getLeft = function (i) {
        var e, t, o, s, n = this, r = 0;
        return n.slideOffset = 0, t = n.$slides.first().outerHeight(!0), !0 === n.options.infinite ? (n.slideCount > n.options.slidesToShow && (n.slideOffset = n.slideWidth * n.options.slidesToShow * -1, s = -1, !0 === n.options.vertical && !0 === n.options.centerMode && (2 === n.options.slidesToShow ? s = -1.5 : 1 === n.options.slidesToShow && (s = -2)), r = t * n.options.slidesToShow * s), n.slideCount % n.options.slidesToScroll != 0 && i + n.options.slidesToScroll > n.slideCount && n.slideCount > n.options.slidesToShow && (i > n.slideCount ? (n.slideOffset = (n.options.slidesToShow - (i - n.slideCount)) * n.slideWidth * -1, r = (n.options.slidesToShow - (i - n.slideCount)) * t * -1) : (n.slideOffset = n.slideCount % n.options.slidesToScroll * n.slideWidth * -1, r = n.slideCount % n.options.slidesToScroll * t * -1))) : i + n.options.slidesToShow > n.slideCount && (n.slideOffset = (i + n.options.slidesToShow - n.slideCount) * n.slideWidth, r = (i + n.options.slidesToShow - n.slideCount) * t), n.slideCount <= n.options.slidesToShow && (n.slideOffset = 0, r = 0), !0 === n.options.centerMode && n.slideCount <= n.options.slidesToShow ? n.slideOffset = n.slideWidth * Math.floor(n.options.slidesToShow) / 2 - n.slideWidth * n.slideCount / 2 : !0 === n.options.centerMode && !0 === n.options.infinite ? n.slideOffset += n.slideWidth * Math.floor(n.options.slidesToShow / 2) - n.slideWidth : !0 === n.options.centerMode && (n.slideOffset = 0, n.slideOffset += n.slideWidth * Math.floor(n.options.slidesToShow / 2)), e = !1 === n.options.vertical ? i * n.slideWidth * -1 + n.slideOffset : i * t * -1 + r, !0 === n.options.variableWidth && (o = n.slideCount <= n.options.slidesToShow || !1 === n.options.infinite ? n.$slideTrack.children(".slick-slide").eq(i) : n.$slideTrack.children(".slick-slide").eq(i + n.options.slidesToShow), e = !0 === n.options.rtl ? o[0] ? -1 * (n.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0 : o[0] ? -1 * o[0].offsetLeft : 0, !0 === n.options.centerMode && (o = n.slideCount <= n.options.slidesToShow || !1 === n.options.infinite ? n.$slideTrack.children(".slick-slide").eq(i) : n.$slideTrack.children(".slick-slide").eq(i + n.options.slidesToShow + 1), e = !0 === n.options.rtl ? o[0] ? -1 * (n.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0 : o[0] ? -1 * o[0].offsetLeft : 0, e += (n.$list.width() - o.outerWidth()) / 2)), e
    }, e.prototype.getOption = e.prototype.slickGetOption = function (i) {
        return this.options[i]
    }, e.prototype.getNavigableIndexes = function () {
        var i, e = this, t = 0, o = 0, s = [];
        for (!1 === e.options.infinite ? i = e.slideCount : (t = -1 * e.options.slidesToScroll, o = -1 * e.options.slidesToScroll, i = 2 * e.slideCount); t < i;) s.push(t), t = o + e.options.slidesToScroll, o += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
        return s
    }, e.prototype.getSlick = function () {
        return this
    }, e.prototype.getSlideCount = function () {
        var e, t, o = this;
        return t = !0 === o.options.centerMode ? o.slideWidth * Math.floor(o.options.slidesToShow / 2) : 0, !0 === o.options.swipeToSlide ? (o.$slideTrack.find(".slick-slide").each(function (s, n) {
            if (n.offsetLeft - t + i(n).outerWidth() / 2 > -1 * o.swipeLeft) return e = n, !1
        }), Math.abs(i(e).attr("data-slick-index") - o.currentSlide) || 1) : o.options.slidesToScroll
    }, e.prototype.goTo = e.prototype.slickGoTo = function (i, e) {
        this.changeSlide({data: {message: "index", index: parseInt(i)}}, e)
    }, e.prototype.init = function (e) {
        var t = this;
        i(t.$slider).hasClass("slick-initialized") || (i(t.$slider).addClass("slick-initialized"), t.buildRows(), t.buildOut(), t.setProps(), t.startLoad(), t.loadSlider(), t.initializeEvents(), t.updateArrows(), t.updateDots(), t.checkResponsive(!0), t.focusHandler()), e && t.$slider.trigger("init", [t]), !0 === t.options.accessibility && t.initADA(), t.options.autoplay && (t.paused = !1, t.autoPlay())
    }, e.prototype.initADA = function () {
        var e = this, t = Math.ceil(e.slideCount / e.options.slidesToShow),
            o = e.getNavigableIndexes().filter(function (i) {
                return i >= 0 && i < e.slideCount
            });
        e.$slides.add(e.$slideTrack.find(".slick-cloned")).attr({
            "aria-hidden": "true",
            tabindex: "-1"
        }).find("a, input, button, select").attr({tabindex: "-1"}), null !== e.$dots && (e.$slides.not(e.$slideTrack.find(".slick-cloned")).each(function (t) {
            var s = o.indexOf(t);
            i(this).attr({
                role: "tabpanel",
                id: "slick-slide" + e.instanceUid + t,
                tabindex: -1
            }), -1 !== s && i(this).attr({"aria-describedby": "slick-slide-control" + e.instanceUid + s})
        }), e.$dots.attr("role", "tablist").find("li").each(function (s) {
            var n = o[s];
            i(this).attr({role: "presentation"}), i(this).find("button").first().attr({
                role: "tab",
                id: "slick-slide-control" + e.instanceUid + s,
                "aria-controls": "slick-slide" + e.instanceUid + n,
                "aria-label": s + 1 + " of " + t,
                "aria-selected": null,
                tabindex: "-1"
            })
        }).eq(e.currentSlide).find("button").attr({"aria-selected": "true", tabindex: "0"}).end());
        for (var s = e.currentSlide, n = s + e.options.slidesToShow; s < n; s++) e.$slides.eq(s).attr("tabindex", 0);
        e.activateADA()
    }, e.prototype.initArrowEvents = function () {
        var i = this;
        !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.off("click.slick").on("click.slick", {message: "previous"}, i.changeSlide), i.$nextArrow.off("click.slick").on("click.slick", {message: "next"}, i.changeSlide), !0 === i.options.accessibility && (i.$prevArrow.on("keydown.slick", i.keyHandler), i.$nextArrow.on("keydown.slick", i.keyHandler)))
    }, e.prototype.initDotEvents = function () {
        var e = this;
        !0 === e.options.dots && (i("li", e.$dots).on("click.slick", {message: "index"}, e.changeSlide), !0 === e.options.accessibility && e.$dots.on("keydown.slick", e.keyHandler)), !0 === e.options.dots && !0 === e.options.pauseOnDotsHover && i("li", e.$dots).on("mouseenter.slick", i.proxy(e.interrupt, e, !0)).on("mouseleave.slick", i.proxy(e.interrupt, e, !1))
    }, e.prototype.initSlideEvents = function () {
        var e = this;
        e.options.pauseOnHover && (e.$list.on("mouseenter.slick", i.proxy(e.interrupt, e, !0)), e.$list.on("mouseleave.slick", i.proxy(e.interrupt, e, !1)))
    }, e.prototype.initializeEvents = function () {
        var e = this;
        e.initArrowEvents(), e.initDotEvents(), e.initSlideEvents(), e.$list.on("touchstart.slick mousedown.slick", {action: "start"}, e.swipeHandler), e.$list.on("touchmove.slick mousemove.slick", {action: "move"}, e.swipeHandler), e.$list.on("touchend.slick mouseup.slick", {action: "end"}, e.swipeHandler), e.$list.on("touchcancel.slick mouseleave.slick", {action: "end"}, e.swipeHandler), e.$list.on("click.slick", e.clickHandler), i(document).on(e.visibilityChange, i.proxy(e.visibility, e)), !0 === e.options.accessibility && e.$list.on("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().on("click.slick", e.selectHandler), i(window).on("orientationchange.slick.slick-" + e.instanceUid, i.proxy(e.orientationChange, e)), i(window).on("resize.slick.slick-" + e.instanceUid, i.proxy(e.resize, e)), i("[draggable!=true]", e.$slideTrack).on("dragstart", e.preventDefault), i(window).on("load.slick.slick-" + e.instanceUid, e.setPosition), i(e.setPosition)
    }, e.prototype.initUI = function () {
        var i = this;
        !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.show(), i.$nextArrow.show()), !0 === i.options.dots && i.slideCount > i.options.slidesToShow && i.$dots.show()
    }, e.prototype.keyHandler = function (i) {
        var e = this;
        i.target.tagName.match("TEXTAREA|INPUT|SELECT") || (37 === i.keyCode && !0 === e.options.accessibility ? e.changeSlide({data: {message: !0 === e.options.rtl ? "next" : "previous"}}) : 39 === i.keyCode && !0 === e.options.accessibility && e.changeSlide({data: {message: !0 === e.options.rtl ? "previous" : "next"}}))
    }, e.prototype.lazyLoad = function () {
        function e(e) {
            i("img[data-lazy]", e).each(function () {
                var e = i(this), t = i(this).attr("data-lazy"), o = i(this).attr("data-srcset"),
                    s = i(this).attr("data-sizes") || n.$slider.attr("data-sizes"), r = document.createElement("img");
                r.onload = function () {
                    e.animate({opacity: 0}, 100, function () {
                        o && (e.attr("srcset", o), s && e.attr("sizes", s)), e.attr("src", t).animate({opacity: 1}, 200, function () {
                            e.removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading")
                        }), n.$slider.trigger("lazyLoaded", [n, e, t])
                    })
                }, r.onerror = function () {
                    e.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), n.$slider.trigger("lazyLoadError", [n, e, t])
                }, r.src = t
            })
        }

        var t, o, s, n = this;
        if (!0 === n.options.centerMode ? !0 === n.options.infinite ? s = (o = n.currentSlide + (n.options.slidesToShow / 2 + 1)) + n.options.slidesToShow + 2 : (o = Math.max(0, n.currentSlide - (n.options.slidesToShow / 2 + 1)), s = n.options.slidesToShow / 2 + 1 + 2 + n.currentSlide) : (o = n.options.infinite ? n.options.slidesToShow + n.currentSlide : n.currentSlide, s = Math.ceil(o + n.options.slidesToShow), !0 === n.options.fade && (o > 0 && o--, s <= n.slideCount && s++)), t = n.$slider.find(".slick-slide").slice(o, s), "anticipated" === n.options.lazyLoad) for (var r = o - 1, l = s, d = n.$slider.find(".slick-slide"), a = 0; a < n.options.slidesToScroll; a++) r < 0 && (r = n.slideCount - 1), t = (t = t.add(d.eq(r))).add(d.eq(l)), r--, l++;
        e(t), n.slideCount <= n.options.slidesToShow ? e(n.$slider.find(".slick-slide")) : n.currentSlide >= n.slideCount - n.options.slidesToShow ? e(n.$slider.find(".slick-cloned").slice(0, n.options.slidesToShow)) : 0 === n.currentSlide && e(n.$slider.find(".slick-cloned").slice(-1 * n.options.slidesToShow))
    }, e.prototype.loadSlider = function () {
        var i = this;
        i.setPosition(), i.$slideTrack.css({opacity: 1}), i.$slider.removeClass("slick-loading"), i.initUI(), "progressive" === i.options.lazyLoad && i.progressiveLazyLoad()
    }, e.prototype.next = e.prototype.slickNext = function () {
        this.changeSlide({data: {message: "next"}})
    }, e.prototype.orientationChange = function () {
        var i = this;
        i.checkResponsive(), i.setPosition()
    }, e.prototype.pause = e.prototype.slickPause = function () {
        var i = this;
        i.autoPlayClear(), i.paused = !0
    }, e.prototype.play = e.prototype.slickPlay = function () {
        var i = this;
        i.autoPlay(), i.options.autoplay = !0, i.paused = !1, i.focussed = !1, i.interrupted = !1
    }, e.prototype.postSlide = function (e) {
        var t = this;
        t.unslicked || (t.$slider.trigger("afterChange", [t, e]), t.animating = !1, t.slideCount > t.options.slidesToShow && t.setPosition(), t.swipeLeft = null, t.options.autoplay && t.autoPlay(), !0 === t.options.accessibility && (t.initADA(), t.options.focusOnChange && i(t.$slides.get(t.currentSlide)).attr("tabindex", 0).focus()))
    }, e.prototype.prev = e.prototype.slickPrev = function () {
        this.changeSlide({data: {message: "previous"}})
    }, e.prototype.preventDefault = function (i) {
        i.preventDefault()
    }, e.prototype.progressiveLazyLoad = function (e) {
        e = e || 1;
        var t, o, s, n, r, l = this, d = i("img[data-lazy]", l.$slider);
        d.length ? (t = d.first(), o = t.attr("data-lazy"), s = t.attr("data-srcset"), n = t.attr("data-sizes") || l.$slider.attr("data-sizes"), (r = document.createElement("img")).onload = function () {
            s && (t.attr("srcset", s), n && t.attr("sizes", n)), t.attr("src", o).removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading"), !0 === l.options.adaptiveHeight && l.setPosition(), l.$slider.trigger("lazyLoaded", [l, t, o]), l.progressiveLazyLoad()
        }, r.onerror = function () {
            e < 3 ? setTimeout(function () {
                l.progressiveLazyLoad(e + 1)
            }, 500) : (t.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), l.$slider.trigger("lazyLoadError", [l, t, o]), l.progressiveLazyLoad())
        }, r.src = o) : l.$slider.trigger("allImagesLoaded", [l])
    }, e.prototype.refresh = function (e) {
        var t, o, s = this;
        o = s.slideCount - s.options.slidesToShow, !s.options.infinite && s.currentSlide > o && (s.currentSlide = o), s.slideCount <= s.options.slidesToShow && (s.currentSlide = 0), t = s.currentSlide, s.destroy(!0), i.extend(s, s.initials, {currentSlide: t}), s.init(), e || s.changeSlide({
            data: {
                message: "index",
                index: t
            }
        }, !1)
    }, e.prototype.registerBreakpoints = function () {
        var e, t, o, s = this, n = s.options.responsive || null;
        if ("array" === i.type(n) && n.length) {
            s.respondTo = s.options.respondTo || "window";
            for (e in n) if (o = s.breakpoints.length - 1, n.hasOwnProperty(e)) {
                for (t = n[e].breakpoint; o >= 0;) s.breakpoints[o] && s.breakpoints[o] === t && s.breakpoints.splice(o, 1), o--;
                s.breakpoints.push(t), s.breakpointSettings[t] = n[e].settings
            }
            s.breakpoints.sort(function (i, e) {
                return s.options.mobileFirst ? i - e : e - i
            })
        }
    }, e.prototype.reinit = function () {
        var e = this;
        e.$slides = e.$slideTrack.children(e.options.slide).addClass("slick-slide"), e.slideCount = e.$slides.length, e.currentSlide >= e.slideCount && 0 !== e.currentSlide && (e.currentSlide = e.currentSlide - e.options.slidesToScroll), e.slideCount <= e.options.slidesToShow && (e.currentSlide = 0), e.registerBreakpoints(), e.setProps(), e.setupInfinite(), e.buildArrows(), e.updateArrows(), e.initArrowEvents(), e.buildDots(), e.updateDots(), e.initDotEvents(), e.cleanUpSlideEvents(), e.initSlideEvents(), e.checkResponsive(!1, !0), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().on("click.slick", e.selectHandler), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), e.setPosition(), e.focusHandler(), e.paused = !e.options.autoplay, e.autoPlay(), e.$slider.trigger("reInit", [e])
    }, e.prototype.resize = function () {
        var e = this;
        i(window).width() !== e.windowWidth && (clearTimeout(e.windowDelay), e.windowDelay = window.setTimeout(function () {
            e.windowWidth = i(window).width(), e.checkResponsive(), e.unslicked || e.setPosition()
        }, 50))
    }, e.prototype.removeSlide = e.prototype.slickRemove = function (i, e, t) {
        var o = this;
        if (i = "boolean" == typeof i ? !0 === (e = i) ? 0 : o.slideCount - 1 : !0 === e ? --i : i, o.slideCount < 1 || i < 0 || i > o.slideCount - 1) return !1;
        o.unload(), !0 === t ? o.$slideTrack.children().remove() : o.$slideTrack.children(this.options.slide).eq(i).remove(), o.$slides = o.$slideTrack.children(this.options.slide), o.$slideTrack.children(this.options.slide).detach(), o.$slideTrack.append(o.$slides), o.$slidesCache = o.$slides, o.reinit()
    }, e.prototype.setCSS = function (i) {
        var e, t, o = this, s = {};
        !0 === o.options.rtl && (i = -i), e = "left" == o.positionProp ? Math.ceil(i) + "px" : "0px", t = "top" == o.positionProp ? Math.ceil(i) + "px" : "0px", s[o.positionProp] = i, !1 === o.transformsEnabled ? o.$slideTrack.css(s) : (s = {}, !1 === o.cssTransitions ? (s[o.animType] = "translate(" + e + ", " + t + ")", o.$slideTrack.css(s)) : (s[o.animType] = "translate3d(" + e + ", " + t + ", 0px)", o.$slideTrack.css(s)))
    }, e.prototype.setDimensions = function () {
        var i = this;
        !1 === i.options.vertical ? !0 === i.options.centerMode && i.$list.css({padding: "0px " + i.options.centerPadding}) : (i.$list.height(i.$slides.first().outerHeight(!0) * i.options.slidesToShow), !0 === i.options.centerMode && i.$list.css({padding: i.options.centerPadding + " 0px"})), i.listWidth = i.$list.width(), i.listHeight = i.$list.height(), !1 === i.options.vertical && !1 === i.options.variableWidth ? (i.slideWidth = Math.ceil(i.listWidth / i.options.slidesToShow), i.$slideTrack.width(Math.ceil(i.slideWidth * i.$slideTrack.children(".slick-slide").length))) : !0 === i.options.variableWidth ? i.$slideTrack.width(5e3 * i.slideCount) : (i.slideWidth = Math.ceil(i.listWidth), i.$slideTrack.height(Math.ceil(i.$slides.first().outerHeight(!0) * i.$slideTrack.children(".slick-slide").length)));
        var e = i.$slides.first().outerWidth(!0) - i.$slides.first().width();
        !1 === i.options.variableWidth && i.$slideTrack.children(".slick-slide").width(i.slideWidth - e)
    }, e.prototype.setFade = function () {
        var e, t = this;
        t.$slides.each(function (o, s) {
            e = t.slideWidth * o * -1, !0 === t.options.rtl ? i(s).css({
                position: "relative",
                right: e,
                top: 0,
                zIndex: t.options.zIndex - 2,
                opacity: 0
            }) : i(s).css({position: "relative", left: e, top: 0, zIndex: t.options.zIndex - 2, opacity: 0})
        }), t.$slides.eq(t.currentSlide).css({zIndex: t.options.zIndex - 1, opacity: 1})
    }, e.prototype.setHeight = function () {
        var i = this;
        if (1 === i.options.slidesToShow && !0 === i.options.adaptiveHeight && !1 === i.options.vertical) {
            var e = i.$slides.eq(i.currentSlide).outerHeight(!0);
            i.$list.css("height", e)
        }
    }, e.prototype.setOption = e.prototype.slickSetOption = function () {
        var e, t, o, s, n, r = this, l = !1;
        if ("object" === i.type(arguments[0]) ? (o = arguments[0], l = arguments[1], n = "multiple") : "string" === i.type(arguments[0]) && (o = arguments[0], s = arguments[1], l = arguments[2], "responsive" === arguments[0] && "array" === i.type(arguments[1]) ? n = "responsive" : void 0 !== arguments[1] && (n = "single")), "single" === n) r.options[o] = s; else if ("multiple" === n) i.each(o, function (i, e) {
            r.options[i] = e
        }); else if ("responsive" === n) for (t in s) if ("array" !== i.type(r.options.responsive)) r.options.responsive = [s[t]]; else {
            for (e = r.options.responsive.length - 1; e >= 0;) r.options.responsive[e].breakpoint === s[t].breakpoint && r.options.responsive.splice(e, 1), e--;
            r.options.responsive.push(s[t])
        }
        l && (r.unload(), r.reinit())
    }, e.prototype.setPosition = function () {
        var i = this;
        i.setDimensions(), i.setHeight(), !1 === i.options.fade ? i.setCSS(i.getLeft(i.currentSlide)) : i.setFade(), i.$slider.trigger("setPosition", [i])
    }, e.prototype.setProps = function () {
        var i = this, e = document.body.style;
        i.positionProp = !0 === i.options.vertical ? "top" : "left", "top" === i.positionProp ? i.$slider.addClass("slick-vertical") : i.$slider.removeClass("slick-vertical"), void 0 === e.WebkitTransition && void 0 === e.MozTransition && void 0 === e.msTransition || !0 === i.options.useCSS && (i.cssTransitions = !0), i.options.fade && ("number" == typeof i.options.zIndex ? i.options.zIndex < 3 && (i.options.zIndex = 3) : i.options.zIndex = i.defaults.zIndex), void 0 !== e.OTransform && (i.animType = "OTransform", i.transformType = "-o-transform", i.transitionType = "OTransition", void 0 === e.perspectiveProperty && void 0 === e.webkitPerspective && (i.animType = !1)), void 0 !== e.MozTransform && (i.animType = "MozTransform", i.transformType = "-moz-transform", i.transitionType = "MozTransition", void 0 === e.perspectiveProperty && void 0 === e.MozPerspective && (i.animType = !1)), void 0 !== e.webkitTransform && (i.animType = "webkitTransform", i.transformType = "-webkit-transform", i.transitionType = "webkitTransition", void 0 === e.perspectiveProperty && void 0 === e.webkitPerspective && (i.animType = !1)), void 0 !== e.msTransform && (i.animType = "msTransform", i.transformType = "-ms-transform", i.transitionType = "msTransition", void 0 === e.msTransform && (i.animType = !1)), void 0 !== e.transform && !1 !== i.animType && (i.animType = "transform", i.transformType = "transform", i.transitionType = "transition"), i.transformsEnabled = i.options.useTransform && null !== i.animType && !1 !== i.animType
    }, e.prototype.setSlideClasses = function (i) {
        var e, t, o, s, n = this;
        if (t = n.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden", "true"), n.$slides.eq(i).addClass("slick-current"), !0 === n.options.centerMode) {
            var r = n.options.slidesToShow % 2 == 0 ? 1 : 0;
            e = Math.floor(n.options.slidesToShow / 2), !0 === n.options.infinite && (i >= e && i <= n.slideCount - 1 - e ? n.$slides.slice(i - e + r, i + e + 1).addClass("slick-active").attr("aria-hidden", "false") : (o = n.options.slidesToShow + i, t.slice(o - e + 1 + r, o + e + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === i ? t.eq(t.length - 1 - n.options.slidesToShow).addClass("slick-center") : i === n.slideCount - 1 && t.eq(n.options.slidesToShow).addClass("slick-center")), n.$slides.eq(i).addClass("slick-center")
        } else i >= 0 && i <= n.slideCount - n.options.slidesToShow ? n.$slides.slice(i, i + n.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : t.length <= n.options.slidesToShow ? t.addClass("slick-active").attr("aria-hidden", "false") : (s = n.slideCount % n.options.slidesToShow, o = !0 === n.options.infinite ? n.options.slidesToShow + i : i, n.options.slidesToShow == n.options.slidesToScroll && n.slideCount - i < n.options.slidesToShow ? t.slice(o - (n.options.slidesToShow - s), o + s).addClass("slick-active").attr("aria-hidden", "false") : t.slice(o, o + n.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false"));
        "ondemand" !== n.options.lazyLoad && "anticipated" !== n.options.lazyLoad || n.lazyLoad()
    }, e.prototype.setupInfinite = function () {
        var e, t, o, s = this;
        if (!0 === s.options.fade && (s.options.centerMode = !1), !0 === s.options.infinite && !1 === s.options.fade && (t = null, s.slideCount > s.options.slidesToShow)) {
            for (o = !0 === s.options.centerMode ? s.options.slidesToShow + 1 : s.options.slidesToShow, e = s.slideCount; e > s.slideCount - o; e -= 1) t = e - 1, i(s.$slides[t]).clone(!0).attr("id", "").attr("data-slick-index", t - s.slideCount).prependTo(s.$slideTrack).addClass("slick-cloned");
            for (e = 0; e < o + s.slideCount; e += 1) t = e, i(s.$slides[t]).clone(!0).attr("id", "").attr("data-slick-index", t + s.slideCount).appendTo(s.$slideTrack).addClass("slick-cloned");
            s.$slideTrack.find(".slick-cloned").find("[id]").each(function () {
                i(this).attr("id", "")
            })
        }
    }, e.prototype.interrupt = function (i) {
        var e = this;
        i || e.autoPlay(), e.interrupted = i
    }, e.prototype.selectHandler = function (e) {
        var t = this, o = i(e.target).is(".slick-slide") ? i(e.target) : i(e.target).parents(".slick-slide"),
            s = parseInt(o.attr("data-slick-index"));
        s || (s = 0), t.slideCount <= t.options.slidesToShow ? t.slideHandler(s, !1, !0) : t.slideHandler(s)
    }, e.prototype.slideHandler = function (i, e, t) {
        var o, s, n, r, l, d = null, a = this;
        if (e = e || !1, !(!0 === a.animating && !0 === a.options.waitForAnimate || !0 === a.options.fade && a.currentSlide === i)) if (!1 === e && a.asNavFor(i), o = i, d = a.getLeft(o), r = a.getLeft(a.currentSlide), a.currentLeft = null === a.swipeLeft ? r : a.swipeLeft, !1 === a.options.infinite && !1 === a.options.centerMode && (i < 0 || i > a.getDotCount() * a.options.slidesToScroll)) !1 === a.options.fade && (o = a.currentSlide, !0 !== t ? a.animateSlide(r, function () {
            a.postSlide(o)
        }) : a.postSlide(o)); else if (!1 === a.options.infinite && !0 === a.options.centerMode && (i < 0 || i > a.slideCount - a.options.slidesToScroll)) !1 === a.options.fade && (o = a.currentSlide, !0 !== t ? a.animateSlide(r, function () {
            a.postSlide(o)
        }) : a.postSlide(o)); else {
            if (a.options.autoplay && clearInterval(a.autoPlayTimer), s = o < 0 ? a.slideCount % a.options.slidesToScroll != 0 ? a.slideCount - a.slideCount % a.options.slidesToScroll : a.slideCount + o : o >= a.slideCount ? a.slideCount % a.options.slidesToScroll != 0 ? 0 : o - a.slideCount : o, a.animating = !0, a.$slider.trigger("beforeChange", [a, a.currentSlide, s]), n = a.currentSlide, a.currentSlide = s, a.setSlideClasses(a.currentSlide), a.options.asNavFor && (l = (l = a.getNavTarget()).slick("getSlick")).slideCount <= l.options.slidesToShow && l.setSlideClasses(a.currentSlide), a.updateDots(), a.updateArrows(), !0 === a.options.fade) return !0 !== t ? (a.fadeSlideOut(n), a.fadeSlide(s, function () {
                a.postSlide(s)
            })) : a.postSlide(s), void a.animateHeight();
            !0 !== t ? a.animateSlide(d, function () {
                a.postSlide(s)
            }) : a.postSlide(s)
        }
    }, e.prototype.startLoad = function () {
        var i = this;
        !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.hide(), i.$nextArrow.hide()), !0 === i.options.dots && i.slideCount > i.options.slidesToShow && i.$dots.hide(), i.$slider.addClass("slick-loading")
    }, e.prototype.swipeDirection = function () {
        var i, e, t, o, s = this;
        return i = s.touchObject.startX - s.touchObject.curX, e = s.touchObject.startY - s.touchObject.curY, t = Math.atan2(e, i), (o = Math.round(180 * t / Math.PI)) < 0 && (o = 360 - Math.abs(o)), o <= 45 && o >= 0 ? !1 === s.options.rtl ? "left" : "right" : o <= 360 && o >= 315 ? !1 === s.options.rtl ? "left" : "right" : o >= 135 && o <= 225 ? !1 === s.options.rtl ? "right" : "left" : !0 === s.options.verticalSwiping ? o >= 35 && o <= 135 ? "down" : "up" : "vertical"
    }, e.prototype.swipeEnd = function (i) {
        var e, t, o = this;
        if (o.dragging = !1, o.swiping = !1, o.scrolling) return o.scrolling = !1, !1;
        if (o.interrupted = !1, o.shouldClick = !(o.touchObject.swipeLength > 10), void 0 === o.touchObject.curX) return !1;
        if (!0 === o.touchObject.edgeHit && o.$slider.trigger("edge", [o, o.swipeDirection()]), o.touchObject.swipeLength >= o.touchObject.minSwipe) {
            switch (t = o.swipeDirection()) {
                case"left":
                case"down":
                    e = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide + o.getSlideCount()) : o.currentSlide + o.getSlideCount(), o.currentDirection = 0;
                    break;
                case"right":
                case"up":
                    e = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide - o.getSlideCount()) : o.currentSlide - o.getSlideCount(), o.currentDirection = 1
            }
            "vertical" != t && (o.slideHandler(e), o.touchObject = {}, o.$slider.trigger("swipe", [o, t]))
        } else o.touchObject.startX !== o.touchObject.curX && (o.slideHandler(o.currentSlide), o.touchObject = {})
    }, e.prototype.swipeHandler = function (i) {
        var e = this;
        if (!(!1 === e.options.swipe || "ontouchend" in document && !1 === e.options.swipe || !1 === e.options.draggable && -1 !== i.type.indexOf("mouse"))) switch (e.touchObject.fingerCount = i.originalEvent && void 0 !== i.originalEvent.touches ? i.originalEvent.touches.length : 1, e.touchObject.minSwipe = e.listWidth / e.options.touchThreshold, !0 === e.options.verticalSwiping && (e.touchObject.minSwipe = e.listHeight / e.options.touchThreshold), i.data.action) {
            case"start":
                e.swipeStart(i);
                break;
            case"move":
                e.swipeMove(i);
                break;
            case"end":
                e.swipeEnd(i)
        }
    }, e.prototype.swipeMove = function (i) {
        var e, t, o, s, n, r, l = this;
        return n = void 0 !== i.originalEvent ? i.originalEvent.touches : null, !(!l.dragging || l.scrolling || n && 1 !== n.length) && (e = l.getLeft(l.currentSlide), l.touchObject.curX = void 0 !== n ? n[0].pageX : i.clientX, l.touchObject.curY = void 0 !== n ? n[0].pageY : i.clientY, l.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(l.touchObject.curX - l.touchObject.startX, 2))), r = Math.round(Math.sqrt(Math.pow(l.touchObject.curY - l.touchObject.startY, 2))), !l.options.verticalSwiping && !l.swiping && r > 4 ? (l.scrolling = !0, !1) : (!0 === l.options.verticalSwiping && (l.touchObject.swipeLength = r), t = l.swipeDirection(), void 0 !== i.originalEvent && l.touchObject.swipeLength > 4 && (l.swiping = !0, i.preventDefault()), s = (!1 === l.options.rtl ? 1 : -1) * (l.touchObject.curX > l.touchObject.startX ? 1 : -1), !0 === l.options.verticalSwiping && (s = l.touchObject.curY > l.touchObject.startY ? 1 : -1), o = l.touchObject.swipeLength, l.touchObject.edgeHit = !1, !1 === l.options.infinite && (0 === l.currentSlide && "right" === t || l.currentSlide >= l.getDotCount() && "left" === t) && (o = l.touchObject.swipeLength * l.options.edgeFriction, l.touchObject.edgeHit = !0), !1 === l.options.vertical ? l.swipeLeft = e + o * s : l.swipeLeft = e + o * (l.$list.height() / l.listWidth) * s, !0 === l.options.verticalSwiping && (l.swipeLeft = e + o * s), !0 !== l.options.fade && !1 !== l.options.touchMove && (!0 === l.animating ? (l.swipeLeft = null, !1) : void l.setCSS(l.swipeLeft))))
    }, e.prototype.swipeStart = function (i) {
        var e, t = this;
        if (t.interrupted = !0, 1 !== t.touchObject.fingerCount || t.slideCount <= t.options.slidesToShow) return t.touchObject = {}, !1;
        void 0 !== i.originalEvent && void 0 !== i.originalEvent.touches && (e = i.originalEvent.touches[0]), t.touchObject.startX = t.touchObject.curX = void 0 !== e ? e.pageX : i.clientX, t.touchObject.startY = t.touchObject.curY = void 0 !== e ? e.pageY : i.clientY, t.dragging = !0
    }, e.prototype.unfilterSlides = e.prototype.slickUnfilter = function () {
        var i = this;
        null !== i.$slidesCache && (i.unload(), i.$slideTrack.children(this.options.slide).detach(), i.$slidesCache.appendTo(i.$slideTrack), i.reinit())
    }, e.prototype.unload = function () {
        var e = this;
        i(".slick-cloned", e.$slider).remove(), e.$dots && e.$dots.remove(), e.$prevArrow && e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.remove(), e.$nextArrow && e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.remove(), e.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden", "true").css("width", "")
    }, e.prototype.unslick = function (i) {
        var e = this;
        e.$slider.trigger("unslick", [e, i]), e.destroy()
    }, e.prototype.updateArrows = function () {
        var i = this;
        Math.floor(i.options.slidesToShow / 2), !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && !i.options.infinite && (i.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), i.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), 0 === i.currentSlide ? (i.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true"), i.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : i.currentSlide >= i.slideCount - i.options.slidesToShow && !1 === i.options.centerMode ? (i.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), i.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : i.currentSlide >= i.slideCount - 1 && !0 === i.options.centerMode && (i.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), i.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")))
    }, e.prototype.updateDots = function () {
        var i = this;
        null !== i.$dots && (i.$dots.find("li").removeClass("slick-active").end(), i.$dots.find("li").eq(Math.floor(i.currentSlide / i.options.slidesToScroll)).addClass("slick-active"))
    }, e.prototype.visibility = function () {
        var i = this;
        i.options.autoplay && (document[i.hidden] ? i.interrupted = !0 : i.interrupted = !1)
    }, i.fn.slick = function () {
        var i, t, o = this, s = arguments[0], n = Array.prototype.slice.call(arguments, 1), r = o.length;
        for (i = 0; i < r; i++) if ("object" == typeof s || void 0 === s ? o[i].slick = new e(o[i], s) : t = o[i].slick[s].apply(o[i].slick, n), void 0 !== t) return t;
        return o
    }
});

/* This Plugin for Maximage Slider */
/*!
 * jQuery Cycle Plugin (with Transition Definitions)
 * Examples and documentation at: http://jquery.malsup.com/cycle/
 * Copyright (c) 2007-2010 M. Alsup
 * Version: 2.9998 (27-OCT-2011)
 * Dual licensed under the MIT and GPL licenses.
 * http://jquery.malsup.com/license.html
 * Requires: jQuery v1.3.2 or later
 */
!function (e, t) {
    function n(t) {
        e.fn.cycle.debug && i(t)
    }

    function i() {
        window.console && console.log && console.log("[cycle] " + Array.prototype.join.call(arguments, " "))
    }

    function c(t, n, i) {
        var c = e(t).data("cycle.opts"), s = !!t.cyclePause;
        s && c.paused ? c.paused(t, c, n, i) : !s && c.resumed && c.resumed(t, c, n, i)
    }

    function s(n, s, o) {
        function l(t, n, c) {
            if (!t && n === !0) {
                var s = e(c).data("cycle.opts");
                if (!s) return i("options not found, can not resume"), !1;
                c.cycleTimeout && (clearTimeout(c.cycleTimeout), c.cycleTimeout = 0), d(s.elements, s, 1, !s.backwards)
            }
        }

        if (n.cycleStop == t && (n.cycleStop = 0), (s === t || null === s) && (s = {}), s.constructor == String) {
            switch (s) {
                case"destroy":
                case"stop":
                    var a = e(n).data("cycle.opts");
                    return a ? (n.cycleStop++, n.cycleTimeout && clearTimeout(n.cycleTimeout), n.cycleTimeout = 0, a.elements && e(a.elements).stop(), e(n).removeData("cycle.opts"), "destroy" == s && r(a), !1) : !1;
                case"toggle":
                    return n.cyclePause = 1 === n.cyclePause ? 0 : 1, l(n.cyclePause, o, n), c(n), !1;
                case"pause":
                    return n.cyclePause = 1, c(n), !1;
                case"resume":
                    return n.cyclePause = 0, l(!1, o, n), c(n), !1;
                case"prev":
                case"next":
                    var a = e(n).data("cycle.opts");
                    return a ? (e.fn.cycle[s](a), !1) : (i('options not found, "prev/next" ignored'), !1);
                default:
                    s = {fx: s}
            }
            return s
        }
        if (s.constructor == Number) {
            var f = s;
            return (s = e(n).data("cycle.opts")) ? 0 > f || f >= s.elements.length ? (i("invalid slide index: " + f), !1) : (s.nextSlide = f, n.cycleTimeout && (clearTimeout(n.cycleTimeout), n.cycleTimeout = 0), "string" == typeof o && (s.oneTimeFx = o), d(s.elements, s, 1, f >= s.currSlide), !1) : (i("options not found, can not advance slide"), !1)
        }
        return s
    }

    function o(t, n) {
        if (!e.support.opacity && n.cleartype && t.style.filter) try {
            t.style.removeAttribute("filter")
        } catch (i) {
        }
    }

    function r(t) {
        t.next && e(t.next).unbind(t.prevNextEvent), t.prev && e(t.prev).unbind(t.prevNextEvent), (t.pager || t.pagerAnchorBuilder) && e.each(t.pagerAnchors || [], function () {
            this.unbind().remove()
        }), t.pagerAnchors = null, t.destroy && t.destroy(t)
    }

    function l(n, s, r, l, h) {
        var p, x = e.extend({}, e.fn.cycle.defaults, l || {}, e.metadata ? n.metadata() : e.meta ? n.data() : {}),
            v = e.isFunction(n.data) ? n.data(x.metaAttr) : null;
        v && (x = e.extend(x, v)), x.autostop && (x.countdown = x.autostopCount || r.length);
        var w = n[0];
        if (n.data("cycle.opts", x), x.$cont = n, x.stopCount = w.cycleStop, x.elements = r, x.before = x.before ? [x.before] : [], x.after = x.after ? [x.after] : [], !e.support.opacity && x.cleartype && x.after.push(function () {
            o(this, x)
        }), x.continuous && x.after.push(function () {
            d(r, x, 0, !x.backwards)
        }), a(x), e.support.opacity || !x.cleartype || x.cleartypeNoBg || g(s), "static" == n.css("position") && n.css("position", "relative"), x.width && n.width(x.width), x.height && "auto" != x.height && n.height(x.height), x.startingSlide != t ? (x.startingSlide = parseInt(x.startingSlide, 10), x.startingSlide >= r.length || x.startSlide < 0 ? x.startingSlide = 0 : p = !0) : x.backwards ? x.startingSlide = r.length - 1 : x.startingSlide = 0, x.random) {
            x.randomMap = [];
            for (var S = 0; S < r.length; S++) x.randomMap.push(S);
            if (x.randomMap.sort(function (e, t) {
                return Math.random() - .5
            }), p) for (var b = 0; b < r.length; b++) x.startingSlide == x.randomMap[b] && (x.randomIndex = b); else x.randomIndex = 1, x.startingSlide = x.randomMap[1]
        } else x.startingSlide >= r.length && (x.startingSlide = 0);
        x.currSlide = x.startingSlide || 0;
        var B = x.startingSlide;
        s.css({position: "absolute", top: 0, left: 0}).hide().each(function (t) {
            var n;
            n = x.backwards ? B ? B >= t ? r.length + (t - B) : B - t : r.length - t : B ? t >= B ? r.length - (t - B) : B - t : r.length - t, e(this).css("z-index", n)
        }), e(r[B]).css("opacity", 1).show(), o(r[B], x), x.fit && (x.aspect ? s.each(function () {
            var t = e(this), n = x.aspect === !0 ? t.width() / t.height() : x.aspect;
            x.width && t.width() != x.width && (t.width(x.width), t.height(x.width / n)), x.height && t.height() < x.height && (t.height(x.height), t.width(x.height * n))
        }) : (x.width && s.width(x.width), x.height && "auto" != x.height && s.height(x.height))), !x.center || x.fit && !x.aspect || s.each(function () {
            var t = e(this);
            t.css({
                "margin-left": x.width ? (x.width - t.width()) / 2 + "px" : 0,
                "margin-top": x.height ? (x.height - t.height()) / 2 + "px" : 0
            })
        }), !x.center || x.fit || x.slideResize || s.each(function () {
            var t = e(this);
            t.css({
                "margin-left": x.width ? (x.width - t.width()) / 2 + "px" : 0,
                "margin-top": x.height ? (x.height - t.height()) / 2 + "px" : 0
            })
        });
        var I = x.containerResize && !n.innerHeight();
        if (I) {
            for (var O = 0, F = 0, A = 0; A < r.length; A++) {
                var k = e(r[A]), H = k[0], T = k.outerWidth(), W = k.outerHeight();
                T || (T = H.offsetWidth || H.width || k.attr("width")), W || (W = H.offsetHeight || H.height || k.attr("height")), O = T > O ? T : O, F = W > F ? W : F
            }
            O > 0 && F > 0 && n.css({width: O + "px", height: F + "px"})
        }
        var P = !1;
        if (x.pause && n.hover(function () {
            P = !0, this.cyclePause++, c(w, !0)
        }, function () {
            P && this.cyclePause--, c(w, !0)
        }), f(x) === !1) return !1;
        var R = !1;
        if (l.requeueAttempts = l.requeueAttempts || 0, s.each(function () {
            var t = e(this);
            if (this.cycleH = x.fit && x.height ? x.height : t.height() || this.offsetHeight || this.height || t.attr("height") || 0, this.cycleW = x.fit && x.width ? x.width : t.width() || this.offsetWidth || this.width || t.attr("width") || 0, t.is("img")) {
                var n = e.browser.msie && 28 == this.cycleW && 30 == this.cycleH && !this.complete,
                    c = e.browser.mozilla && 34 == this.cycleW && 19 == this.cycleH && !this.complete,
                    s = e.browser.opera && (42 == this.cycleW && 19 == this.cycleH || 37 == this.cycleW && 17 == this.cycleH) && !this.complete,
                    o = 0 == this.cycleH && 0 == this.cycleW && !this.complete;
                if (n || c || s || o) {
                    if (h.s && x.requeueOnImageNotLoaded && ++l.requeueAttempts < 100) return i(l.requeueAttempts, " - img slide not loaded, requeuing slideshow: ", this.src, this.cycleW, this.cycleH), setTimeout(function () {
                        e(h.s, h.c).cycle(l)
                    }, x.requeueTimeout), R = !0, !1;
                    i("could not determine size of image: " + this.src, this.cycleW, this.cycleH)
                }
            }
            return !0
        }), R) return !1;
        if (x.cssBefore = x.cssBefore || {}, x.cssAfter = x.cssAfter || {}, x.cssFirst = x.cssFirst || {}, x.animIn = x.animIn || {}, x.animOut = x.animOut || {}, s.not(":eq(" + B + ")").css(x.cssBefore), e(s[B]).css(x.cssFirst), x.timeout) {
            x.timeout = parseInt(x.timeout, 10), x.speed.constructor == String && (x.speed = e.fx.speeds[x.speed] || parseInt(x.speed, 10)), x.sync || (x.speed = x.speed / 2);
            for (var C = "none" == x.fx ? 0 : "shuffle" == x.fx ? 500 : 250; x.timeout - x.speed < C;) x.timeout += x.speed
        }
        if (x.easing && (x.easeIn = x.easeOut = x.easing), x.speedIn || (x.speedIn = x.speed), x.speedOut || (x.speedOut = x.speed), x.slideCount = r.length, x.currSlide = x.lastSlide = B, x.random ? (++x.randomIndex == r.length && (x.randomIndex = 0), x.nextSlide = x.randomMap[x.randomIndex]) : x.backwards ? x.nextSlide = 0 == x.startingSlide ? r.length - 1 : x.startingSlide - 1 : x.nextSlide = x.startingSlide >= r.length - 1 ? 0 : x.startingSlide + 1, !x.multiFx) {
            var z = e.fn.cycle.transitions[x.fx];
            if (e.isFunction(z)) z(n, s, x); else if ("custom" != x.fx && !x.multiFx) return i("unknown transition: " + x.fx, "; slideshow terminating"), !1
        }
        var E = s[B];
        return x.skipInitializationCallbacks || (x.before.length && x.before[0].apply(E, [E, E, x, !0]), x.after.length && x.after[0].apply(E, [E, E, x, !0])), x.next && e(x.next).bind(x.prevNextEvent, function () {
            return m(x, 1)
        }), x.prev && e(x.prev).bind(x.prevNextEvent, function () {
            return m(x, 0)
        }), (x.pager || x.pagerAnchorBuilder) && y(r, x), u(x, r), x
    }

    function a(t) {
        t.original = {
            before: [],
            after: []
        }, t.original.cssBefore = e.extend({}, t.cssBefore), t.original.cssAfter = e.extend({}, t.cssAfter), t.original.animIn = e.extend({}, t.animIn), t.original.animOut = e.extend({}, t.animOut), e.each(t.before, function () {
            t.original.before.push(this)
        }), e.each(t.after, function () {
            t.original.after.push(this)
        })
    }

    function f(t) {
        var c, s, o = e.fn.cycle.transitions;
        if (t.fx.indexOf(",") > 0) {
            for (t.multiFx = !0, t.fxs = t.fx.replace(/\s*/g, "").split(","), c = 0; c < t.fxs.length; c++) {
                var r = t.fxs[c];
                s = o[r], s && o.hasOwnProperty(r) && e.isFunction(s) || (i("discarding unknown transition: ", r), t.fxs.splice(c, 1), c--)
            }
            if (!t.fxs.length) return i("No valid transitions named; slideshow terminating."), !1
        } else if ("all" == t.fx) {
            t.multiFx = !0, t.fxs = [];
            for (p in o) s = o[p], o.hasOwnProperty(p) && e.isFunction(s) && t.fxs.push(p)
        }
        if (t.multiFx && t.randomizeEffects) {
            var l = Math.floor(20 * Math.random()) + 30;
            for (c = 0; l > c; c++) {
                var a = Math.floor(Math.random() * t.fxs.length);
                t.fxs.push(t.fxs.splice(a, 1)[0])
            }
            n("randomized fx sequence: ", t.fxs)
        }
        return !0
    }

    function u(t, n) {
        t.addSlide = function (i, c) {
            var s = e(i), o = s[0];
            t.autostopCount || t.countdown++, n[c ? "unshift" : "push"](o), t.els && t.els[c ? "unshift" : "push"](o), t.slideCount = n.length, t.random && (t.randomMap.push(t.slideCount - 1), t.randomMap.sort(function (e, t) {
                return Math.random() - .5
            })), s.css("position", "absolute"), s[c ? "prependTo" : "appendTo"](t.$cont), c && (t.currSlide++, t.nextSlide++), e.support.opacity || !t.cleartype || t.cleartypeNoBg || g(s), t.fit && t.width && s.width(t.width), t.fit && t.height && "auto" != t.height && s.height(t.height), o.cycleH = t.fit && t.height ? t.height : s.height(), o.cycleW = t.fit && t.width ? t.width : s.width(), s.css(t.cssBefore), (t.pager || t.pagerAnchorBuilder) && e.fn.cycle.createPagerAnchor(n.length - 1, o, e(t.pager), n, t), e.isFunction(t.onAddSlide) ? t.onAddSlide(s) : s.hide()
        }
    }

    function d(i, c, s, o) {
        function r() {
            var e = 0;
            c.timeout;
            c.timeout && !c.continuous ? (e = h(i[c.currSlide], i[c.nextSlide], c, o), "shuffle" == c.fx && (e -= c.speedOut)) : c.continuous && l.cyclePause && (e = 10), e > 0 && (l.cycleTimeout = setTimeout(function () {
                d(i, c, 0, !c.backwards)
            }, e))
        }

        if (s && c.busy && c.manualTrump && (n("manualTrump in go(), stopping active transition"), e(i).stop(!0, !0), c.busy = 0), c.busy) return void n("transition active, ignoring new tx request");
        var l = c.$cont[0], a = i[c.currSlide], f = i[c.nextSlide];
        if (l.cycleStop == c.stopCount && (0 !== l.cycleTimeout || s)) {
            if (!s && !l.cyclePause && !c.bounce && (c.autostop && --c.countdown <= 0 || c.nowrap && !c.random && c.nextSlide < c.currSlide)) return void (c.end && c.end(c));
            var u = !1;
            if (!s && l.cyclePause || c.nextSlide == c.currSlide) r(); else {
                u = !0;
                var p = c.fx;
                a.cycleH = a.cycleH || e(a).height(), a.cycleW = a.cycleW || e(a).width(), f.cycleH = f.cycleH || e(f).height(), f.cycleW = f.cycleW || e(f).width(), c.multiFx && (o && (c.lastFx == t || ++c.lastFx >= c.fxs.length) ? c.lastFx = 0 : !o && (c.lastFx == t || --c.lastFx < 0) && (c.lastFx = c.fxs.length - 1), p = c.fxs[c.lastFx]), c.oneTimeFx && (p = c.oneTimeFx, c.oneTimeFx = null), e.fn.cycle.resetState(c, p), c.before.length && e.each(c.before, function (e, t) {
                    l.cycleStop == c.stopCount && t.apply(f, [a, f, c, o])
                });
                var m = function () {
                    c.busy = 0, e.each(c.after, function (e, t) {
                        l.cycleStop == c.stopCount && t.apply(f, [a, f, c, o])
                    }), l.cycleStop || r()
                };
                n("tx firing(" + p + "); currSlide: " + c.currSlide + "; nextSlide: " + c.nextSlide), c.busy = 1, c.fxFn ? c.fxFn(a, f, c, m, o, s && c.fastOnEvent) : e.isFunction(e.fn.cycle[c.fx]) ? e.fn.cycle[c.fx](a, f, c, m, o, s && c.fastOnEvent) : e.fn.cycle.custom(a, f, c, m, o, s && c.fastOnEvent)
            }
            if (u || c.nextSlide == c.currSlide) if (c.lastSlide = c.currSlide, c.random) c.currSlide = c.nextSlide, ++c.randomIndex == i.length && (c.randomIndex = 0, c.randomMap.sort(function (e, t) {
                return Math.random() - .5
            })), c.nextSlide = c.randomMap[c.randomIndex], c.nextSlide == c.currSlide && (c.nextSlide = c.currSlide == c.slideCount - 1 ? 0 : c.currSlide + 1); else if (c.backwards) {
                var y = c.nextSlide - 1 < 0;
                y && c.bounce ? (c.backwards = !c.backwards, c.nextSlide = 1, c.currSlide = 0) : (c.nextSlide = y ? i.length - 1 : c.nextSlide - 1, c.currSlide = y ? 0 : c.nextSlide + 1)
            } else {
                var y = c.nextSlide + 1 == i.length;
                y && c.bounce ? (c.backwards = !c.backwards, c.nextSlide = i.length - 2, c.currSlide = i.length - 1) : (c.nextSlide = y ? 0 : c.nextSlide + 1, c.currSlide = y ? i.length - 1 : c.nextSlide - 1)
            }
            u && c.pager && c.updateActivePagerLink(c.pager, c.currSlide, c.activePagerClass)
        }
    }

    function h(e, t, i, c) {
        if (i.timeoutFn) {
            for (var s = i.timeoutFn.call(e, e, t, i, c); "none" != i.fx && s - i.speed < 250;) s += i.speed;
            if (n("calculated timeout: " + s + "; speed: " + i.speed), s !== !1) return s
        }
        return i.timeout
    }

    function m(t, n) {
        var i = n ? 1 : -1, c = t.elements, s = t.$cont[0], o = s.cycleTimeout;
        if (o && (clearTimeout(o), s.cycleTimeout = 0), t.random && 0 > i) t.randomIndex--, -2 == --t.randomIndex ? t.randomIndex = c.length - 2 : -1 == t.randomIndex && (t.randomIndex = c.length - 1), t.nextSlide = t.randomMap[t.randomIndex]; else if (t.random) t.nextSlide = t.randomMap[t.randomIndex]; else if (t.nextSlide = t.currSlide + i, t.nextSlide < 0) {
            if (t.nowrap) return !1;
            t.nextSlide = c.length - 1
        } else if (t.nextSlide >= c.length) {
            if (t.nowrap) return !1;
            t.nextSlide = 0
        }
        var r = t.onPrevNextEvent || t.prevNextClick;
        return e.isFunction(r) && r(i > 0, t.nextSlide, c[t.nextSlide]), d(c, t, 1, n), !1
    }

    function y(t, n) {
        var i = e(n.pager);
        e.each(t, function (c, s) {
            e.fn.cycle.createPagerAnchor(c, s, i, t, n)
        }), n.updateActivePagerLink(n.pager, n.startingSlide, n.activePagerClass)
    }

    function g(t) {
        function i(e) {
            return e = parseInt(e, 10).toString(16), e.length < 2 ? "0" + e : e
        }

        function c(t) {
            for (; t && "html" != t.nodeName.toLowerCase(); t = t.parentNode) {
                var n = e.css(t, "background-color");
                if (n && n.indexOf("rgb") >= 0) {
                    var c = n.match(/\d+/g);
                    return "#" + i(c[0]) + i(c[1]) + i(c[2])
                }
                if (n && "transparent" != n) return n
            }
            return "#ffffff"
        }

        n("applying clearType background-color hack"), t.each(function () {
            e(this).css("background-color", c(this))
        })
    }

    var x = "2.9998";
    e.support == t && (e.support = {opacity: !e.browser.msie}), e.expr[":"].paused = function (e) {
        return e.cyclePause
    }, e.fn.cycle = function (t, c) {
        var o = {s: this.selector, c: this.context};
        return 0 === this.length && "stop" != t ? !e.isReady && o.s ? (i("DOM not ready, queuing slideshow"), e(function () {
            e(o.s, o.c).cycle(t, c)
        }), this) : (i("terminating; zero elements found by selector" + (e.isReady ? "" : " (DOM not ready)")), this) : this.each(function () {
            var r = s(this, t, c);
            if (r !== !1) {
                r.updateActivePagerLink = r.updateActivePagerLink || e.fn.cycle.updateActivePagerLink, this.cycleTimeout && clearTimeout(this.cycleTimeout), this.cycleTimeout = this.cyclePause = 0;
                var a = e(this), f = r.slideExpr ? e(r.slideExpr, this) : a.children(), u = f.get(),
                    p = l(a, f, u, r, o);
                if (p !== !1) {
                    if (u.length < 2) return void i("terminating; too few slides: " + u.length);
                    var m = p.continuous ? 10 : h(u[p.currSlide], u[p.nextSlide], p, !p.backwards);
                    m && (m += p.delay || 0, 10 > m && (m = 10), n("first timeout: " + m), this.cycleTimeout = setTimeout(function () {
                        d(u, p, 0, !r.backwards)
                    }, m))
                }
            }
        })
    }, e.fn.cycle.resetState = function (t, n) {
        n = n || t.fx, t.before = [], t.after = [], t.cssBefore = e.extend({}, t.original.cssBefore), t.cssAfter = e.extend({}, t.original.cssAfter), t.animIn = e.extend({}, t.original.animIn), t.animOut = e.extend({}, t.original.animOut), t.fxFn = null, e.each(t.original.before, function () {
            t.before.push(this)
        }), e.each(t.original.after, function () {
            t.after.push(this)
        });
        var i = e.fn.cycle.transitions[n];
        e.isFunction(i) && i(t.$cont, e(t.elements), t)
    }, e.fn.cycle.updateActivePagerLink = function (t, n, i) {
        e(t).each(function () {
            e(this).children().removeClass(i).eq(n).addClass(i)
        })
    }, e.fn.cycle.next = function (e) {
        m(e, 1)
    }, e.fn.cycle.prev = function (e) {
        m(e, 0)
    }, e.fn.cycle.createPagerAnchor = function (t, i, s, o, r) {
        var l;
        if (e.isFunction(r.pagerAnchorBuilder) ? (l = r.pagerAnchorBuilder(t, i), n("pagerAnchorBuilder(" + t + ", el) returned: " + l)) : l = '<a href="#">' + (t + 1) + "</a>", l) {
            var a = e(l);
            if (0 === a.parents("body").length) {
                var f = [];
                s.length > 1 ? (s.each(function () {
                    var t = a.clone(!0);
                    e(this).append(t), f.push(t[0])
                }), a = e(f)) : a.appendTo(s)
            }
            r.pagerAnchors = r.pagerAnchors || [], r.pagerAnchors.push(a);
            var u = function (n) {
                n.preventDefault(), r.nextSlide = t;
                var i = r.$cont[0], c = i.cycleTimeout;
                c && (clearTimeout(c), i.cycleTimeout = 0);
                var s = r.onPagerEvent || r.pagerClick;
                e.isFunction(s) && s(r.nextSlide, o[r.nextSlide]), d(o, r, 1, r.currSlide < t)
            };
            /mouseenter|mouseover/i.test(r.pagerEvent) ? a.hover(u, function () {
            }) : a.bind(r.pagerEvent, u), /^click/.test(r.pagerEvent) || r.allowPagerClickBubble || a.bind("click.cycle", function () {
                return !1
            });
            var h = r.$cont[0], p = !1;
            r.pauseOnPagerHover && a.hover(function () {
                p = !0, h.cyclePause++, c(h, !0, !0)
            }, function () {
                p && h.cyclePause--, c(h, !0, !0)
            })
        }
    }, e.fn.cycle.hopsFromLast = function (e, t) {
        var n, i = e.lastSlide, c = e.currSlide;
        return n = t ? c > i ? c - i : e.slideCount - i : i > c ? i - c : i + e.slideCount - c
    }, e.fn.cycle.commonReset = function (t, n, i, c, s, o) {
        e(i.elements).not(t).hide(), "undefined" == typeof i.cssBefore.opacity && (i.cssBefore.opacity = 1), i.cssBefore.display = "block", i.slideResize && c !== !1 && n.cycleW > 0 && (i.cssBefore.width = n.cycleW), i.slideResize && s !== !1 && n.cycleH > 0 && (i.cssBefore.height = n.cycleH), i.cssAfter = i.cssAfter || {}, i.cssAfter.display = "none", e(t).css("zIndex", i.slideCount + (o === !0 ? 1 : 0)), e(n).css("zIndex", i.slideCount + (o === !0 ? 0 : 1))
    }, e.fn.cycle.custom = function (t, n, i, c, s, o) {
        var r = e(t), l = e(n), a = i.speedIn, f = i.speedOut, u = i.easeIn, d = i.easeOut;
        l.css(i.cssBefore), o && (a = f = "number" == typeof o ? o : 1, u = d = null);
        var h = function () {
            l.animate(i.animIn, a, u, function () {
                c()
            })
        };
        r.animate(i.animOut, f, d, function () {
            r.css(i.cssAfter), i.sync || h()
        }), i.sync && h()
    }, e.fn.cycle.transitions = {
        fade: function (t, n, i) {
            n.not(":eq(" + i.currSlide + ")").css("opacity", 0), i.before.push(function (t, n, i) {
                e.fn.cycle.commonReset(t, n, i), i.cssBefore.opacity = 0
            }), i.animIn = {opacity: 1}, i.animOut = {opacity: 0}, i.cssBefore = {top: 0, left: 0}
        }
    }, e.fn.cycle.ver = function () {
        return x
    }, e.fn.cycle.defaults = {
        activePagerClass: "activeSlide",
        after: null,
        allowPagerClickBubble: !1,
        animIn: null,
        animOut: null,
        aspect: !1,
        autostop: 0,
        autostopCount: 0,
        backwards: !1,
        before: null,
        center: null,
        cleartype: !e.support.opacity,
        cleartypeNoBg: !1,
        containerResize: 1,
        continuous: 0,
        cssAfter: null,
        cssBefore: null,
        delay: 0,
        easeIn: null,
        easeOut: null,
        easing: null,
        end: null,
        fastOnEvent: 0,
        fit: 0,
        fx: "fade",
        fxFn: null,
        height: "auto",
        manualTrump: !0,
        metaAttr: "cycle",
        next: null,
        nowrap: 0,
        onPagerEvent: null,
        onPrevNextEvent: null,
        pager: null,
        pagerAnchorBuilder: null,
        pagerEvent: "click.cycle",
        pause: 0,
        pauseOnPagerHover: 0,
        prev: null,
        prevNextEvent: "click.cycle",
        random: 0,
        randomizeEffects: 1,
        requeueOnImageNotLoaded: !0,
        requeueTimeout: 250,
        rev: 0,
        shuffle: null,
        skipInitializationCallbacks: !1,
        slideExpr: null,
        slideResize: 1,
        speed: 1e3,
        speedIn: null,
        speedOut: null,
        startingSlide: 0,
        sync: 1,
        timeout: 4e3,
        timeoutFn: null,
        updateActivePagerLink: null,
        width: null
    }
}(jQuery), function (e) {
    e.fn.cycle.transitions.none = function (t, n, i) {
        i.fxFn = function (t, n, i, c) {
            e(n).show(), e(t).hide(), c()
        }
    }, e.fn.cycle.transitions.fadeout = function (t, n, i) {
        n.not(":eq(" + i.currSlide + ")").css({
            display: "block",
            opacity: 1
        }), i.before.push(function (t, n, i, c, s, o) {
            e(t).css("zIndex", i.slideCount + (!o == !0 ? 1 : 0)), e(n).css("zIndex", i.slideCount + (!o == !0 ? 0 : 1))
        }), i.animIn.opacity = 1, i.animOut.opacity = 0, i.cssBefore.opacity = 1, i.cssBefore.display = "block", i.cssAfter.zIndex = 0
    }, e.fn.cycle.transitions.scrollUp = function (t, n, i) {
        t.css("overflow", "hidden"), i.before.push(e.fn.cycle.commonReset);
        var c = t.height();
        i.cssBefore.top = c, i.cssBefore.left = 0, i.cssFirst.top = 0, i.animIn.top = 0, i.animOut.top = -c
    }, e.fn.cycle.transitions.scrollDown = function (t, n, i) {
        t.css("overflow", "hidden"), i.before.push(e.fn.cycle.commonReset);
        var c = t.height();
        i.cssFirst.top = 0, i.cssBefore.top = -c, i.cssBefore.left = 0, i.animIn.top = 0, i.animOut.top = c
    }, e.fn.cycle.transitions.scrollLeft = function (t, n, i) {
        t.css("overflow", "hidden"), i.before.push(e.fn.cycle.commonReset);
        var c = t.width();
        i.cssFirst.left = 0, i.cssBefore.left = c, i.cssBefore.top = 0, i.animIn.left = 0, i.animOut.left = 0 - c
    }, e.fn.cycle.transitions.scrollRight = function (t, n, i) {
        t.css("overflow", "hidden"), i.before.push(e.fn.cycle.commonReset);
        var c = t.width();
        i.cssFirst.left = 0, i.cssBefore.left = -c, i.cssBefore.top = 0, i.animIn.left = 0, i.animOut.left = c
    }, e.fn.cycle.transitions.scrollHorz = function (t, n, i) {
        t.css("overflow", "hidden").width(), i.before.push(function (t, n, i, c) {
            i.rev && (c = !c), e.fn.cycle.commonReset(t, n, i), i.cssBefore.left = c ? n.cycleW - 1 : 1 - n.cycleW, i.animOut.left = c ? -t.cycleW : t.cycleW
        }), i.cssFirst.left = 0, i.cssBefore.top = 0, i.animIn.left = 0, i.animOut.top = 0
    }, e.fn.cycle.transitions.scrollVert = function (t, n, i) {
        t.css("overflow", "hidden"), i.before.push(function (t, n, i, c) {
            i.rev && (c = !c), e.fn.cycle.commonReset(t, n, i), i.cssBefore.top = c ? 1 - n.cycleH : n.cycleH - 1, i.animOut.top = c ? t.cycleH : -t.cycleH
        }), i.cssFirst.top = 0, i.cssBefore.left = 0, i.animIn.top = 0, i.animOut.left = 0
    }, e.fn.cycle.transitions.slideX = function (t, n, i) {
        i.before.push(function (t, n, i) {
            e(i.elements).not(t).hide(), e.fn.cycle.commonReset(t, n, i, !1, !0), i.animIn.width = n.cycleW
        }), i.cssBefore.left = 0, i.cssBefore.top = 0, i.cssBefore.width = 0, i.animIn.width = "show", i.animOut.width = 0
    }, e.fn.cycle.transitions.slideY = function (t, n, i) {
        i.before.push(function (t, n, i) {
            e(i.elements).not(t).hide(), e.fn.cycle.commonReset(t, n, i, !0, !1), i.animIn.height = n.cycleH
        }), i.cssBefore.left = 0, i.cssBefore.top = 0, i.cssBefore.height = 0, i.animIn.height = "show", i.animOut.height = 0
    }, e.fn.cycle.transitions.shuffle = function (t, n, i) {
        var c, s = t.css("overflow", "visible").width();
        for (n.css({left: 0, top: 0}), i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !0, !0, !0)
        }), i.speedAdjusted || (i.speed = i.speed / 2, i.speedAdjusted = !0), i.random = 0, i.shuffle = i.shuffle || {
            left: -s,
            top: 15
        }, i.els = [], c = 0; c < n.length; c++) i.els.push(n[c]);
        for (c = 0; c < i.currSlide; c++) i.els.push(i.els.shift());
        i.fxFn = function (t, n, i, c, s) {
            i.rev && (s = !s);
            var o = e(s ? t : n);
            e(n).css(i.cssBefore);
            var r = i.slideCount;
            o.animate(i.shuffle, i.speedIn, i.easeIn, function () {
                for (var n = e.fn.cycle.hopsFromLast(i, s), l = 0; n > l; l++) s ? i.els.push(i.els.shift()) : i.els.unshift(i.els.pop());
                if (s) for (var a = 0, f = i.els.length; f > a; a++) e(i.els[a]).css("z-index", f - a + r); else {
                    var u = e(t).css("z-index");
                    o.css("z-index", parseInt(u, 10) + 1 + r)
                }
                o.animate({left: 0, top: 0}, i.speedOut, i.easeOut, function () {
                    e(s ? this : t).hide(), c && c()
                })
            })
        }, e.extend(i.cssBefore, {display: "block", opacity: 1, top: 0, left: 0})
    }, e.fn.cycle.transitions.turnUp = function (t, n, i) {
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !0, !1), i.cssBefore.top = n.cycleH, i.animIn.height = n.cycleH, i.animOut.width = n.cycleW
        }), i.cssFirst.top = 0, i.cssBefore.left = 0, i.cssBefore.height = 0, i.animIn.top = 0, i.animOut.height = 0
    }, e.fn.cycle.transitions.turnDown = function (t, n, i) {
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !0, !1), i.animIn.height = n.cycleH, i.animOut.top = t.cycleH
        }), i.cssFirst.top = 0, i.cssBefore.left = 0, i.cssBefore.top = 0, i.cssBefore.height = 0, i.animOut.height = 0
    }, e.fn.cycle.transitions.turnLeft = function (t, n, i) {
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !1, !0), i.cssBefore.left = n.cycleW, i.animIn.width = n.cycleW
        }), i.cssBefore.top = 0, i.cssBefore.width = 0, i.animIn.left = 0, i.animOut.width = 0
    }, e.fn.cycle.transitions.turnRight = function (t, n, i) {
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !1, !0), i.animIn.width = n.cycleW, i.animOut.left = t.cycleW
        }), e.extend(i.cssBefore, {top: 0, left: 0, width: 0}), i.animIn.left = 0, i.animOut.width = 0
    }, e.fn.cycle.transitions.zoom = function (t, n, i) {
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !1, !1, !0), i.cssBefore.top = n.cycleH / 2, i.cssBefore.left = n.cycleW / 2, e.extend(i.animIn, {
                top: 0,
                left: 0,
                width: n.cycleW,
                height: n.cycleH
            }), e.extend(i.animOut, {width: 0, height: 0, top: t.cycleH / 2, left: t.cycleW / 2})
        }), i.cssFirst.top = 0, i.cssFirst.left = 0, i.cssBefore.width = 0, i.cssBefore.height = 0
    }, e.fn.cycle.transitions.fadeZoom = function (t, n, i) {
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !1, !1), i.cssBefore.left = n.cycleW / 2, i.cssBefore.top = n.cycleH / 2, e.extend(i.animIn, {
                top: 0,
                left: 0,
                width: n.cycleW,
                height: n.cycleH
            })
        }), i.cssBefore.width = 0, i.cssBefore.height = 0, i.animOut.opacity = 0
    }, e.fn.cycle.transitions.blindX = function (t, n, i) {
        var c = t.css("overflow", "hidden").width();
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i), i.animIn.width = n.cycleW, i.animOut.left = t.cycleW
        }), i.cssBefore.left = c, i.cssBefore.top = 0, i.animIn.left = 0, i.animOut.left = c
    }, e.fn.cycle.transitions.blindY = function (t, n, i) {
        var c = t.css("overflow", "hidden").height();
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i), i.animIn.height = n.cycleH, i.animOut.top = t.cycleH
        }), i.cssBefore.top = c, i.cssBefore.left = 0, i.animIn.top = 0, i.animOut.top = c
    }, e.fn.cycle.transitions.blindZ = function (t, n, i) {
        var c = t.css("overflow", "hidden").height(), s = t.width();
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i), i.animIn.height = n.cycleH, i.animOut.top = t.cycleH
        }), i.cssBefore.top = c, i.cssBefore.left = s, i.animIn.top = 0, i.animIn.left = 0, i.animOut.top = c, i.animOut.left = s
    }, e.fn.cycle.transitions.growX = function (t, n, i) {
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !1, !0), i.cssBefore.left = this.cycleW / 2, i.animIn.left = 0, i.animIn.width = this.cycleW, i.animOut.left = 0
        }), i.cssBefore.top = 0, i.cssBefore.width = 0
    }, e.fn.cycle.transitions.growY = function (t, n, i) {
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !0, !1), i.cssBefore.top = this.cycleH / 2, i.animIn.top = 0, i.animIn.height = this.cycleH, i.animOut.top = 0
        }), i.cssBefore.height = 0, i.cssBefore.left = 0
    }, e.fn.cycle.transitions.curtainX = function (t, n, i) {
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !1, !0, !0), i.cssBefore.left = n.cycleW / 2, i.animIn.left = 0, i.animIn.width = this.cycleW, i.animOut.left = t.cycleW / 2, i.animOut.width = 0
        }), i.cssBefore.top = 0, i.cssBefore.width = 0
    }, e.fn.cycle.transitions.curtainY = function (t, n, i) {
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !0, !1, !0), i.cssBefore.top = n.cycleH / 2, i.animIn.top = 0, i.animIn.height = n.cycleH, i.animOut.top = t.cycleH / 2, i.animOut.height = 0
        }), i.cssBefore.height = 0, i.cssBefore.left = 0
    }, e.fn.cycle.transitions.cover = function (t, n, i) {
        var c = i.direction || "left", s = t.css("overflow", "hidden").width(), o = t.height();
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i), "right" == c ? i.cssBefore.left = -s : "up" == c ? i.cssBefore.top = o : "down" == c ? i.cssBefore.top = -o : i.cssBefore.left = s
        }), i.animIn.left = 0, i.animIn.top = 0, i.cssBefore.top = 0, i.cssBefore.left = 0
    }, e.fn.cycle.transitions.uncover = function (t, n, i) {
        var c = i.direction || "left", s = t.css("overflow", "hidden").width(), o = t.height();
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !0, !0, !0), "right" == c ? i.animOut.left = s : "up" == c ? i.animOut.top = -o : "down" == c ? i.animOut.top = o : i.animOut.left = -s
        }), i.animIn.left = 0, i.animIn.top = 0, i.cssBefore.top = 0, i.cssBefore.left = 0
    }, e.fn.cycle.transitions.toss = function (t, n, i) {
        var c = t.css("overflow", "visible").width(), s = t.height();
        i.before.push(function (t, n, i) {
            e.fn.cycle.commonReset(t, n, i, !0, !0, !0), i.animOut.left || i.animOut.top ? i.animOut.opacity = 0 : e.extend(i.animOut, {
                left: 2 * c,
                top: -s / 2,
                opacity: 0
            })
        }), i.cssBefore.left = 0, i.cssBefore.top = 0, i.animIn.left = 0
    }, e.fn.cycle.transitions.wipe = function (t, n, i) {
        var c = t.css("overflow", "hidden").width(), s = t.height();
        i.cssBefore = i.cssBefore || {};
        var o;
        if (i.clip) if (/l2r/.test(i.clip)) o = "rect(0px 0px " + s + "px 0px)"; else if (/r2l/.test(i.clip)) o = "rect(0px " + c + "px " + s + "px " + c + "px)"; else if (/t2b/.test(i.clip)) o = "rect(0px " + c + "px 0px 0px)"; else if (/b2t/.test(i.clip)) o = "rect(" + s + "px " + c + "px " + s + "px 0px)"; else if (/zoom/.test(i.clip)) {
            var r = parseInt(s / 2, 10), l = parseInt(c / 2, 10);
            o = "rect(" + r + "px " + l + "px " + r + "px " + l + "px)"
        }
        i.cssBefore.clip = i.cssBefore.clip || o || "rect(0px 0px 0px 0px)";
        var a = i.cssBefore.clip.match(/(\d+)/g), f = parseInt(a[0], 10), u = parseInt(a[1], 10),
            d = parseInt(a[2], 10), h = parseInt(a[3], 10);
        i.before.push(function (t, n, i) {
            if (t != n) {
                var o = e(t), r = e(n);
                e.fn.cycle.commonReset(t, n, i, !0, !0, !1), i.cssAfter.display = "block";
                var l = 1, a = parseInt(i.speedIn / 13, 10) - 1;
                !function p() {
                    var e = f ? f - parseInt(l * (f / a), 10) : 0, t = h ? h - parseInt(l * (h / a), 10) : 0,
                        n = s > d ? d + parseInt(l * ((s - d) / a || 1), 10) : s,
                        i = c > u ? u + parseInt(l * ((c - u) / a || 1), 10) : c;
                    r.css({clip: "rect(" + e + "px " + i + "px " + n + "px " + t + "px)"}), l++ <= a ? setTimeout(p, 13) : o.css("display", "none")
                }()
            }
        }), e.extend(i.cssBefore, {
            display: "block",
            opacity: 1,
            top: 0,
            left: 0
        }), i.animIn = {left: 0}, i.animOut = {left: 0}
    }
}(jQuery);

/*	--------------------------------------------------------------------
	MaxImage 2.0 (Fullscreen Slideshow for use with jQuery Cycle Plugin)
	--------------------------------------------------------------------

	Examples and documentation at: http://www.aaronvanderzwan.com/maximage/2.0/
	Copyright (c) 2007-2012 Aaron Vanderzwan
	Dual licensed under the MIT and GPL licenses.

	NOTES:
	This plugin is intended to simplify the creation of fullscreen
	background slideshows.  It is intended to be used alongside the
	jQuery Cycle plugin:
	http://jquery.malsup.com/cycle/

	If you simply need a fullscreen background image, please
	refer to the following document for ways to do this that
	are much more simple:
	http://css-tricks.com/perfect-full-page-background-image/

	If you have any questions please contact Aaron Vanderzwan
	at http://www.aaronvanderzwan.com/blog/
	Documentation at:
	http://blog.aaronvanderzwan.com/2012/07/maximage-2-0/

	HISTORY:
	MaxImage 2.0 is a project first built as jQuery MaxImage Plugin
	(http://www.aaronvanderzwan.com/maximage/). Once CSS3 came along,
	the background-size:cover solved the problem MaxImage
	was intended to solve.  However, fully customizable
	fullscreen slideshows is still fairly complex and I have not
	found any helpers for integrating with the jQuery Cycle Plugin.
	MaxCycle is intended to solve this problem.

	TABLE OF CONTENTS:
	@Modern
		@setup
		@resize
		@preload
	@Old
		@setup
		@preload
		@onceloaded
		@maximage
		@windowresize
		@doneresizing
	@Cycle
		@setup
	@Adjust
		@center
		@fill
		@maxcover
		@maxcontain
	@Utils
		@browser_tests
		@construct_slide_object
		@sizes
	@modern_browser
	@debug

*/
/*!
 * Maximage Version: 2.0.8 (16-Jan-2012) - http://www.aaronvanderzwan.com/maximage/2.0/
 */

!function (e) {
    "use strict";
    e.fn.maximage = function (i, t) {
        function a(e) {
            window.console && window.console.log && window.console.log(e)
        }

        var d;
        ("object" == typeof i || void 0 === i) && (d = e.extend(e.fn.maximage.defaults, i || {})), "string" == typeof i && (d = e.fn.maximage.defaults), e.Body = e("body"), e.Window = e(window), e.Scroll = e("html, body"), e.Events = {RESIZE: "resize"}, this.each(function () {
            var t = e(this), n = 0, s = [], o = {
                setup: function () {
                    if (e.Slides.length > 0) {
                        var i, a = e.Slides.length;
                        for (i = 0; a > i; i++) {
                            var d = e.Slides[i];
                            t.append('<div class="mc-image ' + d.theclass + '" title="' + d.alt + '" style="background-image:url(\'' + d.url + "');" + d.style + '" data-href="' + d.datahref + '">' + d.content + "</div>")
                        }
                        o.preload(0), o.resize()
                    }
                }, preload: function (i) {
                    var a = e("<img/>");
                    a.on("load", function () {
                        0 == n && (c.setup(), d.onFirstImageLoaded()), n == e.Slides.length - 1 ? d.onImagesLoaded(t) : (n++, o.preload(n))
                    }), a[0].src = e.Slides[i].url, s.push(a[0])
                }, resize: function () {
                    e.Window.bind(e.Events.RESIZE, function () {
                        e.Scroll.addClass("mc-hide-scrolls"), e.Window.data("h", h.sizes().h).data("w", h.sizes().w), t.height(e.Window.data("h")).width(e.Window.data("w")).children().height(e.Window.data("h")).width(e.Window.data("w")), t.children().each(function () {
                            this.cycleH = e.Window.data("h"), this.cycleW = e.Window.data("w")
                        }), e(e.Scroll).removeClass("mc-hide-scrolls")
                    })
                }
            }, r = {
                setup: function () {
                    var i, a, n, s = e.Slides.length;
                    if (e.BrowserTests.msie && !d.overrideMSIEStop && document.execCommand("Stop", !1), t.html(""), e.Body.addClass("mc-old-browser"), e.Slides.length > 0) {
                        for (e.Scroll.addClass("mc-hide-scrolls"), e.Window.data("h", h.sizes().h).data("w", h.sizes().w), e("body").append(e("<div></div>").attr("class", "mc-loader").css({
                            position: "absolute",
                            left: "-9999px"
                        })), n = 0; s > n; n++) i = 0 == e.Slides[n].content.length ? '<img src="' + e.Slides[n].url + '" />' : e.Slides[n].content, a = e("<div>" + i + "</div>").attr("class", "mc-image mc-image-n" + n + " " + e.Slides[n].theclass), t.append(a), 0 == e(".mc-image-n" + n).children("img").length || e("div.mc-loader").append(e(".mc-image-n" + n).children("img").first().clone().addClass("not-loaded"));
                        r.preload(), r.windowResize()
                    }
                }, preload: function () {
                    var i = setInterval(function () {
                        e(".mc-loader").children("img").each(function (i) {
                            var t = e(this);
                            if (t.hasClass("not-loaded") && t.height() > 0) {
                                e(this).removeClass("not-loaded");
                                var a = e("div.mc-image-n" + i).children("img").first();
                                a.data("h", t.height()).data("w", t.width()).data("ar", t.width() / t.height()), r.onceLoaded(i)
                            }
                        }), 0 == e(".not-loaded").length && (e(".mc-loader").remove(), clearInterval(i))
                    }, 1e3)
                }, onceLoaded: function (i) {
                    r.maximage(i), 0 == i ? (t.css({visibility: "visible"}), d.onFirstImageLoaded()) : i == e.Slides.length - 1 && (c.setup(), e(e.Scroll).removeClass("mc-hide-scrolls"), d.onImagesLoaded(t), d.debug && (a(" - Final Maximage - "), a(t)))
                }, maximage: function (i) {
                    e("div.mc-image-n" + i).height(e.Window.data("h")).width(e.Window.data("w")).children("img").first().each(function () {
                        l.maxcover(e(this))
                    })
                }, windowResize: function () {
                    e.Window.bind(e.Events.RESIZE, function () {
                        clearTimeout(this.id), e(".mc-image").length >= 1 && (this.id = setTimeout(r.doneResizing, 200))
                    })
                }, doneResizing: function () {
                    e(e.Scroll).addClass("mc-hide-scrolls"), e.Window.data("h", h.sizes().h).data("w", h.sizes().w), t.height(e.Window.data("h")).width(e.Window.data("w")), t.find(".mc-image").each(function (e) {
                        r.maximage(e)
                    });
                    var i = t.data("cycle.opts");
                    void 0 != i && (i.height = e.Window.data("h"), i.width = e.Window.data("w"), jQuery.each(i.elements, function (i, t) {
                        t.cycleW = e.Window.data("w"), t.cycleH = e.Window.data("h")
                    })), e(e.Scroll).removeClass("mc-hide-scrolls")
                }
            }, c = {
                setup: function () {
                    t.addClass("mc-cycle"), e.Window.data("h", h.sizes().h).data("w", h.sizes().w), jQuery.easing.easeForCSSTransition = function (e, i, t, a, d, n) {
                        return t + a
                    };
                    var i = e.extend({
                        fit: 1,
                        containerResize: 0,
                        height: e.Window.data("h"),
                        width: e.Window.data("w"),
                        slideResize: !1,
                        easing: e.BrowserTests.cssTransitions && d.cssTransitions ? "easeForCSSTransition" : "swing"
                    }, d.cycleOptions);
                    t.cycle(i)
                }
            }, l = {
                center: function (i) {
                    d.verticalCenter && i.css({marginTop: (i.height() - e.Window.data("h")) / 2 * -1}), d.horizontalCenter && i.css({marginLeft: (i.width() - e.Window.data("w")) / 2 * -1})
                }, fill: function (i) {
                    var t = i.is("object") ? i.parent().first() : i;
                    "function" == typeof d.backgroundSize ? d.backgroundSize(i) : "cover" == d.backgroundSize ? e.Window.data("w") / e.Window.data("h") < t.data("ar") ? i.height(e.Window.data("h")).width((e.Window.data("h") * t.data("ar")).toFixed(0)) : i.height((e.Window.data("w") / t.data("ar")).toFixed(0)).width(e.Window.data("w")) : "contain" == d.backgroundSize ? e.Window.data("w") / e.Window.data("h") < t.data("ar") ? i.height((e.Window.data("w") / t.data("ar")).toFixed(0)).width(e.Window.data("w")) : i.height(e.Window.data("h")).width((e.Window.data("h") * t.data("ar")).toFixed(0)) : a("The backgroundSize option was not recognized for older browsers.")
                }, maxcover: function (e) {
                    l.fill(e), l.center(e)
                }, maxcontain: function (e) {
                    l.fill(e), l.center(e)
                }
            }, h = {
                browser_tests: function () {
                    var i = e("<div />")[0], t = ["Moz", "Webkit", "Khtml", "O", "ms"], n = "transition", s = {
                        cssTransitions: !1,
                        cssBackgroundSize: "backgroundSize" in i.style && d.cssBackgroundSize,
                        html5Video: !1,
                        msie: !1
                    };
                    if (d.cssTransitions) {
                        "string" == typeof i.style[n] && (s.cssTransitions = !0), n = n.charAt(0).toUpperCase() + n.substr(1);
                        for (var o = 0; o < t.length; o++) t[o] + n in i.style && (s.cssTransitions = !0)
                    }
                    return document.createElement("video").canPlayType && (s.html5Video = !0), s.msie = void 0 !== h.msie(), d.debug && (a(" - Browser Test - "), a(s)), s
                }, construct_slide_object: function () {
                    var i = new Object, n = new Array;
                    return t.children().each(function (t) {
                        var a = e(this).is("img") ? e(this).clone() : e(this).find("img").first().clone();
                        i = {}, i.url = a.attr("src"), i.title = void 0 != a.attr("title") ? a.attr("title") : "", i.alt = void 0 != a.attr("alt") ? a.attr("alt") : "", i.theclass = void 0 != a.attr("class") ? a.attr("class") : "", i.styles = void 0 != a.attr("style") ? a.attr("style") : "", i.orig = a.clone(), i.datahref = void 0 != a.attr("data-href") ? a.attr("data-href") : "", i.content = "", e(this).find("img").length > 0 && (e.BrowserTests.cssBackgroundSize && e(this).find("img").first().remove(), i.content = e(this).html()), a[0].src = "", e.BrowserTests.cssBackgroundSize && e(this).remove(), n.push(i)
                    }), d.debug && (a(" - Slide Object - "), a(n)), n
                }, msie: function () {
                    for (var e, i = 3, t = document.createElement("div"), a = t.getElementsByTagName("i"); t.innerHTML = "<!--[if gt IE " + ++i + "]><i></i><![endif]-->", a[0];) ;
                    return i > 4 ? i : e
                }, sizes: function () {
                    var i = {h: 0, w: 0};
                    if ("window" == d.fillElement) i.h = e.Window.height(), i.w = e.Window.width(); else {
                        var a = t.parents(d.fillElement).first();
                        0 == a.height() || 1 == a.data("windowHeight") ? (a.data("windowHeight", !0), i.h = e.Window.height()) : i.h = a.height(), 0 == a.width() || 1 == a.data("windowWidth") ? (a.data("windowWidth", !0), i.w = e.Window.width()) : i.w = a.width()
                    }
                    return i
                }
            };
            if (e.BrowserTests = h.browser_tests(), "string" == typeof i) {
                if (e.BrowserTests.html5Video || !t.is("video")) {
                    var w, g = t.is("object") ? t.parent().first() : t;
                    e.Body.hasClass("mc-old-browser") || e.Body.addClass("mc-old-browser"), e.Window.data("h", h.sizes().h).data("w", h.sizes().w), g.data("h", t.height()).data("w", t.width()).data("ar", t.width() / t.height()), e.Window.bind(e.Events.RESIZE, function () {
                        e.Window.data("h", h.sizes().h).data("w", h.sizes().w), w = t.data("resizer"), clearTimeout(w), w = setTimeout(l[i](t), 200), t.data("resizer", w)
                    }), l[i](t)
                }
            } else e.Slides = h.construct_slide_object(), e.BrowserTests.cssBackgroundSize ? (d.debug && a(" - Using Modern - "), o.setup()) : (d.debug && a(" - Using Old - "), r.setup())
        })
    }, e.fn.maximage.defaults = {
        debug: !1,
        cssBackgroundSize: !0,
        cssTransitions: !0,
        verticalCenter: !0,
        horizontalCenter: !0,
        scaleInterval: 20,
        backgroundSize: "cover",
        fillElement: "window",
        overrideMSIEStop: !1,
        onFirstImageLoaded: function () {
        },
        onImagesLoaded: function () {
        }
    }
}(jQuery);


/* ----- Switch Pricing Table Home Layout 2 ----- */
function check() {
    var checkBox = document.getElementById("checbox");
    var text1 = document.getElementsByClassName("text1");
    var text2 = document.getElementsByClassName("text2");
    for (var i = 0; i < text1.length; i++) {
        if (checkBox.checked == true) {
            text1[i].style.display = "block";
            text2[i].style.display = "none";
        } else if (checkBox.checked == false) {
            text1[i].style.display = "none";
            text2[i].style.display = "block";
        }
    }
}

check();


/* ----- Range Slider With Tooltip Start "Simple Animated Slider Control Plugin With jQuery - addSlider"  ----- */
function generateGUID() {
    do var e = "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (e) {
        var n = 16 * Math.random() | 0, t = "x" == e ? n : 3 & n | 8;
        return t.toString(16)
    }); while (GUIDList.indexOf(e) > -1);
    return e
}

function toFunc(e) {
    if ("function" == typeof e) return e;
    if ("string" == typeof e) {
        if (void 0 != window[e] && "function" == typeof window[e]) return window[e];
        try {
            return new Function(e)
        } catch (n) {
        }
    }
    return function () {
        return e
    }
}

function Obj() {
    this._parent = null, this._handlers = [], this._onceHandlers = [], this._elements = $(), this.guid = generateGUID(), this.on = function (e, n) {
        "function" == typeof e && void 0 === n && (n = e, e = "all"), e = e.toLowerCase().split(" ");
        for (var t = 0; t < e.length; t++) this._handlers.push({event: e[t], handler: n});
        return this
    }, this.once = function (e, n) {
        "function" == typeof e && void 0 === n && (n = e, e = "all"), e = e.toLowerCase().split(" ");
        for (var t = 0; t < e.length; t++) this._onceHandlers.push({event: e[t], handler: n});
        return this
    }, this.off = function (e, n) {
        if (void 0 === n && "function" == typeof e) for (var n = e, t = 0; t < this._handlers.length; t++) this._handlers[t].handler == n && this._handlers.splice(t--, 1); else if (void 0 === n && "string" == typeof e) {
            e = e.toLowerCase().split(" ");
            for (var t = 0; t < this._handlers.length; t++) e.indexOf(this._handlers[t].event) > -1 && this._handlers.splice(t--, 1)
        } else {
            e = e.toLowerCase().split(" ");
            for (var t = 0; t < this._handlers.length; t++) e.indexOf(this._handlers[t].event) > -1 && this._handlers[t].handler == n && this._handlers.splice(t--, 1)
        }
        return this
    }, this.offOnce = function (e, n) {
        if (void 0 === n && "function" == typeof e) for (var n = e, t = 0; t < this._onceHandlers.length; t++) this._onceHandlers[t].handler == n && this._onceHandlers.splice(t--, 1); else if (void 0 === n && "string" == typeof e) {
            e = e.toLowerCase().split(" ");
            for (var t = 0; t < this._onceHandlers.length; t++) e.indexOf(this._onceHandlers[t].event) > -1 && this._onceHandlers.splice(t--, 1)
        } else {
            e = e.toLowerCase().split(" ");
            for (var t = 0; t < this._onceHandlers.length; t++) e.indexOf(this._onceHandlers[t].event) > -1 && this._onceHandlers[t].handler == n && this._onceHandlers.splice(t--, 1)
        }
        return this
    }, this.trigger = function (e, n) {
        e = e.toLowerCase().split(" ");
        for (var t = 0; t < this._handlers.length; t++) (e.indexOf(this._handlers[t].event) > -1 || "all" == this._handlers[t].event) && toFunc(this._handlers[t].handler).call(this, this._handlers[t].event, n);
        for (var t = 0; t < this._onceHandlers.length; t++) (e.indexOf(this._onceHandlers[t].event) > -1 || "all" == this._handlers[t].event) && (toFunc(this._onceHandlers[t].handler).call(this, this._onceHandlers[t].event, n), this._onceHandlers.splice(t--, 1));
        return this
    }, this.renderer = function () {
        return $("<div class='Obj'></div>")
    }, this.refresher = function (e) {
        return this.renderer.apply(this)
    }, this.destroyer = function (e) {
    }, this.render = function (e, n) {
        var t = this;
        if (void 0 === e) var e = "body";
        if (void 0 === n) var n = "replace"; else n = n.toLowerCase();
        var i = [].slice.call(arguments, 2), r = this;
        return $(e).each(function (e, s) {
            s = $(s);
            var h = $(t.renderer.apply(t, i));
            h.attr("guid", t.guid), t._elements = t._elements.add(h), "append" == n ? s.append(h) : "prepend" == n ? s.prepend(h) : "after" == n ? s.after(h) : "before" == n ? s.before(h) : "return" == n ? r = h : "none" == n || (s.after(h), s.remove())
        }), this.trigger("render"), r
    }, this.refresh = function () {
        for (var e = $(), n = 0; n < this._elements.length; n++) {
            var t = this._elements.eq(n), i = this.refresher.call(this, t);
            i ? (i.attr("guid", this.guid), this._elements = this._elements.not(t), t.after(i), t.remove(), e = e.add(i)) : e = e.add(t)
        }
        return this._elements = e, this
    }, this.destroy = function () {
        var e = this;
        return this._elements.each(function (n, t) {
            var i = $(t);
            e.destroyer.call(e, i)
        }), this._elements.remove(), this._elements = $(), delete Objs[this.guid], this
    }, Objs[this.guid] = this
}

var GUIDList = [], Objs = {};
if ($add === undefined) var $add = {version: {}, auto: {disabled: false}};
$add.version.Slider = "2.0.1";
$add.SliderObj = function (settings) {
    Obj.apply(this);

    function toNearest(num, x) {
        return (Math.round(num * (1 / x)) / (1 / x));
    }

    function betterParseFloat(t) {
        return isNaN(parseFloat(t)) && t.length > 0 ? betterParseFloat(t.substr(1)) : parseFloat(t)
    };

    this._settings = {
        direction: "horizontal",
        min: 0,
        max: 100,
        step: 0.1,
        value: 50,
        fontsize: 18,
        formatter: function (x) {
            if ((this._settings.step + "").indexOf(".") > -1)
                var digits = (this._settings.step + "").split(".").pop().length;
            else
                var digits = 0;
            v = betterParseFloat(x);
            if (x < 0) {
                var neg = true;
                x = 0 - x;
            } else {
                var neg = false;
            }
            if (isNaN(x)) {
                return "NaN";
            }
            var whole = Math.floor(x);
            var dec = (x - whole);
            dec = Math.round(dec * Math.pow(10, digits));
            dec = dec + "";
            while (dec.length < digits) {
                dec = "0" + dec;
            }
            return ((neg) ? "-" : "") + whole + ((digits > 0) ? "." + dec : "");
        },
        timeout: 2000,
        range: false,
        id: false,
        name: "",
        class: ""
    };
    Object.defineProperty(this, "settings", {
        get: function () {
            this.trigger("getsetting settings", this._settings);
            return this._settings;
        },
        set: function (newSettings) {
            this._settings = $.extend(this._settings, settings);
            this.trigger("setsettings settings", this._settings);
            this.refresh();
        }
    });
    Object.defineProperty(this, "value", {
        get: function () {
            this.trigger("getvalue value", this._settings.value);
            return this._settings.value;
        },
        set: function (newVal) {
            var self = this;
            this._settings.value = newVal;

            this._elements.find(".addui-slider-input").val(this._settings.value);
            if (!this._settings.range) {
                var offset = betterParseFloat(this._settings.value) - this._settings.min;
                var per = (toNearest(offset, this._settings.step) / (this._settings.max - this._settings.min)) * 100;
                if (this._settings.direction == "vertical") {
                    this._elements.find(".addui-slider-handle").css("bottom", per + "%");
                    this._elements.find(".addui-slider-range").css("height", per + "%");
                    this._elements.find(".addui-slider-range").css("bottom", "0%");
                } else {
                    this._elements.find(".addui-slider-handle").css("left", per + "%");
                    this._elements.find(".addui-slider-range").css("width", per + "%");
                }
                this._elements.find(".addui-slider-value span").html(toFunc(this._settings.formatter).call(this, this._settings.value));
            } else {
                var l = (toNearest(parseFloat(this._settings.value.split(",")[0]), this._settings.step));
                var h = (toNearest(parseFloat(this._settings.value.split(",")[1]), this._settings.step));
                var range = this._settings.max - this._settings.min;
                var offsetL = l - this._settings.min;
                var offsetH = h - this._settings.min;
                var lPer = (offsetL / range) * 100;
                var hPer = (offsetH / range) * 100;
                this._elements.each(function (i, el) {
                    var $el = $(el);
                    if (self._settings.direction == "vertical") {
                        $el.find(".addui-slider-handle").eq(0).css("bottom", lPer + "%");
                        $el.find(".addui-slider-handle").eq(1).css("bottom", hPer + "%");
                        $el.find(".addui-slider-range").css("bottom", lPer + "%").css("height", (hPer - lPer) + "%");
                    } else {
                        $el.find(".addui-slider-handle").eq(0).css("left", lPer + "%");
                        $el.find(".addui-slider-handle").eq(1).css("left", hPer + "%");
                        $el.find(".addui-slider-range").css("left", lPer + "%").css("width", (hPer - lPer) + "%");
                    }
                    $el.find(".addui-slider-handle").eq(0).find(".addui-slider-value span").html(toFunc(self._settings.formatter).call(self, l));
                    $el.find(".addui-slider-handle").eq(1).find(".addui-slider-value span").html(toFunc(self._settings.formatter).call(self, h));
                });
            }
        }
    });

    this.renderer = function () {
        var self = this;
        var $slider = $("<div class='addui-slider addui-slider-" + this._settings.direction + ((this._settings.range) ? " addui-slider-isrange" : "") + " " + this._settings.class + "' " + ((this._settings.id) ? "id='" + this._settings.id + "'" : "") + "></div>");
        var $input = $("<input class='addui-slider-input' type='hidden' name='" + this._settings.name + "' value='" + this._settings.value + "' />").appendTo($slider);
        var $track = $("<div class='addui-slider-track'></div>").appendTo($slider);
        var $range = $("<div class='addui-slider-range'></div>").appendTo($track);

        if (!this._settings.range) {
            var $handle = $("<div class='addui-slider-handle'><div class='addui-slider-value'><span style='font-size: " + this._settings.fontsize + "px'></span></div></div>").appendTo($track);
            var activeTimer = null;

            function dragHandler(e) {
                e.preventDefault();
                if (self._settings.direction == "vertical") {
                    if (e.type == "touchmove")
                        var y = e.originalEvent.changedTouches[0].pageY;
                    else
                        var y = e.pageY;
                    var sliderY = $slider.offset().top + $slider.height();
                    var offsetY = sliderY - y;
                    var offsetPer = (offsetY / $slider.height()) * 100;
                } else {
                    if (e.type == "touchmove")
                        var x = e.originalEvent.changedTouches[0].pageX;
                    else
                        var x = e.pageX;
                    var sliderX = $slider.offset().left;
                    var offsetX = x - sliderX;
                    var offsetPer = (offsetX / $slider.width()) * 100;
                }

                var val = toNearest((offsetPer / 100) * (self._settings.max - self._settings.min), self._settings.step) + self._settings.min;
                val = Math.min(self._settings.max, Math.max(self._settings.min, val));
                self.value = toNearest(val, self._settings.step);
            };

            function dragStopHandler(e) {
                $(window).off("mousemove touchmove", dragHandler);
                activeTimer = setTimeout(function () {
                    $handle.removeClass("addui-slider-handle-active");
                }, self._settings.timeout);
            };
            $handle.on("mousedown touchstart", function (e) {
                clearTimeout(activeTimer);
                $handle.addClass("addui-slider-handle-active");
                $(window).on("mousemove touchmove dragmove", dragHandler);
                $(window).one("mouseup touchend", dragStopHandler);
            });
            $slider.on("click", function (e) {
                e.preventDefault();

                if (self._settings.direction == "vertical") {
                    if (e.type == "touchmove")
                        var y = e.originalEvent.changedTouches[0].pageY;
                    else
                        var y = e.pageY;
                    var sliderY = $slider.offset().top + $slider.height();
                    var offsetY = sliderY - y;
                    var offsetPer = (offsetY / $slider.height()) * 100;
                } else {
                    if (e.type == "touchmove")
                        var x = e.originalEvent.changedTouches[0].pageX;
                    else
                        var x = e.pageX;
                    var sliderX = $slider.offset().left;
                    var offsetX = x - sliderX;
                    var offsetPer = (offsetX / $slider.width()) * 100;
                }

                var val = toNearest((offsetPer / 100) * (self._settings.max - self._settings.min), self._settings.step) + self._settings.min;
                val = Math.min(self._settings.max, Math.max(self._settings.min, val));
                clearTimeout(activeTimer);
                $handle.addClass("addui-slider-handle-active");
                activeTimer = setTimeout(function () {
                    $handle.removeClass("addui-slider-handle-active");
                }, self._settings.timeout);
                self.value = val;
            });
        } else {
            var $handle1 = $("<div class='addui-slider-handle addui-slider-handle-l'><div class='addui-slider-value'><span style='font-size: " + this._settings.fontsize + "px'></span></div></div>").appendTo($track);
            var activeTimer1 = null;


            function dragHandler1(e) {
                e.preventDefault();
                if (self._settings.direction == "vertical") {
                    if (e.type == "touchmove")
                        var y = e.originalEvent.changedTouches[0].pageY;
                    else
                        var y = e.pageY;
                    var sliderY = $slider.offset().top + $slider.height();
                    var offsetY = sliderY - y;
                    var range = self._settings.max - self._settings.min;
                    var offsetPer = (offsetY / $slider.height()) * 100;
                } else {
                    if (e.type == "touchmove")
                        var x = e.originalEvent.changedTouches[0].pageX;
                    else
                        var x = e.pageX;
                    var sliderX = $slider.offset().left;
                    var offsetX = x - sliderX;
                    var range = self._settings.max - self._settings.min;
                    var offsetPer = (offsetX / $slider.width()) * 100;
                }
                var offsetVal = offsetPer / 100 * range;
                var val = toNearest(offsetVal + self._settings.min, self._settings.step);
                val = Math.min(self._settings.max, Math.max(self._settings.min, val));
                var higherVal = toNearest(betterParseFloat(self._settings.value.split(',')[1]), self._settings.step);
                if (higherVal < val)
                    higherVal = val;
                self.value = val + "," + higherVal;
            };


            function dragStopHandler1(e) {
                $(window).off("mousemove touchmove", dragHandler1);
                activeTimer1 = setTimeout(function () {
                    $handle1.removeClass("addui-slider-handle-active");
                }, self._settings.timeout);
            };
            $handle1.on("mousedown touchstart", function (e) {
                clearTimeout(activeTimer1);
                $handle1.addClass("addui-slider-handle-active");
                $(window).on("mousemove touchmove dragmove", dragHandler1);
                $(window).one("mouseup touchend", dragStopHandler1);
            });

            var $handle2 = $("<div class='addui-slider-handle addui-slider-handle-h'><div class='addui-slider-value'><span style='font-size: " + this._settings.fontsize + "px'></span></div></div>").appendTo($track);
            var activeTimer2 = null;


            function dragHandler2(e) {
                e.preventDefault();
                if (self._settings.direction == "vertical") {
                    if (e.type == "touchmove")
                        var y = e.originalEvent.changedTouches[0].pageY;
                    else
                        var y = e.pageY;
                    var sliderY = $slider.offset().top + $slider.height();
                    var offsetY = sliderY - y;
                    var offsetPer = (offsetY / $slider.height()) * 100;
                } else {
                    if (e.type == "touchmove")
                        var x = e.originalEvent.changedTouches[0].pageX;
                    else
                        var x = e.pageX;
                    var sliderX = $slider.offset().left;
                    var offsetX = x - sliderX;
                    var offsetPer = (offsetX / $slider.width()) * 100;
                }
                var range = self._settings.max - self._settings.min;
                var offsetVal = offsetPer / 100 * range;
                var val = toNearest(offsetVal + self._settings.min, self._settings.step);
                val = Math.min(self._settings.max, Math.max(self._settings.min, val));
                var lowerVal = toNearest(betterParseFloat(self._settings.value.split(',')[0]), self._settings.step);
                if (lowerVal > val)
                    lowerVal = val;
                self.value = lowerVal + "," + val;
            };


            function dragStopHandler2(e) {
                $(window).off("mousemove touchmove", dragHandler2);
                activeTimer2 = setTimeout(function () {
                    $handle2.removeClass("addui-slider-handle-active");
                }, self._settings.timeout);
            };
            $handle2.on("mousedown touchstart", function (e) {
                clearTimeout(activeTimer2);
                $handle2.addClass("addui-slider-handle-active");
                $(window).on("mousemove touchmove dragmove", dragHandler2);
                $(window).one("mouseup touchend", dragStopHandler2);
            });
        }
        return $slider;
    };

    this.init = function (settings) {
        var self = this;
        this.settings = settings;
        if (!this._settings.range) {
            this._settings.value = Math.max(this._settings.min, Math.min(this._settings.max, betterParseFloat(this._settings.value)));
        } else {
            var val = this._settings.value + "";
            if (val.indexOf(",") > -1) { // Already has two values
                var values = val.split(",");
                var v1 = betterParseFloat(values[0]);
                v1 = Math.min(this._settings.max, Math.max(this._settings.min, v1));
                v1 = toNearest(v1, this._settings.step);

                var v2 = betterParseFloat(values[1]);
                v2 = Math.min(this._settings.max, Math.max(this._settings.min, v2));
                v2 = toNearest(v2, this._settings.step);
            } else { // Only has one value
                var val = toNearest(Math.max(this._settings.min, Math.min(this._settings.max, betterParseFloat(this._settings.value))), this._settings.step);
                var middle = (this._settings.max - this._settings.min) / 2;
                if (val < middle) {
                    var v1 = val;
                    var v2 = this._settings.max - val;
                } else {
                    var v2 = val;
                    var v1 = this._settings.min + val;
                }
            }
            if (v1 < v2)
                this._settings.value = v1 + "," + v2;
            else
                this._settings.value = v2 + "," + v1;
        }
        this.on("render", function () {
            self.value = self._settings.value;
        })
        this.trigger("init", {
            settings: this._settings
        });
    };
    this.init.apply(this, arguments);
};
$add.Slider = function (selector, settings) {
    var o = $(selector).each(function (i, el) {
        var $el = $(el);
        var s = {};
        if ($el.attr("name"))
            s.name = $el.attr("name");
        if ($el.attr("class"))
            s.class = $el.attr("class");
        if ($el.attr("id"))
            s.id = $el.attr("id");
        if ($el.attr("value"))
            s.value = $el.attr("value");
        if ($el.attr("min"))
            s.min = $el.attr("min");
        if ($el.attr("max"))
            s.max = $el.attr("max");
        if ($el.attr("step"))
            s.step = $el.attr("step");
        settings = $.extend(s, $el.data(), settings);
        var S = new $add.SliderObj(settings);
        S.render($el, "replace");
        return S;
    });
    return (o.length == 0) ? null : (o.length == 1) ? o[0] : o;
};
$.fn.addSlider = function (settings) {
    $add.Slider(this, settings);
};
$add.auto.Slider = function () {
    if (!$add.auto.disabled)
        $("[data-addui=slider]").addSlider();
};
$(function () {
    $add.auto.Slider();
});

function betterParseFloat(x) {
    if (isNaN(parseFloat(x)) && x.length > 0)
        return betterParseFloat(x.substr(1));
    return parseFloat(x);
}

function usd(x) {
    x = betterParseFloat(x);
    if (isNaN(x))
        return "$0.00";
    var dollars = Math.floor(x);
    var cents = Math.round((x - dollars) * 100) + "";
    if (cents.length == 1) cents = "0";
    return "$" + dollars;
}

/* ----- Range Slider With Tooltip END with jQuery UI Touch Punch 0.2.3  ----- */


/**
 * asRange v0.3.4
 * https://github.com/amazingSurge/jquery-asRange
 *
 * Copyright (c) amazingSurge
 * Released under the LGPL-3.0 license
 */
!function (t, e) {
    if ("function" == typeof define && define.amd) define(["jquery"], e); else if ("undefined" != typeof exports) e(require("jquery")); else {
        e(t.jQuery), t.jqueryAsRangeEs = {}
    }
}(this, function (t) {
    "use strict";
    var e, i = (e = t) && e.__esModule ? e : {default: e};
    var s = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
        return typeof t
    } : function (t) {
        return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
    };

    function n(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }

    var a = function () {
        function t(t, e) {
            for (var i = 0; i < e.length; i++) {
                var s = e[i];
                s.enumerable = s.enumerable || !1, s.configurable = !0, "value" in s && (s.writable = !0), Object.defineProperty(t, s.key, s)
            }
        }

        return function (e, i, s) {
            return i && t(e.prototype, i), s && t(e, s), e
        }
    }(), o = {
        namespace: "asRange",
        skin: null,
        max: 100,
        min: 0,
        value: null,
        step: 10,
        limit: !0,
        range: !1,
        direction: "h",
        keyboard: !0,
        replaceFirst: !1,
        tip: !0,
        scale: !0,
        format: function (t) {
            return t
        }
    };

    function r(t) {
        var e = t.originalEvent;
        return e.touches && e.touches.length && e.touches[0] && (e = e.touches[0]), e
    }

    var u, l = function () {
        function t(e, s, a) {
            n(this, t), this.$element = e, this.uid = s, this.parent = a, this.options = i.default.extend(!0, {}, this.parent.options), this.direction = this.options.direction, this.value = null, this.classes = {active: this.parent.namespace + "-pointer_active"}
        }

        return a(t, [{
            key: "mousedown", value: function (t) {
                var e = this.parent.direction.axis, s = this.parent.direction.position, n = this.parent.$wrap.offset();
                this.$element.trigger(this.parent.namespace + "::moveStart", this), this.data = {}, this.data.start = t[e], this.data.position = t[e] - n[s];
                var a = this.parent.getValueFromPosition(this.data.position);
                return this.set(a), i.default.each(this.parent.pointer, function (t, e) {
                    e.deactive()
                }), this.active(), this.mousemove = function (t) {
                    var i = r(t),
                        s = this.parent.getValueFromPosition(this.data.position + (i[e] || this.data.start) - this.data.start);
                    return this.set(s), t.preventDefault(), !1
                }, this.mouseup = function () {
                    return (0, i.default)(document).off(".asRange mousemove.asRange touchend.asRange mouseup.asRange touchcancel.asRange"), this.$element.trigger(this.parent.namespace + "::moveEnd", this), !1
                }, (0, i.default)(document).on("touchmove.asRange mousemove.asRange", i.default.proxy(this.mousemove, this)).on("touchend.asRange mouseup.asRange", i.default.proxy(this.mouseup, this)), !1
            }
        }, {
            key: "active", value: function () {
                this.$element.addClass(this.classes.active)
            }
        }, {
            key: "deactive", value: function () {
                this.$element.removeClass(this.classes.active)
            }
        }, {
            key: "set", value: function (t) {
                this.value !== t && (this.parent.step && (t = this.matchStep(t)), !0 === this.options.limit ? t = this.matchLimit(t) : (t <= this.parent.min && (t = this.parent.min), t >= this.parent.max && (t = this.parent.max)), this.value = t, this.updatePosition(), this.$element.focus(), this.$element.trigger(this.parent.namespace + "::move", this))
            }
        }, {
            key: "updatePosition", value: function () {
                var t = {};
                t[this.parent.direction.position] = this.getPercent() + "%", this.$element.css(t)
            }
        }, {
            key: "getPercent", value: function () {
                return (this.value - this.parent.min) / this.parent.interval * 100
            }
        }, {
            key: "get", value: function () {
                return this.value
            }
        }, {
            key: "matchStep", value: function (t) {
                var e = this.parent.step, i = e.toString().split(".")[1];
                return t = Math.round(t / e) * e, i && (t = t.toFixed(i.length)), parseFloat(t)
            }
        }, {
            key: "matchLimit", value: function (t) {
                var e = void 0, i = void 0, s = this.parent.pointer;
                return t <= (e = 1 === this.uid ? this.parent.min : s[this.uid - 2].value) && (t = e), t >= (i = s[this.uid] && null !== s[this.uid].value ? s[this.uid].value : this.parent.max) && (t = i), t
            }
        }, {
            key: "destroy", value: function () {
                this.$element.off(".asRange"), this.$element.remove()
            }
        }]), t
    }(), h = {
        defaults: {scale: {valuesNumber: 3, gap: 1, grid: 5}}, init: function (t) {
            var e = i.default.extend({}, this.defaults, t.options.scale).scale;
            e.values = [], e.values.push(t.min);
            for (var s = (t.max - t.min) / (e.valuesNumber - 1), n = 1; n <= e.valuesNumber - 2; n++) e.values.push(s * n);
            e.values.push(t.max);
            var a = {
                    scale: t.namespace + "-scale",
                    lines: t.namespace + "-scale-lines",
                    grid: t.namespace + "-scale-grid",
                    inlineGrid: t.namespace + "-scale-inlineGrid",
                    values: t.namespace + "-scale-values"
                }, o = e.values.length, r = ((e.grid - 1) * (e.gap + 1) + e.gap) * (o - 1) + o, u = 100 / (r - 1),
                l = 100 / (o - 1);
            this.$scale = (0, i.default)("<div></div>").addClass(a.scale), this.$lines = (0, i.default)("<ul></ul>").addClass(a.lines), this.$values = (0, i.default)("<ul></ul>").addClass(a.values);
            for (var h = 0; h < r; h++) {
                (0 === h || h === r || h % ((r - 1) / (o - 1)) == 0 ? (0, i.default)('<li class="' + a.grid + '"></li>') : h % e.grid == 0 ? (0, i.default)('<li class="' + a.inlineGrid + '"></li>') : (0, i.default)("<li></li>")).css({left: u * h + "%"}).appendTo(this.$lines)
            }
            for (var p = 0; p < o; p++) (0, i.default)("<li><span>" + e.values[p] + "</span></li>").css({left: l * p + "%"}).appendTo(this.$values);
            this.$lines.add(this.$values).appendTo(this.$scale), this.$scale.appendTo(t.$wrap)
        }, update: function (t) {
            this.$scale.remove(), this.init(t)
        }
    }, p = {
        defaults: {}, init: function (t) {
            var e = this;
            if (this.$arrow = (0, i.default)("<span></span>").appendTo(t.$wrap), this.$arrow.addClass(t.namespace + "-selected"), !1 === t.options.range && t.p1.$element.on(t.namespace + "::move", function (t, i) {
                e.$arrow.css({left: 0, width: i.getPercent() + "%"})
            }), !0 === t.options.range) {
                var s = function () {
                    var i = t.p2.getPercent() - t.p1.getPercent(), s = void 0;
                    i >= 0 ? s = t.p1.getPercent() : (i = -i, s = t.p2.getPercent()), e.$arrow.css({
                        left: s + "%",
                        width: i + "%"
                    })
                };
                t.p1.$element.on(t.namespace + "::move", s), t.p2.$element.on(t.namespace + "::move", s)
            }
        }
    }, c = {
        defaults: {active: "always"}, init: function (t) {
            var e = this, n = i.default.extend({}, this.defaults, t.options.tip);
            this.opts = n, this.classes = {
                tip: t.namespace + "-tip",
                show: t.namespace + "-tip-show"
            }, i.default.each(t.pointer, function (n, a) {
                var o = (0, i.default)("<span></span>").appendTo(t.pointer[n].$element);
                o.addClass(e.classes.tip), "onMove" === e.opts.active && (o.css({display: "none"}), a.$element.on(t.namespace + "::moveEnd", function () {
                    return e.hide(o), !1
                }).on(t.namespace + "::moveStart", function () {
                    return e.show(o), !1
                })), a.$element.on(t.namespace + "::move", function () {
                    var e = void 0;
                    if (e = t.options.range ? t.get()[n] : t.get(), "function" == typeof t.options.format) if (t.options.replaceFirst && "number" != typeof e) {
                        if ("string" == typeof t.options.replaceFirst && (e = t.options.replaceFirst), "object" === s(t.options.replaceFirst)) for (var i in t.options.replaceFirst) Object.hasOwnProperty(t.options.replaceFirst, i) && (e = t.options.replaceFirst[i])
                    } else e = t.options.format(e);
                    return o.text(e), !1
                })
            })
        }, show: function (t) {
            t.addClass(this.classes.show), t.css({display: "block"})
        }, hide: function (t) {
            t.removeClass(this.classes.show), t.css({display: "none"})
        }
    }, d = {}, f = function () {
        function t(e, s) {
            var a = this;
            n(this, t);
            var r = {};
            if (this.element = e, this.$element = (0, i.default)(e), this.$element.is("input")) {
                var u = this.$element.val();
                "string" == typeof u && (r.value = u.split(",")), i.default.each(["min", "max", "step"], function (t, e) {
                    var i = parseFloat(a.$element.attr(e));
                    isNaN(i) || (r[e] = i)
                }), this.$element.css({display: "none"}), this.$wrap = (0, i.default)("<div></div>"), this.$element.after(this.$wrap)
            } else this.$wrap = this.$element;
            if (this.options = i.default.extend({}, o, s, this.$element.data(), r), this.namespace = this.options.namespace, this.components = i.default.extend(!0, {}, d), this.options.range && (this.options.replaceFirst = !1), this.value = this.options.value, null === this.value && (this.value = this.options.min), this.options.range ? i.default.isArray(this.value) ? 1 === this.value.length && (this.value[1] = this.value[0]) : this.value = [this.value, this.value] : i.default.isArray(this.value) && (this.value = this.value[0]), this.min = this.options.min, this.max = this.options.max, this.step = this.options.step, this.interval = this.max - this.min, this.initialized = !1, this.updating = !1, this.disabled = !1, "v" === this.options.direction ? this.direction = {
                axis: "pageY",
                position: "top"
            } : this.direction = {
                axis: "pageX",
                position: "left"
            }, this.$wrap.addClass(this.namespace), this.options.skin && this.$wrap.addClass(this.namespace + "_" + this.options.skin), this.max < this.min || this.step >= this.interval) throw new Error("error options about max min step");
            this.init()
        }

        return a(t, [{
            key: "init", value: function () {
                this.$wrap.append('<div class="' + this.namespace + '-bar" />'), this.buildPointers(), this.components.selected.init(this), !1 !== this.options.tip && this.components.tip.init(this), !1 !== this.options.scale && this.components.scale.init(this), this.set(this.value), this.bindEvents(), this._trigger("ready"), this.initialized = !0
            }
        }, {
            key: "_trigger", value: function (t) {
                for (var e = arguments.length, i = Array(e > 1 ? e - 1 : 0), s = 1; s < e; s++) i[s - 1] = arguments[s];
                var n = [this].concat(i);
                this.$element.trigger(this.namespace + "::" + t, n);
                var a = "on" + (t = t.replace(/\b\w+\b/g, function (t) {
                    return t.substring(0, 1).toUpperCase() + t.substring(1)
                }));
                "function" == typeof this.options[a] && this.options[a].apply(this, i)
            }
        }, {
            key: "buildPointers", value: function () {
                this.pointer = [];
                var t = 1;
                this.options.range && (t = 2);
                for (var e = 1; e <= t; e++) {
                    var s = (0, i.default)('<div class="' + this.namespace + "-pointer " + this.namespace + "-pointer-" + e + '"></div>').appendTo(this.$wrap),
                        n = new l(s, e, this);
                    this.pointer.push(n)
                }
                this.p1 = this.pointer[0], this.options.range && (this.p2 = this.pointer[1])
            }
        }, {
            key: "bindEvents", value: function () {
                var t = this, e = this;
                this.$wrap.on("touchstart.asRange mousedown.asRange", function (t) {
                    if (!0 !== e.disabled) {
                        if ((t = r(t)).which ? 3 === t.which : 2 === t.button) return !1;
                        var i = e.$wrap.offset(), s = t[e.direction.axis] - i[e.direction.position];
                        return e.getAdjacentPointer(s).mousedown(t), !1
                    }
                }), this.$element.is("input") && this.$element.on(this.namespace + "::change", function () {
                    var e = t.get();
                    t.$element.val(e)
                }), i.default.each(this.pointer, function (i, s) {
                    s.$element.on(t.namespace + "::move", function () {
                        return e.value = e.get(), !(!e.initialized || e.updating) && (e._trigger("change", e.value), !1)
                    })
                })
            }
        }, {
            key: "getValueFromPosition", value: function (t) {
                return t > 0 ? this.min + t / this.getLength() * this.interval : 0
            }
        }, {
            key: "getAdjacentPointer", value: function (t) {
                var e = this.getValueFromPosition(t);
                if (this.options.range) {
                    var i = this.p1.value, s = this.p2.value, n = Math.abs(i - s);
                    return i <= s ? e > i + n / 2 ? this.p2 : this.p1 : e > s + n / 2 ? this.p1 : this.p2
                }
                return this.p1
            }
        }, {
            key: "getLength", value: function () {
                return "v" === this.options.direction ? this.$wrap.height() : this.$wrap.width()
            }
        }, {
            key: "update", value: function (t) {
                var e = this;
                this.updating = !0, i.default.each(["max", "min", "step", "limit", "value"], function (i, s) {
                    t[s] && (e[s] = t[s])
                }), (t.max || t.min) && this.setInterval(t.min, t.max), t.value || (this.value = t.min), i.default.each(this.components, function (t, i) {
                    "function" == typeof i.update && i.update(e)
                }), this.set(this.value), this._trigger("update"), this.updating = !1
            }
        }, {
            key: "get", value: function () {
                var t = [];
                if (i.default.each(this.pointer, function (e, i) {
                    t[e] = i.get()
                }), this.options.range) return t;
                if (t[0] === this.options.min && ("string" == typeof this.options.replaceFirst && (t[0] = this.options.replaceFirst), "object" === s(this.options.replaceFirst))) for (var e in this.options.replaceFirst) Object.hasOwnProperty(this.options.replaceFirst, e) && (t[0] = e);
                return t[0]
            }
        }, {
            key: "set", value: function (t) {
                if (this.options.range) {
                    if ("number" == typeof t && (t = [t]), !i.default.isArray(t)) return;
                    i.default.each(this.pointer, function (e, i) {
                        i.set(t[e])
                    })
                } else this.p1.set(t);
                this.value = t
            }
        }, {
            key: "val", value: function (t) {
                return t ? (this.set(t), this) : this.get()
            }
        }, {
            key: "setInterval", value: function (t, e) {
                this.min = t, this.max = e, this.interval = e - t
            }
        }, {
            key: "enable", value: function () {
                return this.disabled = !1, this.$wrap.removeClass(this.namespace + "_disabled"), this._trigger("enable"), this
            }
        }, {
            key: "disable", value: function () {
                return this.disabled = !0, this.$wrap.addClass(this.namespace + "_disabled"), this._trigger("disable"), this
            }
        }, {
            key: "destroy", value: function () {
                i.default.each(this.pointer, function (t, e) {
                    e.destroy()
                }), this.$wrap.destroy(), this._trigger("destroy")
            }
        }], [{
            key: "registerComponent", value: function (t, e) {
                d[t] = e
            }
        }, {
            key: "setDefaults", value: function (t) {
                i.default.extend(o, i.default.isPlainObject(t) && t)
            }
        }]), t
    }();
    f.registerComponent("scale", h), f.registerComponent("selected", p), f.registerComponent("tip", c), (u = (0, i.default)(document)).on("asRange::ready", function (t, e) {
        var s = void 0, n = {
            keys: {UP: 38, DOWN: 40, LEFT: 37, RIGHT: 39, RETURN: 13, ESCAPE: 27, BACKSPACE: 8, SPACE: 32},
            map: {},
            bound: !1,
            press: function (t) {
                var e = t.keyCode || t.which;
                if (e in n.map && "function" == typeof n.map[e]) return n.map[e](t), !1
            },
            attach: function (t) {
                var e = void 0, i = void 0;
                for (e in t) t.hasOwnProperty(e) && ((i = e.toUpperCase()) in n.keys ? n.map[n.keys[i]] = t[e] : n.map[i] = t[e]);
                n.bound || (n.bound = !0, u.bind("keydown", n.press))
            },
            detach: function () {
                n.bound = !1, n.map = {}, u.unbind("keydown", n.press)
            }
        };
        !0 === e.options.keyboard && i.default.each(e.pointer, function (t, i) {
            s = e.options.step ? e.options.step : 1;
            var a = function () {
                var t = i.value;
                i.set(t - s)
            }, o = function () {
                var t = i.value;
                i.set(t + s)
            };
            i.$element.attr("tabindex", "0").on("focus", function () {
                return n.attach({left: a, right: o}), !1
            }).on("blur", function () {
                return n.detach(), !1
            })
        })
    });
    var v = "asRange", m = i.default.fn.asRange;

    function g(t) {
        for (var e = arguments.length, s = Array(e > 1 ? e - 1 : 0), n = 1; n < e; n++) s[n - 1] = arguments[n];
        if ("string" == typeof t) {
            var a = t;
            if (/^_/.test(a)) return !1;
            if (!(/^(get)$/.test(a) || "val" === a && 0 === s.length)) return this.each(function () {
                var t = i.default.data(this, v);
                t && "function" == typeof t[a] && t[a].apply(t, s)
            });
            var o = this.first().data(v);
            if (o && "function" == typeof o[a]) return o[a].apply(o, s)
        }
        return this.each(function () {
            (0, i.default)(this).data(v) || (0, i.default)(this).data(v, new f(this, t))
        })
    }

    i.default.fn.asRange = g, i.default.asRange = i.default.extend({
        setDefaults: f.setDefaults,
        noConflict: function () {
            return i.default.fn.asRange = m, g
        }
    }, {version: "0.3.4"})
});
