// Backend js function for support admin functions with plugin.
"use strict";
var wlnca = jQuery.noConflict();
wlnca(window).on('load', function () {
    wlnca(function (wlnca) {
        "use strict";
        wlnca(function () {
            wlnca('#wk_wc_fb_messenger_theme_color').wpColorPicker();
            wlnca('#wk-wc-page-option').select2();
        });
    });
});
