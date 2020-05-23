new WOW().init();

/*****************************************************************************
 * Drawer menu control
 *****************************************************************************/
(function($) {

    // Toggle drawer display on/off
    function toggleDrawer() {
        var body = $("html");
        var open = !body.hasClass("drawer-open");
        if (open) {
            drawerPosition();
        }
        body.toggleClass("drawer-open");
    }

    // Position the drawer menu
    // Elements with the .header-drawer CSS class are used to calculate offset position of drawer menu
    function drawerPosition() {
        // Calculate top position and height of drawer
        var h = 0;
        $(".header-drawer, #wpadminbar").each(function() {
            var n = $(this);
            if (n.is(":visible")) {
                h += n.outerHeight(); 
            }
        });
        var height = $(window).height() - h;
        $("#drawer").css({top: h, height: height });
    }

    // Event handler for toggling drawer menu
    $(function() {
        $("#toggle_drawer").on("click", function(e) {
            e.preventDefault();
            toggleDrawer();
        });
    });

    // Resize/reposition drawer on window resize
    $(window).on("resize", function() {
        drawerPosition();
    });

    // Drawer sub-menu toggle
    $(function() {
        $("li.nolink > a").on("click", function(e) {
            e.preventDefault();
            var target_menu = $(this).next(".sub-menu");
            $("li.nolink .sub-menu").each(function() {
                var menu = $(this);
                if (menu.parent().prop("id") === target_menu.parent().prop("id")) {
                    target_menu.slideToggle();
                } else {
                    menu.slideUp();
                }
            });
        });
        $(".drawer .menu-item-has-children > a").on("click", function(e) {
            e.preventDefault();
            var n = $(this);
            var submenu = n.next(".sub-menu");
            $("#drawer").addClass("is-submenu-open");
            submenu.addClass("is-open");
            $("#drawer").scrollTop(0);
        });
        $(".menu-item-back a").on("click", function(e) {
            e.preventDefault();
            var n = $(this);
            var submenu = n.closest(".sub-menu");
            $("#drawer").removeClass("is-submenu-open");
            submenu.removeClass("is-open");
        });
    });

})(jQuery);


/*****************************************************************************
 * Body classes for scrolled, below the fold
 *****************************************************************************/
(function($) {

    var wh = 0;

    var max_h = 0;

    var body = $("body");

    var st = 0;

    // Animate fixed header on scroll
    function animate_header() {
        if (st > max_h) {
            body.addClass("is-scrolled");
        } else {
            body.removeClass("is-scrolled");
        }
        if (wh && st >= wh) {
            body.addClass("below-fold");
        } else {
            body.removeClass("below-fold");
        }
        window.requestAnimationFrame(animate_header);
    }
    window.requestAnimationFrame(animate_header);

    $(window).on("load resize", function() {
        wh = $(window).height();
    });

    $(window).on("scroll", function() {
        st = $(document).scrollTop();
    });

})(jQuery);


/*****************************************************************************
 * Match Heights
 *****************************************************************************/
(function($) {

    function match_heights2(elements) {
        elements.css("height", "auto");
        setTimeout(function() {
            var h = 0;
            elements.each(function() {
                var h2 = parseInt($(this).height(), 10);
                if (!isNaN(h2) && h2 > 0) {
                    h = Math.max(h, h2);
                }
            });
            if (h > 0) {
                elements.height(h);
            }
        }, 10);
    }

    function match_heights() {
        var ftext = $(".match-heights");
        if (ftext.length < 1) {
            return false;
        }
        ftext.each(function() {
            var n = $(this);
            match_heights2($(".mh-child", n));
            match_heights2($(".mh-child2", n));
        });
        return true;
    }

    function heights_listener() {
        var has_heights = match_heights();
        if (!has_heights) {
            $(window).off("load resize", heights_listener);
            $(document).off("ready", heights_listener);
        }
    }

    $(document).on("ready", heights_listener);

    $(window).on("load resize", heights_listener);

})(jQuery);

/*****************************************************************************
 * Scroll to hash with history update
 *****************************************************************************/
function scroll_to_hash(hash, update_state) {
    var st = 0;
    if (typeof update_state === "undefined") {
        update_state = true;
    }
    if (hash) {
        var section = jQuery(hash);
        if (section.length < 1) {
            return;
        }
        st = section.offset().top - jQuery(".header-drawer").height() - jQuery("#wpadminbar").height();
    }
    if (jQuery.fn.magnificPopup) {
        jQuery.magnificPopup.close();
    }
    jQuery('html, body').animate({
        scrollTop: st
    }, 450, 'swing', function() {
        if (update_state && document.location.hash !== hash) {
            history.pushState({}, "", hash);
        }              
    });
}

(function($) {
    $(function() {
        $("a[href^='#']:not([href='#'])").click(function(e) {
            e.preventDefault();
            scroll_to_hash(this.hash);
        });
        window.onpopstate = function(e) {
            scroll_to_hash(document.location.hash);
        };
    });
})(jQuery);

/*****************************************************************************
 * Animate.css trigger via JavaScript
 *****************************************************************************/
function scaffoldAnimateCSS(element, animationName, callback) {
    const node = document.querySelector(element)
    if (!node) {
        return;
    }
    node.classList.add('animated', animationName)

    function handleAnimationEnd() {
        node.classList.remove('animated', animationName)
        node.removeEventListener('animationend', handleAnimationEnd)

        if (typeof callback === 'function') callback()
    }

    node.addEventListener('animationend', handleAnimationEnd)
}

/*****************************************************************************
 * Responsive background image
 *****************************************************************************/
(function($) {

    var bgs = false;

    function init_bgs() {
        if (!bgs) {
            bgs = $(".responsive-bgimg");
            if (bgs.length > 0) {
                $(window).on("resize", draw_bgs);
            }
        }
    }

    function draw_bgs() {
        var ww = $(window).width();
        bgs.each(function() {
            draw_single($(this), ww);            
        });
    }

    function draw_single(bg, ww) {
        var breakpoint = bg.data("breakpoint");
        if (!breakpoint) {
            breakpoint = 767;
        }
        var k = ww > breakpoint ? "bgDesktop" : "bgMobile";
        var url = bg.data(k);
        var url_style;
        if (url) {
            url_style = "url('" + url + "')";
        } else {
            url_style = "unset";
        }
        bg.css("background-image", url_style);
    }

    $(function() {
        init_bgs();
        draw_bgs();
    });

})(jQuery);