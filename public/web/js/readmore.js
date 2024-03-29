/**
 * Created by Myroslav.Zozulia on 20.01.14.
 */
(function (d) {
    function g(c, a) {
        this.element = c;
        this.options = d.extend({}, h, a);
        d(this.element).data("max-height", this.options.maxHeight);
        delete this.options.maxHeight;
        if (this.options.embedCSS && !k) {
            var b = ".readmore-js-toggle, .readmore-js-section { " + this.options.sectionCSS + " } .readmore-js-section { overflow: hidden; }", e = document.createElement("style");
            e.type = "text/css";
            e.styleSheet ? e.styleSheet.cssText = b : e.appendChild(document.createTextNode(b));
            document.getElementsByTagName("head")[0].appendChild(e);
            k = !0
        }
        this._defaults = h;
        this._name = f;
        this.init()
    }

    var f = "readmore", h = {speed: 100, maxHeight: 200, moreLink: '<a href="#">Read More</a>', lessLink: '<a href="#">Close</a>', embedCSS: !0, sectionCSS: "display: block; width: 100%;", beforeToggle: function () {
    }, afterToggle: function () {
    }}, k = !1;
    g.prototype = {init: function () {
        var c = this;
        d(this.element).each(function () {
            var a = d(this), b = a.css("max-height").replace(/[^-\d\.]/g, "") > a.data("max-height") ? a.css("max-height").replace(/[^-\d\.]/g, "") : a.data("max-height");
            a.addClass("readmore-js-section");
            "none" != a.css("max-height") && a.css("max-height", "none");
            a.data("boxHeight", a.outerHeight(!0));
            if (a.outerHeight(!0) < b)return!0;
            a.after(d(c.options.moreLink).on("click",function (b) {
                c.toggleSlider(this, a, b)
            }).addClass("readmore-js-toggle"));
            a.data("sliderHeight", b);
            a.css({height: b})
        })
    }, toggleSlider: function (c, a, b) {
        b.preventDefault();
        var e = this, f = newLink = "";
        b = !1;
        f = d(a).data("sliderHeight");
        d(a).height() == f ? (f = d(a).data().boxHeight + "px", newLink = "lessLink", b = !0) : newLink = "moreLink";
        e.options.beforeToggle(c,
            a, b);
        d(a).animate({height: f}, {duration: e.options.speed});
        d(c).replaceWith(d(e.options[newLink]).on("click",function (b) {
            e.toggleSlider(this, a, b)
        }).addClass("readmore-js-toggle"));
        e.options.afterToggle(c, a, b)
    }};
    d.fn[f] = function (c) {
        var a = arguments;
        if (void 0 === c || "object" === typeof c)return this.each(function () {
            d.data(this, "plugin_" + f) || d.data(this, "plugin_" + f, new g(this, c))
        });
        if ("string" === typeof c && "_" !== c[0] && "init" !== c)return this.each(function () {
            var b = d.data(this, "plugin_" + f);
            b instanceof g && "function" === typeof b[c] && b[c].apply(b, Array.prototype.slice.call(a, 1))
        })
    }
})(jQuery);