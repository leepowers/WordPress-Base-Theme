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
		// Set the mail from email address
		add_filter("wp_mail_from", array(&$this, "email_from"));
		// Set the mail from name
		add_filter("wp_mail_from_name", array(&$this, "email_from_name"));
		// Remove the inline admin bar styles, when not compatible with this theme.
		#add_theme_support("admin-bar", array("callback" => "__return_false"));
		// Register/setup navigation menus
		add_action("after_setup_theme", array(&$this, "setup_menus"));
        // Setup image sizes
		$this->image_sizes();
	}

	/**
	 * Email sender (from address)
	 */
	public function email_from($from) {
		$from2 = get_theme_mod("scaffold_email_from");
		if (empty($from2)) {
			return $from;
		} else {
			return $from2;
		}
	}

	/**
	 * Email sender name (from name)
	 */
	public function email_from_name($from_name) {
		$from2 = get_theme_mod("scaffold_email_from_name");
		if (empty($from2)) {
			return $from_name;
		} else {
			return $from2;
		}
	}

	/**
	 * Callback for setting the content type of emails to HTML
	 */
	public function mail_content_type($content_type) {
		return "text/html";
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
		wp_enqueue_script("magnific", SCAFFOLD_URL . "/ui/magnific/jquery.magnific-popup.js", array("jquery"), "0.9.9", true);
		wp_enqueue_script("lazysizes", SCAFFOLD_URL . "/ui/js/lazysizes.min.js", array("jquery"), "v3.0.0-rc2", true);
		wp_enqueue_script("match-height", SCAFFOLD_URL . "/ui/js/jquery.matchHeight-min.js", array("jquery"), "v0.5.2", true);
		wp_enqueue_script("owl", SCAFFOLD_URL . "/ui/owl/owl.carousel.js", array("jquery"), "2.2.0", true);
		wp_enqueue_style("owl", SCAFFOLD_URL . "/ui/owl/assets/owl.carousel.css", array(), "2.2.0");
		wp_enqueue_style("owl-theme", SCAFFOLD_URL . "/ui/owl/assets/owl.theme.default.css", array(), "2.2.0");
		wp_enqueue_style("scaffold", SCAFFOLD_URL_CSS . "/theme.css", array(), SCAFFOLD_VERSION);
		wp_enqueue_style("magnific", SCAFFOLD_URL . "/ui/magnific/magnific-popup.css", array("scaffold"), "0.9.9");
		wp_enqueue_script("scaffold", SCAFFOLD_URL_JS . "/theme.js", array("jquery"), SCAFFOLD_VERSION, true);
		wp_localize_script("scaffold", "ajaxurl", admin_url("admin-ajax.php"));
		wp_enqueue_style("font-awesome", SCAFFOLD_URL_CSS . "/font-awesome.css", array(), "4.6.3");
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

}