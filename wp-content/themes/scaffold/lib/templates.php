<?php

/**
 * Class for template loading / rendering.
 */
class scaffold_templates {

	/**
	 * Number of layout panes rendered on current page
	 */
	static public $layout_count = 0;

	/**
	 * Load a template file, render, and return as a string
	 * @param string $filename
	 * @param array $data
	 * @return string
	 */
	public function render($filename, array $data = null) {
		ob_start();
		$this->load($filename, $data);
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	/**
	 * Locate a template file.
	 * Search first in template, then in plugin template directory at SCAFFOLD_TEMPLATE_DIR
	 * @param string $filename
	 * @return string
	 */
	public function locate($filename) {
		$path = locate_template($filename);
		if ($path) {
			return $path;
		} else {
			$path = SCAFFOLD_TEMPLATE_DIR . "/$filename";
			if (is_readable($path) && is_file($path)) {
				return $path;
			}
		}
		return "";
	}

	/**
	 * Load a template file and output 
	 * @param string $filename
	 * @param array $data
	 */
	public function load($_template_filename, array $data = null) {
		$_template_path = $this->locate($_template_filename);
		if ($_template_path) {
			if ($data) {
				// Export data into the current scope
				foreach ($data as $vname => $vval) {
					$v2 = $this->variableize($vname);
					$$v2 = $vval;
				}
			}
			include($_template_path);
		} else {
			echo("Unable to locate template with filename '$_template_filename'");
		}
	}

	/**
	 * Transform a string into a safe variable name.
	 * @param string $s
	 * @return string
	 */
	public function variableize($s) {
		return preg_replace('/[^a-zA-Z0-9_]+/', '_', $s);
	}

	/**
	 * Replace `<br>` with responsive line breaks
	 */
	public function br2lb($str, $classname = "lb") {
		return str_replace(array("<br>", "<br/>", "<br />"), '<span class="' . $classname . '"></span>', $str);
	}
	
	/**
	 * Format an ACF link
	 * - 1: link
	 * - 2: target
	 * - 3: additional attributes
	 * - 4: link content
	 */
	public function format_acf_link($args, $format = '<a href="%1$s"%2$s%3$s>%4$s</a>') {
		$link = shortcode_atts(array(
			"url" => "",
			"target" => "",
			"attributes" => "",
			"content" => "",
		), $args);
		if (isset($args["title"]) && $args["title"] && empty($link["content"])) {
			$link["content"] = $args["title"];
		}
		$data = array(
			$link["url"],
			$link["target"] ? sprintf(' target="%s"', $link["target"]) : "",
			$link["attributes"] ? (" " . $link["attributes"]) : "",
			$link["content"]
		);
		return vsprintf($format, $data);
	}


}