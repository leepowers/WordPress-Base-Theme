<?php

/**
 * Write to PHP error log
 */
function scaffold_log() {
	$args = func_get_args();
	foreach ($args as $arg) {
		$msg = print_r($arg, true);
		error_log($msg);
	}
}

/**
 * Dump debug messages to front-end
 */
function scaffold_dump() {
	$args = func_get_args();
	foreach ($args as $arg) {
		printf("<pre>\n%s\n</pre>\n", print_r($arg, true));
	}
}

/**
 * Main code control for theme
 */
require_once "constants.php";
require_once SCAFFOLD_LIB . "/core.php";
scaffold_core::instance()->bootstrap();



/**
 * Add quick-collapse feature to ACF Flexible Content fields
 */
add_action('acf/input/admin_head', function() { ?>
    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                var collapseButtonClass = 'collapse-all';

                // Add a clickable link to the label line of flexible content fields
                $('.acf-field-flexible-content > .acf-label')
                    .append('<a class="' + collapseButtonClass + '" style="position: absolute; top: 0; right: 0; cursor: pointer;">Collapse All</a>');

                // Simulate a click on each flexible content item's "collapse" button when clicking the new link
                $('.' + collapseButtonClass).on('click', function() {
                    $('.acf-flexible-content .layout:not(.-collapsed) .acf-fc-layout-controls .-collapse').click();
                });
            });
        })(jQuery);
    </script><?php
});