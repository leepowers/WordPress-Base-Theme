<?php

/**
 * General hooks for theme.
 * For setting up WordPress actions, filters that are theme related.
 */
class scaffold_hooks {

	/**
	 * Bind to actions and filters
	 */
	public function bind() {
		// Enqueue the very first CSS and JavaScript (such as a CSS reset)
		add_action("wp_enqueue_scripts", array(&$this, "ui_resources_first"), 1);
		// Enqueue the very last CSS and JavaScript (such as any CSS to override)
		add_action("wp_enqueue_scripts", array(&$this, "ui_resources_last"), PHP_INT_MAX - SCAFFOLD_UI_PRECEDENCE);
		// Enqueue admin dashboard scripts and styles last
		add_action("admin_enqueue_scripts", array(&$this, "ui_admin_last"), PHP_INT_MAX - SCAFFOLD_UI_PRECEDENCE);
		// Add featured image support for posts and pages
		add_theme_support("post-thumbnails", array("post", "page"));
		// Register/setup navigation menus
		add_action("after_setup_theme", array(&$this, "setup_menus"));
		// Enable SVG uploads
		add_filter("upload_mimes", array(&$this, "upload_types"));
		// Disable emojis
		add_action("init", array(&$this, "remove_emoji_filters"));
		// Disable big image scaling
		add_filter("big_image_size_threshold", "__return_false");
        // Setup image sizes
		$this->image_sizes();
		// ACF option pages
		$this->acf_option_pages();
	}

	/**
	 * Disable emoji character subs
	 */
	public function remove_emoji_filters() {
		remove_filter("the_content", "convert_smilies", 20);
		remove_filter("acf_the_content", "convert_smilies", 20);
	}

	/**
	 * Enable SVG file uploads
	 */
	public function upload_types($mimes) {
		$mimes["svg"] = "image/svg+xml";
		return $mimes;
	}

	/**
	 * Setup first UI resources (CSS, JavaScript)
	 * - Enqueue CSS reset
	 * - Enqueue jQuery
	 */
	public function ui_resources_first() {
		wp_enqueue_script("jquery");
		wp_enqueue_style("scaffold-reset", SCAFFOLD_URL_CSS . "/reset.css", array(), SCAFFOLD_VERSION);
	}

	/**
	 * Setup final UI resources (CSS, JavaScript)
	 * - Magnific Lightbox
	 * - LazySizes
	 * - Owl Carousel
	 * - Match Heights
	 * - Enqueue CSS overrides last (main theme styles)
	 */
	public function ui_resources_last() {
		// Theme scripts and styles
		wp_enqueue_script("lazysizes", SCAFFOLD_URL . "/ui/js/lazysizes.min.js", array("jquery"), "v3.0.0-rc2", true);
		wp_enqueue_script("wowjs", SCAFFOLD_URL_JS . "/wow.js", array("jquery"), "1.1.3", true);
		wp_enqueue_script("slick-slider", SCAFFOLD_URL . "/ui/slick/slick.js", array("jquery"), "1.8.1", true);
		wp_enqueue_script("select2", SCAFFOLD_URL . "/ui/select2/select2.full.js", array("jquery"), "4.0.6-rc.0", true);
		wp_enqueue_style("animate-css", SCAFFOLD_URL_CSS . "/animate.css", array(), "3.7.0");
		wp_enqueue_style("slick-slider", SCAFFOLD_URL . "/ui/slick/slick.css", array(), "1.8.1");
		wp_enqueue_style("slick-theme", SCAFFOLD_URL . "/ui/slick/slick-theme.css", array(), "1.8.1");
		wp_enqueue_style("select2", SCAFFOLD_URL . "/ui/select2/select2.min.css", array(), "4.0.6-rc.0");
		wp_enqueue_style("scaffold-grid", SCAFFOLD_URL_CSS . "/grid.css", array(), SCAFFOLD_VERSION);
		wp_enqueue_style("scaffold", SCAFFOLD_URL_CSS . "/theme.css", array(), SCAFFOLD_VERSION);
		wp_enqueue_script("fontawesome", "https://kit.fontawesome.com/67c1442228.js", array(), null, true);
		wp_enqueue_script("scaffold", SCAFFOLD_URL_JS . "/theme.js", array("jquery"), SCAFFOLD_VERSION, true);
		wp_localize_script("scaffold", "ajaxurl", admin_url("admin-ajax.php"));
	}

	/**
	 * Setup final UI resources for admin dashboard. 
	 */
	public function ui_admin_last($hook = "") {
		if ($hook === "widgets.php") {
			// Add any widget management specific resources
		} 
		wp_enqueue_style("scaffold", SCAFFOLD_URL_CSS . "/theme.admin.css", array(), SCAFFOLD_VERSION);
		wp_enqueue_script("scaffold", SCAFFOLD_URL_JS . "/theme.admin.js", array("jquery"), SCAFFOLD_VERSION, true);
	}

	/**
	 * Setup custom menus
	 */
	public function setup_menus() {
		register_nav_menus(array(
			"primary" => __("Primary Menu", "scaffold"),
		));
	}

	/**
	 * Setup custom image sizes
	 */
	public function image_sizes() {
		/*
		add_image_size("custom-size", 160, 160, true);
		set_post_thumbnail_size(160, 160, true);  // Default thumbnail size
		*/
	}

	/**
	 * Setup theme option pages
	 */
	public function acf_option_pages() {
		if (function_exists("acf_add_options_page")) {
			acf_add_options_sub_page(array(
				"page_title" => __("Scaffold Settings", "scaffold"),
				"menu_title" => __("Scaffold", "scaffold"),
				"parent_slug" => "options-general.php",
			));
		}
	}

}