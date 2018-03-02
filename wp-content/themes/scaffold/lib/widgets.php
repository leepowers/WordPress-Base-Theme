<?php

require_once SCAFFOLD_LIB . "/widgets/posts-grid.php";


class scaffold_widgets {

	/**
	 * Hook widgets into WordPress
	 */
	public function bind() {
		add_action("widgets_init", array(&$this, "register"));
	}

	/**
	 * Register widgets and sidebars
	 */
	public function register() {
		// Sidebars
		for ($i = 1; $i <= SCAFFOLD_FOOTER_COLUMNS; $i++) {
			register_sidebar(array(
				"name" => "Footer #$i",
				"id" => "scaffold_footer_$i",
				"before_widget" => '<div id="%1$s" class="scaffold-Widget widget %2$s">',
				"after_widget" => '</div>',
				"before_title" => '<h6 class="scaffold-WidgetTitle">',
				"after_title" => '</h6>',
			));
		}
		// Widgets
		register_widget("scaffold_widgets_posts_grid");
	}

}