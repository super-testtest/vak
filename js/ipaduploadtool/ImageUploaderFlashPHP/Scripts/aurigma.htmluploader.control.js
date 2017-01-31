(function () {
    function e(a) {
        throw a;
    }
    var h = void 0,
        i = !0,
        k = null,
        m = !1;

    function aa() {
        return function (a) {
            return a
        }
    }

    function ba() {
        return function () {}
    }

    function ca(a) {
        return function (b) {
            this[a] = b
        }
    }

    function n(a) {
        return function () {
            return this[a]
        }
    }

    function p(a) {
        return function () {
            return a
        }
    }
    var r, da = da || {}, s = this;

    function ea(a, b) {
        var c = a.split("."),
            d = s;
        !(c[0] in d) && d.execScript && d.execScript("var " + c[0]);
        for (var f; c.length && (f = c.shift());)!c.length && fa(b) ? d[f] = b : d = d[f] ? d[f] : d[f] = {}
    }

    function ga(a) {
        for (var a = a.split("."), b = s, c; c = a.shift();)
            if (b[c] != k) b = b[c];
            else return k;
        return b
    }

    function ha() {}

    function t(a) {
        a.t = function () {
            return a.cj || (a.cj = new a)
        }
    }

    function ia(a) {
        var b = typeof a;
        if ("object" == b)
            if (a) {
                if (a instanceof Array) return "array";
                if (a instanceof Object) return b;
                var c = Object.prototype.toString.call(a);
                if ("[object Window]" == c) return "object";
                if ("[object Array]" == c || "number" == typeof a.length && "undefined" != typeof a.splice && "undefined" != typeof a.propertyIsEnumerable && !a.propertyIsEnumerable("splice")) return "array";
                if ("[object Function]" == c || "undefined" != typeof a.call && "undefined" != typeof a.propertyIsEnumerable && !a.propertyIsEnumerable("call")) return "function"
            } else return "null";
            else if ("function" == b && "undefined" == typeof a.call) return "object";
        return b
    }

    function fa(a) {
        return a !== h
    }

    function ja(a) {
        return "array" == ia(a)
    }

    function ka(a) {
        var b = ia(a);
        return "array" == b || "object" == b && "number" == typeof a.length
    }

    function u(a) {
        return "string" == typeof a
    }

    function la(a) {
        return "function" == ia(a)
    }

    function ma(a) {
        var b = typeof a;
        return "object" == b && a != k || "function" == b
    }

    function na(a) {
        return a[oa] || (a[oa] = ++pa)
    }
    var oa = "closure_uid_" + Math.floor(2147483648 * Math.random()).toString(36),
        pa = 0;

    function qa(a, b, c) {
        return a.call.apply(a.bind, arguments)
    }

    function ra(a, b, c) {
        a || e(Error());
        if (2 < arguments.length) {
            var d = Array.prototype.slice.call(arguments, 2);
            return function () {
                var c = Array.prototype.slice.call(arguments);
                Array.prototype.unshift.apply(c, d);
                return a.apply(b, c)
            }
        }
        return function () {
            return a.apply(b, arguments)
        }
    }

    function v(a, b, c) {
        v = Function.prototype.bind && -1 != Function.prototype.bind.toString().indexOf("native code") ? qa : ra;
        return v.apply(k, arguments)
    }

    function sa(a, b) {
        var c = Array.prototype.slice.call(arguments, 1);
        return function () {
            var b = Array.prototype.slice.call(arguments);
            b.unshift.apply(b, c);
            return a.apply(this, b)
        }
    }
    var ta = Date.now || function () {
            return +new Date
        };

    function w(a, b) {
        function c() {}
        c.prototype = b.prototype;
        a.b = b.prototype;
        a.prototype = new c;
        a.prototype.constructor = a
    };

    function va(a, b, c, d, f, g) {
        this.xb = a || wa;
        this.Uf = b || 0;
        this.ib = c || 0;
        this.Wa = d || 0;
        this.ia = f || 0;
        this.Aa = g || 0
    }
    va.prototype.va = function () {
        return new va(this.xb, this.Uf, this.ib, this.Wa, this.ia, this.Aa)
    };
    var wa = 0;

    function xa() {}
    t(xa);
    xa.prototype.Of = 0;

    function ya(a) {
        return ":" + (a.Of++).toString(36)
    }
    xa.t();
    var za = {
        Tk: "Id",
        Bl: "TitleText",
        wk: "AddFilesHyperlinkText",
        al: "OrText",
        el: "ClearAllHyperlinkText",
        Wl: "Width",
        Sk: "Height",
        dl: "ProgressBytesMode",
        tl: "ShowViewComboBox",
        Ul: "ViewComboBox",
        Tl: "ViewComboBoxText",
        Vl: "ViewMode",
        vk: "AddFilesButtonText",
        Lk: "EnableDescriptionEditor",
        Nk: "DisableRotation",
        Jk: "EnableAddingFiles",
        xl: "StatusPaneFilesUploadedText",
        ul: "StatusPaneDataUploadedText",
        yl: "NoFilesToUploadText",
        wl: "FilesToUploadText",
        Fl: "UploadButtonText",
        yk: "CancelUploadButtonText",
        Vk: "ItemTooltip",
        Uk: "ImageTooltip",
        fl: "RemovalIconTooltip",
        ql: "RotationIconTooltip",
        Ik: "DescriptionEditorIconTooltip",
        bl: "PaneItemToolbarAlwaysVisible",
        uk: "ActionUrl",
        Fk: "DescriptionEditorSaveButtonText",
        Ek: "DescriptionEditorCancelButtonText",
        gl: "FileMask",
        hl: "MaxFileCount",
        ll: "MaxTotalFileSize",
        il: "MaxFileSize",
        nl: "MinFileSize",
        kl: "MaxImageWidth",
        pl: "MinImageWidth",
        jl: "MaxImageHeight",
        ol: "MinImageHeight",
        ml: "MinFileCount",
        xk: "AddFilesProgressDialogText",
        Ck: "CommonDialogCancelButtonText",
        Pk: "FileNameNotAllowedMessage",
        Dl: "MaxFileCountExceeded",
        Yk: "MaxTotalFileSizeExceeded",
        Qk: "MaxFileSizeExceeded",
        Rk: "FileSizeTooSmall",
        Hk: "DimensionsTooSmall",
        Gk: "DimensionsTooLarge",
        Ok: "FilesNotAdded",
        Cl: "TooFewFiles",
        Nl: "UploadErrorMessage",
        rl: "ServerNotFoundMessage",
        sl: "ServerSideErrorMessage",
        Hl: "UploadCancelledByUserMessage",
        Gl: "UploadCancelledByCancelMethodMessage",
        Il: "UploadCancelledFromAfterPackageUploadEventMessage",
        Bk: "ClosePreviewTooltip",
        Ol: "IconItemWidth",
        Pl: "IconSize",
        Ql: "ThumbnailPreviewSize",
        Rl: "TileItemWidth",
        Sl: "TilePreviewSize",
        Wk: "Locale",
        Ak: "ChunkSize",
        $k: "MinImageWidthHeightLogic",
        vl: "StatusPaneFilesPreparedText",
        zl: "StatusPanePreparingText",
        Al: "StatusPaneSendingText",
        zk: "CannotReadFile",
        Zk: "MemoryLimitReached",
        cl: "PreviewNotAvailable",
        El: "TooManyFilesSelectedToOpen",
        Mk: "EnableDisproportionalExifThumbnails",
        Dk: "CommonDialogOkButtonText",
        Xk: "MaxFileToLoadSize",
        Jl: "UploadErrorDialogHideDetailsButtonText",
        Kl: "UploadErrorDialogMessage",
        Ll: "UploadErrorDialogShowDetailsButtonText",
        Ml: "UploadErrorDialogTitle",
        Kk: "EnableAutoRotation"
    }, x = {};
    x.Id = "upldr" + ya(xa.t());
    x.TitleText = "Files for upload";
    x.AddFilesHyperlinkText = "Add files";
    x.OrText = "or";
    x.ClearAllHyperlinkText = "remove all files";
    x.ShowViewComboBox = i;
    x.ViewComboBox = ["Tiles", "Thumbnails", "Icons"];
    x.ViewComboBoxText = "Change view:";
    x.ViewMode = "tiles";
    x.Width = "600px";
    x.Height = "400px";
    x.ProgressBytesMode = "ByPackageSize";
    x.AddFilesButtonText = "+Add files";
    x.EnableDescriptionEditor = i;
    x.EnableRotation = i;
    x.EnableAddingFiles = i;
    x.StatusPaneFilesUploadedText = "Files completed: {0} / {1}";
    x.StatusPaneDataUploadedText = "Data uploaded: {0} / {1}";
    x.NoFilesToUploadText = "No files to upload";
    x.FilesToUploadText = "Total files: {0}";
    x.UploadButtonText = "Upload";
    x.CancelUploadButtonText = "Cancel";
    x.ItemTooltip = "{0}\n{1}";
    x.ImageTooltip = "{0}\n{1}, {2}";
    x.RemovalIconTooltip = "Remove";
    x.RotationIconTooltip = "";
    x.DescriptionEditorIconTooltip = "Edit description";
    x.PaneItemToolbarAlwaysVisible = m;
    x.ActionUrl = ".";
    x.DescriptionEditorSaveButtonText = "Save";
    x.DescriptionEditorCancelButtonText = "Cancel";
    x.FileMask = "";
    x.MaxFileCount = 0;
    x.MaxTotalFileSize = 0;
    x.MaxFileSize = 0;
    x.MinFileSize = 0;
    x.MaxImageWidth = 0;
    x.MinImageWidth = 0;
    x.MaxImageHeight = 0;
    x.MinImageHeight = 0;
    x.MinFileCount = 1;
    x.AddFilesProgressDialogText = "Adding files to upload list...";
    x.CommonDialogCancelButtonText = "Cancel";
    x.FileNameNotAllowedMessage = 'The file "{0}" cannot be added. This file has inadmissible name.';
    x.MaxFileCountExceeded = "Not all files were added. You allowed to upload no more than {0} file(s).";
    x.MaxTotalFileSizeExceeded = "Not all files were added. Maximum total file size ({0}) was exceeded.";
    x.MaxFileSizeExceeded = 'Size of "{0}" is too large to be added. Maximum allowed size is {1}.';
    x.FileSizeTooSmall = 'Size of "{0}" is too small to be added. Minimum allowed size is {1}.';
    x.DimensionsTooLarge = 'Dimensions of "{0}" are too large, the file wasn\'t added. Maximum allowed image dimensions are {1}x{2} pixels.';
    x.DimensionsTooSmall = 'Dimensions of "{0}" are too small, the file wasn\'t added. Minimum allowed image dimensions are {1}x{2} pixels.';
    x.FilesNotAdded = "{0} files were not added due to restrictions of the site.";
    x.TooFewFiles = "At least {0} files should be selected to start upload.";
    x.UploadErrorMessage = "Uploader encountered some problem. If you see this message, contact web master.";
    x.ServerNotFoundMessage = "The server or proxy {0} cannot be found.";
    x.ServerSideErrorMessage = "Some server-side error occurred. If you see this message, contact your Web master.";
    x.UploadCancelledByUserMessage = "Uploading is cancelled by user.";
    x.UploadCancelledByCancelMethodMessage = 'Uploading is cancelled by "cancelUpload" method.';
    x.UploadCancelledFromAfterPackageUploadEventMessage = "Upload cancelled from AfterPackageUpload event handler.";
    x.ClosePreviewTooltip = "Click to close";
    x.IconItemWidth = 0;
    x.IconSize = 0;
    x.ThumbnailPreviewSize = 120;
    x.TileItemWidth = 0;
    x.TilePreviewSize = 100;
    var Aa = {
        UploaderState: 0
    };
    Aa.UploadProgress = new va;

    function Ba(a) {
        this.stack = Error().stack || "";
        if (a) this.message = "" + a
    }
    w(Ba, Error);
    Ba.prototype.name = "CustomError";

    function Ca(a, b) {
        for (var c = 1; c < arguments.length; c++) var d = ("" + arguments[c]).replace(/\$/g, "$$$$"),
        a = a.replace(/\%s/, d);
        return a
    }

    function Da(a) {
        return a.replace(/[\t\r\n ]+/g, " ").replace(/^[\t\r\n ]+|[\t\r\n ]+$/g, "")
    }

    function Ea(a) {
        return a.replace(/^[\s\xa0]+|[\s\xa0]+$/g, "")
    }

    function Fa(a) {
        return a.replace(/(\r\n|\r|\n)/g, "<br />")
    }

    function Ga(a) {
        if (!Ha.test(a)) return a; - 1 != a.indexOf("&") && (a = a.replace(Ia, "&amp;")); - 1 != a.indexOf("<") && (a = a.replace(Ja, "&lt;")); - 1 != a.indexOf(">") && (a = a.replace(Ka, "&gt;")); - 1 != a.indexOf('"') && (a = a.replace(La, "&quot;"));
        return a
    }
    var Ia = /&/g,
        Ja = /</g,
        Ka = />/g,
        La = /\"/g,
        Ha = /[&<>\"]/,
        Ma = {};

    function Na(a) {
        return Ma[a] || (Ma[a] = ("" + a).replace(/\-([a-z])/g, function (a, c) {
            return c.toUpperCase()
        }))
    };

    function Oa(a, b) {
        b.unshift(a);
        Ba.call(this, Ca.apply(k, b));
        b.shift();
        this.cm = a
    }
    w(Oa, Ba);
    Oa.prototype.name = "AssertionError";

    function Pa(a, b) {
        e(new Oa("Failure" + (a ? ": " + a : ""), Array.prototype.slice.call(arguments, 1)))
    };
    var Qa = Array.prototype,
        Ra = Qa.indexOf ? function (a, b, c) {
            return Qa.indexOf.call(a, b, c)
        } : function (a, b, c) {
            c = c == k ? 0 : 0 > c ? Math.max(0, a.length + c) : c;
            if (u(a)) return !u(b) || 1 != b.length ? -1 : a.indexOf(b, c);
            for (; c < a.length; c++)
                if (c in a && a[c] === b) return c;
            return -1
        }, y = Qa.forEach ? function (a, b, c) {
            Qa.forEach.call(a, b, c)
        } : function (a, b, c) {
            for (var d = a.length, f = u(a) ? a.split("") : a, g = 0; g < d; g++) g in f && b.call(c, f[g], g, a)
        }, Sa = Qa.map ? function (a, b, c) {
            return Qa.map.call(a, b, c)
        } : function (a, b, c) {
            for (var d = a.length, f = Array(d), g = u(a) ?
                    a.split("") : a, j = 0; j < d; j++) j in g && (f[j] = b.call(c, g[j], j, a));
            return f
        }, Ta = Qa.some ? function (a, b, c) {
            return Qa.some.call(a, b, c)
        } : function (a, b, c) {
            for (var d = a.length, f = u(a) ? a.split("") : a, g = 0; g < d; g++)
                if (g in f && b.call(c, f[g], g, a)) return i;
            return m
        }, Ua = Qa.every ? function (a, b, c) {
            return Qa.every.call(a, b, c)
        } : function (a, b, c) {
            for (var d = a.length, f = u(a) ? a.split("") : a, g = 0; g < d; g++)
                if (g in f && !b.call(c, f[g], g, a)) return m;
            return i
        };

    function Va(a, b) {
        return 0 <= Ra(a, b)
    }

    function Wa(a, b) {
        var c = Ra(a, b),
            d;
        (d = 0 <= c) && Qa.splice.call(a, c, 1);
        return d
    }

    function Xa(a) {
        return Qa.concat.apply(Qa, arguments)
    }

    function Ya(a) {
        if (ja(a)) return Xa(a);
        for (var b = [], c = 0, d = a.length; c < d; c++) b[c] = a[c];
        return b
    }

    function $a(a, b) {
        for (var c = 1; c < arguments.length; c++) {
            var d = arguments[c],
                f;
            if (ja(d) || (f = ka(d)) && d.hasOwnProperty("callee")) a.push.apply(a, d);
            else if (f)
                for (var g = a.length, j = d.length, l = 0; l < j; l++) a[g + l] = d[l];
            else a.push(d)
        }
    }

    function ab(a, b, c, d) {
        Qa.splice.apply(a, bb(arguments, 1))
    }

    function bb(a, b, c) {
        return 2 >= arguments.length ? Qa.slice.call(a, b) : Qa.slice.call(a, b, c)
    };
    var cb;

    function db(a) {
        return (a = a.className) && "function" == typeof a.split ? a.split(/\s+/) : []
    }

    function A(a, b) {
        var c = db(a),
            d = bb(arguments, 1),
            d = eb(c, d);
        a.className = c.join(" ");
        return d
    }

    function fb(a, b) {
        var c = db(a),
            d = bb(arguments, 1),
            d = gb(c, d);
        a.className = c.join(" ");
        return d
    }

    function eb(a, b) {
        for (var c = 0, d = 0; d < b.length; d++) Va(a, b[d]) || (a.push(b[d]), c++);
        return c == b.length
    }

    function gb(a, b) {
        for (var c = 0, d = 0; d < a.length; d++) Va(b, a[d]) && (ab(a, d--, 1), c++);
        return c == b.length
    }

    function ib(a, b, c) {
        var d = db(a);
        u(b) ? Wa(d, b) : ja(b) && gb(d, b);
        u(c) && !Va(d, c) ? d.push(c) : ja(c) && eb(d, c);
        a.className = d.join(" ")
    };

    function jb(a, b, c) {
        for (var d in a) b.call(c, a[d], d, a)
    }

    function kb(a) {
        var b = [],
            c = 0,
            d;
        for (d in a) b[c++] = a[d];
        return b
    }

    function lb(a) {
        var b = [],
            c = 0,
            d;
        for (d in a) b[c++] = d;
        return b
    }

    function mb(a, b, c) {
        b in a && e(Error('The object already contains the key "' + b + '"'));
        a[b] = c
    }

    function nb() {
        var a = {}, b;
        for (b in x) a[b] = x[b];
        return a
    }
    var ob = "constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(",");

    function pb(a, b) {
        for (var c, d, f = 1; f < arguments.length; f++) {
            d = arguments[f];
            for (c in d) a[c] = d[c];
            for (var g = 0; g < ob.length; g++) c = ob[g], Object.prototype.hasOwnProperty.call(d, c) && (a[c] = d[c])
        }
    };
    var qb, rb, sb, tb, ub, vb;

    function wb() {
        return s.navigator ? s.navigator.userAgent : k
    }

    function xb() {
        return s.navigator
    }
    ub = tb = sb = rb = qb = m;
    var yb;
    if (yb = wb()) {
        var zb = xb();
        qb = 0 == yb.indexOf("Opera");
        rb = !qb && -1 != yb.indexOf("MSIE");
        tb = (sb = !qb && -1 != yb.indexOf("WebKit")) && -1 != yb.indexOf("Mobile");
        ub = !qb && !sb && "Gecko" == zb.product
    }
    var Ab = qb,
        B = rb,
        Bb = ub,
        C = sb,
        Cb = tb,
        Db = xb();
    vb = -1 != (Db && Db.platform || "").indexOf("Mac");
    var Eb = !! xb() && -1 != (xb().appVersion || "").indexOf("X11"),
        Fb;
    a: {
        var Gb = "",
            Hb;
        if (Ab && s.opera) var Ib = s.opera.version,
        Gb = "function" == typeof Ib ? Ib() : Ib;
        else if (Bb ? Hb = /rv\:([^\);]+)(\)|;)/ : B ? Hb = /MSIE\s+([^\);]+)(\)|;)/ : C && (Hb = /WebKit\/(\S+)/), Hb) var Jb = Hb.exec(wb()),
        Gb = Jb ? Jb[1] : "";
        if (B) {
            var Kb, Lb = s.document;
            Kb = Lb ? Lb.documentMode : h;
            if (Kb > parseFloat(Gb)) {
                Fb = "" + Kb;
                break a
            }
        }
        Fb = Gb
    }
    var Mb = {};

    function E(a) {
        var b;
        if (!(b = Mb[a])) {
            b = 0;
            for (var c = Ea("" + Fb).split("."), d = Ea("" + a).split("."), f = Math.max(c.length, d.length), g = 0; 0 == b && g < f; g++) {
                var j = c[g] || "",
                    l = d[g] || "",
                    o = RegExp("(\\d*)(\\D*)", "g"),
                    q = RegExp("(\\d*)(\\D*)", "g");
                do {
                    var z = o.exec(j) || ["", "", ""],
                        D = q.exec(l) || ["", "", ""];
                    if (0 == z[0].length && 0 == D[0].length) break;
                    b = ((0 == z[1].length ? 0 : parseInt(z[1], 10)) < (0 == D[1].length ? 0 : parseInt(D[1], 10)) ? -1 : (0 == z[1].length ? 0 : parseInt(z[1], 10)) > (0 == D[1].length ? 0 : parseInt(D[1], 10)) ? 1 : 0) || ((0 == z[2].length) < (0 ==
                        D[2].length) ? -1 : (0 == z[2].length) > (0 == D[2].length) ? 1 : 0) || (z[2] < D[2] ? -1 : z[2] > D[2] ? 1 : 0)
                } while (0 == b)
            }
            b = Mb[a] = 0 <= b
        }
        return b
    }
    var Nb = {};

    function Ob(a) {
        return Nb[a] || (Nb[a] = B && document.documentMode && document.documentMode >= a)
    };

    function Pb(a, b) {
        this.width = a;
        this.height = b
    }
    Pb.prototype.va = function () {
        return new Pb(this.width, this.height)
    };
    Pb.prototype.toString = function () {
        return "(" + this.width + " x " + this.height + ")"
    };
    Pb.prototype.floor = function () {
        this.width = Math.floor(this.width);
        this.height = Math.floor(this.height);
        return this
    };
    Pb.prototype.round = function () {
        this.width = Math.round(this.width);
        this.height = Math.round(this.height);
        return this
    };
    var Qb = !B || Ob(9);
    !Bb && !B || B && Ob(9) || Bb && E("1.9.1");
    var Rb = B && !E("9");

    function F(a, b) {
        this.x = fa(a) ? a : 0;
        this.y = fa(b) ? b : 0
    }
    F.prototype.va = function () {
        return new F(this.x, this.y)
    };
    F.prototype.toString = function () {
        return "(" + this.x + ", " + this.y + ")"
    };

    function Sb(a, b) {
        return new F(a.x - b.x, a.y - b.y)
    };

    function Tb(a) {
        return a ? new Ub(Vb(a)) : cb || (cb = new Ub)
    }

    function Wb(a) {
        return u(a) ? document.getElementById(a) : a
    }

    function Xb(a, b, c, d) {
        a = d || a;
        b = b && "*" != b ? b.toUpperCase() : "";
        if (a.querySelectorAll && a.querySelector && (!C || Yb(document) || E("528")) && (b || c)) return a.querySelectorAll(b + (c ? "." + c : ""));
        if (c && a.getElementsByClassName) {
            a = a.getElementsByClassName(c);
            if (b) {
                for (var d = {}, f = 0, g = 0, j; j = a[g]; g++) b == j.nodeName && (d[f++] = j);
                d.length = f;
                return d
            }
            return a
        }
        a = a.getElementsByTagName(b || "*");
        if (c) {
            d = {};
            for (g = f = 0; j = a[g]; g++) b = j.className, "function" == typeof b.split && Va(b.split(/\s+/), c) && (d[f++] = j);
            d.length = f;
            return d
        }
        return a
    }

    function Zb(a, b) {
        jb(b, function (b, d) {
            "style" == d ? a.style.cssText = b : "class" == d ? a.className = b : "for" == d ? a.htmlFor = b : d in $b ? a.setAttribute($b[d], b) : 0 == d.lastIndexOf("aria-", 0) ? a.setAttribute(d, b) : a[d] = b
        })
    }
    var $b = {
        cellpadding: "cellPadding",
        cellspacing: "cellSpacing",
        colspan: "colSpan",
        rowspan: "rowSpan",
        valign: "vAlign",
        height: "height",
        width: "width",
        usemap: "useMap",
        frameborder: "frameBorder",
        maxlength: "maxLength",
        type: "type"
    };

    function ac(a, b, c) {
        return bc(document, arguments)
    }

    function bc(a, b) {
        var c = b[0],
            d = b[1];
        if (!Qb && d && (d.name || d.type)) {
            c = ["<", c];
            d.name && c.push(' name="', Ga(d.name), '"');
            if (d.type) {
                c.push(' type="', Ga(d.type), '"');
                var f = {};
                pb(f, d);
                d = f;
                delete d.type
            }
            c.push(">");
            c = c.join("")
        }
        c = a.createElement(c);
        if (d) u(d) ? c.className = d : ja(d) ? A.apply(k, [c].concat(d)) : Zb(c, d);
        2 < b.length && cc(a, c, b, 2);
        return c
    }

    function cc(a, b, c, d) {
        function f(c) {
            c && b.appendChild(u(c) ? a.createTextNode(c) : c)
        }
        for (; d < c.length; d++) {
            var g = c[d];
            ka(g) && !(ma(g) && 0 < g.nodeType) ? y(dc(g) ? Ya(g) : g, f) : f(g)
        }
    }

    function Yb(a) {
        return "CSS1Compat" == a.compatMode
    }

    function ec(a, b) {
        cc(Vb(a), a, arguments, 1)
    }

    function fc(a) {
        for (var b; b = a.firstChild;) a.removeChild(b)
    }

    function gc(a) {
        a && a.parentNode && a.parentNode.removeChild(a)
    }

    function hc(a) {
        return a.firstElementChild != h ? a.firstElementChild : ic(a.firstChild, i)
    }

    function ic(a, b) {
        for (; a && 1 != a.nodeType;) a = b ? a.nextSibling : a.previousSibling;
        return a
    }

    function jc(a, b) {
        if (a.contains && 1 == b.nodeType) return a == b || a.contains(b);
        if ("undefined" != typeof a.compareDocumentPosition) return a == b || Boolean(a.compareDocumentPosition(b) & 16);
        for (; b && a != b;) b = b.parentNode;
        return b == a
    }

    function Vb(a) {
        return 9 == a.nodeType ? a : a.ownerDocument || a.document
    }

    function kc(a, b) {
        if ("textContent" in a) a.textContent = b;
        else if (a.firstChild && 3 == a.firstChild.nodeType) {
            for (; a.lastChild != a.firstChild;) a.removeChild(a.lastChild);
            a.firstChild.data = b
        } else fc(a), a.appendChild(Vb(a).createTextNode(b))
    }
    var lc = {
        SCRIPT: 1,
        STYLE: 1,
        HEAD: 1,
        IFRAME: 1,
        OBJECT: 1
    }, mc = {
            IMG: " ",
            BR: "\n"
        };

    function nc(a) {
        var b = a.getAttributeNode("tabindex");
        return b && b.specified ? (a = a.tabIndex, "number" == typeof a && 0 <= a && 32768 > a) : m
    }

    function oc(a) {
        var b = [];
        qc(a, b, m);
        return b.join("")
    }

    function qc(a, b, c) {
        if (!(a.nodeName in lc))
            if (3 == a.nodeType) c ? b.push(("" + a.nodeValue).replace(/(\r\n|\r|\n)/g, "")) : b.push(a.nodeValue);
            else if (a.nodeName in mc) b.push(mc[a.nodeName]);
        else
            for (a = a.firstChild; a;) qc(a, b, c), a = a.nextSibling
    }

    function dc(a) {
        if (a && "number" == typeof a.length) {
            if (ma(a)) return "function" == typeof a.item || "string" == typeof a.item;
            if (la(a)) return "function" == typeof a.item
        }
        return m
    }

    function Ub(a) {
        this.Q = a || s.document || document
    }
    r = Ub.prototype;
    r.o = Tb;

    function rc(a) {
        return a.Q
    }
    r.a = function (a) {
        return u(a) ? this.Q.getElementById(a) : a
    };
    r.d = function (a, b, c) {
        return bc(this.Q, arguments)
    };
    r.createElement = function (a) {
        return this.Q.createElement(a)
    };
    r.createTextNode = function (a) {
        return this.Q.createTextNode(a)
    };

    function sc(a) {
        return Yb(a.Q)
    }

    function tc(a) {
        var b = a.Q,
            a = !C && Yb(b) ? b.documentElement : b.body,
            b = b.parentWindow || b.defaultView;
        return new F(b.pageXOffset || a.scrollLeft, b.pageYOffset || a.scrollTop)
    }
    r.appendChild = function (a, b) {
        a.appendChild(b)
    };
    r.append = ec;
    r.Mg = hc;
    r.contains = jc;
    r.Wj = kc;

    function uc() {
        if (!vc()) return m;
        var a = m;
        (a = document.createElement("canvas").mozGetAsFile) || (a = window.atob && (window.BlobBuilder || window.WebKitBlobBuilder || window.MozBlobBuilder));
        return !!a
    }

    function vc() {
        var a = s.URL || s.webkitURL,
            a = a && a.createObjectURL;
        return !!a
    }

    function wc() {
        return "FormData" in s && "File" in s && "files" in document.createElement("input")
    }
    ea("Aurigma.ImageUploaderFlash.Control.isHtmlUploaderSupported", wc);
    ea("Aurigma.ImageUploaderFlash.Control.isThumbnailCreationSupported", uc);
    ea("Aurigma.ImageUploaderFlash.Control.isImageRestrictionsSupported", function () {
        return vc()
    });

    function xc() {}
    var yc = 0;
    r = xc.prototype;
    r.key = 0;
    r.ic = m;
    r.Ue = m;
    r.ld = function (a, b, c, d, f, g) {
        la(a) ? this.Xg = i : a && a.handleEvent && la(a.handleEvent) ? this.Xg = m : e(Error("Invalid listener argument"));
        this.Gc = a;
        this.sh = b;
        this.src = c;
        this.type = d;
        this.capture = !! f;
        this.ae = g;
        this.Ue = m;
        this.key = ++yc;
        this.ic = m
    };
    r.handleEvent = function (a) {
        return this.Xg ? this.Gc.call(this.ae || this.src, a) : this.Gc.handleEvent.call(this.Gc, a)
    };
    var zc = !B || Ob(9),
        Ac = !B || Ob(9),
        Bc = B && !E("8");
    !C || E("528");
    Bb && E("1.9b") || B && E("8") || Ab && E("9.5") || C && E("528");
    !Bb || E("8");

    function Cc() {}
    Cc.prototype.Sd = m;
    Cc.prototype.i = function () {
        if (!this.Sd) this.Sd = i, this.h()
    };
    Cc.prototype.h = function () {
        this.li && Dc.apply(k, this.li)
    };

    function Ec(a) {
        a && "function" == typeof a.i && a.i()
    }

    function Dc(a) {
        for (var b = 0, c = arguments.length; b < c; ++b) {
            var d = arguments[b];
            ka(d) ? Dc.apply(k, d) : Ec(d)
        }
    };

    function G(a, b) {
        this.type = a;
        this.currentTarget = this.target = b
    }
    w(G, Cc);
    r = G.prototype;
    r.h = function () {
        delete this.type;
        delete this.target;
        delete this.currentTarget
    };
    r.hc = m;
    r.vd = i;
    r.stopPropagation = function () {
        this.hc = i
    };
    r.preventDefault = function () {
        this.vd = m
    };

    function Fc(a) {
        Fc[" "](a);
        return a
    }
    Fc[" "] = ha;

    function Gc(a, b) {
        a && this.ld(a, b)
    }
    w(Gc, G);
    var Hc = [1, 4, 2];
    r = Gc.prototype;
    r.target = k;
    r.relatedTarget = k;
    r.offsetX = 0;
    r.offsetY = 0;
    r.clientX = 0;
    r.clientY = 0;
    r.screenX = 0;
    r.screenY = 0;
    r.button = 0;
    r.keyCode = 0;
    r.charCode = 0;
    r.ctrlKey = m;
    r.altKey = m;
    r.shiftKey = m;
    r.metaKey = m;
    r.Vf = m;
    r.ga = k;
    r.ld = function (a, b) {
        var c = this.type = a.type;
        G.call(this, c);
        this.target = a.target || a.srcElement;
        this.currentTarget = b;
        var d = a.relatedTarget;
        if (d) {
            if (Bb) {
                var f;
                a: {
                    try {
                        Fc(d.nodeName);
                        f = i;
                        break a
                    } catch (g) {}
                    f = m
                }
                f || (d = k)
            }
        } else if ("mouseover" == c) d = a.fromElement;
        else if ("mouseout" == c) d = a.toElement;
        this.relatedTarget = d;
        this.offsetX = C || a.offsetX !== h ? a.offsetX : a.layerX;
        this.offsetY = C || a.offsetY !== h ? a.offsetY : a.layerY;
        this.clientX = a.clientX !== h ? a.clientX : a.pageX;
        this.clientY = a.clientY !== h ? a.clientY : a.pageY;
        this.screenX =
            a.screenX || 0;
        this.screenY = a.screenY || 0;
        this.button = a.button;
        this.keyCode = a.keyCode || 0;
        this.charCode = a.charCode || ("keypress" == c ? a.keyCode : 0);
        this.ctrlKey = a.ctrlKey;
        this.altKey = a.altKey;
        this.shiftKey = a.shiftKey;
        this.metaKey = a.metaKey;
        this.Vf = vb ? a.metaKey : a.ctrlKey;
        this.state = a.state;
        this.ga = a;
        delete this.vd;
        delete this.hc
    };

    function Ic(a) {
        return (zc ? 0 == a.ga.button : "click" == a.type ? i : !! (a.ga.button & Hc[0])) && !(C && vb && a.ctrlKey)
    }
    r.stopPropagation = function () {
        Gc.b.stopPropagation.call(this);
        this.ga.stopPropagation ? this.ga.stopPropagation() : this.ga.cancelBubble = i
    };
    r.preventDefault = function () {
        Gc.b.preventDefault.call(this);
        var a = this.ga;
        if (a.preventDefault) a.preventDefault();
        else if (a.returnValue = m, Bc) try {
            if (a.ctrlKey || 112 <= a.keyCode && 123 >= a.keyCode) a.keyCode = -1
        } catch (b) {}
    };
    r.si = n("ga");
    r.h = function () {
        Gc.b.h.call(this);
        this.relatedTarget = this.currentTarget = this.target = this.ga = k
    };
    var Jc = {}, Kc = {}, Lc = {}, Mc = {};

    function Nc(a, b, c, d, f) {
        if (b) {
            if (ja(b)) {
                for (var g = 0; g < b.length; g++) Nc(a, b[g], c, d, f);
                return k
            }
            var d = !! d,
                j = Kc;
            b in j || (j[b] = {
                fa: 0,
                Va: 0
            });
            j = j[b];
            d in j || (j[d] = {
                fa: 0,
                Va: 0
            }, j.fa++);
            var j = j[d],
                l = na(a),
                o;
            j.Va++;
            if (j[l]) {
                o = j[l];
                for (g = 0; g < o.length; g++)
                    if (j = o[g], j.Gc == c && j.ae == f) {
                        if (j.ic) break;
                        return o[g].key
                    }
            } else o = j[l] = [], j.fa++;
            g = Oc();
            g.src = a;
            j = new xc;
            j.ld(c, g, a, b, d, f);
            c = j.key;
            g.key = c;
            o.push(j);
            Jc[c] = j;
            Lc[l] || (Lc[l] = []);
            Lc[l].push(j);
            a.addEventListener ? (a == s || !a.Cg) && a.addEventListener(b, g, d) : a.attachEvent(b in
                Mc ? Mc[b] : Mc[b] = "on" + b, g);
            return c
        }
        e(Error("Invalid event type"))
    }

    function Oc() {
        var a = Pc,
            b = Ac ? function (c) {
                return a.call(b.src, b.key, c)
            } : function (c) {
                c = a.call(b.src, b.key, c);
                if (!c) return c
            };
        return b
    }

    function Qc(a, b, c, d, f) {
        if (ja(b)) {
            for (var g = 0; g < b.length; g++) Qc(a, b[g], c, d, f);
            return k
        }
        a = Nc(a, b, c, d, f);
        Jc[a].Ue = i;
        return a
    }

    function Rc(a, b, c, d, f) {
        if (ja(b))
            for (var g = 0; g < b.length; g++) Rc(a, b[g], c, d, f);
        else if (d = !! d, a = Sc(a, b, d))
            for (g = 0; g < a.length; g++)
                if (a[g].Gc == c && a[g].capture == d && a[g].ae == f) {
                    Tc(a[g].key);
                    break
                }
    }

    function Tc(a) {
        if (!Jc[a]) return m;
        var b = Jc[a];
        if (b.ic) return m;
        var c = b.src,
            d = b.type,
            f = b.sh,
            g = b.capture;
        c.removeEventListener ? (c == s || !c.Cg) && c.removeEventListener(d, f, g) : c.detachEvent && c.detachEvent(d in Mc ? Mc[d] : Mc[d] = "on" + d, f);
        c = na(c);
        f = Kc[d][g][c];
        if (Lc[c]) {
            var j = Lc[c];
            Wa(j, b);
            0 == j.length && delete Lc[c]
        }
        b.ic = i;
        f.kh = i;
        Uc(d, g, c, f);
        delete Jc[a];
        return i
    }

    function Uc(a, b, c, d) {
        if (!d.ke && d.kh) {
            for (var f = 0, g = 0; f < d.length; f++) d[f].ic ? d[f].sh.src = k : (f != g && (d[g] = d[f]), g++);
            d.length = g;
            d.kh = m;
            0 == g && (delete Kc[a][b][c], Kc[a][b].fa--, 0 == Kc[a][b].fa && (delete Kc[a][b], Kc[a].fa--), 0 == Kc[a].fa && delete Kc[a])
        }
    }

    function Vc(a) {
        var b, c = 0,
            d = b == k;
        b = !! b;
        if (a == k) jb(Lc, function (a) {
            for (var f = a.length - 1; 0 <= f; f--) {
                var g = a[f];
                if (d || b == g.capture) Tc(g.key), c++
            }
        });
        else if (a = na(a), Lc[a])
            for (var a = Lc[a], f = a.length - 1; 0 <= f; f--) {
                var g = a[f];
                if (d || b == g.capture) Tc(g.key), c++
            }
    }

    function Sc(a, b, c) {
        var d = Kc;
        return b in d && (d = d[b], c in d && (d = d[c], a = na(a), d[a])) ? d[a] : k
    }

    function Wc(a) {
        var a = na(a),
            b = Lc[a];
        if (b) {
            var c = fa("progress"),
                d = fa(h);
            return c && d ? (b = Kc.progress, !! b && !! b[h] && a in b[h]) : !c && !d ? i : Ta(b, function (a) {
                return c && "progress" == a.type || d && a.capture == h
            })
        }
        return m
    }

    function Xc(a, b, c, d, f) {
        var g = 1,
            b = na(b);
        if (a[b]) {
            a.Va--;
            a = a[b];
            a.ke ? a.ke++ : a.ke = 1;
            try {
                for (var j = a.length, l = 0; l < j; l++) {
                    var o = a[l];
                    o && !o.ic && (g &= Yc(o, f) !== m)
                }
            } finally {
                a.ke--, Uc(c, d, b, a)
            }
        }
        return Boolean(g)
    }

    function Yc(a, b) {
        var c = a.handleEvent(b);
        a.Ue && Tc(a.key);
        return c
    }

    function Pc(a, b) {
        if (!Jc[a]) return i;
        var c = Jc[a],
            d = c.type,
            f = Kc;
        if (!(d in f)) return i;
        var f = f[d],
            g, j;
        if (!Ac) {
            g = b || ga("window.event");
            var l = i in f,
                o = m in f;
            if (l) {
                if (0 > g.keyCode || g.returnValue != h) return i;
                a: {
                    var q = m;
                    if (0 == g.keyCode) try {
                        g.keyCode = -1;
                        break a
                    } catch (z) {
                        q = i
                    }
                    if (q || g.returnValue == h) g.returnValue = i
                }
            }
            q = new Gc;
            q.ld(g, this);
            g = i;
            try {
                if (l) {
                    for (var D = [], S = q.currentTarget; S; S = S.parentNode) D.push(S);
                    j = f[i];
                    j.Va = j.fa;
                    for (var Y = D.length - 1; !q.hc && 0 <= Y && j.Va; Y--) q.currentTarget = D[Y], g &= Xc(j, D[Y], d, i, q);
                    if (o) {
                        j = f[m];
                        j.Va = j.fa;
                        for (Y = 0; !q.hc && Y < D.length && j.Va; Y++) q.currentTarget = D[Y], g &= Xc(j, D[Y], d, m, q)
                    }
                } else g = Yc(c, q)
            } finally {
                if (D) D.length = 0;
                q.i()
            }
            return g
        }
        d = new Gc(b, this);
        try {
            g = Yc(c, d)
        } finally {
            d.i()
        }
        return g
    }
    var Zc = 0;

    function H() {}
    w(H, Cc);
    r = H.prototype;
    r.Cg = i;
    r.pe = k;
    r.dg = ca("pe");
    r.addEventListener = function (a, b, c, d) {
        Nc(this, a, b, c, d)
    };
    r.removeEventListener = function (a, b, c, d) {
        Rc(this, a, b, c, d)
    };
    r.dispatchEvent = function (a) {
        var b = a.type || a,
            c = Kc;
        if (b in c) {
            if (u(a)) a = new G(a, this);
            else if (a instanceof G) a.target = a.target || this;
            else {
                var d = a,
                    a = new G(b, this);
                pb(a, d)
            }
            var d = 1,
                f, c = c[b],
                b = i in c,
                g;
            if (b) {
                f = [];
                for (g = this; g; g = g.pe) f.push(g);
                g = c[i];
                g.Va = g.fa;
                for (var j = f.length - 1; !a.hc && 0 <= j && g.Va; j--) a.currentTarget = f[j], d &= Xc(g, f[j], a.type, i, a) && a.vd != m
            }
            if (m in c)
                if (g = c[m], g.Va = g.fa, b)
                    for (j = 0; !a.hc && j < f.length && g.Va; j++) a.currentTarget = f[j], d &= Xc(g, f[j], a.type, m, a) && a.vd != m;
                else
                    for (f = this; !a.hc && f &&
                        g.Va; f = f.pe) a.currentTarget = f, d &= Xc(g, f, a.type, m, a) && a.vd != m;
            a = Boolean(d)
        } else a = i;
        return a
    };
    r.h = function () {
        H.b.h.call(this);
        Vc(this);
        this.pe = k
    };

    function $c(a, b, c) {
        G.call(this, a);
        this.Ff = b;
        this.l = c
    }
    w($c, G);
    var ad = "collection_changed_" + Zc++;
    $c.prototype.ma = n("l");
    $c.prototype.h = function () {
        $c.b.h.call(this);
        delete this.Ff;
        delete this.l
    };

    function bd() {
        this.S = []
    }
    w(bd, H);
    r = bd.prototype;
    r.add = function (a) {
        this.S.push(a);
        a = new $c(ad, "add", [a]);
        try {
            this.dispatchEvent(a)
        } finally {
            a.i()
        }
    };
    r.remove = function (a) {
        return this.Kb(Ra(this.S, a))
    };
    r.Kb = function (a) {
        if (this.S.length > a) {
            var b = this.S[a];
            if (a = 1 == Qa.splice.call(this.S, a, 1).length) {
                b = new $c(ad, "remove", [b]);
                try {
                    this.dispatchEvent(b)
                } finally {
                    b.i()
                }
            }
            return a
        }
        return m
    };
    r.getItem = function (a) {
        return this.S[a]
    };
    r.clear = function () {
        if (0 < this.S.length) {
            this.S = [];
            var a = new $c(ad, "reset", []);
            try {
                this.dispatchEvent(a)
            } finally {
                a.i()
            }
        }
    };
    r.contains = function (a) {
        return Va(this.S, a)
    };
    r.Z = function () {
        return this.S.length
    };
    r.Ge = function () {
        return this.S.slice()
    };

    function cd(a, b) {
        switch (a) {
        case 11:
            return I(b, "UploadErrorMessage");
        case 2:
            return J(I(b, "ServerNotFoundMessage"), I(b, "ActionUrl"));
        case 4:
            return I(b, "ServerSideErrorMessage");
        case 0:
            return I(b, "UploadErrorMessage");
        default:
            return ""
        }
    };

    function dd(a) {
        this.q = a;
        this.W = []
    }
    w(dd, Cc);
    var ed = [];
    r = dd.prototype;
    r.c = function (a, b, c, d, f) {
        ja(b) || (ed[0] = b, b = ed);
        for (var g = 0; g < b.length; g++) this.W.push(Nc(a, b[g], c || this, d || m, f || this.q || this));
        return this
    };

    function fd(a, b, c, d, f, g) {
        if (ja(c))
            for (var j = 0; j < c.length; j++) fd(a, b, c[j], d, f, g);
        else a.W.push(Qc(b, c, d || a, f, g || a.q || a))
    }
    r.ea = function (a, b, c, d, f) {
        if (ja(b))
            for (var g = 0; g < b.length; g++) this.ea(a, b[g], c, d, f);
        else {
            a: {
                c = c || this;
                f = f || this.q || this;
                d = !! d;
                if (a = Sc(a, b, d))
                    for (b = 0; b < a.length; b++)
                        if (!a[b].ic && a[b].Gc == c && a[b].capture == d && a[b].ae == f) {
                            a = a[b];
                            break a
                        }
                a = k
            }
            if (a) a = a.key, Tc(a), Wa(this.W, a)
        }
        return this
    };
    r.vb = function () {
        y(this.W, Tc);
        this.W.length = 0
    };
    r.h = function () {
        dd.b.h.call(this);
        this.vb()
    };
    r.handleEvent = function () {
        e(Error("EventHandler.handleEvent not implemented"))
    };

    function gd() {
        return m
    };
    /*
     * Portions
     * of
     * this
     * code
     * are
     * from
     * MochiKit,
     * received
     * by
     * The
     * Closure
     * Authors
     * under
     * the
     * MIT
     * license.
     * All
     * other
     * code
     * is
     * Copyright
     * 2005-2009
     * The
     * Closure
     * Authors.
     * All
     * Rights
     * Reserved.
     */
    function hd() {
        if (fa(s.URL) && fa(s.URL.createObjectURL)) return s.URL;
        if (fa(s.webkitURL) && fa(s.webkitURL.createObjectURL)) return s.webkitURL;
        if (fa(s.createObjectURL)) return s;
        e(Error("This browser doesn't seem to support blob URLs"))
    };

    function id() {
        this.q = new dd(this);
        this.Ka = []
    }
    w(id, H);
    id.prototype.load = function (a, b) {
        this.U ? this.Ka.push({
            file: a,
            Zi: b
        }) : (this.U = i, this.zf = m, this.qa = b = b || new Image, vc() ? (this.q.c(b, ["load", "error"], this.be), b.src = hd().createObjectURL(a)) : setTimeout(v(this.ei, this), 0))
    };
    id.prototype.ei = function () {
        this.be(new G("error"))
    };
    id.prototype.be = function (a) {
        if (this.qa && this.qa.src) {
            var b = this.qa.src;
            hd().revokeObjectURL(b)
        }
        this.q.vb();
        if ("load" == a.type) this.zf = i;
        try {
            this.dispatchEvent(jd)
        } finally {
            this.qa = k, this.U = this.zf = m, 0 < this.Ka.length && (a = this.Ka.shift(), this.load(a.file, a.Zi))
        }
    };
    id.prototype.Dc = n("zf");
    var jd = "load";

    function kd(a, b, c) {
        return Math.min(Math.max(a, b), c)
    }

    function ld(a) {
        a %= 360;
        return 0 > 360 * a ? a + 360 : a
    };

    function J(a, b) {
        var c = bb(arguments, 1);
        return a.replace(nd, function (a, b) {
            return c[parseInt(b, 10)]
        })
    }

    function od() {
        return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (a) {
            var b = 16 * Math.random() | 0;
            return ("x" == a ? b : b & 3 | 8).toString(16)
        })
    }

    function pd(a, b, c) {
        return setTimeout(c ? v(a, c) : a, b)
    }
    var nd = /{(\d+)}/g;

    function qd(a) {
        for (var a = a.split("."), b = 0, c = a.length - 1; b < c && !a[b]; ++b);
        return b < c ? a.pop() : ""
    }

    function rd(a) {
        e(Error(a))
    }

    function sd(a) {
        a = a.toString(16);
        a = "000000".slice(a.length) + a;
        return "#" + a
    };

    function td(a) {
        switch (qd(a).toLowerCase()) {
        case "jpg":
        case "jpeg":
        case "bmp":
        case "png":
        case "gif":
            return i
        }
        return m
    }

    function ud(a, b, c, d, f, g) {
        g != k || (g = "fit");
        f != k || (f = 0);
        var j, f = ld(f);
        if (90 == f || 270 == f) f = a, a = b, b = f;
        switch (g) {
        case "actualsize":
            return {
                width: a,
                height: b
            };
        case "height":
            j = d / b;
            break;
        case "width":
            j = c / a;
            break;
        case "fit":
            j = d / b;
            c / a < j && (j = c / a);
            break;
        default:
            rd('Incorrect "fitMode" value.')
        }
        1 < j && (j = 1);
        return {
            width: Math.floor(a * j) || 1,
            height: Math.floor(b * j) || 1
        }
    }

    function vd(a, b) {
        var c = na(a),
            d = wd[c];
        if (d) b({
            width: d.width,
            height: d.height
        });
        else {
            var f = new id;
            Nc(f, jd, function j() {
                Rc(f, jd, j);
                var a;
                if (f.Dc()) {
                    a = f.qa;
                    if (!("naturalWidth" in a)) a.naturalWidth = a.width, a.naturalHeight = a.height;
                    wd[c] = {
                        width: a.naturalWidth,
                        height: a.naturalHeight
                    };
                    a = {
                        width: a.naturalWidth,
                        height: a.naturalHeight
                    }
                } else wd[c] = {
                    width: 0,
                    height: 0
                }, a = {
                    width: 0,
                    height: 0
                };
                b(a)
            });
            f.load(a)
        }
    }
    var wd = {};
    var xd = "add_file_" + Zc++,
        yd = "property_change_" + Zc++,
        zd = "complete_" + Zc++;

    function Ad(a, b, c) {
        G.call(this, yd);
        this.rh = a;
        this.dm = b;
        this.ij = c
    }
    w(Ad, G);

    function Bd() {
        this.q = new dd(this);
        this.Me = {}
    }
    w(Bd, H);
    Bd.prototype.I = function (a, b) {
        return a in this.Me ? this.Me[a] : b
    };
    Bd.prototype.sa = function (a, b, c) {
        var d = this.Me,
            f = !c && d[a];
        d[a] = b;
        if (!c && f != b) {
            a = new Ad(a, f, b);
            try {
                this.dispatchEvent(a)
            } finally {
                a.i()
            }
        }
    };
    Bd.prototype.h = function () {
        Bd.b.h.call(this);
        delete this.Me;
        this.q.i();
        delete this.q
    };

    function Cd(a, b) {
        var c = "";
        fa(h) || (c = "B");
        var d = a,
            f = Dd,
            g = d,
            j, l = 1;
        0 > d && (d = -d);
        for (var o = 0; o < Ed.length; o++) {
            var q = Ed[o],
                l = f[q];
            if (d >= l || 1 >= l && d > 0.1 * l) {
                j = q;
                break
            }
        }
        fa(j) ? c && (j += c) : (j = "", l = 1);
        c = Math.pow(10, fa(b) ? b : 2);
        return Math.round(g / l * c) / c + j
    }
    var Ed = "P,T,G,M,K,,m,u,n".split(","),
        Dd = {
            "": 1,
            n: Math.pow(1024, -3),
            u: Math.pow(1024, -2),
            m: 1 / 1024,
            k: 1024,
            K: 1024,
            M: Math.pow(1024, 2),
            G: Math.pow(1024, 3),
            T: Math.pow(1024, 4),
            P: Math.pow(1024, 5)
        };
    B && E(8);

    function Fd(a) {
        Bd.call(this);
        this.Yb = a;
        this.Ce = this.Ee = k;
        Gd(this) ? (this.sa(Hd, Id, i), this.Ee = document.createElement("canvas"), this.Ce = document.createElement("canvas")) : this.sa(Hd, Jd, i);
        this.sa(Kd, 0, i);
        this.sa(Ld, 0, i);
        this.sa(Md, 0, i);
        this.sa(Nd, "", i)
    }
    w(Fd, Bd);
    var Kd = "imageWidth",
        Ld = "imageHeight",
        Md = "angle",
        Nd = "description",
        Hd = "state",
        Id = 0,
        Jd = 1;
    r = Fd.prototype;
    r.getFile = n("Yb");
    r.getName = function () {
        return this.Yb.name
    };
    r.xc = function () {
        return this.Yb.size
    };
    r.of = function () {
        return this.Yb.type
    };

    function Od(a, b) {
        Gd(a) && (b = ld(b), isNaN(b) || a.sa(Md, b))
    }
    r.gb = function () {
        return this.I(Hd)
    };
    r.N = function (a) {
        a != k && this.sa(Hd, a)
    };

    function Gd(a) {
        return /^image\/(jpeg|bmp|png|gif)$/.test(a.of()) || td(a.getName())
    }
    r.h = function () {
        Fd.b.h.call(this);
        delete this.Yb;
        delete this.Ce;
        delete this.Ee
    };

    function Pd(a, b, c, d, f, g, j, l, o) {
        this.Jg = Qd(a);
        this.bh = b || 0;
        this.eh = c || 0;
        this.dh = d || 0;
        this.gh = f || 0;
        this.Kf = g || 0;
        this.Mf = j || 0;
        this.Jf = l || 0;
        this.Lf = o || 0
    }

    function Rd(a, b, c, d) {
        var f;
        if (f = a.Jg) {
            var g = a.Jg;
            f = b.name;
            if (!g || !g.length) f = i;
            else {
                for (var g = g.replace(/([-()\[\]{}+.$\^|,:#<!\\])/g, "\\$1").replace(/\?/g, ".").replace(/\*/g, ".*"), j = "", g = g.split(";"), l = 0, o = g.length; l < o; ++l) g[l] && (j && (j += "|"), j += g[l]);
                f = RegExp("^(" + j + ")$", "gi").test(f)
            }
            f = !f
        }
        if (f) return Sd;
        if (0 != a.dh && b.size > a.dh) return Td;
        if (0 != a.gh && b.size < a.gh) return Ud;
        if (0 != a.bh && c + 1 > a.bh) return Vd;
        if (0 != a.eh && d + b.size > a.eh) return Wd;
        c = 0 < a.Kf || 0 < a.Mf;
        c |= 0 < a.Jf || 0 < a.Lf;
        return (c &= /^image\/(jpeg|bmp|png|gif)$/.test(b.type) ||
            td(b.name)) ? Xd : Yd
    }

    function Zd(a, b, c, d, f) {
        c = Rd(a, b, c, d);
        c == Xd ? vd(b, v(function (a) {
            f(0 != this.Jf && a.height > this.Jf ? $d : 0 != this.Kf && a.width > this.Kf ? ae : 0 != this.Lf && a.height < this.Lf ? be : 0 != this.Mf && a.width < this.Mf ? ce : Yd)
        }, a)) : pd(sa(f, c), 0)
    }

    function Qd(a) {
        if (a == k || !(0 < a.length)) return "";
        var b = [];
        y(a, function (a) {
            a && a[1] && "*.*" != a[1] && b.push(a[1])
        });
        return b.join(";").toLowerCase()
    }
    var Xd = -1,
        Yd = 0,
        Vd = 2,
        Td = 3,
        Ud = 4,
        Wd = 5,
        $d = 6,
        ae = 7,
        be = 8,
        ce = 9,
        Sd = 10;

    function de() {}
    w(de, H);

    function ee(a) {
        if (!a.ua) {
            var b = a.ad;
            if (!b || !(0 < b.length)) a.eb();
            else {
                for (var c = a.ng, d = a.Cf, f = a.ee, g = [], j, l;
                    (j = b.shift()) && (l = Rd(c, j, d, f)) !== Xd;) {
                    var o = new Fd(j);
                    if (l === Yd)++d, f += j.size, g.push(o);
                    else switch (0 < g.length && (fe(a, g), g = []), l) {
                    case Sd:
                    case Td:
                    case Ud:
                        ge(a, o, l);
                        break;
                    case Vd:
                    case Wd:
                        ge(a, o, l);
                        a.eb();
                        return;
                    default:
                        rd('Unexpected "verifyCode" value.')
                    }
                }
                0 < g.length && fe(a, g);
                a.Cf = d;
                a.ee = f;
                j && l === Xd ? Zd(c, j, d, f, v(a.ok, a, j)) : a.eb()
            }
        }
    }
    de.prototype.ok = function (a, b) {
        if (!this.ua) {
            var c = new Fd(a);
            if (b) switch (b) {
            case Sd:
            case Td:
            case Ud:
            case $d:
            case ae:
            case be:
            case ce:
                ge(this, c, b);
                ee(this);
                break;
            case Vd:
            case Wd:
                ge(this, c, b);
                this.eb();
                break;
            default:
                rd('Unexpected "verifyCode" value.')
            } else ++this.Cf, this.ee += a.size, fe(this, [c]), ee(this)
        }
    };
    de.prototype.eb = function () {
        if (!this.ua) try {
            this.dispatchEvent(he)
        } finally {
            this.ng = this.ad = k
        }
    };

    function fe(a, b) {
        if (!a.ua) {
            var c = new G(ie);
            c.items = b;
            try {
                a.dispatchEvent(c)
            } finally {
                c.i()
            }
        }
    }

    function ge(a, b, c) {
        if (!a.ua) {
            var d = new G(je);
            d.item = b;
            d.code = c;
            try {
                a.dispatchEvent(d)
            } finally {
                d.i()
            }
        }
    }
    de.prototype.reset = function () {
        this.ua = i;
        this.ng = this.ad = k
    };
    var ie = "progress",
        he = zd,
        je = "fileSkipped_" + Zc++;

    function ke(a, b, c, d) {
        G.call(this, a);
        this.Fa = b || 0;
        this.response = c || "";
        this.Wc = d || ""
    }
    w(ke, G);
    ke.prototype.h = function () {
        ke.b.h.call(this)
    };

    function le(a, b, c, d, f, g) {
        this.xb = a;
        this.ra = b;
        this.ib = c;
        this.Wa = d;
        this.ia = f;
        this.Aa = g
    }
    le.prototype.va = function () {
        return new le(this.xb, this.ra, this.ib, this.Wa, this.ia, this.Aa)
    };

    function me(a, b, c, d, f) {
        G.call(this, a);
        this.ne = b;
        this.Fa = c || 0;
        this.response = d || "";
        this.Wc = f || ""
    }
    w(me, G);

    function ne() {
        this.jf = new FormData
    };

    function oe(a) {
        G.call(this, zd);
        this.Gj = a
    }
    w(oe, G);

    function pe(a, b, c, d) {
        G.call(this, a || "progress");
        this.lengthComputable = !! b;
        this.loaded = c || 0;
        this.total = d || 0
    }
    w(pe, G);

    function qe(a) {
        if ("function" == typeof a.Zb) return a.Zb();
        if (u(a)) return a.split("");
        if (ka(a)) {
            for (var b = [], c = a.length, d = 0; d < c; d++) b.push(a[d]);
            return b
        }
        return kb(a)
    }

    function re(a, b, c) {
        if ("function" == typeof a.forEach) a.forEach(b, c);
        else if (ka(a) || u(a)) y(a, b, c);
        else {
            var d;
            if ("function" == typeof a.ed) d = a.ed();
            else if ("function" != typeof a.Zb)
                if (ka(a) || u(a)) {
                    d = [];
                    for (var f = a.length, g = 0; g < f; g++) d.push(g)
                } else d = lb(a);
                else d = h;
            for (var f = qe(a), g = f.length, j = 0; j < g; j++) b.call(c, f[j], d && d[j], a)
        }
    };
    var se = "StopIteration" in s ? s.StopIteration : Error("StopIteration");

    function te() {}
    te.prototype.next = function () {
        e(se)
    };
    te.prototype.Nc = function () {
        return this
    };

    function ve(a) {
        if (a instanceof te) return a;
        if ("function" == typeof a.Nc) return a.Nc(m);
        if (ka(a)) {
            var b = 0,
                c = new te;
            c.next = function () {
                for (;;) {
                    b >= a.length && e(se);
                    if (b in a) return a[b++];
                    b++
                }
            };
            return c
        }
        e(Error("Not implemented"))
    }

    function we(a, b) {
        if (ka(a)) try {
            y(a, b, h)
        } catch (c) {
            c !== se && e(c)
        } else {
            a = ve(a);
            try {
                for (;;) b.call(h, a.next(), h, a)
            } catch (d) {
                d !== se && e(d)
            }
        }
    };

    function xe(a, b) {
        this.aa = {};
        this.W = [];
        var c = arguments.length;
        if (1 < c) {
            c % 2 && e(Error("Uneven number of arguments"));
            for (var d = 0; d < c; d += 2) this.set(arguments[d], arguments[d + 1])
        } else a && this.Oe(a)
    }
    r = xe.prototype;
    r.fa = 0;
    r.Fd = 0;
    r.Z = n("fa");
    r.Zb = function () {
        ye(this);
        for (var a = [], b = 0; b < this.W.length; b++) a.push(this.aa[this.W[b]]);
        return a
    };
    r.ed = function () {
        ye(this);
        return this.W.concat()
    };
    r.clear = function () {
        this.aa = {};
        this.Fd = this.fa = this.W.length = 0
    };
    r.remove = function (a) {
        return ze(this.aa, a) ? (delete this.aa[a], this.fa--, this.Fd++, this.W.length > 2 * this.fa && ye(this), i) : m
    };

    function ye(a) {
        if (a.fa != a.W.length) {
            for (var b = 0, c = 0; b < a.W.length;) {
                var d = a.W[b];
                ze(a.aa, d) && (a.W[c++] = d);
                b++
            }
            a.W.length = c
        }
        if (a.fa != a.W.length) {
            for (var f = {}, c = b = 0; b < a.W.length;) d = a.W[b], ze(f, d) || (a.W[c++] = d, f[d] = 1), b++;
            a.W.length = c
        }
    }
    r.get = function (a, b) {
        return ze(this.aa, a) ? this.aa[a] : b
    };
    r.set = function (a, b) {
        ze(this.aa, a) || (this.fa++, this.W.push(a), this.Fd++);
        this.aa[a] = b
    };
    r.Oe = function (a) {
        var b;
        a instanceof xe ? (b = a.ed(), a = a.Zb()) : (b = lb(a), a = kb(a));
        for (var c = 0; c < b.length; c++) this.set(b[c], a[c])
    };
    r.va = function () {
        return new xe(this)
    };
    r.Nc = function (a) {
        ye(this);
        var b = 0,
            c = this.W,
            d = this.aa,
            f = this.Fd,
            g = this,
            j = new te;
        j.next = function () {
            for (;;) {
                f != g.Fd && e(Error("The map has changed since the iterator was created"));
                b >= c.length && e(se);
                var j = c[b++];
                return a ? j : d[j]
            }
        };
        return j
    };

    function ze(a, b) {
        return Object.prototype.hasOwnProperty.call(a, b)
    };

    function Ae(a) {
        this.aa = new xe;
        a && this.Oe(a)
    }

    function Be(a) {
        var b = typeof a;
        return "object" == b && a || "function" == b ? "o" + na(a) : b.substr(0, 1) + a
    }
    r = Ae.prototype;
    r.Z = function () {
        return this.aa.Z()
    };
    r.add = function (a) {
        this.aa.set(Be(a), a)
    };
    r.Oe = function (a) {
        for (var a = qe(a), b = a.length, c = 0; c < b; c++) this.add(a[c])
    };
    r.vb = function (a) {
        for (var a = qe(a), b = a.length, c = 0; c < b; c++) this.remove(a[c])
    };
    r.remove = function (a) {
        return this.aa.remove(Be(a))
    };
    r.clear = function () {
        this.aa.clear()
    };
    r.contains = function (a) {
        a = Be(a);
        return ze(this.aa.aa, a)
    };
    r.Vg = function (a) {
        for (var b = new Ae, a = qe(a), c = 0; c < a.length; c++) {
            var d = a[c];
            this.contains(d) && b.add(d)
        }
        return b
    };
    r.Zb = function () {
        return this.aa.Zb()
    };
    r.va = function () {
        return new Ae(this)
    };
    r.Nc = function () {
        return this.aa.Nc(m)
    };

    function Ce(a) {
        return De(a || arguments.callee.caller, [])
    }

    function De(a, b) {
        var c = [];
        if (Va(b, a)) c.push("[...circular reference...]");
        else if (a && 50 > b.length) {
            c.push(Ee(a) + "(");
            for (var d = a.arguments, f = 0; f < d.length; f++) {
                0 < f && c.push(", ");
                var g;
                g = d[f];
                switch (typeof g) {
                case "object":
                    g = g ? "object" : "null";
                    break;
                case "string":
                    break;
                case "number":
                    g = "" + g;
                    break;
                case "boolean":
                    g = g ? "true" : "false";
                    break;
                case "function":
                    g = (g = Ee(g)) ? g : "[fn]";
                    break;
                default:
                    g = typeof g
                }
                40 < g.length && (g = g.substr(0, 40) + "...");
                c.push(g)
            }
            b.push(a);
            c.push(")\n");
            try {
                c.push(De(a.caller, b))
            } catch (j) {
                c.push("[exception trying to get caller]\n")
            }
        } else a ?
            c.push("[...long stack...]") : c.push("[end]");
        return c.join("")
    }

    function Ee(a) {
        if (Fe[a]) return Fe[a];
        a = "" + a;
        if (!Fe[a]) {
            var b = /function ([^\(]+)/.exec(a);
            Fe[a] = b ? b[1] : "[Anonymous]"
        }
        return Fe[a]
    }
    var Fe = {};

    function Ge(a, b, c, d, f) {
        this.reset(a, b, c, d, f)
    }
    Ge.prototype.Mj = 0;
    Ge.prototype.gf = k;
    Ge.prototype.ff = k;
    var He = 0;
    Ge.prototype.reset = function (a, b, c, d, f) {
        this.Mj = "number" == typeof f ? f : He++;
        this.Mh = d || ta();
        this.Fc = a;
        this.ih = b;
        this.dj = c;
        delete this.gf;
        delete this.ff
    };
    Ge.prototype.bg = ca("Fc");

    function Ie(a) {
        this.jh = a
    }
    Ie.prototype.ba = k;
    Ie.prototype.Fc = k;
    Ie.prototype.Y = k;
    Ie.prototype.gd = k;

    function Je(a, b) {
        this.name = a;
        this.value = b
    }
    Je.prototype.toString = n("name");
    var Ke = new Je("SEVERE", 1E3),
        Le = new Je("WARNING", 900),
        Me = new Je("INFO", 800),
        Ne = new Je("CONFIG", 700),
        Oe = new Je("FINE", 500),
        Pe = new Je("FINER", 400),
        Qe = new Je("FINEST", 300);

    function Re(a) {
        s.console && (s.console.timeStamp ? s.console.timeStamp(a) : s.console.markTimeline && s.console.markTimeline(a));
        s.msWriteProfilerMark && s.msWriteProfilerMark(a)
    }
    r = Ie.prototype;
    r.getName = n("jh");
    r.getParent = n("ba");
    r.bg = ca("Fc");

    function Se(a) {
        if (a.Fc) return a.Fc;
        if (a.ba) return Se(a.ba);
        Pa("Root logger has no level set.");
        return k
    }
    r.log = function (a, b, c) {
        if (a.value >= Se(this).value) {
            a = this.Ci(a, b, c);
            Re("log:" + a.ih);
            for (b = this; b;) {
                var c = b,
                    d = a;
                if (c.gd)
                    for (var f = 0, g = h; g = c.gd[f]; f++) g(d);
                b = b.getParent()
            }
        }
    };
    r.Ci = function (a, b, c) {
        var d = new Ge(a, "" + b, this.jh);
        if (c) {
            d.gf = c;
            var f;
            var g = arguments.callee.caller;
            try {
                var j;
                var l = ga("window.location.href");
                if (u(c)) j = {
                    message: c,
                    name: "Unknown error",
                    lineNumber: "Not available",
                    fileName: l,
                    stack: "Not available"
                };
                else {
                    var o, q, z = m;
                    try {
                        o = c.lineNumber || c.$l || "Not available"
                    } catch (D) {
                        o = "Not available", z = i
                    }
                    try {
                        q = c.fileName || c.filename || c.sourceURL || l
                    } catch (S) {
                        q = "Not available", z = i
                    }
                    j = z || !c.lineNumber || !c.fileName || !c.stack ? {
                        message: c.message,
                        name: c.name,
                        lineNumber: o,
                        fileName: q,
                        stack: c.stack || "Not available"
                    } : c
                }
                f = "Message: " + Ga(j.message) + '\nUrl: <a href="view-source:' + j.fileName + '" target="_new">' + j.fileName + "</a>\nLine: " + j.lineNumber + "\n\nBrowser stack:\n" + Ga(j.stack + "-> ") + "[end]\n\nJS stack traversal:\n" + Ga(Ce(g) + "-> ")
            } catch (Y) {
                f = "Exception trying to expose exception! You win, we lose. " + Y
            }
            d.ff = f
        }
        return d
    };

    function K(a, b) {
        a.log(Le, b, h)
    }
    r.info = function (a, b) {
        this.log(Me, a, b)
    };

    function L(a, b) {
        a.log(Oe, b, h)
    }
    var Te = {}, Ue = k;

    function Ve() {
        Ue || (Ue = new Ie(""), Te[""] = Ue, Ue.bg(Ne))
    }

    function M(a) {
        Ve();
        var b;
        if (!(b = Te[a])) {
            b = new Ie(a);
            var c = a.lastIndexOf("."),
                d = a.substr(c + 1),
                c = M(a.substr(0, c));
            if (!c.Y) c.Y = {};
            c.Y[d] = b;
            b.ba = c;
            Te[a] = b
        }
        return b
    };

    function We() {
        this.U = m;
        this.zg = new dd(this);
        this.reset(0, [])
    }
    w(We, H);
    t(We);
    r = We.prototype;
    r.reset = function (a, b, c) {
        L(this.e, "Resetting packager");
        this.Cj = a;
        this.Db = c || k;
        this.Dj = od();
        this.Tf = 0;
        this.Ka = [];
        this.rd = this.Ga = k;
        this.zg.vb();
        if (this.O)
            for (a = 0; c = this.O[a++];) c.reset();
        this.O = bb(b, 0);
        for (a = 0; c = this.O[a++];) this.zg.c(c, zd, this.ji);
        this.U = m
    };
    r.cf = function (a) {
        this.Ka.push(a);
        this.U || this.Ib()
    };
    r.Ib = function () {
        if (!this.U) {
            this.rd = k;
            var a = this.Ga = this.Ka.shift();
            if (a) {
                L(this.e, "Creating new package " + this.Tf);
                this.U = i;
                var b = function () {
                    var b = this.rd = new ne,
                        d = [
                            ["PackageGuid", this.Dj],
                            ["PackageFileCount", 1],
                            ["PackageCount", this.Cj],
                            ["PackageIndex", this.Tf],
                            [J("SourceName_{0}", 0), a.getName()],
                            [J("SourceSize_{0}", 0), a.xc()],
                            [J("SourceWidth_{0}", 0), a.I(Kd)],
                            [J("SourceHeight_{0}", 0), a.I(Ld)],
                            [J("Angle_{0}", 0), a.I(Md)],
                            [J("Description_{0}", 0), a.I(Nd)]
                        ];
                    Xe(b, d);
                    if (d = this.Db)
                        for (var f in d)
                            if (d.hasOwnProperty(f)) {
                                var g =
                                    d[f];
                                if (g)
                                    for (var j = 0, l = g.length; j < l; ++j) b.jf.append(f, g[j])
                            }
                    this.Sc = 0;
                    Ye(this)
                };
                a.gb() < Jd ? (a.addEventListener(yd, function d(f) {
                    f.rh == Hd && f.ij >= Jd && (a.removeEventListener(yd, d, m, this), b.call(this))
                }, m, this), vd(a.getFile(), function (b) {
                    a.sa(Kd, b.width);
                    a.sa(Ld, b.height);
                    a.N(Jd)
                })) : b.call(this)
            }
        }
    };

    function Ye(a) {
        a.Sc < a.O.length ? a.O[a.Sc].apply(a.Ga) : (Xe(a.rd, [
            ["PackageComplete", 1],
            ["RequestComplete", 1]
        ]), 0 == a.O.length && a.Rd(), a.eb(), a.U = m, a.Tf++, a.Ib())
    }
    r.ji = function (a) {
        var b = a.ii;
        if (b) {
            var a = this.rd,
                c = this.Sc,
                b = b.mode == Ze ? [
                    [J("File{1}Mode_{0}", 0, c), b.mode]
                ] : [
                    [J("File{1}Mode_{0}", 0, c), b.mode],
                    [J("File{1}Name_{0}", 0, c), b.fileName],
                    [J("File{1}Size_{0}", 0, c), b.size],
                    [J("File{1}Width_{0}", 0, c), b.Kh],
                    [J("File{1}Height_{0}", 0, c), b.Jh],
                    [J("File{1}_{0}", 0, c), b.file, b.fileName]
                ];
            Xe(a, b)
        }
        this.Rd();
        this.Sc++;
        Ye(this)
    };

    function Xe(a, b) {
        for (var c, d = 0; c = b[d++];) a.jf.append(c[0], c[1])
    }
    r.eb = function () {
        L(this.e, "Package created.");
        this.dispatchEvent(new oe(this.rd))
    };
    r.Rd = function () {
        var a = new pe("progress", i, Math.min(this.Sc + 1, this.O.length), this.O.length);
        this.dispatchEvent(a);
        a.i()
    };
    r.h = function () {
        this.reset(0, []);
        We.b.h.call(this)
    };
    r.e = M("au.upldr.upload.Packager");
    var $e = RegExp("^(?:([^:/?#.]+):)?(?://(?:([^/?#]*)@)?([\\w\\d\\-\\u0100-\\uffff.%]*)(?::([0-9]+))?)?([^?#]+)?(?:\\?([^#]*))?(?:#(.*))?$");

    function af(a, b) {
        this.ce = a || 1;
        this.Cd = b || bf;
        this.Se = v(this.dk, this);
        this.If = ta()
    }
    w(af, H);
    af.prototype.enabled = m;
    var bf = s.window;
    r = af.prototype;
    r.ta = k;
    r.dk = function () {
        if (this.enabled) {
            var a = ta() - this.If;
            if (0 < a && a < 0.8 * this.ce) this.ta = this.Cd.setTimeout(this.Se, this.ce - a);
            else if (this.dispatchEvent(cf), this.enabled) this.ta = this.Cd.setTimeout(this.Se, this.ce), this.If = ta()
        }
    };
    r.start = function () {
        this.enabled = i;
        if (!this.ta) this.ta = this.Cd.setTimeout(this.Se, this.ce), this.If = ta()
    };
    r.stop = function () {
        this.enabled = m;
        if (this.ta) this.Cd.clearTimeout(this.ta), this.ta = k
    };
    r.h = function () {
        af.b.h.call(this);
        this.stop();
        delete this.Cd
    };
    var cf = "tick";

    function df(a, b, c) {
        la(a) ? c && (a = v(a, c)) : a && "function" == typeof a.handleEvent ? a = v(a.handleEvent, a) : e(Error("Invalid listener argument"));
        return 2147483647 < b ? -1 : bf.setTimeout(a, b || 0)
    };

    function ef() {}
    ef.prototype.rg = k;

    function ff(a) {
        var b;
        if (!(b = a.rg)) b = {}, gf(a) && (b[0] = i, b[1] = i), b = a.rg = b;
        return b
    };
    var hf;

    function jf() {}
    w(jf, ef);

    function kf(a) {
        return (a = gf(a)) ? new ActiveXObject(a) : new XMLHttpRequest
    }
    jf.prototype.wf = k;

    function gf(a) {
        if (!a.wf && "undefined" == typeof XMLHttpRequest && "undefined" != typeof ActiveXObject) {
            for (var b = ["MSXML2.XMLHTTP.6.0", "MSXML2.XMLHTTP.3.0", "MSXML2.XMLHTTP", "Microsoft.XMLHTTP"], c = 0; c < b.length; c++) {
                var d = b[c];
                try {
                    return new ActiveXObject(d), a.wf = d
                } catch (f) {}
            }
            e(Error("Could not create ActiveXObject. ActiveX might be disabled, or MSXML might not be installed"))
        }
        return a.wf
    }
    hf = new jf;

    function lf(a) {
        this.headers = new xe;
        this.Qb = a || k
    }
    w(lf, H);
    lf.prototype.B = M("goog.net.XhrIo");
    var mf = /^https?$/i;
    r = lf.prototype;
    r.ob = m;
    r.p = k;
    r.Mc = k;
    r.je = "";
    r.Gf = "";
    r.fc = 0;
    r.sb = "";
    r.Ud = m;
    r.Bc = m;
    r.kd = m;
    r.dc = m;
    r.kc = 0;
    r.bb = k;
    r.se = "";
    r.Xh = m;
    r.send = function (a, b, c, d) {
        this.p && e(Error("[goog.net.XhrIo] Object is active with another request"));
        b = b ? b.toUpperCase() : "GET";
        this.je = a;
        this.sb = "";
        this.fc = 0;
        this.Gf = b;
        this.Ud = m;
        this.ob = i;
        this.p = this.Qb ? kf(this.Qb) : kf(hf);
        this.Mc = this.Qb ? ff(this.Qb) : ff(hf);
        this.p.onreadystatechange = v(this.Rf, this);
        try {
            L(this.B, nf(this, "Opening Xhr")), this.kd = i, this.p.open(b, a, i), this.kd = m
        } catch (f) {
            L(this.B, nf(this, "Error opening Xhr: " + f.message));
            of(this, f);
            return
        }
        var a = c || "",
            g = this.headers.va();
        d && re(d, function (a,
            b) {
            g.set(b, a)
        });
        "POST" == b && !ze(g.aa, "Content-Type") && g.set("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
        re(g, function (a, b) {
            this.p.setRequestHeader(b, a)
        }, this);
        if (this.se) this.p.responseType = this.se;
        if ("withCredentials" in this.p) this.p.withCredentials = this.Xh;
        try {
            if (this.bb) bf.clearTimeout(this.bb), this.bb = k;
            if (0 < this.kc) L(this.B, nf(this, "Will abort after " + this.kc + "ms if incomplete")), this.bb = bf.setTimeout(v(this.Fe, this), this.kc);
            L(this.B, nf(this, "Sending request"));
            this.Bc =
                i;
            this.p.send(a);
            this.Bc = m
        } catch (j) {
            L(this.B, nf(this, "Send error: " + j.message)), of(this, j)
        }
    };
    r.Fe = function () {
        if ("undefined" != typeof da && this.p) this.sb = "Timed out after " + this.kc + "ms, aborting", this.fc = 8, L(this.B, nf(this, this.sb)), this.dispatchEvent("timeout"), this.abort(8)
    };

    function of(a, b) {
        a.ob = m;
        if (a.p) a.dc = i, a.p.abort(), a.dc = m;
        a.sb = b;
        a.fc = 5;
        pf(a);
        a.oc()
    }

    function pf(a) {
        if (!a.Ud) a.Ud = i, a.dispatchEvent("complete"), a.dispatchEvent("error")
    }
    r.abort = function (a) {
        if (this.p && this.ob) L(this.B, nf(this, "Aborting")), this.ob = m, this.dc = i, this.p.abort(), this.dc = m, this.fc = a || 7, this.dispatchEvent("complete"), this.dispatchEvent("abort"), this.oc()
    };
    r.h = function () {
        if (this.p) {
            if (this.ob) this.ob = m, this.dc = i, this.p.abort(), this.dc = m;
            this.oc(i)
        }
        lf.b.h.call(this)
    };
    r.Rf = function () {
        !this.kd && !this.Bc && !this.dc ? this.tj() : qf(this)
    };
    r.tj = function () {
        qf(this)
    };

    function qf(a) {
        if (a.ob && "undefined" != typeof da)
            if (a.Mc[1] && 4 == rf(a) && 2 == sf(a)) L(a.B, nf(a, "Local request error detected and ignored"));
            else if (a.Bc && 4 == rf(a)) bf.setTimeout(v(a.Rf, a), 0);
        else if (a.dispatchEvent("readystatechange"), 4 == rf(a)) {
            L(a.B, nf(a, "Request complete"));
            a.ob = m;
            if (a.Dc()) a.dispatchEvent("complete"), a.dispatchEvent("success");
            else {
                a.fc = 6;
                var b;
                try {
                    b = 2 < rf(a) ? a.p.statusText : ""
                } catch (c) {
                    L(a.B, "Can not get status: " + c.message), b = ""
                }
                a.sb = b + " [" + sf(a) + "]";
                pf(a)
            }
            a.oc()
        }
    }
    r.oc = function (a) {
        if (this.p) {
            var b = this.p,
                c = this.Mc[0] ? ha : k;
            this.Mc = this.p = k;
            if (this.bb) bf.clearTimeout(this.bb), this.bb = k;
            a || this.dispatchEvent("ready");
            try {
                b.onreadystatechange = c
            } catch (d) {
                this.B.log(Ke, "Problem encountered resetting onreadystatechange: " + d.message, h)
            }
        }
    };
    r.nd = function () {
        return !!this.p
    };
    r.Dc = function () {
        var a = sf(this),
            b;
        a: switch (a) {
        case 200:
        case 201:
        case 202:
        case 204:
        case 304:
        case 1223:
            b = i;
            break a;
        default:
            b = m
        }
        if (!b) {
            if (a = 0 === a) {
                a = ("" + this.je).match($e)[1] || k;
                if (!a && self.location) a = self.location.protocol, a = a.substr(0, a.length - 1);
                a = !mf.test(a ? a.toLowerCase() : "")
            }
            b = a
        }
        return b
    };

    function rf(a) {
        return a.p ? a.p.readyState : 0
    }

    function sf(a) {
        try {
            return 2 < rf(a) ? a.p.status : -1
        } catch (b) {
            return K(a.B, "Can not get status: " + b.message), -1
        }
    }

    function nf(a, b) {
        return b + " [" + a.Gf + " " + a.je + " " + sf(a) + "]"
    };

    function tf(a) {
        lf.call(this, a)
    }
    w(tf, lf);
    tf.prototype.send = function (a, b, c, d) {
        this.p && e(Error("[au.upldr.upload.XhrIo] Object is active with another request"));
        b = b ? b.toUpperCase() : "GET";
        this.je = a;
        this.sb = "";
        this.fc = 0;
        this.Gf = b;
        this.Ud = m;
        this.ob = i;
        this.p = this.Qb ? kf(this.Qb) : kf(hf);
        if (Wc(this)) this.p.upload.onprogress = v(this.tk, this);
        this.Mc = this.Qb ? ff(this.Qb) : ff(hf);
        this.p.onreadystatechange = v(this.Rf, this);
        try {
            L(this.B, nf(this, "Opening Xhr")), this.kd = i, this.p.open(b, a, i), this.kd = m
        } catch (f) {
            K(this.B, nf(this, "Error opening Xhr: " + f.message));
            of(this, f);
            return
        }
        var a = c || "",
            g = this.headers.va();
        d && re(d, function (a, b) {
            g.set(b, a)
        });
        "POST" == b && !(c instanceof FormData) && !ze(g.aa, "Content-Type") && g.set("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
        re(g, function (a, b) {
            this.p.setRequestHeader(b, a)
        }, this);
        if (this.se) this.p.responseType = this.se;
        if ("withCredentials" in this.p) this.p.withCredentials = this.Xh;
        try {
            if (this.bb) bf.clearTimeout(this.bb), this.bb = k;
            if (0 < this.kc) L(this.B, nf(this, "Will abort after " + this.kc + "ms if incomplete")),
            this.bb = bf.setTimeout(v(this.Fe, this), this.kc);
            L(this.B, nf(this, "Sending request"));
            this.Bc = i;
            this.p.send(a);
            this.Bc = m
        } catch (j) {
            K(this.B, nf(this, "Send error: " + j.message)), of(this, j)
        }
    };
    tf.prototype.oc = function (a) {
        if (this.p && this.p.upload && this.p.upload.onprogress) this.p.upload.onprogress = this.Mc[0] ? ha : k;
        tf.b.oc.call(this, a)
    };
    tf.prototype.tk = function (a) {
        this.dispatchEvent(new pe(a.type, a.lengthComputable, a.loaded, a.total))
    };
    tf.prototype.B = M("au.upldr.upload.XhrIo");

    function uf() {
        this.U = m;
        this.q = new dd(this);
        this.reset()
    }
    w(uf, H);
    t(uf);
    r = uf.prototype;
    r.cf = function (a) {
        this.Ka.push(a);
        this.U || this.Ib()
    };
    r.reset = function (a) {
        L(this.e, "Resetting transmitter (" + a + ")");
        this.p && (this.p.i(), delete this.p);
        this.Ka = [];
        this.U = m;
        this.nk = a || ".";
        a = this.p = new tf(h);
        this.q.c(a, "ready", this.sk).c(a, "complete", this.qk).c(a, "progress", this.rk)
    };
    r.Ib = function () {
        if (!this.U) {
            var a = this.Ka.shift();
            if (a) L(this.e, "Uploading package..."), this.U = i, this.p.send(this.nk, "POST", a.jf)
        }
    };
    r.qk = function () {
        var a = this.p,
            b, c = sf(a),
            d;
        try {
            d = a.p ? a.p.responseText : ""
        } catch (f) {
            L(a.B, "Can not get responseText: " + f.message), d = ""
        }
        var g;
        a.Dc() ? (b = zd, L(this.e, "Package uploaded [" + c + "]")) : (b = "error", g = u(a.sb) ? a.sb : "" + a.sb, K(this.e, J('Package upload error \n\t{ errorCode: {0}, errorMessage: "{1}", responseText: "{2}" }', a.fc, g, d)));
        a = new ke(b, c, d, g);
        this.dispatchEvent(a);
        a.i()
    };
    r.sk = function () {
        this.U = m;
        pd(this.Ib, 0, this)
    };
    r.rk = function (a) {
        this.dispatchEvent(new pe("progress", a.lengthComputable, a.loaded, a.total))
    };
    r.h = function () {
        this.reset();
        this.q.vb();
        this.p.i();
        delete this.p;
        uf.b.h.call(this)
    };
    r.e = M("au.upldr.upload.Transmitter");

    function vf(a, b, c) {
        this.oe = a = a || We.t();
        this.He = b = b || uf.t();
        this.ua = this.ud = m;
        this.hm = 0;
        this.Hc = c || "ByPackageSize";
        this.q = new dd(this);
        this.q.c(a, zd, this.Ej).c(a, "progress", this.Fj).c(b, zd, this.fk).c(b, "progress", this.hk).c(b, "error", this.gk)
    }
    w(vf, H);

    function wf(a, b, c, d, f) {
        a.e.info("Starting upload...");
        a.ud && (a.e.log(Ke, "UploadManager is busy. Cancel current operation with stopUpload or wailt until it completes.", h), rd("UploadManager is busy. Cancel current operation with stopUpload or wailt until it completes."));
        a.ud = i;
        a.ua = m;
        if (ja(b)) a.l = bb(b, 0);
        else
            for (var g = 0, j = b.Z(); g < j; g++) a.l.push(b.getItem(g));
        a.oe.reset(a.l.length, c, f);
        a.He.reset(d || ".");
        var l = a.Uc = 0;
        "BySourceSize" == a.Hc && y(a.l, function (a) {
            l += a.xc()
        });
        b = a.gc = new le(1, 0, 0, a.l.length,
            0, l);
        xf(a);
        0 < a.l.length ? (b.xb = 2, yf(a)) : (a.ud = m, b.xb = 4, b.ra = 100, xf(a), zf(a))
    }
    r = vf.prototype;
    r.Ve = function () {
        L(this.e, "Cancel upload.");
        this.oe.reset(0, []);
        this.He.reset();
        this.Uc = 0;
        this.l = [];
        this.ud = m;
        this.ua = i;
        this.Af = 0
    };

    function yf(a) {
        L(a.e, "Enqueue item to package");
        if ("ByPackageSize" === a.Hc) a.gc.ia = 0, a.gc.Aa = 0;
        a.dispatchEvent(new me("beforePackageUpload", a.Uc));
        var b = a.l.shift();
        a.Af = b.xc();
        a.oe.cf(b)
    }

    function zf(a, b, c) {
        a.e.info("All files has been uploaded successfully.");
        a.ua || a.dispatchEvent(new ke(zd, b, c))
    }
    r.Ej = function (a) {
        L(this.e, "Packager complete handler");
        if (!this.ua) a = a.Gj, L(this.e, "Enqueue package to upload."), this.gc.xb = 3, this.He.cf(a)
    };
    r.Fj = function (a) {
        if ("ByPackageSize" === this.Hc) {
            var b = this.gc,
                c = b.ra;
            b.ra = 0 < a.total ? b.ra + 50 * a.loaded / a.total / b.Wa : b.ra + 50 / b.Wa;
            xf(this);
            b.ra = c
        }
    };
    r.fk = function (a) {
        this.e.info("Package " + this.Uc + " uploaded [" + a.Fa + "]");
        if (!this.ua) {
            this.dispatchEvent(new me("afterPackageUpload", this.Uc, a.Fa, a.response, a.Wc));
            var b = 0 >= this.l.length,
                c = this.gc;
            c.ib++;
            c.ia = "ByPackageSize" === this.Hc ? c.Aa : c.ia + this.Af;
            b ? (c.xb = 4, c.ra = 100) : c.ra = "ByPackageSize" === this.Hc ? 100 * c.ib / c.Wa : 100 * c.ia / c.Aa;
            xf(this);
            this.Uc++;
            b ? (this.ud = m, zf(this, a.Fa, a.response)) : yf(this)
        }
    };
    r.hk = function (a) {
        var b = this.gc;
        if ("ByPackageSize" === this.Hc) b.Aa = a.total, b.ia = a.loaded, b.ra = 100 * (b.ib + 0.5) / b.Wa, 0 < b.Aa && (b.ra += 50 * b.ia / b.Wa / b.Aa), xf(this);
        else {
            var c = b.ia;
            b.ia += Math.min(a.loaded, this.Af);
            b.ra = 100 * b.ia / b.Aa;
            xf(this);
            b.ia = c;
            b.ra = 100 * b.ia / b.Aa
        }
    };
    r.gk = function (a) {
        this.Vb(new ke("error", a.Fa, a.response, "Upload error: " + a.Wc))
    };

    function xf(a) {
        var b = new G("progress");
        b.state = a.gc.va();
        a.dispatchEvent(b)
    }
    r.Vb = function (a) {
        this.dispatchEvent(a)
    };
    r.h = function () {
        this.q.vb();
        this.He.i();
        this.oe.i();
        vf.b.h.call(this)
    };
    r.e = M("au.upldr.upload.UploadManager");

    function Af(a, b) {
        G.call(this, a || zd);
        this.ii = b
    }
    w(Af, G);

    function Bf(a, b, c, d) {
        G.call(this, a);
        this.canvas = b;
        this.Zl = c;
        this.Xl = d || 0;
        this.width = b && b.width || 0;
        this.height = b && b.height || 0
    }
    w(Bf, G);

    function Cf() {
        this.qb = new id;
        this.q = new dd(this);
        this.q.c(this.qb, jd, this.xf)
    }
    w(Cf, H);
    Cf.prototype.create = function (a, b, c, d, f, g, j) {
        this.U && rd("ThumbnailCreator is busy. Wailt until the current operation completes.");
        this.U = i;
        this.ua = m;
        this.Kg = b;
        this.pk = c;
        this.Wi = d;
        this.di = f;
        this.og = g;
        this.ug = j;
        this.qb.load(a)
    };
    Cf.prototype.reset = function () {
        this.ua = i;
        this.U = m
    };
    Cf.prototype.xf = function () {
        var a = this.ug;
        delete this.ug;
        if (this.ua) this.U = m;
        else {
            var b;
            if (this.qb.Dc()) {
                var c = this.qb.qa;
                0 < c.width && 0 < c.height && (a = a || document.createElement("canvas"), (a = Df(c, this.Kg, this.pk, this.Wi, this.di, this.og, a)) && (b = new Bf(zd, a, this.Kg, this.og)))
            }
            b || (b = new Bf("error"));
            this.U = m;
            this.dispatchEvent(b);
            b.i()
        }
    };

    function Df(a, b, c, d, f, g, j) {
        if (j != k && 0 < a.width && 0 < a.height) {
            var l = ud(a.width, a.height, c, d, g, b);
            j.width = l.width;
            j.height = l.height;
            try {
                for (var o = j.getContext("2d"), q = a.width, z = a.height, D = ud(q, z, c, d, 0, b), S = document.createElement("canvas"), Y = document.createElement("canvas");
                    (q = Math.floor(q / 2)) > D.width && (z = Math.floor(z / 2)) > D.height;) S.width = q, S.height = z, S.getContext("2d").drawImage(a, 0, 0, q, z), a = S, S = Y, Y = a;
                if (f != k) o.save(), o.fillStyle = sd(f), o.fillRect(0, 0, l.width, l.height), o.restore();
                var b = !(g % 180),
                    g = g *
                        Math.PI / 180,
                    hb = Math.sin(g),
                    pc = Math.cos(g);
                o.setTransform(pc, hb, -hb, pc, l.width / 2, l.height / 2);
                var ua = b ? l.width : l.height,
                    Z = b ? l.height : l.width;
                o.drawImage(a, -ua / 2, -Z / 2, ua, Z);
                return j
            } catch (md) {}
        }
        return k
    }
    Cf.prototype.h = function () {
        this.q.vb();
        Cf.b.h.call(this)
    };

    function Ef(a, b, c, d, f) {
        this.mode = a;
        this.fileName = b;
        this.file = c;
        this.Kh = d || 0;
        this.Jh = f || 0;
        this.size = c ? c.size : 0
    };
    var Ze = "none";

    function Ff(a, b, c, d, f, g) {
        this.U = m;
        this.Ug = a;
        this.xd = Gf(b);
        this.De = c == k ? 96 : c;
        this.Be = d == k ? 96 : d;
        this.Ae = Hf(f);
        this.ze = g == k ? 16777215 : g;
        this.Ic = 0;
        this.lg = new Cf;
        this.q = new dd(this);
        this.q.c(this.lg, [zd, "error"], this.ck)
    }
    w(Ff, H);
    r = Ff.prototype;
    r.apply = function (a) {
        this.U && rd("Converter is busy. Wait until current operation completes.");
        this.e.info("Applying converter " + ("{ index: " + this.Ug + ", mode: " + If(this) + ", thimbnailFitMode: " + this.Ae + ", thumbnailWidth: " + this.De + ", thumbnailHeight: " + this.Be + ", thumbnailBgColor: " + sd(this.ze) + " }"));
        this.U = i;
        this.Ga = a;
        this.Ic = Jf(this.xd, 0, a.getName());
        Kf(this)
    };
    r.reset = function () {
        this.U = m;
        this.Ic = 0;
        this.Ld = this.Ga = k;
        this.lg.reset()
    };

    function Kf(a) {
        var b;
        b = 0 <= a.Ic ? a.xd[a.Ic].mode : Ze;
        if ("sourceFile" == b) L(a.e, 'Creating "sourceFile" converted item'), b = a.Ga, a.Ld = new Ef("sourceFile", b.getName(), b.getFile(), b.I(Kd), b.I(Ld)), pd(a.eb, 0, a);
        else if (b == Ze) Lf(a);
        else if ("thumbnail" == b) L(a.e, 'Creating "thumbnail" converted item'), b = a.Ga, Gd(b) ? a.lg.create(b.getFile(), a.Ae, a.De, a.Be, a.ze, b.I(Md)) : Lf(a)
    }

    function Lf(a) {
        L(a.e, 'Creating "none" converted item');
        a.Ld = new Ef(Ze, "", k);
        pd(a.eb, 0, a)
    }
    r.eb = function () {
        var a = this.Ld;
        a ? this.e.info("Item created: { mode: " + a.mode + ", name: " + a.fileName + ", file: " + a.file + ", width: " + a.Kh + ", height: " + a.Jh + "}") : this.e.info("Item created: null");
        try {
            this.dispatchEvent(new Af(zd, a))
        } finally {
            this.reset()
        }
    };
    r.ck = function (a) {
        var b = this.Ga.getName();
        if (a.type == zd && a.canvas != k) {
            L(this.e, J("Thumbnail created: {0}x{1}", a.width, a.height));
            var b = b + "_Thumbnail" + this.Ug + ".jpg",
                c;
            if (a.canvas.mozGetAsFile) c = a.canvas.mozGetAsFile(b, "image/jpeg");
            else {
                var d = a.canvas.toDataURL("image/jpeg");
                c = window.BlobBuilder || window.WebKitBlobBuilder || window.MozBlobBuilder;
                for (var f = window.atob(d.split(",")[1]), d = d.split(",")[0].split(":")[1].split(";")[0], g = new ArrayBuffer(f.length), j = new Uint8Array(g), l = 0; l < f.length; l++) j[l] =
                    f.charCodeAt(l);
                c = new c;
                c.append(g);
                c = c.getBlob(d)
            }
            this.Ld = new Ef("thumbnail", b, c, a.width, a.height);
            this.eb()
        } else L(this.e, "Thumbnail not created. Trying to apply next convert rule."), this.Ic = Jf(this.xd, this.Ic + 1, b), Kf(this)
    };

    function Jf(a, b, c) {
        0 > b && (b = 0);
        if (b < a.length) {
            do
                if (a[b].pattern.test(c)) return b; while (a[++b])
        }
        return -1
    }

    function Gf(a) {
        for (var b = 'Can not parse "' + a + '" string', a = a.split(";"), c = [], d, f = 0; d = a[f++];) {
            d = d.split("=");
            2 != d.length && rd(b);
            var g = Ea(d[0]);
            d = Ea(d[1]);
            (!g || !d) && rd(b);
            var g = g.toLowerCase().split(","),
                j = [];
            y(g, function (a, b, c) {
                j[b] = Ea(a);
                c[b] = j[b].replace(/\./g, "\\.").replace(/\?/g, ".").replace(/\*/g, ".+")
            });
            g = RegExp("^" + g.join("|") + "$", "i");
            j = j.join(",");
            d = d.toLowerCase();
            "none" == d ? d = Ze : "thumbnail" == d ? uc() ? d = "thumbnail" : (window.alert("Thumbnail converter is not supported in your browser."), d = Ze) :
                "sourcefile" == d ? d = "sourceFile" : rd(b);
            c.push({
                pattern: g,
                mode: d,
                fj: j
            })
        }
        return c
    }

    function If(a) {
        for (var a = a.xd, b = "", c, d = 0; c = a[d++];) b && (b += ";"), b += c.fj + "=" + c.mode;
        return b
    }

    function Hf(a) {
        if (!a) return "fit";
        a = (a + "").toLowerCase();
        switch (a) {
        case "fit":
        case "width":
        case "height":
        case "actualsize":
            return a;
        default:
            return "fit"
        }
    }
    r.e = M("au.upldr.upload.Converter");
    var N = {};
    N.Width = N.Height = function (a) {
        a = (a + "").toLowerCase();
        /^\d+$/.test(a) && (a += "px");
        return a
    };
    N.ViewMode = function (a) {
        a = (a + "").toLowerCase();
        if ("tiles" !== a && "thumbnails" !== a && "icons" !== a) N.Ne("ViewMode", a), a = x.ViewMode;
        return a
    };
    N.ViewComboBox = function (a) {
        if (!a || !ja(a) || 3 !== a.length) N.Ne("ViewComboBox", a), a = x.ViewComboBox;
        return a
    };
    N.Le = function (a, b) {
        if (!vc()) return K(N.B, "The image restrictions are not supported in this browser."), x[a];
        var c = parseInt(b, 10);
        isNaN(c) && (c = x[a], N.Ne(a, b));
        return c
    };
    N.MaxImageHeight = sa(N.Le, "MaxImageHeight");
    N.MaxImageWidth = sa(N.Le, "MaxImageWidth");
    N.MinImageHeight = sa(N.Le, "MinImageHeight");
    N.MinImageWidth = sa(N.Le, "MinImageWidth");
    N.ProgressBytesMode = function (a) {
        var b = (a + "").toLowerCase();
        "bysourcesize" == b || "1" === b ? b = "BySourceSize" : "bypackagesize" === b || "0" === b ? b = "ByPackageSize" : (b = "ByPackageSize", N.Ne("ProgressBytesMode", a));
        return b
    };
    N.Ne = function (a, b) {
        K(N.B, 'Incorrect value for "' + a + '": "' + b + '"')
    };
    N.B = M("au.upldr.validate");
    var Mf;
    (Mf = "ScriptEngine" in s && "JScript" == s.ScriptEngine()) && (s.ScriptEngineMajorVersion(), s.ScriptEngineMinorVersion(), s.ScriptEngineBuildVersion());

    function Nf(a, b) {
        this.Oa = Mf ? [] : "";
        a != k && this.append.apply(this, arguments)
    }
    Nf.prototype.set = function (a) {
        this.clear();
        this.append(a)
    };
    Mf ? (Nf.prototype.Te = 0, Nf.prototype.append = function (a, b, c) {
        b == k ? this.Oa[this.Te++] = a : (this.Oa.push.apply(this.Oa, arguments), this.Te = this.Oa.length);
        return this
    }) : Nf.prototype.append = function (a, b, c) {
        this.Oa += a;
        if (b != k)
            for (var d = 1; d < arguments.length; d++) this.Oa += arguments[d];
        return this
    };
    Nf.prototype.clear = function () {
        Mf ? this.Te = this.Oa.length = 0 : this.Oa = ""
    };
    Nf.prototype.toString = function () {
        if (Mf) {
            var a = this.Oa.join("");
            this.clear();
            a && this.append(a);
            return a
        }
        return this.Oa
    };

    function Of(a, b, c, d) {
        this.top = a;
        this.right = b;
        this.bottom = c;
        this.left = d
    }
    Of.prototype.va = function () {
        return new Of(this.top, this.right, this.bottom, this.left)
    };
    Of.prototype.toString = function () {
        return "(" + this.top + "t, " + this.right + "r, " + this.bottom + "b, " + this.left + "l)"
    };
    Of.prototype.contains = function (a) {
        return !this || !a ? m : a instanceof Of ? a.left >= this.left && a.right <= this.right && a.top >= this.top && a.bottom <= this.bottom : a.x >= this.left && a.x <= this.right && a.y >= this.top && a.y <= this.bottom
    };

    function Pf(a, b, c, d) {
        this.left = a;
        this.top = b;
        this.width = c;
        this.height = d
    }
    r = Pf.prototype;
    r.va = function () {
        return new Pf(this.left, this.top, this.width, this.height)
    };
    r.toString = function () {
        return "(" + this.left + ", " + this.top + " - " + this.width + "w x " + this.height + "h)"
    };
    r.Vg = function (a) {
        var b = Math.max(this.left, a.left),
            c = Math.min(this.left + this.width, a.left + a.width);
        if (b <= c) {
            var d = Math.max(this.top, a.top),
                a = Math.min(this.top + this.height, a.top + a.height);
            if (d <= a) return this.left = b, this.top = d, this.width = c - b, this.height = a - d, i
        }
        return m
    };
    r.contains = function (a) {
        return a instanceof Pf ? this.left <= a.left && this.left + this.width >= a.left + a.width && this.top <= a.top && this.top + this.height >= a.top + a.height : a.x >= this.left && a.x <= this.left + this.width && a.y >= this.top && a.y <= this.top + this.height
    };
    r.xc = function () {
        return new Pb(this.width, this.height)
    };

    function Qf(a, b, c) {
        a.style[Na(c)] = b
    }

    function Rf(a, b) {
        var c = Vb(a);
        return c.defaultView && c.defaultView.getComputedStyle && (c = c.defaultView.getComputedStyle(a, k)) ? c[b] || c.getPropertyValue(b) : ""
    }

    function Sf(a, b) {
        return a.currentStyle ? a.currentStyle[b] : k
    }

    function Tf(a, b) {
        return Rf(a, b) || Sf(a, b) || a.style && a.style[b]
    }

    function Uf(a, b, c) {
        var d, f = Bb && (vb || Eb) && E("1.9");
        b instanceof F ? (d = b.x, b = b.y) : (d = b, b = c);
        a.style.left = Vf(d, f);
        a.style.top = Vf(b, f)
    }

    function Wf(a) {
        a = a ? 9 == a.nodeType ? a : Vb(a) : document;
        return B && !Ob(9) && !sc(Tb(a)) ? a.body : a.documentElement
    }

    function Xf(a) {
        var b = a.getBoundingClientRect();
        if (B) a = a.ownerDocument, b.left -= a.documentElement.clientLeft + a.body.clientLeft, b.top -= a.documentElement.clientTop + a.body.clientTop;
        return b
    }

    function Yf(a) {
        if (B && !Ob(8)) return a.offsetParent;
        for (var b = Vb(a), c = Tf(a, "position"), d = "fixed" == c || "absolute" == c, a = a.parentNode; a && a != b; a = a.parentNode)
            if (c = Tf(a, "position"), d = d && "static" == c && a != b.documentElement && a != b.body, !d && (a.scrollWidth > a.clientWidth || a.scrollHeight > a.clientHeight || "fixed" == c || "absolute" == c || "relative" == c)) return a;
        return k
    }

    function Zf(a) {
        for (var b = new Of(0, Infinity, Infinity, 0), c = Tb(a), d = c.Q.body, f = c.Q.documentElement, g = !C && Yb(c.Q) ? c.Q.documentElement : c.Q.body; a = Yf(a);)
            if ((!B || 0 != a.clientWidth) && (!C || 0 != a.clientHeight || a != d) && a != d && a != f && "visible" != Tf(a, "overflow")) {
                var j = $f(a),
                    l;
                l = a;
                if (Bb && !E("1.9")) {
                    var o = parseFloat(Rf(l, "borderLeftWidth"));
                    if (ag(l)) var q = l.offsetWidth - l.clientWidth - o - parseFloat(Rf(l, "borderRightWidth")),
                    o = o + q;
                    l = new F(o, parseFloat(Rf(l, "borderTopWidth")))
                } else l = new F(l.clientLeft, l.clientTop);
                j.x +=
                    l.x;
                j.y += l.y;
                b.top = Math.max(b.top, j.y);
                b.right = Math.min(b.right, j.x + a.clientWidth);
                b.bottom = Math.min(b.bottom, j.y + a.clientHeight);
                b.left = Math.max(b.left, j.x)
            }
        d = g.scrollLeft;
        g = g.scrollTop;
        b.left = Math.max(b.left, d);
        b.top = Math.max(b.top, g);
        c = c.Q.parentWindow || c.Q.defaultView || window;
        f = c.document;
        C && !E("500") && !Cb ? ("undefined" == typeof c.innerHeight && (c = window), f = c.innerHeight, a = c.document.documentElement.scrollHeight, c == c.top && a < f && (f -= 15), c = new Pb(c.innerWidth, f)) : (c = Yb(f) ? f.documentElement : f.body, c =
            new Pb(c.clientWidth, c.clientHeight));
        b.right = Math.min(b.right, d + c.width);
        b.bottom = Math.min(b.bottom, g + c.height);
        return 0 <= b.top && 0 <= b.left && b.bottom > b.top && b.right > b.left ? b : k
    }

    function $f(a) {
        var b, c = Vb(a),
            d = Tf(a, "position"),
            f = Bb && c.getBoxObjectFor && !a.getBoundingClientRect && "absolute" == d && (b = c.getBoxObjectFor(a)) && (0 > b.screenX || 0 > b.screenY),
            g = new F(0, 0),
            j = Wf(c);
        if (a == j) return g;
        if (a.getBoundingClientRect) b = Xf(a), a = tc(Tb(c)), g.x = b.left + a.x, g.y = b.top + a.y;
        else if (c.getBoxObjectFor && !f) b = c.getBoxObjectFor(a), a = c.getBoxObjectFor(j), g.x = b.screenX - a.screenX, g.y = b.screenY - a.screenY;
        else {
            b = a;
            do {
                g.x += b.offsetLeft;
                g.y += b.offsetTop;
                b != a && (g.x += b.clientLeft || 0, g.y += b.clientTop || 0);
                if (C && "fixed" == Tf(b, "position")) {
                    g.x += c.body.scrollLeft;
                    g.y += c.body.scrollTop;
                    break
                }
                b = b.offsetParent
            } while (b && b != a);
            if (Ab || C && "absolute" == d) g.y -= c.body.offsetTop;
            for (b = a;
                (b = Yf(b)) && b != c.body && b != j;)
                if (g.x -= b.scrollLeft, !Ab || "TR" != b.tagName) g.y -= b.scrollTop
        }
        return g
    }

    function bg(a, b, c) {
        b instanceof Pb ? (c = b.height, b = b.width) : c == h && e(Error("missing height argument"));
        a.style.width = Vf(b, i);
        a.style.height = Vf(c, i)
    }

    function Vf(a, b) {
        "number" == typeof a && (a = (b ? Math.round(a) : a) + "px");
        return a
    }

    function cg(a) {
        if ("none" != Tf(a, "display")) return dg(a);
        var b = a.style,
            c = b.display,
            d = b.visibility,
            f = b.position;
        b.visibility = "hidden";
        b.position = "absolute";
        b.display = "inline";
        a = dg(a);
        b.display = c;
        b.position = f;
        b.visibility = d;
        return a
    }

    function dg(a) {
        var b = a.offsetWidth,
            c = a.offsetHeight,
            d = C && !b && !c;
        return (!fa(b) || d) && a.getBoundingClientRect ? (a = Xf(a), new Pb(a.right - a.left, a.bottom - a.top)) : new Pb(b, c)
    }

    function eg(a) {
        var b = $f(a),
            a = cg(a);
        return new Pf(b.x, b.y, a.width, a.height)
    }

    function O(a, b) {
        a.style.display = b ? "" : "none"
    }

    function ag(a) {
        return "rtl" == Tf(a, "direction")
    }
    var fg = Bb ? "MozUserSelect" : C ? "WebkitUserSelect" : k;

    function gg(a, b, c) {
        c = !c ? a.getElementsByTagName("*") : k;
        if (fg) {
            if (b = b ? "none" : "", a.style[fg] = b, c)
                for (var a = 0, d; d = c[a]; a++) d.style[fg] = b
        } else if (B || Ab)
            if (b = b ? "on" : "", a.setAttribute("unselectable", b), c)
                for (a = 0; d = c[a]; a++) d.setAttribute("unselectable", b)
    }

    function hg(a, b) {
        if (/^\d+px?$/.test(b)) return parseInt(b, 10);
        var c = a.style.left,
            d = a.runtimeStyle.left;
        a.runtimeStyle.left = a.currentStyle.left;
        a.style.left = b;
        var f = a.style.pixelLeft;
        a.style.left = c;
        a.runtimeStyle.left = d;
        return f
    }

    function ig(a, b) {
        if (B) {
            var c = hg(a, Sf(a, b + "Left")),
                d = hg(a, Sf(a, b + "Right")),
                f = hg(a, Sf(a, b + "Top")),
                g = hg(a, Sf(a, b + "Bottom"));
            return new Of(f, d, g, c)
        }
        c = Rf(a, b + "Left");
        d = Rf(a, b + "Right");
        f = Rf(a, b + "Top");
        g = Rf(a, b + "Bottom");
        return new Of(parseFloat(f), parseFloat(d), parseFloat(g), parseFloat(c))
    }
    var jg = {
        thin: 2,
        medium: 4,
        thick: 6
    };

    function kg(a, b) {
        if ("none" == Sf(a, b + "Style")) return 0;
        var c = Sf(a, b + "Width");
        return c in jg ? jg[c] : hg(a, c)
    }

    function lg(a) {
        if (B) {
            var b = kg(a, "borderLeft"),
                c = kg(a, "borderRight"),
                d = kg(a, "borderTop"),
                a = kg(a, "borderBottom");
            return new Of(d, c, a, b)
        }
        b = Rf(a, "borderLeftWidth");
        c = Rf(a, "borderRightWidth");
        d = Rf(a, "borderTopWidth");
        a = Rf(a, "borderBottomWidth");
        return new Of(parseFloat(d), parseFloat(c), parseFloat(a), parseFloat(b))
    };

    function P(a) {
        this.Da = a || Tb();
        this.wd = mg
    }
    w(P, H);
    P.prototype.Yi = xa.t();
    var mg = k;

    function ng(a, b) {
        switch (a) {
        case 1:
            return b ? "disable" : "enable";
        case 2:
            return b ? "highlight" : "unhighlight";
        case 4:
            return b ? "activate" : "deactivate";
        case 8:
            return b ? "select" : "unselect";
        case 16:
            return b ? "check" : "uncheck";
        case 32:
            return b ? "focus" : "blur";
        case 64:
            return b ? "open" : "close"
        }
        e(Error("Invalid component state"))
    }
    r = P.prototype;
    r.Ac = k;
    r.F = m;
    r.g = k;
    r.wd = k;
    r.j = k;
    r.ba = k;
    r.Y = k;
    r.Pa = k;
    r.Vh = m;

    function og(a) {
        return a.Ac || (a.Ac = ya(a.Yi))
    }

    function pg(a, b) {
        if (a.ba && a.ba.Pa) {
            var c = a.ba.Pa,
                d = a.Ac;
            d in c && delete c[d];
            mb(a.ba.Pa, b, a)
        }
        a.Ac = b
    }
    r.a = n("g");

    function Q(a) {
        return a.yc || (a.yc = new dd(a))
    }

    function qg(a, b) {
        a == b && e(Error("Unable to set parent component"));
        b && a.ba && a.Ac && rg(a.ba, a.Ac) && a.ba != b && e(Error("Unable to set parent component"));
        a.ba = b;
        P.b.dg.call(a, b)
    }
    r.getParent = n("ba");
    r.dg = function (a) {
        this.ba && this.ba != a && e(Error("Method not supported"));
        P.b.dg.call(this, a)
    };
    r.o = n("Da");
    r.d = function () {
        this.g = this.Da.createElement("div")
    };
    r.X = function (a) {
        sg(this, a)
    };

    function sg(a, b, c) {
        a.F && e(Error("Component already rendered"));
        a.g || a.d();
        b ? b.insertBefore(a.g, c || k) : a.Da.Q.body.appendChild(a.g);
        (!a.ba || a.ba.F) && a.s()
    }
    r.J = function (a) {
        this.F && e(Error("Component already rendered"));
        if (a && this.R(a)) {
            this.Vh = i;
            if (!this.Da || this.Da.Q != Vb(a)) this.Da = Tb(a);
            this.Qa(a);
            this.s()
        } else e(Error("Invalid element to decorate"))
    };
    r.R = p(i);
    r.Qa = ca("g");
    r.s = function () {
        this.F = i;
        R(this, function (a) {
            !a.F && a.a() && a.s()
        })
    };
    r.ka = function () {
        R(this, function (a) {
            a.F && a.ka()
        });
        this.yc && this.yc.vb();
        this.F = m
    };
    r.h = function () {
        P.b.h.call(this);
        this.F && this.ka();
        this.yc && (this.yc.i(), delete this.yc);
        R(this, function (a) {
            a.i()
        });
        !this.Vh && this.g && gc(this.g);
        this.ba = this.j = this.g = this.Pa = this.Y = k
    };

    function tg(a, b) {
        return og(a) + "." + b
    }
    r.z = function (a, b) {
        this.Oc(a, T(this), b)
    };
    r.Oc = function (a, b, c) {
        a.F && (c || !this.F) && e(Error("Component already rendered"));
        (0 > b || b > T(this)) && e(Error("Child component index out of bounds"));
        if (!this.Pa || !this.Y) this.Pa = {}, this.Y = [];
        a.getParent() == this ? (this.Pa[og(a)] = a, Wa(this.Y, a)) : mb(this.Pa, og(a), a);
        qg(a, this);
        ab(this.Y, b, 0, a);
        a.F && this.F && a.getParent() == this ? (c = this.H(), c.insertBefore(a.a(), c.childNodes[b] || k)) : c ? (this.g || this.d(), b = this.A(b + 1), sg(a, this.H(), b ? b.g : k)) : this.F && !a.F && a.g && a.s()
    };
    r.H = n("g");

    function ug(a) {
        if (a.wd == k) a.wd = ag(a.F ? a.g : a.Da.Q.body);
        return a.wd
    }
    r.Kc = function (a) {
        this.F && e(Error("Component already rendered"));
        this.wd = a
    };

    function T(a) {
        return a.Y ? a.Y.length : 0
    }

    function rg(a, b) {
        return a.Pa && b ? (b in a.Pa ? a.Pa[b] : h) || k : k
    }
    r.A = function (a) {
        return this.Y ? this.Y[a] || k : k
    };

    function R(a, b, c) {
        a.Y && y(a.Y, b, c)
    }

    function vg(a, b) {
        return a.Y && b ? Ra(a.Y, b) : -1
    }
    r.removeChild = function (a, b) {
        if (a) {
            var c = u(a) ? a : og(a),
                a = rg(this, c);
            if (c && a) {
                var d = this.Pa;
                c in d && delete d[c];
                Wa(this.Y, a);
                b && (a.ka(), a.g && gc(a.g));
                qg(a, k)
            }
        }
        a || e(Error("Child is not in parent component"));
        return a
    };

    function wg(a, b) {
        P.call(this, b);
        this.od = fa(a) ? a : "";
        this.Tg = m
    }
    w(wg, P);
    wg.prototype.d = function () {
        this.Qa(this.Da.d("span", h, this.od))
    };
    wg.prototype.Qa = function (a) {
        wg.b.Qa.call(this, a);
        this.od = a.firstChild && a.firstChild.nodeValue || "";
        A(a, "au-upldr-label")
    };

    function xg(a, b, c) {
        a.od = fa(b) ? b : "";
        a.Tg = !! c;
        if (b = a.a()) a.Tg ? b.innerHTML = a.od : kc(b, a.od)
    };

    function yg(a, b) {
        a.setAttribute("role", b);
        a.fm = b
    }

    function zg(a, b, c) {
        a.setAttribute("aria-" + b, c)
    };

    function Ag() {}
    var Bg;
    t(Ag);
    r = Ag.prototype;
    r.xa = ba();
    r.d = function (a) {
        var b = a.o().d("div", this.Ea(a).join(" "), a.wa);
        this.ue(a, b);
        return b
    };
    r.H = aa();
    r.Vc = function (a, b, c) {
        if (a = a.a ? a.a() : a)
            if (B && !E("7")) {
                var d = Cg(db(a), b);
                d.push(b);
                sa(c ? A : fb, a).apply(k, d)
            } else c ? A(a, b) : fb(a, b)
    };
    r.R = p(i);
    r.J = function (a, b) {
        b.id && pg(a, b.id);
        var c = this.H(b);
        c && c.firstChild ? Dg(a, c.firstChild.nextSibling ? Ya(c.childNodes) : c.firstChild) : a.wa = k;
        var d = 0,
            f = this.f(),
            g = this.f(),
            j = m,
            l = m,
            c = m,
            o = db(b);
        y(o, function (a) {
            !j && a == f ? (j = i, g == f && (l = i)) : !l && a == g ? l = i : d |= this.nf(a)
        }, this);
        a.Pb = d;
        j || (o.push(f), g == f && (l = i));
        l || o.push(g);
        var q = a.Ya;
        q && o.push.apply(o, q);
        if (B && !E("7")) {
            var z = Cg(o);
            0 < z.length && (o.push.apply(o, z), c = i)
        }
        if (!j || !l || q || c) b.className = o.join(" ");
        this.ue(a, b);
        return b
    };
    r.Cc = function (a) {
        ug(a) && this.Kc(a.a(), i);
        a.isEnabled() && this.wb(a, a.V())
    };
    r.ue = function (a, b) {
        a.isEnabled() || this.Ia(b, 1, i);
        U(a, 8) && this.Ia(b, 8, i);
        a.da & 16 && this.Ia(b, 16, U(a, 16));
        a.da & 64 && this.Ia(b, 64, U(a, 64))
    };
    r.yd = function (a, b) {
        gg(a, !b, !B && !Ab)
    };
    r.Kc = function (a, b) {
        this.Vc(a, this.f() + "-rtl", b)
    };
    r.Eb = function (a) {
        var b;
        return a.da & 32 && (b = a.ha()) ? nc(b) : m
    };
    r.wb = function (a, b) {
        var c;
        if (a.da & 32 && (c = a.ha())) {
            if (!b && U(a, 32)) {
                try {
                    c.blur()
                } catch (d) {}
                U(a, 32) && a.$b(k)
            }
            if (nc(c) != b) b ? c.tabIndex = 0 : (c.tabIndex = -1, c.removeAttribute("tabIndex"))
        }
    };
    r.D = function (a, b) {
        O(a, b)
    };
    r.N = function (a, b, c) {
        var d = a.a();
        if (d) {
            var f = this.cd(b);
            f && this.Vc(a, f, c);
            this.Ia(d, b, c)
        }
    };
    r.Ia = function (a, b, c) {
        Bg || (Bg = {
            1: "disabled",
            8: "selected",
            16: "checked",
            64: "expanded"
        });
        (b = Bg[b]) && zg(a, b, c)
    };
    r.na = function (a, b) {
        var c = this.H(a);
        if (c && (fc(c), b))
            if (u(b)) kc(c, b);
            else {
                var d = function (a) {
                    if (a) {
                        var b = Vb(c);
                        c.appendChild(u(a) ? b.createTextNode(a) : a)
                    }
                };
                ja(b) ? y(b, d) : ka(b) && !("nodeType" in b) ? y(Ya(b), d) : d(b)
            }
    };
    r.ha = function (a) {
        return a.a()
    };
    r.f = p("goog-control");
    r.Ea = function (a) {
        var b = this.f(),
            c = [b],
            d = this.f();
        d != b && c.push(d);
        b = a.gb();
        for (d = []; b;) {
            var f = b & -b;
            d.push(this.cd(f));
            b &= ~f
        }
        c.push.apply(c, d);
        (a = a.Ya) && c.push.apply(c, a);
        B && !E("7") && c.push.apply(c, Cg(c));
        return c
    };

    function Cg(a, b) {
        var c = [];
        b && (a = a.concat([b]));
        y([], function (d) {
            Ua(d, sa(Va, a)) && (!b || Va(d, b)) && c.push(d.join("_"))
        });
        return c
    }
    r.cd = function (a) {
        this.Jd || Eg(this);
        return this.Jd[a]
    };
    r.nf = function (a) {
        if (!this.Ih) {
            this.Jd || Eg(this);
            var b = this.Jd,
                c = {}, d;
            for (d in b) c[b[d]] = d;
            this.Ih = c
        }
        a = parseInt(this.Ih[a], 10);
        return isNaN(a) ? 0 : a
    };

    function Eg(a) {
        var b = a.f();
        a.Jd = {
            1: b + "-disabled",
            2: b + "-hover",
            4: b + "-active",
            8: b + "-selected",
            16: b + "-checked",
            32: b + "-focused",
            64: b + "-open"
        }
    };

    function Fg() {}
    w(Fg, Ag);
    t(Fg);
    r = Fg.prototype;
    r.xa = p("button");
    r.Ia = function (a, b, c) {
        16 == b ? zg(a, "pressed", c) : Fg.b.Ia.call(this, a, b, c)
    };
    r.d = function (a) {
        var b = Fg.b.d.call(this, a),
            c = a.hb();
        c && this.lb(b, c);
        (c = a.$()) && this.C(b, c);
        a.da & 16 && this.Ia(b, 16, U(a, 16));
        return b
    };
    r.J = function (a, b) {
        var b = Fg.b.J.call(this, a, b),
            c = this.$(b);
        a.Ab = c;
        a.zb = this.hb(b);
        a.da & 16 && this.Ia(b, 16, U(a, 16));
        return b
    };
    r.$ = ha;
    r.C = ha;
    r.hb = function (a) {
        return a.title
    };
    r.lb = function (a, b) {
        if (a) a.title = b || ""
    };
    r.f = p("goog-button");

    function Gg(a, b) {
        la(a) || e(Error("Invalid component class " + a));
        la(b) || e(Error("Invalid renderer class " + b));
        var c = na(a);
        Hg[c] = b
    }

    function Ig(a, b) {
        a || e(Error("Invalid class name " + a));
        la(b) || e(Error("Invalid decorator function " + b));
        Jg[a] = b
    }
    var Hg = {}, Jg = {};

    function Kg(a, b, c, d, f) {
        if (!B && (!C || !E("525"))) return i;
        if (vb && f) return Lg(a);
        if (f && !d || !c && (17 == b || 18 == b) || B && d && b == a) return m;
        switch (a) {
        case 13:
            return !(B && Ob(9));
        case 27:
            return !C
        }
        return Lg(a)
    }

    function Lg(a) {
        if (48 <= a && 57 >= a || 96 <= a && 106 >= a || 65 <= a && 90 >= a || C && 0 == a) return i;
        switch (a) {
        case 32:
        case 63:
        case 107:
        case 109:
        case 110:
        case 111:
        case 186:
        case 59:
        case 189:
        case 187:
        case 188:
        case 190:
        case 191:
        case 192:
        case 222:
        case 219:
        case 220:
        case 221:
            return i;
        default:
            return m
        }
    };

    function Mg(a, b) {
        a && this.Rb(a, b)
    }
    w(Mg, H);
    r = Mg.prototype;
    r.g = k;
    r.ge = k;
    r.Df = k;
    r.he = k;
    r.Gb = -1;
    r.Fb = -1;
    var Ng = {
        3: 13,
        12: 144,
        63232: 38,
        63233: 40,
        63234: 37,
        63235: 39,
        63236: 112,
        63237: 113,
        63238: 114,
        63239: 115,
        63240: 116,
        63241: 117,
        63242: 118,
        63243: 119,
        63244: 120,
        63245: 121,
        63246: 122,
        63247: 123,
        63248: 44,
        63272: 46,
        63273: 36,
        63275: 35,
        63276: 33,
        63277: 34,
        63289: 144,
        63302: 45
    }, Og = {
            Up: 38,
            Down: 40,
            Left: 37,
            Right: 39,
            Enter: 13,
            F1: 112,
            F2: 113,
            F3: 114,
            F4: 115,
            F5: 116,
            F6: 117,
            F7: 118,
            F8: 119,
            F9: 120,
            F10: 121,
            F11: 122,
            F12: 123,
            "U+007F": 46,
            Home: 36,
            End: 35,
            PageUp: 33,
            PageDown: 34,
            Insert: 45
        }, Pg = {
            61: 187,
            59: 186
        }, Qg = B || C && E("525");
    r = Mg.prototype;
    r.Ri = function (a) {
        if (C && (17 == this.Gb && !a.ctrlKey || 18 == this.Gb && !a.altKey)) this.Fb = this.Gb = -1;
        Qg && !Kg(a.keyCode, this.Gb, a.shiftKey, a.ctrlKey, a.altKey) ? this.handleEvent(a) : this.Fb = Bb && a.keyCode in Pg ? Pg[a.keyCode] : a.keyCode
    };
    r.Si = function () {
        this.Fb = this.Gb = -1
    };
    r.handleEvent = function (a) {
        var b = a.ga,
            c, d;
        B && "keypress" == a.type ? (c = this.Fb, d = 13 != c && 27 != c ? b.keyCode : 0) : C && "keypress" == a.type ? (c = this.Fb, d = 0 <= b.charCode && 63232 > b.charCode && Lg(c) ? b.charCode : 0) : Ab ? (c = this.Fb, d = Lg(c) ? b.keyCode : 0) : (c = b.keyCode || this.Fb, d = b.charCode || 0, vb && 63 == d && !c && (c = 191));
        var f = c,
            g = b.keyIdentifier;
        c ? 63232 <= c && c in Ng ? f = Ng[c] : 25 == c && a.shiftKey && (f = 9) : g && g in Og && (f = Og[g]);
        a = f == this.Gb;
        this.Gb = f;
        b = new Rg(f, d, a, b);
        try {
            this.dispatchEvent(b)
        } finally {
            b.i()
        }
    };
    r.a = n("g");
    r.Rb = function (a, b) {
        this.he && this.detach();
        this.g = a;
        this.ge = Nc(this.g, "keypress", this, b);
        this.Df = Nc(this.g, "keydown", this.Ri, b, this);
        this.he = Nc(this.g, "keyup", this.Si, b, this)
    };
    r.detach = function () {
        if (this.ge) Tc(this.ge), Tc(this.Df), Tc(this.he), this.he = this.Df = this.ge = k;
        this.g = k;
        this.Fb = this.Gb = -1
    };
    r.h = function () {
        Mg.b.h.call(this);
        this.detach()
    };

    function Rg(a, b, c, d) {
        d && this.ld(d, h);
        this.type = "key";
        this.keyCode = a;
        this.charCode = b;
        this.repeat = c
    }
    w(Rg, Gc);

    function V(a, b, c) {
        P.call(this, c);
        if (!b) {
            for (var b = this.constructor, d; b;) {
                d = na(b);
                if (d = Hg[d]) break;
                b = b.b ? b.b.constructor : k
            }
            b = d ? la(d.t) ? d.t() : new d : k
        }
        this.w = b;
        this.wa = a
    }
    w(V, P);
    r = V.prototype;
    r.wa = k;
    r.Pb = 0;
    r.da = 39;
    r.Pc = 255;
    r.ye = 0;
    r.la = i;
    r.Ya = k;
    r.sf = i;
    r.Hd = m;
    r.qe = k;
    r.Yg = n("sf");

    function Sg(a, b) {
        a.F && b != a.sf && Tg(a, b);
        a.sf = b
    }
    r.ha = function () {
        return this.w.ha(this)
    };
    r.Xd = function () {
        return this.Ua || (this.Ua = new Mg)
    };
    r.Vc = function (a, b) {
        if (b) {
            if (a) this.Ya ? Va(this.Ya, a) || this.Ya.push(a) : this.Ya = [a], this.w.Vc(this, a, i)
        } else if (a && this.Ya) {
            Wa(this.Ya, a);
            if (0 == this.Ya.length) this.Ya = k;
            this.w.Vc(this, a, m)
        }
    };
    r.d = function () {
        var a = this.w.d(this);
        this.g = a;
        var b = this.qe || this.w.xa();
        b && yg(a, b);
        this.Hd || this.w.yd(a, m);
        this.V() || this.w.D(a, m)
    };
    r.H = function () {
        return this.w.H(this.a())
    };
    r.R = function (a) {
        return this.w.R(a)
    };
    r.Qa = function (a) {
        this.g = a = this.w.J(this, a);
        var b = this.qe || this.w.xa();
        b && yg(a, b);
        this.Hd || this.w.yd(a, m);
        this.la = "none" != a.style.display
    };
    r.s = function () {
        V.b.s.call(this);
        this.w.Cc(this);
        if (this.da & -2 && (this.Yg() && Tg(this, i), this.da & 32)) {
            var a = this.ha();
            if (a) {
                var b = this.Xd();
                b.Rb(a);
                Q(this).c(b, "key", this.Sa).c(a, "focus", this.ac).c(a, "blur", this.$b)
            }
        }
    };

    function Tg(a, b) {
        var c = Q(a),
            d = a.a();
        b ? (c.c(d, "mouseover", a.zc).c(d, "mousedown", a.bc).c(d, "mouseup", a.cc).c(d, "mouseout", a.tf), B && c.c(d, "dblclick", a.Ng)) : (c.ea(d, "mouseover", a.zc).ea(d, "mousedown", a.bc).ea(d, "mouseup", a.cc).ea(d, "mouseout", a.tf), B && c.ea(d, "dblclick", a.Ng))
    }
    r.ka = function () {
        V.b.ka.call(this);
        this.Ua && this.Ua.detach();
        this.V() && this.isEnabled() && this.w.wb(this, m)
    };
    r.h = function () {
        V.b.h.call(this);
        this.Ua && (this.Ua.i(), delete this.Ua);
        delete this.w;
        this.Ya = this.wa = k
    };
    r.na = function (a) {
        this.w.na(this.a(), a);
        this.wa = a
    };

    function Dg(a, b) {
        a.wa = b
    }
    r.uc = function () {
        var a = this.wa;
        if (!a) return "";
        if (!u(a))
            if (ja(a)) a = Sa(a, oc).join("");
            else {
                if (Rb && "innerText" in a) a = a.innerText.replace(/(\r\n|\r|\n)/g, "\n");
                else {
                    var b = [];
                    qc(a, b, i);
                    a = b.join("")
                }
                a = a.replace(/ \xAD /g, " ").replace(/\xAD/g, "");
                a = a.replace(/\u200B/g, "");
                Rb || (a = a.replace(/ +/g, " "));
                " " != a && (a = a.replace(/^\s*/, ""))
            }
        return Da(a)
    };
    r.Kc = function (a) {
        V.b.Kc.call(this, a);
        var b = this.a();
        b && this.w.Kc(b, a)
    };
    r.yd = function (a) {
        this.Hd = a;
        var b = this.a();
        b && this.w.yd(b, a)
    };
    r.V = n("la");
    r.D = function (a, b) {
        if (b || this.la != a && this.dispatchEvent(a ? "show" : "hide")) {
            var c = this.a();
            c && this.w.D(c, a);
            this.isEnabled() && this.w.wb(this, a);
            this.la = a;
            return i
        }
        return m
    };
    r.isEnabled = function () {
        return !U(this, 1)
    };
    r.za = function (a) {
        var b = this.getParent();
        if ((!b || "function" != typeof b.isEnabled || b.isEnabled()) && Ug(this, 1, !a)) a || (this.setActive(m), this.Ma(m)), this.V() && this.w.wb(this, a), this.N(1, !a)
    };
    r.Ma = function (a) {
        Ug(this, 2, a) && this.N(2, a)
    };
    r.nd = function () {
        return U(this, 4)
    };
    r.setActive = function (a) {
        Ug(this, 4, a) && this.N(4, a)
    };
    r.Nb = function (a) {
        Ug(this, 8, a) && this.N(8, a)
    };
    r.ca = function (a) {
        Ug(this, 64, a) && this.N(64, a)
    };
    r.gb = n("Pb");

    function U(a, b) {
        return !!(a.Pb & b)
    }
    r.N = function (a, b) {
        if (this.da & a && b != U(this, a)) this.w.N(this, a, b), this.Pb = b ? this.Pb | a : this.Pb & ~a
    };

    function Vg(a, b, c) {
        a.F && U(a, b) && !c && e(Error("Component already rendered"));
        !c && U(a, b) && a.N(b, m);
        a.da = c ? a.da | b : a.da & ~b
    }

    function Wg(a, b) {
        return !!(a.Pc & b) && !! (a.da & b)
    }

    function Xg(a, b, c) {
        a.ye = c ? a.ye | b : a.ye & ~b
    }

    function Ug(a, b, c) {
        return !!(a.da & b) && U(a, b) != c && (!(a.ye & b) || a.dispatchEvent(ng(b, c))) && !a.Sd
    }
    r.zc = function (a) {
        (!a.relatedTarget || !jc(this.a(), a.relatedTarget)) && this.dispatchEvent("enter") && this.isEnabled() && Wg(this, 2) && this.Ma(i)
    };
    r.tf = function (a) {
        if ((!a.relatedTarget || !jc(this.a(), a.relatedTarget)) && this.dispatchEvent("leave")) Wg(this, 4) && this.setActive(m), Wg(this, 2) && this.Ma(m)
    };
    r.bc = function (a) {
        this.isEnabled() && (Wg(this, 2) && this.Ma(i), Ic(a) && (Wg(this, 4) && this.setActive(i), this.w.Eb(this) && this.ha().focus()));
        !this.Hd && Ic(a) && a.preventDefault()
    };
    r.cc = function (a) {
        this.isEnabled() && (Wg(this, 2) && this.Ma(i), this.nd() && this.Hb(a) && Wg(this, 4) && this.setActive(m))
    };
    r.Ng = function (a) {
        this.isEnabled() && this.Hb(a)
    };
    r.Hb = function (a) {
        if (Wg(this, 16)) {
            var b = !U(this, 16);
            Ug(this, 16, b) && this.N(16, b)
        }
        Wg(this, 8) && this.Nb(i);
        Wg(this, 64) && this.ca(!U(this, 64));
        b = new G("action", this);
        if (a) b.altKey = a.altKey, b.ctrlKey = a.ctrlKey, b.metaKey = a.metaKey, b.shiftKey = a.shiftKey, b.Vf = a.Vf;
        return this.dispatchEvent(b)
    };
    r.ac = function () {
        Wg(this, 32) && Ug(this, 32, i) && this.N(32, i)
    };
    r.$b = function () {
        Wg(this, 4) && this.setActive(m);
        Wg(this, 32) && Ug(this, 32, m) && this.N(32, m)
    };
    r.Sa = function (a) {
        return this.V() && this.isEnabled() && this.Za(a) ? (a.preventDefault(), a.stopPropagation(), i) : m
    };
    r.Za = function (a) {
        return 13 == a.keyCode && this.Hb(a)
    };
    Gg(V, Ag);
    Ig("goog-control", function () {
        return new V(k)
    });

    function Yg() {}
    w(Yg, Fg);
    t(Yg);
    r = Yg.prototype;
    r.xa = ba();
    r.d = function (a) {
        Zg(a);
        return a.o().d("button", {
            "class": this.Ea(a).join(" "),
            disabled: !a.isEnabled(),
            title: a.hb() || "",
            value: a.$() || ""
        }, a.uc() || "")
    };
    r.R = function (a) {
        return "BUTTON" == a.tagName || "INPUT" == a.tagName && ("button" == a.type || "submit" == a.type || "reset" == a.type)
    };
    r.J = function (a, b) {
        Zg(a);
        b.disabled && A(b, this.cd(1));
        return Yg.b.J.call(this, a, b)
    };
    r.Cc = function (a) {
        Q(a).c(a.a(), "click", a.Hb)
    };
    r.yd = ha;
    r.Kc = ha;
    r.Eb = function (a) {
        return a.isEnabled()
    };
    r.wb = ha;
    r.N = function (a, b, c) {
        Yg.b.N.call(this, a, b, c);
        if ((a = a.a()) && 1 == b) a.disabled = c
    };
    r.$ = function (a) {
        return a.value
    };
    r.C = function (a, b) {
        if (a) a.value = b
    };
    r.Ia = ha;

    function Zg(a) {
        Sg(a, m);
        a.Pc &= -256;
        Vg(a, 32, m)
    };

    function W(a, b, c) {
        V.call(this, a, b || Yg.t(), c)
    }
    w(W, V);
    r = W.prototype;
    r.$ = n("Ab");
    r.C = function (a) {
        this.Ab = a;
        this.w.C(this.a(), a)
    };
    r.hb = n("zb");
    r.lb = function (a) {
        this.zb = a;
        this.w.lb(this.a(), a)
    };
    r.h = function () {
        W.b.h.call(this);
        delete this.Ab;
        delete this.zb
    };
    r.s = function () {
        W.b.s.call(this);
        if (this.da & 32) {
            var a = this.ha();
            a && Q(this).c(a, "keyup", this.Za)
        }
    };
    r.Za = function (a) {
        return 13 == a.keyCode && "key" == a.type || 32 == a.keyCode && "keyup" == a.type ? this.Hb(a) : 32 == a.keyCode
    };
    Ig("goog-button", function () {
        return new W(k)
    });

    function $g() {}
    w($g, Fg);
    t($g);
    r = $g.prototype;
    r.H = aa();
    r.d = function (a) {
        var b = {
            "class": "goog-inline-block " + this.Ea(a).join(" "),
            title: a.hb() || ""
        };
        return a.o().d("div", b, a.wa)
    };
    r.R = function (a) {
        return "DIV" == a.tagName
    };
    r.J = function (a, b) {
        A(b, "goog-inline-block", this.f());
        return $g.b.J.call(this, a, b)
    };
    r.f = p("goog-css3-button");
    Ig("goog-css3-button", function () {
        return new W(k, $g.t())
    });
    Ig("goog-css3-toggle-button", function () {
        var a = new W(k, $g.t());
        Vg(a, 16, i);
        return a
    });

    function ah() {}
    w(ah, H);
    r = ah.prototype;
    r.Ab = 0;
    r.$a = 0;
    r.jb = 100;
    r.fb = 0;
    r.kg = 1;
    r.rb = m;
    r.Nf = m;
    r.C = function (a) {
        a = bh(this, a);
        if (this.Ab != a) this.Ab = a + this.fb > this.jb ? this.jb - this.fb : a < this.$a ? this.$a : a, !this.rb && !this.Nf && this.dispatchEvent("change")
    };
    r.$ = function () {
        return bh(this, this.Ab)
    };
    r.zd = function (a) {
        if (this.$a != a) {
            var b = this.rb;
            this.rb = i;
            this.$a = a;
            if (a + this.fb > this.jb) this.fb = this.jb - this.$a;
            a > this.Ab && this.C(a);
            if (a > this.jb) this.fb = 0, this.Mb(a), this.C(a);
            this.rb = b;
            !this.rb && !this.Nf && this.dispatchEvent("change")
        }
    };
    r.Yd = function () {
        return bh(this, this.$a)
    };
    r.Mb = function (a) {
        a = bh(this, a);
        if (this.jb != a) {
            var b = this.rb;
            this.rb = i;
            this.jb = a;
            a < this.Ab + this.fb && this.C(a - this.fb);
            if (a < this.$a) this.fb = 0, this.zd(a), this.C(this.jb);
            if (a < this.$a + this.fb) this.fb = this.jb - this.$a;
            this.rb = b;
            !this.rb && !this.Nf && this.dispatchEvent("change")
        }
    };
    r.wc = function () {
        return bh(this, this.jb)
    };

    function bh(a, b) {
        return a.kg == k ? b : a.$a + Math.round((b - a.$a) / a.kg) * a.kg
    };

    function ch(a) {
        P.call(this, a);
        this.Jb = new ah;
        Nc(this.Jb, "change", this.Mi, m, this)
    }
    w(ch, P);
    var dh = {
        vertical: "progress-bar-vertical",
        horizontal: "progress-bar-horizontal"
    };
    r = ch.prototype;
    r.d = function () {
        this.Na = eh(this);
        var a = dh[this.ya];
        this.g = this.o().d("div", a, this.Na);
        fh(this);
        gh(this);
        hh(this)
    };
    r.s = function () {
        ch.b.s.call(this);
        B && 7 > Fb && Nc(this.a(), "resize", this.Ed, m, this);
        this.Ed();
        yg(this.a(), "progressbar");
        zg(this.a(), "live", "polite")
    };
    r.ka = function () {
        ch.b.ka.call(this);
        ih(this)
    };

    function eh(a) {
        return a.o().d("div", "progress-bar-thumb")
    }

    function ih(a) {
        B && 7 > Fb && Rc(a.a(), "resize", a.Ed, m, a)
    }
    r.Qa = function (a) {
        ch.b.Qa.call(this, a);
        A(this.a(), dh[this.ya]);
        a = Xb(document, k, "progress-bar-thumb", this.a())[0];
        a || (a = eh(this), this.a().appendChild(a));
        this.Na = a
    };
    r.$ = function () {
        return this.Jb.$()
    };
    r.C = function (a) {
        this.Jb.C(a);
        this.a() && fh(this)
    };

    function fh(a) {
        zg(a.a(), "valuenow", a.$())
    }
    r.Yd = function () {
        return this.Jb.Yd()
    };
    r.zd = function (a) {
        this.Jb.zd(a);
        this.a() && gh(this)
    };

    function gh(a) {
        zg(a.a(), "valuemin", a.Yd())
    }
    r.wc = function () {
        return this.Jb.wc()
    };
    r.Mb = function (a) {
        this.Jb.Mb(a);
        this.a() && hh(this)
    };

    function hh(a) {
        zg(a.a(), "valuemax", a.wc())
    }
    r.ya = "horizontal";
    r.Mi = function () {
        this.Ed();
        this.dispatchEvent("change")
    };
    r.Ed = function () {
        if (this.Na) {
            var a = this.Yd(),
                b = this.wc(),
                a = (this.$() - a) / (b - a),
                b = Math.round(100 * a);
            "vertical" == this.ya ? B && 7 > Fb ? (this.Na.style.top = 0, this.Na.style.height = "100%", b = this.Na.offsetHeight, a = Math.round(a * b), this.Na.style.top = b - a + "px", this.Na.style.height = a + "px") : (this.Na.style.top = 100 - b + "%", this.Na.style.height = b + "%") : this.Na.style.width = b + "%"
        }
    };
    r.cg = function (a) {
        if (this.ya != a) {
            var b = dh[this.ya],
                c = dh[a];
            this.ya = a;
            if (this.a()) {
                for (var a = this.a(), d = db(a), f = m, g = 0; g < d.length; g++) d[g] == b && (ab(d, g--, 1), f = i);
                if (f) d.push(c), a.className = d.join(" ");
                b = this.Na.style;
                "vertical" == this.ya ? (b.left = 0, b.width = "100%") : (b.top = b.left = 0, b.height = "100%");
                this.Ed()
            }
        }
    };
    r.h = function () {
        ih(this);
        ch.b.h.call(this);
        this.Na = k;
        this.Jb.i()
    };

    function jh(a, b) {
        P.call(this, b);
        this.j = a
    }
    w(jh, P);
    r = jh.prototype;
    r.f = p("au-upldr-status-pane");
    r.d = function () {
        var a = this.o(),
            b = a.d("div", [this.f(), "statusBar"].join(" "));
        this.g = b;
        var c = this.ub = new ch;
        c.Mb(100);
        c.zd(0);
        this.z(c, i);
        A(c.a(), "uploadProgressBar");
        var d, f = a.d("div", k, c = a.d("div"), d = a.d("div"));
        this.$c = new wg;
        this.z(this.$c, m);
        this.$c.X(c);
        A(this.$c.a(), "statusBarText0");
        a = a.createElement("br");
        c.appendChild(a);
        this.Ub = new wg;
        this.z(this.Ub, m);
        this.Ub.X(c);
        A(this.Ub.a(), "statusBarText1");
        this.Xa = new W("", $g.t());
        this.z(this.Xa, m);
        this.Xa.X(d);
        A(this.Xa.a(), "sendButton");
        this.Ie();
        b.appendChild(f)
    };
    r.s = function () {
        jh.b.s.call(this);
        var a = this.j,
            b = a.r;
        X(b, "UploaderState", this.Ie, this);
        X(b, "UploadButtonText", this.Ie, this);
        X(b, "CancelUploadButtonText", this.Ie, this);
        X(b, "FilesToUploadText", this.Dd, this);
        X(b, "NoFilesToUploadText", this.Dd, this);
        X(b, "UploadProgress", this.ik, this);
        b = Q(this);
        b.c(this.Xa, "action", this.yj);
        b.c(a.ma(), ad, this.Dd)
    };
    r.Ie = function () {
        var a = this.j.r;
        switch (I(a, "UploaderState")) {
        case 0:
            O(this.ub.a(), m);
            O(this.Ub.a(), m);
            a = I(a, "UploadButtonText");
            this.Xa.na(a);
            ib(this.Xa.a(), "cancelButton", "sendButton");
            this.Dd();
            break;
        case 1:
            O(this.ub.a(), m);
            O(this.Ub.a(), m);
            a = I(a, "UploadButtonText");
            this.Xa.na(a);
            ib(this.Xa.a(), "cancelButton", "sendButton");
            this.Dd();
            break;
        case 2:
            O(this.ub.a(), i), O(this.Ub.a(), i), a = I(a, "CancelUploadButtonText"), this.Xa.na(a), this.Xa.za(i), ib(this.Xa.a(), "sendButton", "cancelButton")
        }
    };
    r.ik = function () {
        var a = this.j.r;
        if (2 == I(a, "UploaderState")) {
            var b = I(a, "UploadProgress");
            this.ub.C(b.Uf);
            var c = I(a, "StatusPaneFilesUploadedText"),
                c = J(c, b.ib, b.Wa);
            xg(this.$c, c);
            c = I(a, "StatusPaneDataUploadedText");
            a = Cd(b.ia);
            b = Cd(b.Aa);
            c = J(c, a, b);
            xg(this.Ub, c)
        }
    };
    r.Dd = function () {
        var a = this.j,
            b = a.r;
        switch (I(b, "UploaderState")) {
        case 0:
            b = I(b, "NoFilesToUploadText");
            a = m;
            break;
        case 1:
            b = I(b, "FilesToUploadText");
            b = J(b, a.ma().Z());
            a = i;
            break;
        default:
            return
        }
        xg(this.$c, b, i);
        this.Xa.za(a)
    };
    r.yj = function () {
        var a = this.j;
        switch (I(a.r, "UploaderState")) {
        case 1:
            a.upload();
            break;
        case 2:
            kh(a, h) && a.Vb(9, -1, "", I(a.r, "UploadCancelledByUserMessage"))
        }
    };
    r.R = gd;

    function lh(a, b) {
        this.q = new dd(this);
        this.ag(a || k);
        if (b) this.Lc = b
    }
    w(lh, H);
    r = lh.prototype;
    r.g = k;
    r.qg = i;
    r.pg = k;
    r.Ec = m;
    r.Zj = m;
    r.Hf = -1;
    r.Zg = -1;
    r.Rg = m;
    r.pi = i;
    r.Lc = "toggle_display";
    r.of = n("Lc");
    r.a = n("g");
    r.ag = function (a) {
        mh(this);
        this.g = a
    };

    function nh(a) {
        mh(a);
        a.qg = m
    }

    function oh(a, b) {
        mh(a);
        a.Rg = b
    }

    function mh(a) {
        a.Ec && e(Error("Can not change this state of the popup while showing."))
    }
    r.V = n("Ec");
    r.D = function (a) {
        this.Ad && this.Ad.stop();
        this.jd && this.jd.stop();
        if (a) {
            if (!this.Ec && this.Pf()) {
                this.g || e(Error("Caller must call setElement before trying to show the popup"));
                this.La();
                a = Vb(this.g);
                this.Rg && this.q.c(a, "keydown", this.nj, i);
                if (this.qg)
                    if (this.q.c(a, "mousedown", this.mh, i), B) {
                        var b;
                        try {
                            b = a.activeElement
                        } catch (c) {}
                        for (; b && "IFRAME" == b.nodeName;) {
                            try {
                                var d = b.contentDocument || b.contentWindow.document
                            } catch (f) {
                                break
                            }
                            a = d;
                            b = a.activeElement
                        }
                        this.q.c(a, "mousedown", this.mh, i);
                        this.q.c(a, "deactivate",
                            this.lh)
                    } else this.q.c(a, "blur", this.lh);
                    "toggle_display" == this.Lc ? (this.g.style.visibility = "visible", O(this.g, i)) : "move_offscreen" == this.Lc && this.La();
                this.Ec = i;
                this.Ad ? (Qc(this.Ad, "end", this.nh, m, this), this.Ad.play()) : this.nh()
            }
        } else ph(this)
    };
    r.La = ha;

    function ph(a, b) {
        if (!a.Ec || !a.dispatchEvent({
            type: "beforehide",
            target: b
        })) return m;
        a.q && a.q.vb();
        a.jd ? (Qc(a.jd, "end", sa(a.yg, b), m, a), a.jd.play()) : a.yg(b);
        return i
    }
    r.yg = function (a) {
        if ("toggle_display" == this.Lc) this.Zj ? df(this.Sg, 0, this) : this.Sg();
        else if ("move_offscreen" == this.Lc) this.g.style.left = "-200px", this.g.style.top = "-200px";
        this.Ec = m;
        this.Qf(a)
    };
    r.Sg = function () {
        this.g.style.visibility = "hidden";
        O(this.g, m)
    };
    r.Pf = function () {
        return this.dispatchEvent("beforeshow")
    };
    r.nh = function () {
        this.Hf = ta();
        this.Zg = -1;
        this.dispatchEvent("show")
    };
    r.Qf = function (a) {
        this.Zg = ta();
        this.dispatchEvent({
            type: "hide",
            target: a
        })
    };
    r.mh = function (a) {
        a = a.target;
        !jc(this.g, a) && (!this.pg || jc(this.pg, a)) && !(150 > ta() - this.Hf) && ph(this, a)
    };
    r.nj = function (a) {
        27 == a.keyCode && ph(this, a.target) && (a.preventDefault(), a.stopPropagation())
    };
    r.lh = function (a) {
        if (this.pi) {
            var b = Vb(this.g);
            if (B || Ab) {
                if (a = b.activeElement, !a || jc(this.g, a) || "BODY" == a.tagName) return
            } else if (a.target != b) return;
            150 > ta() - this.Hf || ph(this)
        }
    };
    r.h = function () {
        lh.b.h.call(this);
        this.q.i();
        Ec(this.Ad);
        Ec(this.jd);
        delete this.g;
        delete this.q
    };

    function qh(a, b, c, d, f, g, j, l) {
        var o, q = c.offsetParent;
        if (q) {
            var z = "HTML" == q.tagName || "BODY" == q.tagName;
            if (!z || "static" != Tf(q, "position")) o = $f(q), z || (o = Sb(o, new F(q.scrollLeft, q.scrollTop)))
        }
        q = eg(a);
        (z = Zf(a)) && q.Vg(new Pf(z.left, z.top, z.right - z.left, z.bottom - z.top));
        var z = Tb(a),
            D = Tb(c);
        if (z.Q != D.Q) {
            var S = z.Q.body,
                D = D.Q.parentWindow || D.Q.defaultView,
                Y = new F(0, 0),
                hb = Vb(S) ? Vb(S).parentWindow || Vb(S).defaultView : window,
                pc = S;
            do {
                var ua;
                if (hb == D) ua = $f(pc);
                else {
                    var Z = pc;
                    ua = new F;
                    if (1 == Z.nodeType)
                        if (Z.getBoundingClientRect) Z =
                            Xf(Z), ua.x = Z.left, ua.y = Z.top;
                        else {
                            var md = tc(Tb(Z)),
                                Z = $f(Z);
                            ua.x = Z.x - md.x;
                            ua.y = Z.y - md.y
                        } else {
                            var md = la(Z.si),
                                ue = Z;
                            Z.targetTouches ? ue = Z.targetTouches[0] : md && Z.ga.targetTouches && (ue = Z.ga.targetTouches[0]);
                            ua.x = ue.clientX;
                            ua.y = ue.clientY
                        }
                }
                Y.x += ua.x;
                Y.y += ua.y
            } while (hb && hb != D && (pc = hb.frameElement) && (hb = hb.parent));
            S = Sb(Y, $f(S));
            B && !sc(z) && (S = Sb(S, tc(z)));
            q.left += S.x;
            q.top += S.y
        }
        a = (b & 4 && ag(a) ? b ^ 2 : b) & -5;
        b = new F(a & 2 ? q.left + q.width : q.left, a & 1 ? q.top + q.height : q.top);
        o && (b = Sb(b, o));
        f && (b.x += (a & 2 ? -1 : 1) * f.x, b.y +=
            (a & 1 ? -1 : 1) * f.y);
        var Za;
        if (j && (Za = Zf(c)) && o) Za.top -= o.y, Za.right -= o.x, Za.bottom -= o.y, Za.left -= o.x;
        return rh(b, c, d, g, Za, j, l)
    }

    function rh(a, b, c, d, f, g, j) {
        var a = a.va(),
            l = 0,
            o = (c & 4 && ag(b) ? c ^ 2 : c) & -5,
            c = cg(b),
            j = j ? j.va() : c.va();
        if (d || 0 != o) o & 2 ? a.x -= j.width + (d ? d.right : 0) : d && (a.x += d.left), o & 1 ? a.y -= j.height + (d ? d.bottom : 0) : d && (a.y += d.top);
        if (g) {
            if (f) {
                l = a;
                d = 0;
                if (65 == (g & 65) && (l.x < f.left || l.x >= f.right)) g &= -2;
                if (132 == (g & 132) && (l.y < f.top || l.y >= f.bottom)) g &= -5;
                if (l.x < f.left && g & 1) l.x = f.left, d |= 1;
                if (l.x < f.left && l.x + j.width > f.right && g & 16) j.width = Math.max(j.width - (l.x + j.width - f.right), 0), d |= 4;
                if (l.x + j.width > f.right && g & 1) l.x = Math.max(f.right - j.width,
                    f.left), d |= 1;
                g & 2 && (d |= (l.x < f.left ? 16 : 0) | (l.x + j.width > f.right ? 32 : 0));
                if (l.y < f.top && g & 4) l.y = f.top, d |= 2;
                if (l.y >= f.top && l.y + j.height > f.bottom && g & 32) j.height = Math.max(j.height - (l.y + j.height - f.bottom), 0), d |= 8;
                if (l.y + j.height > f.bottom && g & 4) l.y = Math.max(f.bottom - j.height, f.top), d |= 2;
                g & 8 && (d |= (l.y < f.top ? 64 : 0) | (l.y + j.height > f.bottom ? 128 : 0));
                l = d
            } else l = 256; if (l & 496) return l
        }
        Uf(b, a);
        if (!(c == j || (!c || !j ? 0 : c.width == j.width && c.height == j.height))) f = sc(Tb(Vb(b))), B && (!f || !E("8")) ? (a = b.style, f ? (f = ig(b, "padding"), b =
            lg(b), a.pixelWidth = j.width - b.left - f.left - f.right - b.right, a.pixelHeight = j.height - b.top - f.top - f.bottom - b.bottom) : (a.pixelWidth = j.width, a.pixelHeight = j.height)) : (b = b.style, Bb ? b.MozBoxSizing = "border-box" : C ? b.WebkitBoxSizing = "border-box" : b.boxSizing = "border-box", b.width = Math.max(j.width, 0) + "px", b.height = Math.max(j.height, 0) + "px");
        return l
    };

    function sh(a, b) {
        P.call(this, b);
        this.j = a
    }
    w(sh, P);
    r = sh.prototype;
    r.f = p("au-upldr-progress-dialog");
    r.d = function () {
        var a = this.j.r,
            b = this.o(),
            c = b.d("div", this.f());
        A(c, "waitWindowPanel");
        this.g = c;
        O(c, m);
        var d = this.Ha = new lh(c);
        d.D(m);
        oh(d, m);
        nh(d);
        var f = new wg(I(a, "AddFilesProgressDialogText"));
        this.z(f, i);
        X(a, "AddFilesProgressDialogText", function () {
            xg(f, I(a, "AddFilesProgressDialogText"))
        });
        d = this.ub = new ch;
        d.Mb(100);
        d.zd(0);
        this.z(d, i);
        A(d.a(), "waitWindowProgressBar");
        d = b.createElement("div");
        b.appendChild(c, d);
        b = this.nc = new W(I(a, "CommonDialogCancelButtonText"), $g.t());
        this.z(b, m);
        b.X(d);
        X(a, "CommonDialogCancelButtonText",
            function () {
                this.nc.na(I(a, "CommonDialogCancelButtonText"))
            }, this)
    };
    r.s = function () {
        sh.b.s.call(this);
        Q(this).c(this.Ha, "hide", this.sd).c(this.Ha, "show", this.td).c(this.nc, "action", this.mi).c(this.nc, "action", this.Ta)
    };
    r.show = function () {
        this.Ha.D(i)
    };
    r.Ta = function () {
        this.Ha.D(m)
    };
    r.Mb = function (a) {
        this.ub.Mb(a)
    };
    r.wc = function () {
        return this.ub.wc()
    };
    r.$ = function () {
        return this.ub.$()
    };
    r.C = function (a) {
        this.ub.C(a)
    };
    r.sd = function () {
        this.dispatchEvent(th)
    };
    r.td = function () {
        this.dispatchEvent(uh)
    };
    r.mi = function () {
        this.dispatchEvent(vh)
    };
    r.R = gd;
    r.e = M("au.upldr.ui.ProgressDialog");
    var uh = "show",
        th = "hide",
        vh = "cancel";

    function wh(a, b) {
        P.call(this, b);
        this.j = a;
        this.Kd = new W("X", $g.t());
        this.z(this.Kd);
        this.ie = new wg;
        this.z(this.ie);
        Q(this).c(this.Kd, "action", this.Ta).c(a.qd, ad, this.jj);
        this.la = i;
        this.Fe = 1E4
    }
    w(wh, P);
    r = wh.prototype;
    r.f = p("au-upldr-information-bar");
    r.d = function () {
        var a = this.o().d("div", this.f());
        A(a, "informationBar");
        this.g = a;
        this.Kd.X(a);
        A(this.Kd.a(), "informationBarCloseButton");
        this.ie.X(a);
        A(this.ie.a(), "informationBarText");
        this.Ta()
    };
    r.s = function () {
        wh.b.s.call(this);
        this.Yl = cg(this.a()).height
    };
    r.R = gd;
    r.Ta = function () {
        this.ta && (clearTimeout(this.ta), delete this.ta);
        this.la = m;
        this.a() && A(this.a(), "au-upldr-information-bar-collapsed");
        var a = xh(this);
        a != k && pd(v(this.show, this, a), 100)
    };
    r.show = function (a) {
        if (a != k && "" !== (a += "")) L(this.e, 'Show message: "' + a + '"'), this.la = i, xg(this.ie, a), this.a() && fb(this.a(), "au-upldr-information-bar-collapsed"), this.ta = pd(this.Ta, this.Fe, this)
    };
    r.jj = function (a) {
        !this.la && "add" == a.Ff && (L(this.e, "New notifications added: [" + this.j.qd.Z() + "]"), this.show(xh(this)))
    };

    function xh(a) {
        var a = a.j.qd,
            b;
        0 < a.Z() && (b = a.getItem(0), a.Kb(0));
        return b
    }
    r.e = M("au.upldr.ui.InformationBar");

    function yh() {}
    yh.prototype.La = ba();

    function zh(a, b) {
        this.We = a instanceof F ? a : new F(a, b)
    }
    w(zh, yh);
    zh.prototype.La = function (a, b, c, d) {
        qh(Wf(a), 0, a, b, this.We, c, k, d)
    };

    function Ah(a, b, c) {
        this.element = a;
        this.Tc = b;
        this.Bj = c
    }
    w(Ah, yh);
    Ah.prototype.La = function (a, b, c) {
        qh(this.element, this.Tc, a, b, h, c, this.Bj)
    };

    function Bh(a, b, c) {
        Ah.call(this, a, b);
        this.$g = c ? 5 : 0
    }
    w(Bh, Ah);
    Bh.prototype.La = function (a, b, c, d) {
        var f = qh(this.element, this.Tc, a, b, k, c, 10, d);
        if (f & 496) {
            var g = Ch(f, this.Tc),
                b = Ch(f, b),
                f = qh(this.element, g, a, b, k, c, 10, d);
            f & 496 && (g = Ch(f, g), b = Ch(f, b), qh(this.element, g, a, b, k, c, this.$g, d))
        }
    };

    function Ch(a, b) {
        a & 48 && (b ^= 2);
        a & 192 && (b ^= 1);
        return b
    };

    function Dh(a, b) {
        this.qh = 4;
        this.Wf = b || h;
        lh.call(this, a)
    }
    w(Dh, lh);

    function Eh(a) {
        a.qh = 0;
        a.V() && a.La()
    }
    Dh.prototype.eg = function (a) {
        this.Wf = a || h;
        this.V() && this.La()
    };
    Dh.prototype.La = function () {
        if (this.Wf) {
            var a = !this.V() && "move_offscreen" != this.of(),
                b = this.a();
            if (a) b.style.visibility = "hidden", O(b, i);
            this.Wf.La(b, this.qh, this.am);
            a && O(b, m)
        }
    };

    function Fh(a, b) {
        P.call(this, b);
        this.Ga = k;
        this.j = a
    }
    w(Fh, P);
    r = Fh.prototype;
    r.f = p("au-upldr-description-editor");
    r.d = function () {
        var a = this.j,
            b = this.o();
        this.yb = b.d("textarea", {
            rows: 3,
            cols: 25
        });
        A(this.yb, "descriptionEditorTextBox");
        var c = b.d("div", this.f(), this.yb);
        A(c, "descriptionEditorWindow");
        this.g = c;
        O(c, m);
        var d = this.Ha = new Dh(c);
        d.D(m);
        oh(d, i);
        Eh(d);
        d = b.createElement("div");
        b.appendChild(c, d);
        b = $g.t();
        c = this.le = new W(I(a, "DescriptionEditorSaveButtonText"), b);
        this.z(c, m);
        c.X(d);
        X(a, "DescriptionEditorSaveButtonText", function () {
            this.le.na(I(a, "DescriptionEditorSaveButtonText"))
        }, this);
        c = this.nc = new W(I(a,
            "DescriptionEditorCancelButtonText"), b);
        this.z(c, m);
        c.X(d);
        X(a, "DescriptionEditorCancelButtonText", function () {
            this.nc.na(I(a, "DescriptionEditorCancelButtonText"))
        }, this)
    };
    r.s = function () {
        Fh.b.s.call(this);
        Q(this).c(this.Ha, "hide", this.sd).c(this.Ha, "show", this.td).c(this.nc, "action", this.Ta).c(this.le, "action", this.vh).c(this.le, "action", this.Ta).c(this.yb, "keydown", this.bk)
    };
    r.show = function (a, b) {
        this.Ga = a;
        this.yb.value = a.I(Nd);
        var c = this.Ha;
        c.eg(new Bh(b, 1, i));
        c.D(i)
    };
    r.Ta = function () {
        this.Ha.D(m)
    };
    r.bk = function (a) {
        13 === a.keyCode && !a.shiftKey && !a.altKey && !a.metaKey && !a.ctrlKey && (a.preventDefault(), this.vh(), this.Ta())
    };
    r.vh = function () {
        var a = this.yb.value;
        a != k && this.Ga.sa(Nd, a)
    };
    r.sd = function () {
        this.Ga = k;
        this.yb.value = "";
        this.dispatchEvent(Gh)
    };
    r.td = function () {
        if (this.yb.value) this.yb.focus();
        else {
            var a = this.le.a();
            fd(Q(this), a, "keydown", function () {
                this.yb.focus()
            });
            a.focus()
        }
        this.dispatchEvent(Hh)
    };
    r.R = gd;
    r.e = M("au.upldr.ui.DescriptionEditor");
    var Hh = "show",
        Gh = "hide";

    function Ih(a) {
        G.call(this, xd);
        this.ad = a
    }
    w(Ih, G);

    function Jh(a, b) {
        this.Xc = new dd(this);
        var c = a;
        b && (c = Vb(a));
        this.Xc.c(c, "dragenter", this.lj);
        c != a && this.Xc.c(c, "dragover", this.mj);
        this.Xc.c(a, "dragover", this.oj);
        this.Xc.c(a, "drop", this.pj)
    }
    w(Jh, H);
    r = Jh.prototype;
    r.sc = m;
    r.B = M("goog.events.FileDropHandler");
    r.h = function () {
        Jh.b.h.call(this);
        this.Xc.i()
    };
    r.lj = function (a) {
        this.B.log(Pe, '"' + a.target.id + '" (' + a.target + ") dispatched: " + a.type, h);
        var b = a.ga.dataTransfer;
        (this.sc = !(!b || !(b.types && (Va(b.types, "Files") || Va(b.types, "public.file-url")) || b.files && 0 < b.files.length))) && a.preventDefault();
        this.B.log(Pe, "dndContainsFiles_: " + this.sc, h)
    };
    r.mj = function (a) {
        this.B.log(Qe, '"' + a.target.id + '" (' + a.target + ") dispatched: " + a.type, h);
        if (this.sc) a.preventDefault(), a.ga.dataTransfer.dropEffect = "none"
    };
    r.oj = function (a) {
        this.B.log(Qe, '"' + a.target.id + '" (' + a.target + ") dispatched: " + a.type, h);
        if (this.sc) a.preventDefault(), a.stopPropagation(), a = a.ga.dataTransfer, a.effectAllowed = "all", a.dropEffect = "copy"
    };
    r.pj = function (a) {
        this.B.log(Pe, '"' + a.target.id + '" (' + a.target + ") dispatched: " + a.type, h);
        if (this.sc) {
            a.preventDefault();
            a.stopPropagation();
            L(this.B, "Firing DROP event...");
            a = new Gc(a.ga);
            a.type = "drop";
            try {
                this.dispatchEvent(a)
            } finally {
                a.i()
            }
        }
    };

    function Kh(a) {
        this.ba = a || k;
        this.pd = this.kb = this.g = this.pc = k;
        this.Yf = m;
        this.ec = this.xe = this.bf = this.Td = k;
        this.q = new dd(this)
    }
    r = Kh.prototype;
    r.Rb = function (a) {
        this.pc && this.detach();
        a.F || rd("Container is not rendered.");
        this.pc = a;
        this.g = a.a();
        this.q.c(this.g, "mousedown", this.Hg)
    };
    r.detach = function () {
        this.q.ea(this.g, "mousedown", this.Hg);
        this.pc = k
    };
    r.Hg = function (a) {
        var b = this.g;
        if (a.target == b && Ic(a)) {
            this.Td = $f(b);
            var c = a.ga,
                c = Lh(this, new F(c.pageX, c.pageY));
            if (c.x < b.clientWidth && c.y < b.scrollHeight) this.q.c(document, "mousemove", this.Fg, i).c(document, "mouseup", this.Gg, m), this.bf = new Pb(b.clientWidth, b.scrollHeight), this.xe = c, Mh(this), a.preventDefault()
        }
    };

    function Mh(a) {
        var b = [];
        R(a.pc, function (a, d) {
            var f = a.a();
            b[d] = new Pf(f.offsetLeft, f.offsetTop, f.offsetWidth, f.offsetHeight)
        });
        a.ec = b
    }

    function Lh(a, b) {
        var c = a.g;
        if (!a.Td) a.Td = $f(c);
        var d = Sb(b, a.Td);
        d.x += c.scrollLeft;
        d.y += c.scrollTop;
        return d
    }

    function Nh(a, b) {
        if (!a.pd) {
            var c = a.pd = ac("div", "au-upldr-rectselection-bg");
            Qc(c, "click", function () {
                gc(c)
            });
            window.document.body.appendChild(c)
        }
        if (!a.kb) a.kb = ac("li", "au-upldr-rectselection");
        O(a.kb, m);
        a.Yf = m;
        Uf(a.kb, b.x, b.y);
        (a.ba || window.document.body).appendChild(a.kb)
    }
    r.Fg = function (a) {
        var b = this.kb;
        if (!b) Nh(this, this.xe), b = this.kb;
        var c = this.xe,
            d = a.ga,
            f = Lh(this, new F(d.pageX, d.pageY)),
            d = Math.min(c.x, f.x),
            g = Math.min(c.y, f.y),
            j = kd(Math.abs(f.x - c.x), 1, this.bf.width - d - 4),
            c = kd(Math.abs(f.y - c.y), 1, this.bf.height - g - 4);
        Uf(b, d, g);
        bg(b, j, c);
        var f = f.y,
            l = this.g;
        if (0 > f - l.scrollTop) l.scrollTop = f;
        else if (f - l.scrollTop > l.clientHeight) l.scrollTop = f - l.clientHeight;
        if (!this.Yf && (5 < j || 5 < c)) this.Yf = i, O(b, i);
        Oh(this, new Pf(d, g, j, c));
        a.preventDefault();
        a.stopPropagation()
    };

    function Oh(a, b) {
        R(a.pc, function (a, d) {
            var f = U(a, 8);
            f ^ (this.ec[d].left <= b.left + b.width && b.left <= this.ec[d].left + this.ec[d].width && this.ec[d].top <= b.top + b.height && b.top <= this.ec[d].top + this.ec[d].height) && this.pc.A(d).Nb(!f)
        }, a)
    }
    r.Gg = function () {
        this.q.ea(document, "mousemove", this.Fg, i).ea(document, "mouseup", this.Gg, m);
        if (this.kb) gc(this.kb), this.kb = k;
        if (this.pd) gc(this.pd), this.pd = k;
        this.xe = k
    };

    function Ph(a, b, c) {
        this.Da = c || (a ? Tb(Wb(a)) : Tb());
        Dh.call(this, this.Da.d("div", {
            style: "position:absolute;display:none;"
        }));
        this.Ze = new F(1, 1);
        this.Wb = new Ae;
        a && this.Rb(a);
        b != k && kc(this.a(), b)
    }
    w(Ph, Dh);
    var Qh = [];
    r = Ph.prototype;
    r.Ba = k;
    r.className = "goog-tooltip";
    r.Bh = 500;
    r.Xi = 0;
    r.o = n("Da");
    r.Rb = function (a) {
        a = Wb(a);
        this.Wb.add(a);
        Nc(a, "mouseover", this.zc, m, this);
        Nc(a, "mouseout", this.$d, m, this);
        Nc(a, "mousemove", this.Og, m, this);
        Nc(a, "focus", this.ac, m, this);
        Nc(a, "blur", this.$d, m, this)
    };
    r.detach = function (a) {
        if (a) a = Wb(a), Rh(this, a), this.Wb.remove(a);
        else {
            for (var b = this.Wb.Zb(), c = 0; a = b[c]; c++) Rh(this, a);
            this.Wb.clear()
        }
    };

    function Rh(a, b) {
        Rc(b, "mouseover", a.zc, m, a);
        Rc(b, "mouseout", a.$d, m, a);
        Rc(b, "mousemove", a.Og, m, a);
        Rc(b, "focus", a.ac, m, a);
        Rc(b, "blur", a.$d, m, a)
    }
    r.ag = function (a) {
        var b = this.a();
        b && gc(b);
        Ph.b.ag.call(this, a);
        if (a) b = this.Da.Q.body, b.insertBefore(a, b.lastChild)
    };
    r.gb = function () {
        return this.Ob ? this.V() ? 4 : 1 : this.hd ? 3 : this.V() ? 2 : 0
    };
    r.Pf = function () {
        if (!lh.prototype.Pf.call(this)) return m;
        if (this.anchor)
            for (var a, b = 0; a = Qh[b]; b++) jc(a.a(), this.anchor) || a.D(m);
        Va(Qh, this) || Qh.push(this);
        a = this.a();
        a.className = this.className;
        Sh(this);
        Nc(a, "mouseover", this.Qg, m, this);
        Nc(a, "mouseout", this.Pg, m, this);
        Th(this);
        return i
    };
    r.Qf = function () {
        Wa(Qh, this);
        for (var a = this.a(), b, c = 0; b = Qh[c]; c++) b.anchor && jc(a, b.anchor) && b.D(m);
        this.ph && Uh(this.ph);
        Rc(a, "mouseover", this.Qg, m, this);
        Rc(a, "mouseout", this.Pg, m, this);
        this.anchor = h;
        if (0 == this.gb()) this.te = m;
        lh.prototype.Qf.call(this)
    };
    r.fh = function (a, b) {
        if (this.anchor == a && this.Wb.contains(this.anchor))
            if (this.te || !this.em) {
                if (this.D(m), !this.V()) this.anchor = a, this.eg(b || Vh(this, 0)), this.D(i)
            } else this.anchor = h;
        this.Ob = h
    };
    r.gj = function (a) {
        this.hd = h;
        a == this.anchor && (this.Ba == k || this.Ba != this.a() && !this.Wb.contains(this.Ba)) && (!this.vg || !this.vg.Ba) && this.D(m)
    };

    function Wh(a, b) {
        var c = tc(a.Da);
        a.Ze.x = b.clientX + c.x;
        a.Ze.y = b.clientY + c.y
    }
    r.zc = function (a) {
        var b = Xh(this, a.target);
        this.Ba = b;
        Sh(this);
        if (b != this.anchor) {
            this.anchor = b;
            if (!this.Ob) this.Ob = df(v(this.fh, this, b, h), this.Bh);
            Yh(this);
            Wh(this, a)
        }
    };

    function Xh(a, b) {
        try {
            for (; b && !a.Wb.contains(b);) b = b.parentNode;
            return b
        } catch (c) {
            return k
        }
    }
    r.Og = function (a) {
        Wh(this, a);
        this.te = i
    };
    r.ac = function (a) {
        this.Ba = a = Xh(this, a.target);
        this.te = i;
        if (this.anchor != a) {
            this.anchor = a;
            var b = Vh(this, 1);
            Sh(this);
            if (!this.Ob) this.Ob = df(v(this.fh, this, a, b), this.Bh);
            Yh(this)
        }
    };

    function Vh(a, b) {
        if (0 == b) {
            var c = a.Ze.va();
            return new Zh(c)
        }
        return new $h(a.Ba)
    }

    function Yh(a) {
        if (a.anchor)
            for (var b, c = 0; b = Qh[c]; c++)
                if (jc(b.a(), a.anchor)) b.vg = a, a.ph = b
    }
    r.$d = function (a) {
        var b = Xh(this, a.target),
            c = Xh(this, a.relatedTarget);
        if (b != c) {
            if (b == this.Ba) this.Ba = k;
            Th(this);
            this.te = m;
            this.V() && (!a.relatedTarget || !jc(this.a(), a.relatedTarget)) ? Uh(this) : this.anchor = h
        }
    };
    r.Qg = function () {
        var a = this.a();
        if (this.Ba != a) Sh(this), this.Ba = a
    };
    r.Pg = function (a) {
        var b = this.a();
        if (this.Ba == b && (!a.relatedTarget || !jc(b, a.relatedTarget))) this.Ba = k, Uh(this)
    };

    function Th(a) {
        if (a.Ob) bf.clearTimeout(a.Ob), a.Ob = h
    }

    function Uh(a) {
        if (2 == a.gb()) a.hd = df(v(a.gj, a, a.anchor), a.Xi)
    }

    function Sh(a) {
        if (a.hd) bf.clearTimeout(a.hd), a.hd = h
    }
    r.h = function () {
        this.D(m);
        Th(this);
        this.detach();
        this.a() && gc(this.a());
        this.Ba = k;
        delete this.Da;
        Ph.b.h.call(this)
    };

    function Zh(a, b) {
        zh.call(this, a, b)
    }
    w(Zh, zh);
    Zh.prototype.La = function (a, b, c) {
        b = Wf(a);
        b = Zf(b);
        c = c ? new Of(c.top + 10, c.right, c.bottom, c.left + 10) : new Of(10, 0, 0, 10);
        rh(this.We, a, 4, c, b, 9) & 496 && rh(this.We, a, 4, c, b, 5)
    };

    function $h(a) {
        Ah.call(this, a, 3)
    }
    w($h, Ah);
    $h.prototype.La = function (a, b, c) {
        var d = new F(10, 0);
        qh(this.element, this.Tc, a, b, d, c, 9) & 496 && qh(this.element, 2, a, 1, d, c, 5)
    };

    function ai() {}
    w(ai, Fg);
    t(ai);
    r = ai.prototype;
    r.d = function (a) {
        var b = {
            "class": "goog-inline-block " + this.Ea(a).join(" "),
            title: a.hb() || ""
        }, b = a.o().d("div", b, this.Md(a.wa, a.o()));
        this.ue(a, b);
        return b
    };
    r.xa = p("button");
    r.ue = function (a, b) {
        a.isEnabled() || this.Ia(b, 1, i);
        U(a, 8) && this.Ia(b, 8, i);
        a.da & 16 && this.Ia(b, 16, i);
        U(a, 64) && this.Ia(b, 64, i)
    };
    r.H = function (a) {
        return a && a.firstChild.firstChild
    };
    r.Md = function (a, b) {
        return b.d("div", "goog-inline-block " + (this.f() + "-outer-box"), b.d("div", "goog-inline-block " + (this.f() + "-inner-box"), a))
    };
    r.R = function (a) {
        return "DIV" == a.tagName
    };
    r.J = function (a, b) {
        bi(b, i);
        bi(b, m);
        var c;
        a: {
            if ((c = a.o().Mg(b)) && -1 != c.className.indexOf(this.f() + "-outer-box"))
                if ((c = a.o().Mg(c)) && -1 != c.className.indexOf(this.f() + "-inner-box")) {
                    c = i;
                    break a
                }
            c = m
        }
        c || b.appendChild(this.Md(b.childNodes, a.o()));
        A(b, "goog-inline-block", this.f());
        return ai.b.J.call(this, a, b)
    };
    r.f = p("goog-custom-button");

    function bi(a, b) {
        if (a)
            for (var c = b ? a.firstChild : a.lastChild, d; c && c.parentNode == a;) {
                d = b ? c.nextSibling : c.previousSibling;
                if (3 == c.nodeType) {
                    var f = c.nodeValue;
                    if ("" == Ea(f)) a.removeChild(c);
                    else {
                        c.nodeValue = b ? f.replace(/^[\s\xa0]+/, "") : f.replace(/[\s\xa0]+$/, "");
                        break
                    }
                } else break;
                c = d
            }
    };

    function ci() {}
    w(ci, ai);
    t(ci);
    ci.prototype.f = p("goog-toolbar-button");

    function di(a, b, c) {
        W.call(this, a, b || ci.t(), c)
    }
    w(di, W);
    Ig("goog-toolbar-button", function () {
        return new di(k)
    });

    function ei() {}
    w(ei, Ag);
    t(ei);
    ei.prototype.d = function (a) {
        return a.o().d("div", this.f())
    };
    ei.prototype.J = function (a, b) {
        b.id && pg(a, b.id);
        if ("HR" == b.tagName) {
            var c = b,
                b = this.d(a);
            c.parentNode && c.parentNode.insertBefore(b, c);
            gc(c)
        } else A(b, this.f());
        return b
    };
    ei.prototype.na = ba();
    ei.prototype.f = p("goog-menuseparator");

    function fi() {}
    w(fi, ei);
    t(fi);
    fi.prototype.d = function (a) {
        return a.o().d("div", this.f() + " goog-inline-block", "\u00a0")
    };
    fi.prototype.J = function (a, b) {
        b = fi.b.J.call(this, a, b);
        A(b, "goog-inline-block");
        return b
    };
    fi.prototype.f = p("goog-toolbar-separator");

    function gi(a, b) {
        V.call(this, k, a || ei.t(), b);
        Vg(this, 1, m);
        Vg(this, 2, m);
        Vg(this, 4, m);
        Vg(this, 32, m);
        this.Pb = 1
    }
    w(gi, V);
    gi.prototype.s = function () {
        gi.b.s.call(this);
        yg(this.a(), "separator")
    };
    Ig("goog-menuseparator", function () {
        return new gi
    });

    function hi() {}
    t(hi);
    r = hi.prototype;
    r.xa = ba();

    function ii(a, b) {
        if (a) a.tabIndex = b ? 0 : -1
    }
    r.d = function (a) {
        return a.o().d("div", this.Ea(a).join(" "))
    };
    r.H = aa();
    r.R = function (a) {
        return "DIV" == a.tagName
    };
    r.J = function (a, b) {
        b.id && pg(a, b.id);
        var c = this.f(),
            d = m,
            f = db(b);
        f && y(f, function (b) {
            b == c ? d = i : b && (b == c + "-disabled" ? a.za(m) : b == c + "-horizontal" ? a.cg(ji) : b == c + "-vertical" && a.cg(ki))
        }, this);
        d || A(b, c);
        li(this, a, this.H(b));
        return b
    };

    function li(a, b, c) {
        if (c)
            for (var d = c.firstChild, f; d && d.parentNode == c;) {
                f = d.nextSibling;
                if (1 == d.nodeType) {
                    var g = a.dd(d);
                    if (g) g.g = d, b.isEnabled() || g.za(m), b.z(g), g.J(d)
                } else(!d.nodeValue || "" == Ea(d.nodeValue)) && c.removeChild(d);
                d = f
            }
    }
    r.dd = function (a) {
        a: {
            for (var b = db(a), c = 0, d = b.length; c < d; c++)
                if (a = b[c] in Jg ? Jg[b[c]]() : k) break a;
            a = k
        }
        return a
    };
    r.Cc = function (a) {
        a = a.a();
        gg(a, i, Bb);
        if (B) a.hideFocus = i;
        var b = this.xa();
        b && yg(a, b)
    };
    r.ha = function (a) {
        return a.a()
    };
    r.f = p("goog-container");
    r.Ea = function (a) {
        var b = this.f(),
            c = [b, a.ya == ji ? b + "-horizontal" : b + "-vertical"];
        a.isEnabled() || c.push(b + "-disabled");
        return c
    };
    r.Lg = function () {
        return ki
    };

    function mi(a, b, c) {
        P.call(this, c);
        this.w = b || hi.t();
        this.ya = a || this.w.Lg()
    }
    w(mi, P);
    var ji = "horizontal",
        ki = "vertical";
    r = mi.prototype;
    r.Ef = k;
    r.Ua = k;
    r.w = k;
    r.ya = k;
    r.la = i;
    r.Xb = i;
    r.hf = i;
    r.Ja = -1;
    r.ja = k;
    r.tb = m;
    r.bi = m;
    r.Aj = i;
    r.pb = k;
    r.ha = function () {
        return this.Ef || this.w.ha(this)
    };
    r.Xd = function () {
        return this.Ua || (this.Ua = new Mg(this.ha()))
    };
    r.d = function () {
        this.g = this.w.d(this)
    };
    r.H = function () {
        return this.w.H(this.a())
    };
    r.R = function (a) {
        return this.w.R(a)
    };
    r.Qa = function (a) {
        this.g = this.w.J(this, a);
        if ("none" == a.style.display) this.la = m
    };
    r.s = function () {
        mi.b.s.call(this);
        R(this, function (a) {
            a.F && ni(this, a)
        }, this);
        var a = this.a();
        this.w.Cc(this);
        this.D(this.la, i);
        Q(this).c(this, "enter", this.pf).c(this, "highlight", this.qf).c(this, "unhighlight", this.uf).c(this, "open", this.Ui).c(this, "close", this.Oi).c(a, "mousedown", this.bc).c(Vb(a), "mouseup", this.Qi).c(a, ["mousedown", "mouseup", "mouseover", "mouseout"], this.Ni);
        this.Eb() && oi(this, i)
    };

    function oi(a, b) {
        var c = Q(a),
            d = a.ha();
        b ? c.c(d, "focus", a.ac).c(d, "blur", a.$b).c(a.Xd(), "key", a.Sa) : c.ea(d, "focus", a.ac).ea(d, "blur", a.$b).ea(a.Xd(), "key", a.Sa)
    }
    r.ka = function () {
        pi(this, -1);
        this.ja && this.ja.ca(m);
        this.tb = m;
        mi.b.ka.call(this)
    };
    r.h = function () {
        mi.b.h.call(this);
        if (this.Ua) this.Ua.i(), this.Ua = k;
        this.w = this.ja = this.pb = this.Ef = k
    };
    r.pf = p(i);
    r.qf = function (a) {
        var b = vg(this, a.target);
        if (-1 < b && b != this.Ja) {
            var c = qi(this);
            c && c.Ma(m);
            this.Ja = b;
            c = qi(this);
            this.tb && c.setActive(i);
            this.Aj && this.ja && c != this.ja && (c.da & 64 ? c.ca(i) : this.ja.ca(m))
        }
        zg(this.a(), "activedescendant", a.target.a().id)
    };
    r.uf = function (a) {
        if (a.target == qi(this)) this.Ja = -1;
        zg(this.a(), "activedescendant", "")
    };
    r.Ui = function (a) {
        if ((a = a.target) && a != this.ja && a.getParent() == this) this.ja && this.ja.ca(m), this.ja = a
    };
    r.Oi = function (a) {
        if (a.target == this.ja) this.ja = k
    };
    r.bc = function (a) {
        if (this.Xb) this.tb = i;
        var b = this.ha();
        b && nc(b) ? b.focus() : a.preventDefault()
    };
    r.Qi = function () {
        this.tb = m
    };
    r.Ni = function (a) {
        var b;
        a: {
            b = a.target;
            if (this.pb)
                for (var c = this.a(); b && b !== c;) {
                    var d = b.id;
                    if (d in this.pb) {
                        b = this.pb[d];
                        break a
                    }
                    b = b.parentNode
                }
            b = k
        }
        if (b) switch (a.type) {
        case "mousedown":
            b.bc(a);
            break;
        case "mouseup":
            b.cc(a);
            break;
        case "mouseover":
            b.zc(a);
            break;
        case "mouseout":
            b.tf(a)
        }
    };
    r.ac = ba();
    r.$b = function () {
        pi(this, -1);
        this.tb = m;
        this.ja && this.ja.ca(m)
    };
    r.Sa = function (a) {
        return this.isEnabled() && this.V() && (0 != T(this) || this.Ef) && this.Za(a) ? (a.preventDefault(), a.stopPropagation(), i) : m
    };
    r.Za = function (a) {
        var b = qi(this);
        if (b && "function" == typeof b.Sa && b.Sa(a) || this.ja && this.ja != b && "function" == typeof this.ja.Sa && this.ja.Sa(a)) return i;
        if (a.shiftKey || a.ctrlKey || a.metaKey || a.altKey) return m;
        switch (a.keyCode) {
        case 27:
            if (this.Eb()) this.ha().blur();
            else return m;
            break;
        case 36:
            ri(this);
            break;
        case 35:
            si(this);
            break;
        case 38:
            if (this.ya == ki) ti(this);
            else return m;
            break;
        case 37:
            if (this.ya == ji) ug(this) ? ui(this) : ti(this);
            else return m;
            break;
        case 40:
            if (this.ya == ki) ui(this);
            else return m;
            break;
        case 39:
            if (this.ya ==
                ji) ug(this) ? ti(this) : ui(this);
            else return m;
            break;
        default:
            return m
        }
        return i
    };

    function ni(a, b) {
        var c = b.a(),
            c = c.id || (c.id = og(b));
        if (!a.pb) a.pb = {};
        a.pb[c] = b
    }
    r.z = function (a, b) {
        mi.b.z.call(this, a, b)
    };
    r.Oc = function (a, b, c) {
        Xg(a, 2, i);
        Xg(a, 64, i);
        (this.Eb() || !this.bi) && Vg(a, 32, m);
        Sg(a, m);
        mi.b.Oc.call(this, a, b, c);
        a.F && this.F && ni(this, a);
        b <= this.Ja && this.Ja++
    };
    r.removeChild = function (a, b) {
        if (a = u(a) ? rg(this, a) : a) {
            var c = vg(this, a); - 1 != c && (c == this.Ja ? a.Ma(m) : c < this.Ja && this.Ja--);
            var d = a.a();
            if (d && d.id && this.pb) c = this.pb, d = d.id, d in c && delete c[d]
        }
        a = mi.b.removeChild.call(this, a, b);
        Sg(a, i);
        return a
    };
    r.cg = function (a) {
        this.a() && e(Error("Component already rendered"));
        this.ya = a
    };
    r.V = n("la");
    r.D = function (a, b) {
        if (b || this.la != a && this.dispatchEvent(a ? "show" : "hide")) {
            this.la = a;
            var c = this.a();
            c && (O(c, a), this.Eb() && ii(this.ha(), this.Xb && this.la), b || this.dispatchEvent(this.la ? "aftershow" : "afterhide"));
            return i
        }
        return m
    };
    r.isEnabled = n("Xb");
    r.za = function (a) {
        if (this.Xb != a && this.dispatchEvent(a ? "enable" : "disable")) a ? (this.Xb = i, R(this, function (a) {
            a.Wh ? delete a.Wh : a.za(i)
        })) : (R(this, function (a) {
            a.isEnabled() ? a.za(m) : a.Wh = i
        }), this.tb = this.Xb = m), this.Eb() && ii(this.ha(), a && this.la)
    };
    r.Eb = n("hf");
    r.wb = function (a) {
        a != this.hf && this.F && oi(this, a);
        this.hf = a;
        this.Xb && this.la && ii(this.ha(), a)
    };

    function pi(a, b) {
        var c = a.A(b);
        c ? c.Ma(i) : -1 < a.Ja && qi(a).Ma(m)
    }
    r.Ma = function (a) {
        pi(this, vg(this, a))
    };

    function qi(a) {
        return a.A(a.Ja)
    }

    function ri(a) {
        vi(a, function (a, c) {
            return (a + 1) % c
        }, T(a) - 1)
    }

    function si(a) {
        vi(a, function (a, c) {
            a--;
            return 0 > a ? c - 1 : a
        }, 0)
    }

    function ui(a) {
        vi(a, function (a, c) {
            return (a + 1) % c
        }, a.Ja)
    }

    function ti(a) {
        vi(a, function (a, c) {
            a--;
            return 0 > a ? c - 1 : a
        }, a.Ja)
    }

    function vi(a, b, c) {
        for (var c = 0 > c ? vg(a, a.ja) : c, d = T(a), c = b.call(a, c, d), f = 0; f <= d;) {
            var g = a.A(c);
            if (g && a.sg(g)) {
                pi(a, c);
                break
            }
            f++;
            c = b.call(a, c, d)
        }
    }
    r.sg = function (a) {
        return a.V() && a.isEnabled() && !! (a.da & 2)
    };

    function wi() {}
    w(wi, hi);
    t(wi);
    wi.prototype.xa = p("toolbar");
    wi.prototype.dd = function (a) {
        return "HR" == a.tagName ? new gi(fi.t()) : wi.b.dd.call(this, a)
    };
    wi.prototype.f = p("goog-toolbar");
    wi.prototype.Lg = function () {
        return ji
    };

    function xi(a, b, c) {
        mi.call(this, b, a || wi.t(), c)
    }
    w(xi, mi);

    function yi() {}
    w(yi, Ag);
    r = yi.prototype;
    r.f = p("au-upldr-list-item");
    r.d = function (a) {
        var b = a.o().d("li", "au-upldr-list-item " + this.Ea(a).join(" ")),
            c = this.mf(a);
        if (0 < c) b.style.width = c + "px";
        a.g = b;
        this.Ag(a);
        return b
    };
    r.mf = p(0);
    r.Ag = function (a) {
        var b = a.o(),
            c = a.H();
        b.appendChild(c, this.Bb(a));
        var d = this.Cb(a);
        a.nb = d;
        a.z(d, i);
        A(d.a(), "iconsBar");
        b.appendChild(c, this.qc(a));
        a = zi(a);
        b.appendChild(c, a)
    };

    function zi(a) {
        var b = a.j.I(Nd),
            c = a.o().d("div", {
                "class": "au-upldr-description-icon",
                id: tg(a, Ai)
            });
        O(c, !! b);
        var d = a.Qd;
        d && d.i();
        d = new Ph(c);
        if (b != k) b = Fa(b), d.a().innerHTML = b;
        a.Qd = d;
        return c
    }
    r.Bb = function (a) {
        var b = "au-upldr-preview",
            c = a.j;
        Gd(c) && (b += " au-upldr-file-image");
        var d = qd(c.getName() || "");
        d && (b += " au-upldr-file-" + d);
        var f = a.o().d("div", {
            "class": b,
            id: tg(a, Bi)
        });
        if (a = c.I(Md)) {
            var g = "rotate(" + a + "deg)";
            y(["-webkit-transform", "-moz-transform", "transform"], function (a) {
                u(a) ? Qf(f, g, a) : jb(a, sa(Qf, f))
            })
        }
        return f
    };
    r.Cb = function () {
        var a = new xi;
        a.wb(m);
        pg(a, ya(xa.t()));
        return a
    };
    r.qc = function (a) {
        return a.o().d("div", "au-upldr-item-content")
    };
    r.xa = p("listitem");

    function Ci() {}
    w(Ci, $g);
    t(Ci);
    Ci.prototype.f = p("au-upldr-css3-toolbar-button");

    function Di() {}
    w(Di, yi);
    t(Di);
    r = Di.prototype;
    r.f = p("au-upldr-tile-list-item");
    r.mf = function (a) {
        return I(a.pa.r, "TileItemWidth")
    };
    r.Bb = function (a) {
        var b = Di.b.Bb.call(this, a),
            c = I(a.pa.r, "TilePreviewSize");
        if (0 < c) b.style.width = b.style.height = c + "px";
        (a = a.j.Ee) && b.appendChild(a);
        return b
    };
    r.Cb = function (a) {
        var b = Di.b.Cb.call(this, a),
            a = a.pa.r,
            c, d, f = Ci.t();
        I(a, "EnableDescriptionEditor") && (c = new di(ac("div", "au-upldr-button au-upldr-button-edit-description"), f), c.C(1), d = I(a, "DescriptionEditorIconTooltip"), c.lb(d), pg(c, tg(b, (1).toString(36))), b.z(c, i));
        I(a, "EnableRotation") && (c = new di(ac("div", "au-upldr-button au-upldr-button-rotate"), f), c.C(2), d = I(a, "RotationIconTooltip"), c.lb(d), pg(c, tg(b, (2).toString(36))), b.z(c, i));
        c = new di(ac("div", "au-upldr-button au-upldr-button-remove"), f);
        c.C(3);
        d = I(a, "RemovalIconTooltip");
        c.lb(d);
        pg(c, tg(b, (3).toString(36)));
        b.z(c, i);
        return b
    };
    r.qc = function (a) {
        var b = a.o(),
            c = a.j,
            d = Di.b.qc.call(this, a),
            f = b.d("div", "au-upldr-filename", c.getName());
        A(f, "tilesViewFileNameText");
        b.appendChild(d, f);
        f = b.d("div", "au-upldr-filesize", Cd(c.Yb.size, 0));
        A(f, "tilesViewParamText");
        b.appendChild(d, f);
        Gd(c) && (b = new wg(""), pg(b, tg(a, "dimension")), a.z(b), b.X(f));
        return d
    };

    function Ei(a, b, c) {
        V.call(this, k, c);
        Vg(this, 8, i);
        this.Pc &= -9;
        this.j = a;
        this.pa = b;
        this.zb = new Ph;
        this.Je();
        this.nb = k;
        Q(this).c(a, yd, this.sj)
    }
    w(Ei, V);
    var Bi = "preview",
        Ai = "descriptionicon";
    r = Ei.prototype;
    r.sj = function (a) {
        a = a.rh;
        if (a == Kd || a == Ld) Fi(this), this.Je();
        else if (a == Md) Gi(this);
        else if (a == Nd) {
            var a = this.j.I(Nd) + "",
                b = Wb(tg(this, Ai));
            this.Qd.a().innerHTML = Fa(a);
            O(b, !! a)
        }
    };
    r.Je = function () {
        var a = this.j,
            b = Gd(a),
            c = b ? a.I(Kd) : 0,
            b = b ? a.I(Ld) : 0,
            d;
        d = I(this.pa.r, 0 < c && 0 < b ? "ImageTooltip" : "ItemTooltip");
        var f = d.replace(/[,\u3001]\s*\n.*[:\uff1a]\s*\{2\}$/g, "");
        f != d && (d = f.replace(/\{3\}/g, "{2}"));
        d = J(d, a.getName(), Cd(a.Yb.size, 0), c + "x" + b);
        d = Fa(d);
        this.zb.a().innerHTML = d
    };

    function Fi(a) {
        var b = rg(a, tg(a, "dimension"));
        if (b) {
            var c = a.j,
                a = c.I(Kd),
                c = c.I(Ld);
            0 < a && 0 < c && xg(b, ", " + a + "x" + c)
        }
    }

    function Gi(a) {
        var b = "rotate(" + a.j.I(Md) + "deg)",
            c = Wb(tg(a, Bi));
        y(["-webkit-transform", "-moz-transform", "transform"], function (a) {
            u(a) ? Qf(c, b, a) : jb(a, sa(Qf, c))
        })
    }
    r.wj = function (a) {
        if (a.target instanceof di) switch (a.target.$()) {
        case 1:
            this.pa.oa.Dg.show(this.j, this.nb.a());
            break;
        case 3:
            var b = this.pa;
            b.ma();
            if (U(this, 8)) {
                var c = [];
                R(this.getParent(), function (a, b) {
                    U(a, 8) && c.unshift(b)
                });
                y(c, function (a) {
                    b.re(a)
                })
            } else b.re(vg(this.getParent(), this));
            break;
        case 2:
            U(this, 8) ? R(this.getParent(), function (a) {
                U(a, 8) && Hi(a)
            }) : Hi(this)
        }
        a.stopPropagation()
    };
    r.xj = function (a) {
        if (U(this, 8)) {
            var b = I(this.pa.r, "PaneItemToolbarAlwaysVisible"),
                c = this,
                d = c.getParent();
            if ("highlight" == a.type) {
                var a = this.nb,
                    f = a.Ja,
                    g = rg(a, tg(a, (1).toString(36))); - 1 != f && a.A(f) !== g && R(d, function (a) {
                        if (c != a) {
                            var d = U(a, 8);
                            d && R(a.nb, function (a, c) {
                                Xg(a, 2, m);
                                c == f ? (a.Ma(i), a.D(i)) : b || a.D(m);
                                Xg(a, 2, i)
                            });
                            Ii(a, d)
                        }
                    })
            } else R(d, function (a) {
                c != a && (R(a.nb, function (a) {
                    Xg(a, 2, m);
                    a.Ma(m);
                    Xg(a, 2, i);
                    a.D(i)
                }), Ii(a, m))
            })
        }
    };

    function Ii(a, b) {
        I(a.pa.r, "PaneItemToolbarAlwaysVisible") && (b = i);
        a.nb.a().style.visibility = b ? "visible" : "hidden"
    }

    function Hi(a) {
        a = a.j;
        Od(a, (a.I(Md) || 0) + 90)
    }
    r.s = function () {
        Ei.b.s.call(this);
        var a = this.a();
        this.zb.Rb(a);
        Q(this).c(this.nb, ["highlight", "unhighlight"], this.xj).c(this, ["highlight", "unhighlight"], function (a) {
            a.target == this && Ii(this, "highlight" == a.type)
        }).c(this.nb, "action", this.wj).c(this.nb.a(), ["mouseup", "dblclick"], function (a) {
            a.stopPropagation()
        }).c(a, "dblclick", this.$j);
        Ii(this, m);
        Fi(this)
    };
    r.$j = function () {
        this.pa.oa.yf.show(this.j)
    };
    r.ka = function () {
        Ei.b.ka.call(this);
        this.zb.detach(this.a())
    };
    r.h = function () {
        this.zb.i();
        delete this.zb;
        this.Qd.i();
        delete this.Qd;
        Ei.b.h.call(this)
    };
    r.R = gd;
    Gg(Ei, Di);

    function Ji() {}
    w(Ji, yi);
    t(Ji);
    Ji.prototype.f = p("au-upldr-thumbnail-list-item");
    Ji.prototype.Cb = function (a) {
        var b = Ji.b.Cb.call(this, a),
            a = a.pa.r,
            c, d, f = Ci.t();
        I(a, "EnableDescriptionEditor") && (c = new di(ac("div", "au-upldr-button au-upldr-button-edit-description"), f), c.C(1), d = I(a, "DescriptionEditorIconTooltip"), c.lb(d), pg(c, tg(b, (1).toString(36))), b.z(c, i));
        I(a, "EnableRotation") && (c = new di(ac("div", "au-upldr-button au-upldr-button-rotate"), f), c.C(2), d = I(a, "RotationIconTooltip"), c.lb(d), pg(c, tg(b, (2).toString(36))), b.z(c, i));
        c = new di(ac("div", "au-upldr-button au-upldr-button-remove"),
            f);
        c.C(3);
        d = I(a, "RemovalIconTooltip");
        c.lb(d);
        pg(c, tg(b, (3).toString(36)));
        b.z(c, i);
        return b
    };
    Ji.prototype.Bb = function (a) {
        var b = Ji.b.Bb.call(this, a),
            c = I(a.pa.r, "ThumbnailPreviewSize");
        if (0 < c) b.style.width = b.style.height = c + "px";
        (a = a.j.Ce) && b.appendChild(a);
        return b
    };
    Ji.prototype.Ag = function (a) {
        var b = a.o(),
            c = a.H();
        b.appendChild(c, this.Bb(a));
        var d = b.d("div", "au-upldr-toolbar-outer");
        b.appendChild(c, d);
        var f = this.Cb(a);
        a.nb = f;
        a.z(f, m);
        f.X(d);
        A(f.a(), "iconsBar");
        b.appendChild(c, this.qc(a));
        a = zi(a);
        b.appendChild(c, a)
    };

    function Ki() {}
    w(Ki, yi);
    t(Ki);
    r = Ki.prototype;
    r.f = p("au-upldr-icon-list-item");
    r.mf = function (a) {
        return I(a.pa.r, "IconItemWidth")
    };
    r.Cb = function (a) {
        var b = Ki.b.Cb.call(this, a),
            c = Ci.t(),
            c = new di(ac("div", "au-upldr-button au-upldr-button-remove"), c);
        c.C(3);
        c.lb(I(a.pa.r, "RemovalIconTooltip"));
        pg(c, tg(b, (3).toString(36)));
        b.z(c, i);
        return b
    };
    r.Bb = function (a) {
        var b = Ki.b.Bb.call(this, a),
            a = I(a.pa.r, "IconSize");
        if (0 < a) b.style.width = b.style.height = a + "px";
        return b
    };
    r.qc = function (a) {
        var b = Ki.b.qc.call(this, a);
        a.o().Wj(b, a.j.getName());
        A(b, "iconsViewFileNameText");
        return b
    };

    function Li() {}
    w(Li, $g);
    Li.prototype.d = function (a) {
        var b = {
            "class": "goog-inline-block au-upldr-file-button " + this.Ea(a).join(" "),
            title: a.hb() || ""
        }, c = a.o(),
            d = c.d("input", {
                type: "file",
                multiple: "multiple"
            });
        return c.d("div", b, d, c.d("div", k, a.wa))
    };
    Li.prototype.H = function (a) {
        return a.lastElementChild != h ? a.lastElementChild : ic(a.lastChild, m)
    };
    t(Li);

    function Mi(a, b, c) {
        W.call(this, a, b || Li.t(), c)
    }
    w(Mi, W);
    Mi.prototype.s = function () {
        Mi.b.s.call(this);
        (this.Ra = hc(this.a())) && Q(this).c(this.Ra, "change", this.Wd, m)
    };
    Mi.prototype.ka = function () {
        Mi.b.ka.call(this);
        this.Ra && Q(this).ea(this.Ra, "change", this.Wd, m);
        this.Ra = k
    };
    Mi.prototype.Wd = function (a) {
        var a = a.target,
            b = new Ih(a.files);
        try {
            this.dispatchEvent(b)
        } finally {
            a.value = "", b.i()
        }
    };

    function Ni(a, b, c) {
        V.call(this, k);
        this.gi = c;
        this.pa = b;
        this.j = a;
        Vg(this, 32, m)
    }
    w(Ni, V);
    r = Ni.prototype;
    r.f = function () {
        return "au-upldr-button-list-item " + this.gi
    };
    r.d = function () {
        var a = this.o().d("li", this.f());
        yg(a, "listitem");
        this.g = a;
        var b = this.j,
            a = I(b, "AddFilesButtonText"),
            c = Bb ? new Mi(a) : new W(a, $g.t());
        Vg(c, 32, m);
        this.z(c, i);
        c.za(I(b, "EnableAddingFiles"));
        X(b, "AddFilesButtonText", function () {
            c.na(I(b, "AddFilesButtonText"))
        });
        X(b, "EnableAddingFiles", function () {
            c.za(I(b, "EnableAddingFiles"))
        });
        A(c.a(), "addFilesButton")
    };
    r.s = function () {
        Ni.b.s.call(this);
        var a = this.A(0);
        Bb ? Q(this).c(a, xd, this.qi) : Q(this).c(a, "action", this.fi)
    };
    r.fi = function () {
        this.pa.Qe()
    };
    r.qi = function (a) {
        this.pa.Gd(a);
        a.stopPropagation()
    };

    function Oi() {}
    w(Oi, hi);
    t(Oi);
    Oi.prototype.f = p("au-upldr-list");
    Oi.prototype.d = function (a) {
        function b() {
            var b = Pi(a);
            f.forEach(function (c) {
                c = new Ei(c, d, b);
                a.z(c, i)
            });
            var c = "";
            b instanceof Di ? c = "au-upldr-tile-list-item" : b instanceof Ji ? c = "au-upldr-thumbnail-list-item" : b instanceof Ki && (c = "au-upldr-icon-list-item");
            c = new Ni(g, a.j, c);
            a.Pe = c;
            c.X(a.H())
        }
        var c = a.o().d("ul", this.Ea(a).join(" "));
        a.g = c;
        A(c, "tileList");
        var d = a.j,
            f = d.ma(),
            g = d.r;
        X(g, "ViewMode", function () {
            for (; a.Y && 0 != a.Y.length;) {
                var c = a.removeChild(a.A(0), i);
                c && c.i()
            }
            a.Pe.i();
            a.Pe = k;
            b()
        });
        b();
        return c
    };
    Oi.prototype.xa = p("list");

    function Qi(a) {
        mi.call(this, ji, Oi.t());
        this.j = a;
        this.Ca = -1;
        this.mb = 0
    }
    w(Qi, mi);
    r = Qi.prototype;
    r.s = function () {
        Qi.b.s.call(this);
        var a = this.j.ma(),
            b = this.a();
        Q(this).c(a, ad, this.Bf).c(this, "action", this.rj).c(b, "click", this.oi)
    };
    r.oi = function (a) {
        a.target == this.a() && Ri(this)
    };
    r.rj = function (a) {
        var b = a.target;
        if (b instanceof Ei) {
            var c = vg(this, b);
            a.ctrlKey ? Si(this, c, 1, i) : a.shiftKey ? (b = this.mb, c -= b, Si(this, b, c + (0 < c ? 1 : -1), m)) : Si(this, c, 1, m);
            a.stopPropagation()
        }
    };
    r.Bf = function (a) {
        var b = a.Ff;
        if ("add" == b) {
            var c = Pi(this),
                d = this.j;
            y(a.ma(), function (a) {
                this.z(new Ei(a, d, c), i)
            }, this)
        } else if ("remove" == b) {
            var f = a.ma();
            R(this, function (a) {
                Va(f, a.j) && (this.removeChild(a, i), a.i())
            }, this)
        } else if ("reset" == b)
            for (; this.Y && 0 != this.Y.length;)(a = this.removeChild(this.A(0), i)) && a.i();
        Ri(this)
    };
    r.A = function (a) {
        return a === T(this) ? this.Pe : Qi.b.A.call(this, a)
    };

    function Pi(a) {
        a = I(a.j.r, "ViewMode");
        if ("tiles" != a) {
            if ("thumbnails" == a) return Ji.t();
            if ("icons" == a) return Ki.t()
        }
        return Di.t()
    }
    r.Za = function (a) {
        var b = qi(this);
        if (b && "function" == typeof b.Sa && b.Sa(a)) return i;
        if (a.ctrlKey || a.metaKey || a.altKey) return m;
        b = a.shiftKey;
        switch (a.keyCode) {
        case 27:
            Ri(this);
            break;
        case 36:
            b && 0 < this.mb ? (b = this.mb, a = -1 - b) : (b = 0, a = 1);
            Si(this, b, a, m);
            break;
        case 35:
            a = T(this);
            b ? (b = this.mb, a -= b) : (b = a - 1, a = 1);
            Si(this, b, a, m);
            break;
        case 38:
            a = Ti(this);
            if (0 < a) {
                var c;
                b ? (b = this.mb, c = kd(this.Ca - a, 0, T(this) - 1), a = c - b, a += 0 < a ? 1 : -1) : (c = b = kd(this.Ca - a, 0, T(this) - 1), a = 1);
                this.A(this.Ca).a().offsetTop !== this.A(c).a().offsetTop &&
                    Si(this, b, a, m)
            }
            break;
        case 40:
            a = Ti(this);
            if (0 < a) b ? (b = this.mb, c = kd(this.Ca + a, 0, T(this) - 1), a = c - b, a += 0 < a ? 1 : -1) : (c = b = kd(this.Ca + a, 0, T(this) - 1), a = 1), this.A(this.Ca).a().offsetTop !== this.A(c).a().offsetTop && Si(this, b, a, m);
            break;
        case 37:
            ug(this) ? Ui(this, b) : Vi(this, b);
            break;
        case 39:
            ug(this) ? Vi(this, b) : Ui(this, b);
            break;
        case 46:
            Wi(this);
            Si(this, this.Ca, 1, m);
            break;
        default:
            return m
        }
        return i
    };

    function Wi(a) {
        var b = a.j;
        b.ma();
        var c = [];
        R(a, function (a, b) {
            U(a, 8) && c.unshift(b)
        });
        y(c, function (a) {
            b.re(a)
        })
    }
    r.kf = function () {
        var a = this.A(0);
        if (a) {
            var a = a.a(),
                b = ig(a, "margin"),
                c = this.a();
            return Math.min(T(this) - 2, Math.floor(c.scrollTop / (a.offsetHeight + b.top + b.bottom)) * Math.floor(c.clientWidth / (a.offsetWidth + b.right + b.left)))
        }
        return 0
    };

    function Ri(a) {
        R(a, function (a) {
            a.Nb(m)
        });
        a.Ca = -1;
        a.mb = 0
    }

    function Ti(a) {
        if (0 < T(a)) {
            var b = a.A(0).a(),
                a = a.a().clientWidth,
                c = b.offsetWidth,
                b = ig(b, "margin"),
                c = c + (b.left + b.right);
            return Math.floor(a / c)
        }
        return 0
    }

    function Ui(a, b) {
        var c, d;
        b ? (c = a.mb, d = kd(a.Ca + 1, 0, T(a) - 1) - c, d += 0 < d ? 1 : -1) : (c = a.Ca + 1, d = 1);
        Si(a, c, d, m)
    }

    function Vi(a, b) {
        var c, d;
        b ? (c = a.mb, d = kd(a.Ca - 1, 0, T(a) - 1) - c, d += 0 < d ? 1 : -1) : (c = 0 <= a.Ca ? a.Ca - 1 : T(a) - 1, d = 1);
        Si(a, c, d, m)
    }

    function Si(a, b, c, d) {
        var f = T(a);
        if (0 < f) {
            b = kd(b, 0, f - 1);
            d || R(a, function (a) {
                a.Nb(m)
            });
            var d = kd(b + c, -1, f),
                g;
            if (0 <= c)
                for (c = b; c < d; c++) a.A(c).Nb(i), g = c;
            else
                for (c = b; c > d; c--) a.A(c).Nb(i), g = c;
            a.mb = b;
            if (fa(g)) a.Ca = g, Xi(a, g)
        }
    }

    function Xi(a, b) {
        var c = a.A(b).a();
        if (c) {
            var d = a.a(),
                f = $f(c),
                g = $f(d),
                j = lg(d),
                l = f.x - g.x - j.left,
                f = f.y - g.y - j.top,
                g = d.clientHeight - c.offsetHeight;
            d.scrollLeft += Math.min(l, Math.max(l - (d.clientWidth - c.offsetWidth), 0));
            d.scrollTop += Math.min(f, Math.max(f - g, 0))
        }
    }
    r.R = gd;
    r.e = M("au.upldr.ui.List");
    Gg(Qi, Oi);

    function Yi(a, b) {
        P.call(this, b);
        this.Zf = this.Vd = k;
        this.j = a
    }
    w(Yi, P);
    r = Yi.prototype;
    r.f = p("au-upldr-upload-pane");
    r.s = function () {
        Yi.b.s.call(this);
        var a = this.a();
        this.Vd = new Jh(a, m);
        var b = Q(this);
        b.c(this.Vd, "drop", this.ri);
        b.c(a, "dragover", function () {
            Zi(this, i)
        });
        b.c(a, "dragleave", function () {
            Zi(this, m)
        });
        this.Zf.Rb(this.A(0));
        X(this.j.r, "UploaderState", this.mk, this)
    };
    r.ka = function () {
        Yi.b.ka.call(this);
        this.Vd.i();
        delete this.Vd;
        this.Zf.detach()
    };
    r.d = function () {
        var d;
        var a = this.o(),
            b = a.createElement("div"),
            c = a.createElement("div");
        this.g = c;
        c.appendChild(b);
        b = this.j;
        A(c, this.f());
        A(c, "uploadPaneBar");
        b = new Qi(b);
        this.z(b, i);
        d = this.Qc = a.d("div", this.f() + "-bg"), a = d;
        O(a, m);
        c.firstChild.appendChild(a);
        this.Zf = new Kh(b.a())
    };
    r.H = function () {
        return hc(this.a())
    };
    r.ri = function (a) {
        Zi(this, m);
        this.dispatchEvent(new Ih(a.ga.dataTransfer.files))
    };

    function Zi(a, b) {
        var c = a.f() + "-dragover";
        b ? A(a.a(), c) : fb(a.a(), c)
    }
    r.mk = function () {
        O(this.Qc, 2 == this.j.gb())
    };
    r.R = gd;

    function $i(a, b) {
        P.call(this, b);
        this.Ga = k;
        this.j = a
    }
    w($i, P);
    r = $i.prototype;
    r.f = p("au-upldr-image-preview");
    r.d = function () {
        var a = this.j,
            b = this.o();
        this.qa = b.createElement("img");
        this.Rc = new wg;
        var c = b.d("div", this.f(), b.d("div", k, this.qa, b = b.createElement("div")));
        c.title = I(a, "ClosePreviewTooltip");
        X(a, "ClosePreviewTooltip", this.Je, this);
        this.Rc.X(b);
        A(this.Rc.a(), "previewFileNameLabelText");
        this.g = c;
        O(c, m);
        a = this.Ha = new Dh(c);
        a.D(m);
        oh(a, i)
    };
    r.Je = function () {
        this.a().title = I(this.j, "ClosePreviewTooltip")
    };
    r.s = function () {
        $i.b.s.call(this);
        Q(this).c(this.Ha, "hide", this.sd).c(this.Ha, "show", this.td).c(this.qa, ["load", "error"], this.be).c(this.a(), "click", this.Ta)
    };
    r.show = function (a) {
        if (Gd(a)) {
            this.Ga = a;
            var b = a.getName();
            this.qa.alt = b;
            xg(this.Rc, b);
            var b = this.qa,
                c;
            c = a.getFile();
            c = hd().createObjectURL(c);
            b.src = c;
            b = a.I(Md);
            c = a.I(Kd);
            var d = a.I(Ld),
                f = cg(this.a().parentNode),
                g = f.width,
                j = f.height,
                a = this.a().style,
                l = !! (b % 180);
            f.width -= 20;
            f.height -= 60;
            f.width < c || f.height < d ? (f = ud(c, d, f.width, f.height, b), l && (f = {
                width: f.height,
                height: f.width
            })) : f = {
                width: c,
                height: d
            };
            a.top = Math.floor((j - f.height - 60) / 2) + "px";
            c = Math.max(f.width, cg(this.a()).width);
            a.left = Math.floor((g - c - 20) /
                2) + "px";
            a = this.qa.style;
            a.maxWidth = f.width + "px";
            a.maxHeight = f.height + "px";
            c = l ? Math.floor((f.width - f.height) / 2) + "px" : 0;
            b = "rotate(" + b + "deg)";
            f = ["Webkit", "Moz", "O", "ms"];
            if ("transform" in a) a.transform = b;
            for (g = 0; f[g];) l = f[g] + "Transform", l in a && (a[l] = b), ++g;
            this.Rc.a().parentNode.style.marginTop = c;
            this.Ha.D(i)
        }
    };
    r.Ta = function () {
        this.Ha.D(m)
    };
    r.be = function () {
        var a = this.qa.src;
        hd().revokeObjectURL(a)
    };
    r.sd = function () {
        this.Ga = k;
        var a = this.qa.src;
        hd().revokeObjectURL(a);
        this.qa.src = "";
        xg(this.Rc, "");
        this.dispatchEvent(aj)
    };
    r.td = function () {
        this.dispatchEvent(bj)
    };
    r.R = gd;
    r.e = M("au.upldr.ui.ImagePreview");
    var bj = "show",
        aj = "hide";

    function cj() {}
    w(cj, Fg);
    t(cj);
    r = cj.prototype;
    r.d = function (a) {
        var b = {
            "class": "goog-inline-block " + this.Ea(a).join(" "),
            title: a.hb() || ""
        };
        return a.o().d("div", b, a.wa)
    };
    r.xa = p("button");
    r.R = function (a) {
        return "DIV" == a.tagName
    };
    r.J = function (a, b) {
        A(b, "goog-inline-block");
        return cj.b.J.call(this, a, b)
    };
    r.$ = p(k);
    r.f = p("goog-flat-button");
    Ig("goog-flat-button", function () {
        return new W(k, cj.t())
    });

    function dj() {}
    w(dj, cj);
    t(dj);
    dj.prototype.f = p("goog-link-button");
    Ig("goog-link-button", function () {
        return new W(k, dj.t())
    });

    function ej() {}
    w(ej, dj);
    ej.prototype.d = function (a) {
        var b = {
            "class": "goog-inline-block au-upldr-file-link-button " + this.Ea(a).join(" "),
            title: a.hb() || ""
        }, c = a.o(),
            d = c.d("input", {
                type: "file",
                multiple: "multiple"
            });
        return c.d("div", b, d, c.d("div", k, a.wa))
    };
    ej.prototype.H = function (a) {
        return a.lastElementChild != h ? a.lastElementChild : ic(a.lastChild, m)
    };
    t(ej);

    function fj(a, b, c, d) {
        Bh.call(this, a, b, c || d);
        if (c || d) this.$g = 65 | (d ? 32 : 132)
    }
    w(fj, Bh);
    var gj, hj;
    hj = gj = m;
    var ij = wb();
    ij && (-1 != ij.indexOf("Firefox") || -1 != ij.indexOf("Camino") || (-1 != ij.indexOf("iPhone") || -1 != ij.indexOf("iPod") ? gj = i : -1 != ij.indexOf("iPad") && (hj = i)));
    var jj = gj,
        kj = hj;

    function lj() {}
    w(lj, hi);
    t(lj);
    r = lj.prototype;
    r.xa = p("menu");
    r.R = function (a) {
        return "UL" == a.tagName || lj.b.R.call(this, a)
    };
    r.dd = function (a) {
        return "HR" == a.tagName ? new gi : lj.b.dd.call(this, a)
    };
    r.Tb = function (a, b) {
        return jc(a.a(), b)
    };
    r.f = p("goog-menu");
    r.Cc = function (a) {
        lj.b.Cc.call(this, a);
        zg(a.a(), "haspopup", "true")
    };
    Ig("goog-menuseparator", function () {
        return new gi
    });

    function mj() {
        this.wg = []
    }
    w(mj, Ag);
    t(mj);

    function nj(a, b) {
        var c = a.wg[b];
        if (!c) {
            switch (b) {
            case 0:
                c = a.f() + "-highlight";
                break;
            case 1:
                c = a.f() + "-checkbox";
                break;
            case 2:
                c = a.f() + "-content"
            }
            a.wg[b] = c
        }
        return c
    }
    r = mj.prototype;
    r.xa = p("menuitem");
    r.d = function (a) {
        var b = a.o().d("div", this.Ea(a).join(" "), oj(this, a.wa, a.o()));
        pj(this, a, b, !! (a.da & 8) || !! (a.da & 16));
        return b
    };
    r.H = function (a) {
        return a && a.firstChild
    };
    r.J = function (a, b) {
        var c = hc(b),
            d = nj(this, 2);
        c && -1 != c.className.indexOf(d) || b.appendChild(oj(this, b.childNodes, a.o()));
        Va(db(b), "goog-option") && (a.ve(i), this.ve(a, b, i));
        return mj.b.J.call(this, a, b)
    };
    r.na = function (a, b) {
        var c = this.H(a),
            d = qj(this, a) ? c.firstChild : k;
        mj.b.na.call(this, a, b);
        d && !qj(this, a) && c.insertBefore(d, c.firstChild || k)
    };

    function oj(a, b, c) {
        a = nj(a, 2);
        return c.d("div", a, b)
    }
    r.fg = function (a, b, c) {
        b && (yg(b, c ? "menuitemradio" : this.xa()), pj(this, a, b, c))
    };
    r.ve = function (a, b, c) {
        b && (yg(b, c ? "menuitemcheckbox" : this.xa()), pj(this, a, b, c))
    };

    function qj(a, b) {
        var c = a.H(b);
        if (c) {
            var c = c.firstChild,
                d = nj(a, 1);
            return !!c && !! c.className && -1 != c.className.indexOf(d)
        }
        return m
    }

    function pj(a, b, c, d) {
        d != qj(a, c) && (d ? A(c, "goog-option") : fb(c, "goog-option"), c = a.H(c), d ? (a = nj(a, 1), c.insertBefore(b.o().d("div", a), c.firstChild || k)) : c.removeChild(c.firstChild))
    }
    r.cd = function (a) {
        switch (a) {
        case 2:
            return nj(this, 0);
        case 16:
        case 8:
            return "goog-option-selected";
        default:
            return mj.b.cd.call(this, a)
        }
    };
    r.nf = function (a) {
        var b = nj(this, 0);
        switch (a) {
        case "goog-option-selected":
            return 16;
        case b:
            return 2;
        default:
            return mj.b.nf.call(this, a)
        }
    };
    r.f = p("goog-menuitem");

    function rj(a, b, c, d) {
        V.call(this, a, d || mj.t(), c);
        this.C(b)
    }
    w(rj, V);
    r = rj.prototype;
    r.$ = function () {
        var a = this.j;
        return a != k ? a : this.uc()
    };
    r.C = ca("j");
    r.fg = function (a) {
        Vg(this, 8, a);
        U(this, 16) && !a && Ug(this, 16, m) && this.N(16, m);
        var b = this.a();
        b && this.w.fg(this, b, a)
    };
    r.ve = function (a) {
        Vg(this, 16, a);
        var b = this.a();
        b && this.w.ve(this, b, a)
    };
    r.uc = function () {
        var a = this.wa;
        return ja(a) ? (a = Sa(a, function (a) {
            var c = db(a);
            return Va(c, "goog-menuitem-accel") || Va(c, "goog-menuitem-mnemonic-separator") ? "" : oc(a)
        }).join(""), Da(a)) : rj.b.uc.call(this)
    };
    r.cc = function (a) {
        var b = this.getParent();
        if (b) {
            var c = b.oh;
            b.oh = k;
            if (b = c && "number" == typeof a.clientX) b = new F(a.clientX, a.clientY), b = c == b ? i : !c || !b ? m : c.x == b.x && c.y == b.y;
            if (b) return
        }
        rj.b.cc.call(this, a)
    };
    r.Za = function (a) {
        return a.keyCode == this.hh && this.Hb(a) ? i : rj.b.Za.call(this, a)
    };
    r.Ei = n("hh");
    Ig("goog-menuitem", function () {
        return new rj(k)
    });

    function sj() {}
    w(sj, Ag);
    t(sj);
    sj.prototype.f = p("goog-menuheader");

    function tj(a, b, c) {
        V.call(this, a, c || sj.t(), b);
        Vg(this, 1, m);
        Vg(this, 2, m);
        Vg(this, 4, m);
        Vg(this, 32, m);
        this.Pb = 1
    }
    w(tj, V);
    Ig("goog-menuheader", function () {
        return new tj(k)
    });

    function uj(a, b) {
        mi.call(this, ki, b || lj.t(), a);
        this.wb(m)
    }
    w(uj, mi);
    r = uj.prototype;
    r.Re = i;
    r.ci = m;
    r.f = function () {
        return this.w.f()
    };
    r.Tb = function (a) {
        if (this.w.Tb(this, a)) return i;
        for (var b = 0, c = T(this); b < c; b++) {
            var d = this.A(b);
            if ("function" == typeof d.Tb && d.Tb(a)) return i
        }
        return m
    };
    r.cb = function (a) {
        this.z(a, i)
    };
    r.mc = function (a, b) {
        this.Oc(a, b, i)
    };
    r.vc = function (a) {
        return this.A(a)
    };
    r.lf = function () {
        return T(this)
    };
    r.ma = function () {
        var a = [];
        R(this, function (b) {
            a.push(b)
        });
        return a
    };
    r.eg = function (a, b) {
        var c = this.V();
        c || O(this.a(), i);
        var d = this.a(),
            f = a,
            g = b,
            j = $f(d);
        if (f instanceof F) g = f.y, f = f.x;
        Uf(d, d.offsetLeft + (f - j.x), d.offsetTop + (g - j.y));
        c || O(this.a(), m)
    };
    r.D = function (a, b, c) {
        (b = uj.b.D.call(this, a, b)) && a && this.F && this.Re && this.ha().focus();
        this.oh = a && c && "number" == typeof c.clientX ? new F(c.clientX, c.clientY) : k;
        return b
    };
    r.pf = function (a) {
        this.Re && this.ha().focus();
        return uj.b.pf.call(this, a)
    };
    r.sg = function (a) {
        return (this.ci || a.isEnabled()) && a.V() && !! (a.da & 2)
    };
    r.Qa = function (a) {
        var b = this.w,
            c;
        c = this.o();
        c = Xb(c.Q, "div", b.f() + "-content", a);
        for (var d = c.length, f = 0; f < d; f++) li(b, this, c[f]);
        uj.b.Qa.call(this, a)
    };
    r.Za = function (a) {
        var b = uj.b.Za.call(this, a);
        b || R(this, function (c) {
            !b && c.Ei && c.hh == a.keyCode && (this.isEnabled() && this.Ma(c), b = c.Sa(a))
        }, this);
        return b
    };

    function vj() {}
    w(vj, ai);
    t(vj);
    if (Bb) vj.prototype.na = function (a, b) {
        var c = vj.b.H.call(this, a && a.firstChild);
        if (c) {
            var d = this.createCaption(b, Tb(a)),
                f = c.parentNode;
            f && f.replaceChild(d, c)
        }
    };
    r = vj.prototype;
    r.H = function (a) {
        a = vj.b.H.call(this, a && a.firstChild);
        if (Bb && a && a.__goog_wrapper_div) a = a.firstChild;
        return a
    };
    r.J = function (a, b) {
        var c = Xb(document, "*", "goog-menu", b)[0];
        if (c) {
            O(c, m);
            Vb(c).body.appendChild(c);
            var d = new uj;
            d.J(c);
            a.Jc(d)
        }
        return vj.b.J.call(this, a, b)
    };
    r.Md = function (a, b) {
        return vj.b.Md.call(this, [this.createCaption(a, b), this.Nd(b)], b)
    };
    r.createCaption = function (a, b) {
        return b.d("div", "goog-inline-block " + (this.f() + "-caption"), a)
    };
    r.Nd = function (a) {
        return a.d("div", "goog-inline-block " + (this.f() + "-dropdown"), "\u00a0")
    };
    r.f = p("goog-menu-button");

    function wj(a, b, c, d) {
        W.call(this, a, c || vj.t(), d);
        Vg(this, 64, i);
        b && this.Jc(b);
        this.hj = k;
        this.ta = new af(500);
        if ((jj || kj) && !E("533.17.9")) this.de = i
    }
    w(wj, W);
    r = wj.prototype;
    r.ai = i;
    r.$f = m;
    r.de = m;
    r.uh = m;
    r.s = function () {
        wj.b.s.call(this);
        this.v && xj(this, this.v, i);
        zg(this.a(), "haspopup", "true")
    };
    r.ka = function () {
        wj.b.ka.call(this);
        if (this.v) {
            this.ca(m);
            this.v.ka();
            xj(this, this.v, m);
            var a = this.v.a();
            a && gc(a)
        }
    };
    r.h = function () {
        wj.b.h.call(this);
        this.v && (this.v.i(), delete this.v);
        delete this.Hj;
        this.ta.i()
    };
    r.bc = function (a) {
        wj.b.bc.call(this, a);
        if (this.nd() && (this.ca(!U(this, 64), a), this.v)) this.v.tb = U(this, 64)
    };
    r.cc = function (a) {
        wj.b.cc.call(this, a);
        if (this.v && !this.nd()) this.v.tb = m
    };
    r.Hb = function () {
        this.setActive(m);
        return i
    };
    r.Pi = function (a) {
        this.v && this.v.V() && !this.Tb(a.target) && this.ca(m)
    };
    r.Tb = function (a) {
        return a && jc(this.a(), a) || this.v && this.v.Tb(a) || m
    };
    r.Za = function (a) {
        if (32 == a.keyCode) {
            if (a.preventDefault(), "keyup" != a.type) return m
        } else if ("key" != a.type) return m;
        if (this.v && this.v.V()) {
            var b = this.v.Sa(a);
            return 27 == a.keyCode ? (this.ca(m), i) : b
        }
        return 40 == a.keyCode || 38 == a.keyCode || 32 == a.keyCode ? (this.ca(i), i) : m
    };
    r.rf = function () {
        this.ca(m)
    };
    r.Ti = function () {
        this.nd() || this.ca(m)
    };
    r.$b = function (a) {
        this.de || this.ca(m);
        wj.b.$b.call(this, a)
    };

    function yj(a) {
        a.v || a.Jc(new uj(a.o()));
        return a.v || k
    }
    r.Jc = function (a) {
        var b = this.v;
        if (a != b && (b && (this.ca(m), this.F && xj(this, b, m), delete this.v), a)) {
            this.v = a;
            qg(a, this);
            a.D(m);
            var c = this.de;
            (a.Re = c) && a.wb(i);
            this.F && xj(this, a, i)
        }
        return b
    };
    r.cb = function (a) {
        yj(this).z(a, i)
    };
    r.mc = function (a, b) {
        yj(this).Oc(a, b, i)
    };
    r.vc = function (a) {
        return this.v ? this.v.A(a) : k
    };
    r.lf = function () {
        return this.v ? T(this.v) : 0
    };
    r.D = function (a, b) {
        var c = wj.b.D.call(this, a, b);
        c && !this.V() && this.ca(m);
        return c
    };
    r.za = function (a) {
        wj.b.za.call(this, a);
        this.isEnabled() || this.ca(m)
    };
    r.ca = function (a, b) {
        wj.b.ca.call(this, a);
        if (this.v && U(this, 64) == a) {
            if (a) this.v.F || (this.uh ? this.v.X(this.a().parentNode) : this.v.X()), this.lc = Zf(this.a()), this.Sb = eg(this.a()), zj(this), pi(this.v, -1);
            else if (this.setActive(m), this.v.tb = m, this.a() && zg(this.a(), "activedescendant", ""), this.me != k) {
                this.me = h;
                var c = this.v.a();
                c && bg(c, "", "")
            }
            this.v.D(a, m, b);
            if (!this.Sd) {
                var c = Q(this),
                    d = a ? c.c : c.ea;
                d.call(c, rc(this.o()), "mousedown", this.Pi, i);
                this.de && d.call(c, this.v, "blur", this.Ti);
                d.call(c, this.ta, cf, this.vj);
                a ? this.ta.start() : this.ta.stop()
            }
        }
    };

    function zj(a) {
        if (a.v.F) {
            var b = a.Hj || a.a(),
                c = a.bm;
            c || (c = new fj(b, a.ai ? 5 : 7, !a.$f, a.$f));
            b = a.v.a();
            if (!a.v.V()) b.style.visibility = "hidden", O(b, i);
            if (!a.me && a.$f) a.me = cg(b);
            c.La(b, c.Tc ^ 1, a.hj, a.me);
            if (!a.v.V()) O(b, m), b.style.visibility = "visible"
        }
    }
    r.vj = function () {
        var a = eg(this.a()),
            b = Zf(this.a());
        if (!(this.Sb == a || (!this.Sb || !a ? 0 : this.Sb.left == a.left && this.Sb.width == a.width && this.Sb.top == a.top && this.Sb.height == a.height)) || !(this.lc == b || (!this.lc || !b ? 0 : this.lc.top == b.top && this.lc.right == b.right && this.lc.bottom == b.bottom && this.lc.left == b.left))) this.Sb = a, this.lc = b, zj(this)
    };

    function xj(a, b, c) {
        var d = Q(a),
            c = c ? d.c : d.ea;
        c.call(d, b, "action", a.rf);
        c.call(d, b, "highlight", a.qf);
        c.call(d, b, "unhighlight", a.uf)
    }
    r.qf = function (a) {
        zg(this.a(), "activedescendant", a.target.a().id)
    };
    r.uf = function () {
        qi(this.v) || zg(this.a(), "activedescendant", "")
    };
    Ig("goog-menu-button", function () {
        return new wj(k)
    });

    function Aj(a) {
        this.l = [];
        Bj(this, a)
    }
    w(Aj, H);
    r = Aj.prototype;
    r.Lb = k;
    r.wh = k;
    r.lf = function () {
        return this.l.length
    };
    r.vc = function (a) {
        return this.l[a] || k
    };

    function Bj(a, b) {
        b && (y(b, function (a) {
            Cj(this, a, m)
        }, a), $a(a.l, b))
    }
    r.cb = function (a) {
        this.mc(a, this.lf())
    };
    r.mc = function (a, b) {
        a && (Cj(this, a, m), ab(this.l, b, 0, a))
    };
    r.fd = n("Lb");
    r.ma = function () {
        return Ya(this.l)
    };
    r.jc = function (a) {
        if (a != this.Lb) Cj(this, this.Lb, m), this.Lb = a, Cj(this, a, i);
        this.dispatchEvent("select")
    };
    r.Zd = function () {
        return this.Lb ? Ra(this.l, this.Lb) : -1
    };
    r.gg = function (a) {
        this.jc(this.vc(a))
    };
    r.clear = function () {
        var a = this.l;
        if (!ja(a))
            for (var b = a.length - 1; 0 <= b; b--) delete a[b];
        a.length = 0;
        this.Lb = k
    };
    r.h = function () {
        Aj.b.h.call(this);
        delete this.l;
        this.Lb = k
    };

    function Cj(a, b, c) {
        b && ("function" == typeof a.wh ? a.wh(b, c) : "function" == typeof b.Nb && b.Nb(c))
    };

    function Dj(a, b, c, d) {
        wj.call(this, a, b, c, d);
        this.Pd = a;
        Ej(this);
        this.qe = "listbox"
    }
    w(Dj, wj);
    r = Dj.prototype;
    r.L = k;
    r.Pd = k;
    r.s = function () {
        Dj.b.s.call(this);
        Ej(this);
        Fj(this);
        zg(this.a(), "haspopup", "false")
    };
    r.Qa = function (a) {
        Dj.b.Qa.call(this, a);
        (a = this.uc()) ? (this.Pd = a, Ej(this)) : this.gg(0)
    };
    r.h = function () {
        Dj.b.h.call(this);
        if (this.L) this.L.i(), this.L = k;
        this.Pd = k
    };
    r.rf = function (a) {
        this.jc(a.target);
        Dj.b.rf.call(this, a);
        a.stopPropagation();
        this.dispatchEvent("action")
    };
    r.Vi = function () {
        var a = this.fd();
        Dj.b.C.call(this, a && a.$());
        Ej(this)
    };
    r.Jc = function (a) {
        var b = Dj.b.Jc.call(this, a);
        a != b && (this.L && this.L.clear(), a && (this.L ? R(a, function (a) {
            Gj(a);
            this.L.cb(a)
        }, this) : Hj(this, a)));
        return b
    };
    r.cb = function (a) {
        Gj(a);
        Dj.b.cb.call(this, a);
        this.L ? this.L.cb(a) : Hj(this, yj(this))
    };
    r.mc = function (a, b) {
        Gj(a);
        Dj.b.mc.call(this, a, b);
        this.L ? this.L.mc(a, b) : Hj(this, yj(this))
    };
    r.jc = function (a) {
        if (this.L) {
            var b = this.fd();
            this.L.jc(a);
            a != b && this.dispatchEvent("change")
        }
    };
    r.gg = function (a) {
        this.L && this.jc(this.L.vc(a))
    };
    r.C = function (a) {
        if (a != k && this.L)
            for (var b = 0, c; c = this.L.vc(b); b++)
                if (c && "function" == typeof c.$ && c.$() == a) {
                    this.jc(c);
                    return
                }
        this.jc(k)
    };
    r.fd = function () {
        return this.L ? this.L.fd() : k
    };
    r.Zd = function () {
        return this.L ? this.L.Zd() : -1
    };

    function Hj(a, b) {
        a.L = new Aj;
        b && R(b, function (a) {
            Gj(a);
            this.L.cb(a)
        }, a);
        Fj(a)
    }

    function Fj(a) {
        a.L && Q(a).c(a.L, "select", a.Vi)
    }

    function Ej(a) {
        var b = a.fd();
        a.na(b ? b.uc() : a.Pd)
    }

    function Gj(a) {
        a.qe = a instanceof rj ? "option" : "separator"
    }
    r.ca = function (a, b) {
        Dj.b.ca.call(this, a, b);
        U(this, 64) && pi(yj(this), this.Zd())
    };
    Ig("goog-select", function () {
        return new Dj(k)
    });

    function Ij(a, b, c) {
        rj.call(this, a, b, c);
        this.fg(i)
    }
    w(Ij, rj);
    Ij.prototype.Hb = function () {
        return this.dispatchEvent("action")
    };
    Ig("goog-option", function () {
        return new Ij(k)
    });

    function Jj() {}
    w(Jj, cj);
    t(Jj);
    r = Jj.prototype;
    r.d = function (a) {
        var b = {
            "class": "goog-inline-block " + this.Ea(a).join(" "),
            title: a.hb() || ""
        };
        return a.o().d("div", b, [this.createCaption(a.wa, a.o()), this.Nd(a.o())])
    };
    r.H = function (a) {
        return a && a.firstChild
    };
    r.J = function (a, b) {
        var c = Xb(document, "*", "goog-menu", b)[0];
        if (c) {
            O(c, m);
            rc(a.o()).body.appendChild(c);
            var d = new uj;
            d.J(c);
            a.Jc(d)
        }
        Xb(document, "*", this.f() + "-caption", b)[0] || b.appendChild(this.createCaption(b.childNodes, a.o()));
        Xb(document, "*", this.f() + "-dropdown", b)[0] || b.appendChild(this.Nd(a.o()));
        return Jj.b.J.call(this, a, b)
    };
    r.createCaption = function (a, b) {
        return b.d("div", "goog-inline-block " + (this.f() + "-caption"), a)
    };
    r.Nd = function (a) {
        return a.d("div", "goog-inline-block " + (this.f() + "-dropdown"), "\u00a0")
    };
    r.f = p("goog-flat-menu-button");
    Ig("goog-flat-menu-button", function () {
        return new wj(k, k, Jj.t())
    });

    function Kj() {}
    w(Kj, Ag);
    t(Kj);
    Kj.prototype.f = p("au-upldr-top-pane");
    Kj.prototype.d = function (a) {
        var b = a.o().d("div", this.Ea(a).join(" "));
        a.g = b;
        var c = a.j.r,
            d = dj.t(),
            f = ac("div", "au-upldr-title");
        A(f, "titleText");
        b.appendChild(f);
        var g = new wg(I(c, "TitleText"));
        X(c, "TitleText", function () {
            xg(g, I(c, "TitleText"))
        });
        a.z(g, m);
        g.X(f);
        var j = [Bb ? new Mi(I(c, "AddFilesHyperlinkText"), ej.t()) : new W(I(c, "AddFilesHyperlinkText"), d), new wg(I(c, "OrText")), new W(I(c, "ClearAllHyperlinkText"), d)];
        j[0].za(I(c, "EnableAddingFiles"));
        j[2].za(m);
        X(c, "AddFilesHyperlinkText", function () {
            j[0].na(I(c,
                "AddFilesHyperlinkText"))
        });
        X(c, "EnableAddingFiles", function () {
            j[0].za(I(c, "EnableAddingFiles"))
        });
        X(c, "OrText", function () {
            xg(j[1], I(c, "OrText"))
        });
        X(c, "ClearAllHyperlinkText", function () {
            j[2].na(I(c, "ClearAllHyperlinkText"))
        });
        y(j, function (c, d) {
            0 < d && ec(b, "\u00a0");
            a.z(c, i)
        });
        A(j[0].a(), "htmlLink");
        A(j[1].a(), "uploadPanelOrText");
        A(j[2].a(), "htmlLink");
        var d = I(c, "ViewComboBox"),
            l = new Dj(k, k, Jj.t());
        l.cb(new rj(d[0], "tiles"));
        l.cb(new rj(d[1], "thumbnails"));
        l.cb(new rj(d[2], "icons"));
        l.C(I(c, "ViewMode"));
        l.uh = i;
        X(c, "ViewComboBox", function () {
            for (var a = I(c, "ViewComboBox"), b = 0; 3 > b; b++) l.vc(b).na(a[b]);
            l.gg(l.Zd())
        });
        X(c, "ViewMode", function () {
            l.C(I(c, "ViewMode"))
        });
        f = ac("div", "au-upldr-change-view");
        b.insertBefore(f, b.childNodes[0] || k);
        var o = [new wg(I(c, "ViewComboBoxText")), l];
        X(c, "ViewComboBoxText", function () {
            xg(o[0], I(c, "ViewComboBoxText"))
        });
        y(o, function (c, d) {
            0 < d && ec(b, "\u00a0");
            a.z(c, m);
            c.X(f)
        });
        A(o[0].a(), "panelText");
        A(o[1].a(), "viewComboBox");
        var q = f;
        O(q, I(c, "ShowViewComboBox"));
        X(c, "ShowViewComboBox",
            function () {
                O(q, I(c, "ShowViewComboBox"))
            });
        return b
    };

    function Lj(a, b) {
        V.call(this, k, b);
        this.j = a;
        Vg(this, 255, m)
    }
    w(Lj, V);
    r = Lj.prototype;
    r.s = function () {
        Lj.b.s.call(this);
        var a = Q(this),
            b = this.A(1);
        Bb ? a.c(b, xd, this.qj) : a.c(b, "action", this.kj);
        a.c(this.A(3), "action", this.uj);
        var c = this.A(5);
        a.c(c, "action", this.zj);
        var d, f;
        f = yj(c).F;
        f || (d = yj(c).a(), c.a().parentNode.appendChild(d));
        b = cg(d);
        f || gc(d);
        if (0 < b.width) d = c.a(), c = ig(d, "padding"), d.style.width = Vf(b.width - c.left - c.right, i);
        a.c(this.j.ma(), ad, this.Bf)
    };
    r.qj = function (a) {
        this.j.Gd(a);
        a.stopPropagation()
    };
    r.kj = function () {
        this.j.Qe()
    };
    r.uj = function () {
        var a = this.j;
        a.l.clear();
        a.N(0)
    };
    r.zj = function (a) {
        this.j.r.setProperty("ViewMode", a.target.$())
    };
    r.Bf = function (a) {
        this.A(3).za(0 < a.target.Z())
    };
    r.R = gd;
    r.Yg = gd;
    Gg(Lj, Kj);

    function Mj(a, b) {
        P.call(this, b);
        this.j = a
    }
    w(Mj, P);
    r = Mj.prototype;
    r.f = p("au-upldr-uploader");
    r.kf = function () {
        return this.A(2).A(0).kf()
    };
    r.d = function () {
        var a = this.j,
            b = a.r,
            c = new Nf;
        c.append("width:");
        c.append(I(b, "Width"));
        c.append(";height:");
        c.append(I(b, "Height"));
        var d = this.o(),
            f = [d.d("div", k), d.d("div", k), d.d("div", k), d.d("div", k)],
            g = d.d("div", this.f() + "-panes", f[0], f[1], f[2], f[3], f[4]);
        "-ms-flex" in g.style && A(g, "flexbox");
        this.g = g = d.d("div", {
            className: this.f(),
            id: I(b, "Id"),
            style: c.toString()
        }, g);
        for (var c = [new Lj(a), new wh(a), new Yi(a), new jh(a)], j = 0; j < c.length; j++) c[j] && (this.z(c[j], m), c[j].X(f[j]));
        this.Qc = d.d("div", this.f() +
            "-bg");
        O(this.Qc, m);
        g.appendChild(this.Qc);
        (this.Dg = new Fh(b)).X(g);
        (this.ab = new sh(a)).X(g);
        this.yf = new $i(b);
        this.yf.X(g)
    };
    r.s = function () {
        Mj.b.s.call(this);
        Q(this).c(this.Dg, [Gh, Hh], this.$e).c(this.ab, [th, uh], this.$e).c(this.yf, [aj, bj], this.$e)
    };
    r.zh = function (a, b) {
        this.hg && (clearTimeout(this.hg), delete this.hg);
        0 < b ? this.hg = pd(v(this.zh, this, a), b) : O(this.Qc, !a)
    };
    r.$e = function (a) {
        this.zh(a.type === Gh)
    };
    r.R = gd;

    function Nj() {
        this.th = ta()
    }
    var Oj = new Nj;
    Nj.prototype.set = ca("th");
    Nj.prototype.reset = function () {
        this.set(ta())
    };
    Nj.prototype.get = n("th");

    function Pj(a) {
        this.Xf = a || "";
        this.ak = Oj
    }
    r = Pj.prototype;
    r.Ah = i;
    r.Eh = i;
    r.Dh = i;
    r.Ch = m;
    r.Fh = m;

    function Qj(a) {
        return 10 > a ? "0" + a : "" + a
    }

    function Rj(a, b) {
        var c = (a.Mh - b) / 1E3,
            d = c.toFixed(3),
            f = 0;
        if (1 > c) f = 2;
        else
            for (; 100 > c;) f++, c *= 10;
        for (; 0 < f--;) d = " " + d;
        return d
    }

    function Sj(a) {
        Pj.call(this, a)
    }
    w(Sj, Pj);

    function Tj() {
        this.Ij = v(this.$h, this);
        this.tc = new Sj(this.Xf);
        this.tc.Ah = m;
        this.tc.Ch = i;
        this.tc.Fh = i;
        this.tc.Eh = m;
        this.Wg = this.tc.Dh = m
    }
    w(Tj, H);
    t(Tj);
    Tj.prototype.Xf = "[htmluploader_trace]";
    Tj.prototype.$h = function (a) {
        var b = this.tc,
            c = [];
        c.push(b.Xf, " ");
        if (b.Ah) {
            var d = new Date(a.Mh);
            c.push("[", Qj(d.getFullYear() - 2E3) + Qj(d.getMonth() + 1) + Qj(d.getDate()) + " " + Qj(d.getHours()) + ":" + Qj(d.getMinutes()) + ":" + Qj(d.getSeconds()) + "." + Qj(Math.floor(d.getMilliseconds() / 10)), "] ")
        }
        b.Eh && c.push("[", Rj(a, b.ak.get()), "s] ");
        b.Dh && c.push("[", a.dj, "] ");
        b.Fh && c.push("[", a.Fc.name, "] ");
        c.push(a.ih, "\n");
        b.Ch && a.gf && c.push(a.ff, "\n");
        a = c.join("");
        b = new G("trace");
        b.log = a;
        this.dispatchEvent(b);
        b.i()
    };
    M("au.upldr").bg(Me);
    Re = ba();

    function Uj(a) {
        this.Ra = ac("input", {
            type: "file",
            multiple: "multiple",
            style: "position:absolute;visibility:hidden;top:-100px;width:1px;height:1px"
        });
        (a || document.body).appendChild(this.Ra);
        Nc(this.Ra, "change", this.Wd, m, this)
    }
    w(Uj, H);
    Uj.prototype.open = function () {
        this.Ra.click()
    };
    Uj.prototype.Wd = function (a) {
        a = a.target;
        this.dispatchEvent(new Ih(a.files));
        a.value = ""
    };
    Uj.prototype.h = function () {
        Uj.b.h.call(this);
        Vc(this.Ra);
        gc(this.Ra);
        delete this.Ra
    };

    function Vj(a, b) {
        this.ah = b;
        this.bd = [];
        a > this.ah && e(Error("[goog.structs.SimplePool] Initial cannot be greater than max"));
        for (var c = 0; c < a; c++) this.bd.push(this.Od())
    }
    w(Vj, Cc);
    r = Vj.prototype;
    r.Bg = k;
    r.Eg = k;

    function Wj(a, b) {
        a.bd.length < a.ah ? a.bd.push(b) : a.af(b)
    }
    r.Od = function () {
        return this.Bg ? this.Bg() : {}
    };
    r.af = function (a) {
        if (this.Eg) this.Eg(a);
        else if (ma(a))
            if (la(a.i)) a.i();
            else
                for (var b in a) delete a[b]
    };
    r.h = function () {
        Vj.b.h.call(this);
        for (var a = this.bd; a.length;) this.af(a.pop());
        delete this.bd
    };

    function Xj() {
        this.Yc = [];
        this.Sf = new xe;
        this.Oh = this.Ph = this.Qh = this.Gh = 0;
        this.Bd = new xe;
        this.xg = this.Nh = 0;
        this.Of = 1;
        this.df = new Vj(0, 4E3);
        this.df.Od = function () {
            return new Yj
        };
        this.Hh = new Vj(0, 50);
        this.Hh.Od = function () {
            return new Zj
        };
        var a = this;
        this.vf = new Vj(0, 2E3);
        this.vf.Od = function () {
            return "" + a.Of++
        };
        this.vf.af = ba();
        this.ki = 3
    }
    Xj.prototype.B = M("goog.debug.Trace");

    function Zj() {
        this.mg = this.Lh = this.Xe = 0
    }
    Zj.prototype.toString = function () {
        var a = [];
        a.push(this.type, " ", this.Xe, " (", Math.round(10 * this.Lh) / 10, " ms)");
        this.mg && a.push(" [VarAlloc = ", this.mg, "]");
        return a.join("")
    };

    function Yj() {}

    function $j(a, b, c, d) {
        var f = []; - 1 == c ? f.push("    ") : f.push(ak(a.Ig - c));
        f.push(" ", bk(a.Ig - b));
        0 == a.ef ? f.push(" Start        ") : 1 == a.ef ? (f.push(" Done "), f.push(ak(a.gm - a.startTime), " ms ")) : f.push(" Comment      ");
        f.push(d, a);
        0 < a.ek && f.push("[VarAlloc ", a.ek, "] ");
        return f.join("")
    }
    Yj.prototype.toString = function () {
        return this.type == k ? this.hi : "[" + this.type + "] " + this.hi
    };
    Xj.prototype.reset = function (a) {
        this.ki = a;
        for (a = 0; a < this.Yc.length; a++) {
            var b = this.df.id;
            b && Wj(this.vf, b);
            Wj(this.df, this.Yc[a])
        }
        this.Yc.length = 0;
        this.Sf.clear();
        this.Gh = ta();
        this.xg = this.Nh = this.Oh = this.Ph = this.Qh = 0;
        b = this.Bd.ed();
        for (a = 0; a < b.length; a++) {
            var c = this.Bd.get(b[a]);
            c.Xe = 0;
            c.Lh = 0;
            c.mg = 0;
            Wj(this.Hh, c)
        }
        this.Bd.clear()
    };
    Xj.prototype.toString = function () {
        for (var a = [], b = -1, c = [], d = 0; d < this.Yc.length; d++) {
            var f = this.Yc[d];
            1 == f.ef && c.pop();
            a.push(" ", $j(f, this.Gh, b, c.join("")));
            b = f.Ig;
            a.push("\n");
            0 == f.ef && c.push("|  ")
        }
        if (0 != this.Sf.Z()) {
            var g = ta();
            a.push(" Unstopped timers:\n");
            we(this.Sf, function (b) {
                a.push("  ", b, " (", g - b.startTime, " ms, started at ", bk(b.startTime), ")\n")
            })
        }
        b = this.Bd.ed();
        for (d = 0; d < b.length; d++) c = this.Bd.get(b[d]), 1 < c.Xe && a.push(" TOTAL ", c, "\n");
        a.push("Total tracers created ", this.Nh, "\n", "Total comments created ",
            this.xg, "\n", "Overhead start: ", this.Qh, " ms\n", "Overhead end: ", this.Ph, " ms\n", "Overhead comment: ", this.Oh, " ms\n");
        return a.join("")
    };

    function ak(a) {
        var a = Math.round(a),
            b = "";
        1E3 > a && (b = " ");
        100 > a && (b = "  ");
        10 > a && (b = "   ");
        return b + a
    }

    function bk(a) {
        a = Math.round(a);
        return ("" + (100 + a / 1E3 % 60)).substring(1, 3) + "." + ("" + (1E3 + a % 1E3)).substring(1, 4)
    }
    new Xj;

    function ck() {
        this.q = new dd(this);
        this.qb = new id;
        this.q.c(this.qb, jd, this.xf);
        this.Ka = [];
        this.rc = k
    }
    w(ck, H);
    t(ck);
    ck.prototype.create = function (a, b) {
        L(this.e, "Enqueue new item to preview generation");
        this.Ka.push({
            item: a,
            size: b
        });
        this.rc || this.Ib()
    };
    ck.prototype.Ib = function () {
        if (!(this.rc || 0 == this.Ka.length)) this.rc = this.Ka.shift(), this.qb.load(this.rc.item.getFile())
    };
    ck.prototype.xf = function () {
        if (this.qb.Dc()) {
            var a = this.qb.qa,
                b = this.rc;
            b.item.sa(Kd, a.width);
            b.item.sa(Ld, a.height);
            b.item.N(Jd);
            for (var c = b.size, b = [b.item.Ee, b.item.Ce], d = 0; 2 > d; d++) {
                var f = b[d];
                if (f = Df(a, "fit", c[d].width, c[d].height, k, 0, f)) f.style.marginTop = Math.round((c[d].height - f.height) / 2) + "px", f.style.marginLeft = Math.round((c[d].width - f.width) / 2) + "px"
            }
        }
        this.dispatchEvent(zd);
        this.rc = k;
        this.Ib()
    };
    ck.prototype.e = M("au.upldr.image.PreviewGenerator");

    function dk() {
        this.S = []
    }
    w(dk, H);
    r = dk.prototype;
    r.add = function (a) {
        if (!Va(this.S, a)) {
            var b = this.S;
            Va(b, a) || b.push(a);
            a = new $c(ad, "add", [a]);
            try {
                this.dispatchEvent(a)
            } finally {
                a.i()
            }
            return i
        }
        return m
    };
    r.remove = function (a) {
        var b = m;
        if (ja(a))
            for (var c, d = 0; c = a[d++];) b |= Wa(this.S, c);
        else b = Wa(this.S, a); if (b) {
            a = new $c(ad, "remove", [a]);
            try {
                this.dispatchEvent(a)
            } finally {
                a.i()
            }
        }
        return b
    };
    r.Kb = function (a) {
        return this.remove(this.getItem(a))
    };
    r.getItem = function (a) {
        return this.S[a]
    };
    r.clear = function () {
        if (0 < this.S.length) {
            this.S = [];
            var a = new $c(ad, "reset", []);
            try {
                this.dispatchEvent(a)
            } finally {
                a.i()
            }
        }
    };
    r.contains = function (a) {
        return Va(this.S, a)
    };
    r.forEach = function (a, b) {
        y(this.S, function (c, d) {
            a.call(b, c, d, this)
        }, this)
    };
    r.Z = function () {
        return this.S.length
    };
    r.Ge = function () {
        return this.S.slice()
    };

    function ek() {}
    w(ek, H);
    ek.prototype.setProperty = function (a, b) {
        var c = a + "_";
        b !== this[c] && (this[c] = b, this.dispatchEvent(a + "Changed"))
    };

    function X(a, b, c, d) {
        Nc(a, b + "Changed", c, m, d)
    }

    function I(a, b) {
        return a[b + "_"]
    }
    ek.prototype.e = M("au.upldr.PropertyHolder");

    function fk() {
        this.l = []
    }
    r = fk.prototype;
    r.add = function (a) {
        var b = this.l.length;
        a instanceof Ff || (a ? u(a) && (a = {
            mode: a
        }) : a = {}, a = new Ff(b, a.mode || "*.*=SourceFile", a.thumbnailWidth, a.thumbnailHeight, a.thumbnailFitMode, a.thumbnailBgColor));
        this.l.push(a);
        return b
    };
    r.Kb = function (a) {
        return this.l.length > a ? 1 == Qa.splice.call(this.l, a, 1).length : m
    };
    r.getItem = function (a) {
        return this.l[a]
    };
    r.Z = function () {
        return this.l.length
    };
    r.Ge = function () {
        return this.l.slice()
    };
    r.e = M("au.upldr.Converters");

    function gk(a) {
        this.q = new dd(this);
        hk(this);
        wc() || (K(this.e, "HTML5 Uploader is not supported in this browser."), window.alert("HTML5 Uploader is not supported in this browser."));
        var b = nb();
        ma(a) && pb(b, a);
        this.l = new dk;
        this.oa = new Mj(this);
        this.r = new ek;
        this.O = new fk;
        this.qd = new bd;
        this.md = new de;
        this.q.c(this.md, ie, this.bj).c(this.md, he, this.$i).c(this.md, je, this.aj);
        this.Db = {};
        this.fe = {};
        this.Ye = m;
        ik(this, b);
        this.q.c(ck.t(), zd, function () {
            this.Ye = m;
            jk(this)
        })
    }
    w(gk, H);
    r = gk.prototype;
    r.Qe = function () {
        this.Zc.open()
    };
    r.re = function (a) {
        L(this.e, "Remove file at " + a + " position");
        (a = this.l.Kb(a)) && (0 < this.l.Z() ? this.N(1) : this.N(0));
        return a
    };
    r.X = function (a) {
        wc() ? (this.Lj && rd("Uploader already rendered"), this.oa.X(a), this.q.c(this.oa, xd, this.Gd), this.Zc = new Uj(a), this.q.c(this.Zc, xd, this.Gd), this.Lj = i, this.e.info("Version: 8.0.28.0; Build date: 2012-12-5"), pd(this.ni, 0, this)) : this.e.error("HTML5 Uploader is not supported in this browser.")
    };
    r.ni = function () {
        try {
            this.dispatchEvent("initComplete")
        } catch (a) {
            K(this.e, 'Error in "initComplete" event: ' + a.message)
        }
    };
    r.Gd = function (a) {
        L(this.e, "Adding files...");
        a = a.ad;
        if (0 < a.length) {
            for (var b = this.l, c = b.Z(), d = 0, f = 0; f < c; ++f) d += b.getItem(f).xc();
            this.jg = 0;
            this.ig = [];
            b = this.r;
            b = new Pd(I(b, "FileMask"), I(b, "MaxFileCount"), I(b, "MaxTotalFileSize"), I(b, "MaxFileSize"), I(b, "MinFileSize"), I(b, "MaxImageWidth"), I(b, "MinImageWidth"), I(b, "MaxImageHeight"), I(b, "MinImageHeight"));
            fd(this.q, this.oa.ab, vh, this.tg);
            this.oa.ab.Mb(a.length);
            this.oa.ab.C(0);
            this.oa.ab.show();
            f = this.md;
            f.ad = Array.prototype.slice.call(a);
            f.Cf = c;
            f.ee =
                d;
            f.ng = b;
            f.ua = m;
            ee(f)
        }
    };

    function hk(a) {
        var b = Tj.t();
        if (i != b.Wg) {
            Ve();
            var c = Ue,
                d = b.Ij;
            if (!c.gd) c.gd = [];
            c.gd.push(d);
            b.Wg = i
        }
        a.q.c(b, "trace", a.ej)
    }
    r.ej = function (a) {
        var b = new G("trace");
        b.log = a.log;
        try {
            this.dispatchEvent(b)
        } catch (c) {} finally {
            b.i()
        }
    };
    r.bj = function (a) {
        for (var a = a.items, b = 0, c = a.length; b < c; ++b) {
            var d = a[b];
            this.l.add(d);
            Gd(d) && (this.fe[na(d)] = 1)
        }
        0 < c && this.oa.ab.C(this.oa.ab.$() + c);
        this.N(0 < this.l.Z() ? 1 : 0)
    };
    r.aj = function (a) {
        var b = a.item,
            a = a.code;
        L(this.e, 'File "' + b.getName() + '" skipped (' + a + ")");
        this.jg++;
        var c, d = -1,
            b = b.getName(),
            f = this.r;
        switch (a) {
        case Sd:
            c = J(I(f, "FileNameNotAllowedMessage"), b);
            d = 5;
            break;
        case Vd:
            c = J(I(f, "MaxFileCountExceeded"), I(f, "MaxFileCount"));
            d = 6;
            break;
        case Wd:
            c = J(I(f, "MaxTotalFileSizeExceeded"), Cd(I(f, "MaxTotalFileSize"), 0));
            d = 7;
            break;
        case Td:
            c = J(I(f, "MaxFileSizeExceeded"), b, Cd(I(f, "MaxFileSize"), 0));
            d = 0;
            break;
        case Ud:
            c = J(I(f, "FileSizeTooSmall"), b, Cd(I(f, "MinFileSize"), 0));
            d =
                1;
            break;
        case $d:
        case ae:
            c = J(I(f, "DimensionsTooLarge"), b, I(f, "MaxImageWidth"), I(f, "MaxImageHeight"));
            d = 3;
            break;
        case be:
        case ce:
            c = J(I(f, "DimensionsTooSmall"), b, I(f, "MinImageWidth"), I(f, "MinImageHeight")), d = 4
        }
        c && this.ig.push(c);
        if (-1 < d) {
            c = d;
            a = new G("restrictionFailed");
            a.code = c;
            try {
                this.dispatchEvent(a)
            } catch (g) {
                K(this.e, 'Error in "restrictionFailed" event: ' + g.message)
            } finally {
                a.i()
            }
        }
        this.oa.ab.C(this.oa.ab.$() + 1)
    };
    r.$i = function () {
        L(this.e, "Files added.");
        this.oa.ab.Ta();
        this.q.ea(this.oa.ab, vh, this.tg);
        var a = this.ig;
        if (4 < a.length) this.we(J(I(this.r, "FilesNotAdded"), this.jg));
        else
            for (var b = 0, c = a.length; b < c; ++b) this.we(a[b]);
        this.ig = [];
        this.jg = 0;
        try {
            this.dispatchEvent("itemsAdded")
        } catch (d) {
            K(this.e, 'Error in "itemsAdded" event: ' + d.message)
        }
        jk(this)
    };

    function jk(a) {
        if (!a.Ye)
            if (vc()) {
                var b = ck.t(),
                    c;
                c = I(a.r, "TilePreviewSize");
                c = {
                    width: c,
                    height: c
                };
                var d;
                d = I(a.r, "ThumbnailPreviewSize");
                d = {
                    width: d,
                    height: d
                };
                for (var f = a.l, g = f.Z(), j = a.oa.kf(), j = Math.max(0, Math.min(g - 1, j)), l = 0; l < g; l++) {
                    var o = f.getItem(j);
                    if (o) {
                        var q = na(o);
                        if (a.fe[q]) {
                            delete a.fe[q];
                            a.Ye = i;
                            b.create(o, [c, d]);
                            break
                        }
                    }
                    j = (j + 1) % g
                }
            } else a.fe = {}, K(a.e, "The browser doesn't support Blob URI. Preview wouldn't be created.")
    }
    r.tg = function () {
        this.md.reset()
    };
    r.ma = n("l");

    function ik(a, b) {
        jb(Aa, function (a, b) {
            this.setProperty(b, a)
        }, a.r);
        y(kb(za), function (a) {
            this["set" + a](b[a])
        }, a)
    }
    r.gb = function () {
        return I(this.r, "UploaderState")
    };
    r.N = function (a) {
        this.r.setProperty("UploaderState", a)
    };
    r.h = function () {
        gk.b.h.call(this);
        this.oa.i();
        delete this.oa;
        this.Zc && (this.Zc.i(), delete this.Zc);
        this.r.i();
        delete this.r;
        this.l.forEach(function (a) {
            a.i()
        });
        delete this.l;
        kk(this)
    };
    r.upload = function () {
        if (1 == this.gb())
            if (this.l.Z() >= I(this.r, "MinFileCount")) {
                L(this.e, "Dispatch BeforeUpload event");
                var a;
                try {
                    a = this.dispatchEvent("beforeUpload")
                } catch (b) {
                    K(this.e, 'Error in "beforeUpload" event: ' + b.message)
                }
                if (a) {
                    L(this.e, "Start upload");
                    this.N(2);
                    lk(this, 1, 0, 0, this.ma().Z(), 0, 0);
                    a = this.Ke = new vf(h, h, I(this.r, "ProgressBytesMode"));
                    this.q.c(a, "beforePackageUpload", this.Sh).c(a, "afterPackageUpload", this.Rh).c(a, zd, this.Th).c(a, "progress", this.Uh).c(a, "error", this.lk);
                    var c = I(this.r,
                        "ActionUrl");
                    wf(a, this.ma().Ge(), this.O.Ge(), c, this.Db)
                }
            } else a = I(this.r, "TooFewFiles"), a = J(a, I(this.r, "MinFileCount")), this.we(a), this.Vb(1, -1, "", a)
    };
    r.Sh = function (a) {
        L(this.e, "BeforePackageUpload event: " + a.ne);
        var b = new G("beforePackageUpload");
        b.index = a.ne;
        try {
            this.dispatchEvent(b)
        } catch (c) {
            K(this.e, 'Error in "beforePackageUpload" event: ' + c.message)
        } finally {
            b.i()
        }
    };
    r.Rh = function (a) {
        L(this.e, "AfterPackageUpload event: " + a.ne + ", httpStatus: " + a.Fa);
        var b = new G("afterPackageUpload");
        b.index = a.ne;
        b.response = a.response;
        var c;
        try {
            c = !this.dispatchEvent(b)
        } catch (d) {
            K(this.e, 'Error in "afterPackageUpload" event: ' + d.message)
        } finally {
            b.i()
        }
        c ? kh(this) && this.Vb(18, -1, "", I(this.r, "UploadCancelledFromAfterPackageUploadEventMessage")) : this.ma().Kb(0)
    };
    r.Th = function (a) {
        L(this.e, "Upload complete: { httpStatus: " + a.Fa + ', response: "' + a.response + '", errorMessage: "' + a.Wc + '" }');
        kk(this);
        this.N(0 < this.ma().Z() ? 1 : 0);
        var b = new G("afterUpload");
        b.response = a.response;
        try {
            this.dispatchEvent(b)
        } catch (c) {
            K(this.e, 'Error in "afterUpload" event: ' + c.message)
        } finally {
            b.i()
        }
    };
    r.Uh = function (a) {
        a = a.state;
        lk(this, a.xb, a.ra, a.ib, a.Wa, a.ia, a.Aa);
        this.Rd(a.ra, a.ib, a.Wa, a.ia, a.Aa)
    };
    r.Rd = function (a, b, c, d, f) {
        var g = new G("progress");
        g.percent = a;
        g.uploadedFiles = b;
        g.totalFiles = c;
        g.uploadedBytes = d;
        g.totalBytes = f;
        try {
            this.dispatchEvent(g)
        } catch (j) {
            K(this.e, 'Error in "progress" event: ' + j.message)
        } finally {
            g.i()
        }
    };
    r.lk = function (a) {
        L(this.e, a.Wc);
        var b = 300 <= a.Fa && 400 > a.Fa ? 11 : 400 <= a.Fa && 500 > a.Fa ? 2 : 500 <= a.Fa && 600 > a.Fa ? 4 : 0,
            c = cd(b, this.r);
        kh(this, c);
        this.Vb(b, a.Fa, a.response, c)
    };
    r.Vb = function (a, b, c, d) {
        var f = new G("error");
        f.errorCode = a;
        f.httpStatus = b;
        f.response = c;
        f.additionalInfo = d;
        try {
            this.dispatchEvent(f)
        } catch (g) {
            K(this.e, 'Error in "error" event: ' + g.message)
        } finally {
            f.i()
        }
    };

    function lk(a, b, c, d, f, g, j) {
        var l = I(a.r, "UploadProgress"),
            l = l.va();
        l.xb = b;
        l.Uf = c;
        l.ib = d;
        l.Wa = f;
        l.ia = g;
        l.Aa = j;
        a.r.setProperty("UploadProgress", l)
    }

    function kh(a, b) {
        return 2 == a.gb() ? (L(a.e, "Cancel upload: " + b), a.Ke && a.Ke.Ve(), kk(a), a.N(0 < a.ma().Z() ? 1 : 0), b && a.qd.add(b), i) : m
    }

    function kk(a) {
        var b = a.Ke;
        b && (a.q.ea(b, "beforePackageUpload", a.Sh).ea(b, "afterPackageUpload", a.Rh).ea(b, zd, a.Th).ea(b, "progress", a.Uh), b.i(), delete a.Ke)
    }
    r.I = function (a) {
        return I(this.r, a)
    };
    r.sa = function (a, b) {
        N[a] && (b = N[a](b, this));
        this.r.setProperty(a, b)
    };
    r.e = M("au.upldr.BaseUploader");

    function $(a) {
        gk.call(this, a)
    }
    w($, gk);
    y(kb(za), function (a) {
        $.prototype["get" + a] = function () {
            return this.I(a)
        };
        $.prototype["set" + a] = function (b) {
            this.sa(a, b)
        }
    });
    r = $.prototype;
    r.Yh = function (a) {
        if (3 > this.O.Z()) return this.O.add(a);
        K(this.e, "Converter was not added. 3 converters already added.")
    };
    r.Jj = function (a) {
        return this.O.Kb(a)
    };
    r.ti = function () {
        return this.O.Z()
    };
    r.ui = function (a) {
        if (a = this.O.getItem(a)) return If(a)
    };
    r.Nj = function (a, b) {
        var c = this.O.getItem(a);
        return c ? (c.xd = Gf(b), i) : m
    };
    r.vi = function (a) {
        if (a = this.O.getItem(a)) return a.ze
    };
    r.Oj = function (a, b) {
        var c = this.O.getItem(a);
        if (c) {
            var d = b;
            if (u(d)) {
                var f = 10;
                0 == d.lastIndexOf("0x", 0) || 0 == d.lastIndexOf("0X", 0) ? (d = d.slice(2), f = 16) : 0 == d.lastIndexOf("#", 0) && (d = d.slice(1), f = 16);
                d = parseInt(d, f)
            }
            c.ze = d;
            return i
        }
        return m
    };
    r.wi = function (a) {
        if (a = this.O.getItem(a)) return a.Ae
    };
    r.Pj = function (a, b) {
        var c = this.O.getItem(a);
        return c ? (c.Ae = Hf(b), i) : m
    };
    r.xi = function (a) {
        if (a = this.O.getItem(a)) return a.Be
    };
    r.Qj = function (a, b) {
        var c = this.O.getItem(a);
        return c ? (c.Be = b, i) : m
    };
    r.zi = function (a) {
        if (a = this.O.getItem(a)) return a.De
    };
    r.Sj = function (a, b) {
        var c = this.O.getItem(a);
        return c ? (c.De = b, i) : m
    };
    r.yi = function () {
        K(this.e, "Not implemented.");
        return 0
    };
    r.Rj = function () {
        K(this.e, "Not implemented.");
        return m
    };
    r.xh = function () {
        K(this.e, "Not implemented.");
        return m
    };
    r.yh = function () {
        K(this.e, "Not implemented.");
        return m
    };
    r.Gi = function () {
        return this.l.Z()
    };
    r.kk = function (a) {
        return this.l.Kb(a)
    };
    r.jk = function () {
        this.l.clear()
    };
    r.Fi = function (a) {
        if (a = this.l.getItem(a)) return a.I(Md)
    };
    r.Xj = function (a, b) {
        var c = this.l.getItem(a);
        return c ? (Od(c, b), i) : m
    };
    r.Hi = function (a) {
        if (a = this.l.getItem(a)) return a.I(Nd)
    };
    r.Yj = function (a, b) {
        var c = this.l.getItem(a);
        return c ? (b != k && c.sa(Nd, b), i) : m
    };
    r.Ii = function (a) {
        if (a = this.l.getItem(a)) return a.I(Ld)
    };
    r.Ji = function (a) {
        if (a = this.l.getItem(a)) return a.getName()
    };
    r.Ki = function (a) {
        if (a = this.l.getItem(a)) return a.xc()
    };
    r.Li = function (a) {
        if (a = this.l.getItem(a)) return a.I(Kd)
    };
    r.Zh = function (a, b, c) {
        this.Db[a] && c ? this.Db[a].push(b) : this.Db[a] = [b];
        return i
    };
    r.Kj = function (a) {
        return this.Db.hasOwnProperty(a) ? (delete this.Db[a], i) : m
    };
    r.Ai = function () {
        K(this.e, "Not implemented.");
        return m
    };
    r.Tj = function () {
        K(this.e, "Not implemented.");
        return m
    };
    r.Bi = function () {
        K(this.e, "Not implemented.");
        return m
    };
    r.Uj = function () {
        K(this.e, "Not implemented.");
        return m
    };
    r.Di = function () {
        K(this.e, "Not implemented.");
        return m
    };
    r.Vj = function () {
        K(this.e, "Not implemented.");
        return m
    };
    r.we = function (a) {
        a != k && "" != (a += "") && this.qd.add(a)
    };
    r.Ve = function (a) {
        kh(this, a) && this.Vb(12, -1, "", I(this.r, "UploadCancelledByCancelMethodMessage"))
    };
    r.e = M("au.upldr.Uploader");
    ea("Aurigma.ImageUploaderFlash.Control.Uploader", $);
    var mk = {
        addFiles: $.prototype.Qe,
        removeFile: $.prototype.re,
        render: $.prototype.X,
        upload: $.prototype.upload,
        cancelUpload: $.prototype.Ve,
        addEventListener: $.prototype.addEventListener,
        removeEventListener: $.prototype.removeEventListener,
        addCustomField: $.prototype.Zh,
        removeCustomField: $.prototype.Kj,
        showInformationBar: $.prototype.we,
        getExtractExif: $.prototype.Ai,
        setExtractExif: $.prototype.Tj,
        getExtractIptc: $.prototype.Bi,
        setExtractIptc: $.prototype.Uj,
        getMetadataValueSeparator: $.prototype.Di,
        setMetaDataValueSeparator: $.prototype.Vj,
        addConverter: $.prototype.Yh,
        removeConverter: $.prototype.Jj,
        getConverterCount: $.prototype.ti,
        getConverterMode: $.prototype.ui,
        setConverterMode: $.prototype.Nj,
        getConverterThumbnailBgColor: $.prototype.vi,
        setConverterThumbnailBgColor: $.prototype.Oj,
        getConverterThumbnailFitMode: $.prototype.wi,
        setConverterThumbnailFitMode: $.prototype.Pj,
        getConverterThumbnailHeight: $.prototype.xi,
        setConverterThumbnailHeight: $.prototype.Qj,
        getConverterThumbnailWidth: $.prototype.zi,
        setConverterThumbnailWidth: $.prototype.Sj,
        getConverterThumbnailJpegQuality: $.prototype.yi,
        setConverterThumbnailJpegQuality: $.prototype.Rj,
        getConverterThumbnailCopyExif: $.prototype.xh,
        setConverterThumbnailCopyExif: $.prototype.xh,
        getConverterThumbnailCopyIptc: $.prototype.yh,
        setConverterThumbnailCopyIptc: $.prototype.yh,
        getUploadFileCount: $.prototype.Gi,
        uploadFileRemoveAt: $.prototype.kk,
        uploadFileRemoveAll: $.prototype.jk,
        getUploadFileAngle: $.prototype.Fi,
        setUploadFileAngle: $.prototype.Xj,
        getUploadFileDescription: $.prototype.Hi,
        setUploadFileDescription: $.prototype.Yj,
        getUploadFileHeight: $.prototype.Ii,
        getUploadFileName: $.prototype.Ji,
        getUploadFileSize: $.prototype.Ki,
        getUploadFileWidth: $.prototype.Li
    }, nk;
    for (nk in mk) mk.hasOwnProperty(nk) && ($.prototype[nk] = mk[nk]);
})();