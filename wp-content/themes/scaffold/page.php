<?php
/** 
 * Render page content
 */
get_header();
if (have_posts()) {
    while (have_posts()) {
        the_post();
        get_template_part("content", "page");
    }
} else {
    get_template_part("content", "none");
}
get_footer();