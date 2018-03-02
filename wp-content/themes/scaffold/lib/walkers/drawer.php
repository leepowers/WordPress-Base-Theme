<?php

class scaffold_walker_drawer extends Walker_Nav_Menu {

	static public $dupe_link = false;

	static public $last_item = null;

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if (self::$dupe_link && self::$last_item) {
			self::$dupe_link = false;
			$output .= sprintf('<li class="menu-item"><a href="%s"><strong>%s</strong></a></li>' . "\n", self::$last_item->url, self::$last_item->title);
		}
		$mi_html = "";
		parent::start_el($mi_html, $item, $depth, $args, $id);
		if (in_array("menu-item-has-children", $item->classes)) {
			$mi_html = str_replace("</a>", "&nbsp;&raquo;</a>", $mi_html);
		}
		$output .= $mi_html;
		self::$last_item = $item;
	}

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		self::$dupe_link = true;
		$html = "";
		parent::start_lvl($html, $depth, $args);
		$output .= $html;
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		self::$dupe_link = false;
		$output .= '<li class="menu-item menu-item-back"><a href="javascript:;">&laquo; Back</a></li>' . "\n"; 
		$html = "";
		parent::end_lvl($html, $item, $depth, $args, $id);
		$output .= $html;
	}

}