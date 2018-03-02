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
 * Animate fixed header on scroll
 *****************************************************************************/
(function($) {

    var wh = 0;

    var max_h = 0;

    // Animate fixed header on scroll
    function animate_header() {
        var st = $(document).scrollTop();
        if (max_h === 0) {
            max_h = $("body").hasClass("post-type-archive-product") ? 45 : 90;
        }
        if (st > max_h && $(document).outerWidth() > 960) {
            $("#header_top").addClass("compress");
            $("body").addClass("compressed-header");
        } else {
            $("#header_top").removeClass("compress");
            $("body").removeClass("compressed-header");
        }
        if (wh && st >= wh) {
            $("body").addClass("below-fold");
        } else {
            $("body").removeClass("below-fold");
        }
        window.requestAnimationFrame(animate_header);
    }
    window.requestAnimationFrame(animate_header);

    $(window).on("load resize", function() {
        wh = $(window).height();
    });

    $(function() {
        $("#scaffold_to_top").on("click", function(e) {
            e.preventDefault();
            $('html, body').animate(
                {
                    scrollTop: 0
                },
                500,
                function() {

                }
            );
        });
    });

})(jQuery);