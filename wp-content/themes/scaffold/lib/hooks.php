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
        // Setup image sizes
		$this->image_sizes();
		// ACF option pages
		$this->acf_option_pages();
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
		wp_enqueue_style("fontawesome", "https://use.fontawesome.com/releases/v5.8.1/css/all.css", array(), null);
		wp_enqueue_style("scaffold-grid", SCAFFOLD_URL_CSS . "/grid.css", array(), SCAFFOLD_VERSION);
		wp_enqueue_style("scaffold", SCAFFOLD_URL_CSS . "/theme.css", array(), SCAFFOLD_VERSION);
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