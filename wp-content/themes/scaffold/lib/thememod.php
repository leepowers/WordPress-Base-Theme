<?php

/**
 * Manage theme modification settings using the WordPress Customization API: https://codex.wordpress.org/Theme_Customization_API
 */
class scaffold_thememod {

	/**
	 * Bind into WordPress
	 */
	public function bind() {
		// Register our theme modifications customizations
		add_action("customize_register", array(&$this, "register"));
		// Output any custom CSS
		add_action("wp_head", array(&$this, "output_styles"), PHP_INT_MAX - SCAFFOLD_UI_PRECEDENCE);
	}

	public function register() {
		global $wp_customize;
		/**
		 * Header
		 */
		$wp_customize->add_section("scaffold_header", array(
			"title" => __("Header", "scaffold"),
			"description" => "",
			"panel" => "",
			"priority" => 10,
			"capability" => "edit_theme_options",
		));
		// Site logo
		$wp_customize->add_setting("scaffold_logo", array(
			"sanitize_callback" => "esc_attr"
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control($wp_customize, "scaffold_logo_image", array(
				"label" => __("Select a Logo", "scaffold"),
				"section" => "scaffold_header",
				"settings" => "scaffold_logo",
			))
		);
	}

	/**
	 * Generate CSS styles based on thememods
	 */
	public function generate_styles() {
		$settings = array(
			/*
			array(
				"name" => "setting_name",
				"format" => "#my_seelctor { background-color: %1\$s; }",
			),
			*/
		);
		$styles = array();
		foreach ($settings as $setting) {
			$value = get_theme_mod($setting["name"]);
			if ($value) {
				$styles[]= sprintf($setting["format"], $value);
			}
		}
		return implode("\n", $styles);
	}

	/**
	 * Output any styles genereated from the thememods
	 */
	public function output_styles() {
		$styles = $this->generate_styles();
		if ($styles) {
			echo("\n<style type=\"text/css\">\n");
			echo($styles);
			echo("\n</style>\n");
		}
	}
}

