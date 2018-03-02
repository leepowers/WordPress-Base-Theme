<?php

/**
 * Theme constants.
 * Pluggable
 */

if (!defined("SCAFFOLD_VERSION")) {
	/**
	 * Current plugin version
	 * @var string
	 */
	define("SCAFFOLD_VERSION", "0.0.1");
}

if (!defined("SCAFFOLD_FOOTER_COLUMNS")) {
	/**
	 * Number of footer columns to register as sidebars.
	 * @var string
	 */
	define("SCAFFOLD_FOOTER_COLUMNS", 4);
}

if (!defined("SCAFFOLD_UI_PRECEDENCE")) {
	/**
	 * Set importance, precedence of this theme's UI resources (JavaScript, CSS), 
	 * relative to others. Lower numbers are loaded first.
	 * Used during script/style enqueue - this number is subtracted fro PHP_INT_MAX
	 * Use to ensure theme styles are loaded after everything else, so they can cascade (override) any other 
	 * parent theme or plugin styles
	 * @var string
	 */
	define("SCAFFOLD_UI_PRECEDENCE", 99999);
}

if (!defined("SCAFFOLD_DIR")) {
	/**
	 * Absolute path to theme directory
	 * @var string
	 */
	define("SCAFFOLD_DIR", get_template_directory());
}

if (!defined("SCAFFOLD_LIB")) {
	/**
	 * Absolute path to theme library directory
	 * @var string
	 */
	define("SCAFFOLD_LIB", SCAFFOLD_DIR . "/lib");
}

if (!defined("SCAFFOLD_TEMPLATE_DIR")) {
	/**
	 * Absolute path to additional templates
	 * @var string
	 */
	define("SCAFFOLD_TEMPLATE_DIR", SCAFFOLD_DIR . "/templates");
}

if (!defined("SCAFFOLD_URL")) {
	/**
	 * Absolute URL to theme directory
	 * @var string
	 */
	define("SCAFFOLD_URL", get_template_directory_uri());
}

if (!defined("SCAFFOLD_URL_CSS")) {
	/**
	 * Absolute URL to theme CSS directory
	 * @var string
	 */
	define("SCAFFOLD_URL_CSS", SCAFFOLD_URL . "/ui/css");
}

if (!defined("SCAFFOLD_URL_JS")) {
	/**
	 * Absolute URL to theme Javascript directory
	 * @var string
	 */
	define("SCAFFOLD_URL_JS", SCAFFOLD_URL . "/ui/js");
}

if (!defined("SCAFFOLD_URL_IMG")) {
	/**
	 * Absolute URL to theme images directory
	 * @var string
	 */
	define("SCAFFOLD_URL_IMG", SCAFFOLD_URL . "/ui/img");
}

