<?php

require_once SCAFFOLD_LIB . "/hooks.php";
require_once SCAFFOLD_LIB . "/widgets.php";
require_once SCAFFOLD_LIB . "/thememod.php";
require_once SCAFFOLD_LIB . "/templates.php";
require_once SCAFFOLD_LIB . "/shortcodes.php";
require_once SCAFFOLD_LIB . "/walkers/drawer.php";



/**
 * Core theme functionality
 */
class scaffold_core {

	/**
	 * Single/global instance of scaffold_core
	 */
	static public $instance = null;

	/**
	 * Retrieve the singleton instance
	 */
	static public function &instance() {
		if (is_null(self::$instance)) {
			self::$instance = new scaffold_core;
		}
		return self::$instance;
	}

	/**
	 * Theme hooks accessor
	 * @var scaffold_hooks
	 */
	public $hooks = null;

	/**
	 * Theme widgets accessor
	 * @var scaffold_widgets
	 */
	public $widgets = null;

	/**
	 * Theme modifications / customizations management
	 * @var scaffold_thememod
	 */
	public $thememod = null;

	/**
	 * Loading of custom template partials.
	 * @var scaffold_templates
	 */
	public $templates = null;

	/**
	 * Shortcode management
	 * @var scaffold_shortcodes
	 */
	public $shortcodes = null;

	/**
	 * Constructor.
	 * Initialize other 
	 */
	function __construct() {
		$this->hooks = new scaffold_hooks;
		$this->widgets = new scaffold_widgets;
		$this->thememod = new scaffold_thememod;
		$this->templates = new scaffold_templates;
		$this->shortcodes = new scaffold_shortcodes;
	}
	
	/**
	 * Bootstrap / startup the theme
	 */
	public function bootstrap() {
		// Bind actions and filters
		$this->hooks->bind();
		// Setup widgets, sidebars
		$this->widgets->bind();
		// Setup theme modifications
		$this->thememod->bind();
		// Register shortcodes
		$this->shortcodes->bind();
	}

	/**
	 * Check if current user is a site admin
	 */
	public function is_admin() {
		return current_user_can('administrator');
	}

	/**
	 * Check if current user is an editor
	 */
	public function is_editor() {
		return current_user_can('editor') || current_user_can('administrator');
	}

}
