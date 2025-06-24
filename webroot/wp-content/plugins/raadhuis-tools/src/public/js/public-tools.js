(function ($) {
    'use strict';

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1e3);
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(";");
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == " ")
                c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0)
                return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Enable Raadhuis tool
    function enableRaadhuisTool(btn_class, btn_tooltip, cookie_name, toggle_element) {
        jQuery(btn_class).addClass("active");
        jQuery(toggle_element).removeClass("rt-hidden");
        jQuery(btn_class).attr("data-tooltip", btn_tooltip);
        setCookie(cookie_name, "1", 7);
    }

    // Disable Raadhuis tool
    function disableRaadhuisTool(btn_class, btn_tooltip, cookie_name, toggle_element) {
        jQuery(btn_class).removeClass("active");
        jQuery(toggle_element).addClass("rt-hidden");
        jQuery(btn_class).attr("data-tooltip", btn_tooltip);
        setCookie(cookie_name, "0", 7);
    }

    jQuery(function ($) {
        var qtSmoothing = getCookie("qtSmoothing");
        var qtGrid = getCookie("qtGrid");
        var qtBreakpoints = getCookie("qtBreakpoints");

        if (qtGrid == "1") {
            enableRaadhuisTool(".raadhuis-tools-grid", "Grid verbergen", "qtGrid", "#raadhuis-tools-grid");
        } else {
            disableRaadhuisTool(".raadhuis-tools-grid", "Grid tonen", "qtGrid", "#raadhuis-tools-grid");
        }

        if (qtBreakpoints == "1") {
            enableRaadhuisTool(".raadhuis-tools-breakpoints", "Breakpoints verbergen", "qtBreakpoints", "#raadhuis-tools-breakpoints");
        } else {
            disableRaadhuisTool(".raadhuis-tools-breakpoints", "Breakpoints tonen", "qtBreakpoints", "#raadhuis-tools-breakpoints");
        }

        if (qtSmoothing == "1") {
            enableRaadhuisTool(".raadhuis-tools-smoothing", "Font-smoothing inschakelen", "qtSmoothing", "#raadhuis-tools-smoothing");
            jQuery("body").removeClass("raadhuis-tools-antialiased");
            jQuery("body").addClass("raadhuis-tools-subpixel-antialiased");
        } else {
            disableRaadhuisTool(".raadhuis-tools-smoothing", "Font-smoothing uitschakelen", "qtSmoothing", "#raadhuis-tools-smoothing");
            jQuery("body").addClass("raadhuis-tools-antialiased");
            jQuery("body").removeClass("raadhuis-tools-subpixel-antialiased");
        }

        var toggleToolbar = document.querySelectorAll(".toggle-toolbar");
        var stickyToolbarContainer = document.querySelector(
            ".raadhuis-tools-toolbar-container"
        );

        toggleToolbar.forEach(function (element) {
            element.addEventListener("click", function () {
                stickyToolbarContainer.classList.toggle("show-toolbar");
            });
        });

        jQuery(".raadhuis-tools-grid").on("click", function (e) {
            e.preventDefault();
            if (jQuery(".raadhuis-tools-grid").hasClass("active")) {
                disableRaadhuisTool(".raadhuis-tools-grid", "Grid tonen", "qtGrid", "#raadhuis-tools-grid");
            } else {
                enableRaadhuisTool(".raadhuis-tools-grid", "Grid verbergen", "qtGrid", "#raadhuis-tools-grid");
            }
        });

        jQuery(".raadhuis-tools-breakpoints").on("click", function (e) {
            e.preventDefault();
            if (jQuery(".raadhuis-tools-breakpoints").hasClass("active")) {
                disableRaadhuisTool(".raadhuis-tools-breakpoints", "Breakpoints tonen", "qtBreakpoints", "#raadhuis-tools-breakpoints");
            } else {
                enableRaadhuisTool(".raadhuis-tools-breakpoints", "Breakpoints verbergen", "qtBreakpoints", "#raadhuis-tools-breakpoints");
            }
        });

        jQuery(".raadhuis-tools-smoothing").on("click", function (e) {
            e.preventDefault();
            if (jQuery(".raadhuis-tools-smoothing").hasClass("active")) {
                disableRaadhuisTool(".raadhuis-tools-smoothing", "Font-smoothing uitschakelen", "qtSmoothing", "#raadhuis-tools-smoothing");
                jQuery("body").addClass("raadhuis-tools-antialiased");
                jQuery("body").removeClass("raadhuis-tools-subpixel-antialiased");
            } else {
                enableRaadhuisTool(".raadhuis-tools-smoothing", "Font-smoothing inschakelen", "qtSmoothing", "#raadhuis-tools-smoothing");
                jQuery("body").removeClass("raadhuis-tools-antialiased");
                jQuery("body").addClass("raadhuis-tools-subpixel-antialiased");
            }
        });
    });

})(jQuery);
