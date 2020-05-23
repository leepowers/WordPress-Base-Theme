<?php
/**
 * Include file for rendering page layouts.
 * 'require()' or 'include()' in WordPress template files. 
 * Always outputs any editor content.
 */
$core = scaffold_core::instance();
$page_layout = get_field("scaffold_page_layout");
if (empty($page_layout)) {
	the_content();
	return;
}
foreach ($page_layout as $layout) {
	scaffold_templates::$layout_count++;
	$template_name = sprintf("layouts/%s.php", $layout["acf_fc_layout"]);
	$l = $layout;
	if (!isset($l["attributes"])) {
		$l["attributes"] = array();
	}
	echo $core::instance()->templates->render($template_name, $l);
}