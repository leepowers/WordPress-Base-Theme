<?php
$core = scaffold_core::instance();
$home_url = esc_attr(home_url());
$blogname = esc_attr(get_bloginfo("name"));
$blogdescription = esc_attr(get_bloginfo("description"));
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title(" | ", true, "right"); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<style type="text/css">
		<?php echo $core->thememod->generate_styles(); ?>
	</style>
</head>
<body <?php body_class(array("scaffold-js-wait", "bootstrap-wrapper")); ?>>
	<div class="drawer" id="drawer">
		<div class="drawer-menu nav-drawer-menu">
			<?php
				wp_nav_menu(array(
					"theme_location" => "primary",
					"container" => "",
					"walker" => new scaffold_walker_drawer,
				));
			?>
		</div>
	</div>
	<header class="main header-drawer scaffold-u-block">
		<div class="page-wrap">
			<div class="scaffold-u-block">
			<?php
				$logo_url = get_theme_mod("scaffold_logo");
				if ($logo_url) {
			?>
			<a href="<?php echo $home_url; ?>" class="logo"><span class="valign1"><span class="valign2"><img src="<?php echo $logo_url; ?>" alt="<?php echo $blogname; ?>"></span></span></a>
			<?php
				}
			?>
			<nav class="nav-header" id="nav_header">
			<?php
				wp_nav_menu(array(
					"theme_location" => "primary",
					"container" => ""
				));
			?>
			</nav>
			<div class="drawer-trigger">
				<a href="javascript:;" class="drawer-button" id="toggle_drawer">
				<span class="toggle-label"><?php _e("Toggle drawer menu", "scaffold"); ?></span>
					<span class="drawer-button-align">
						<span class="drawer-button-closed">
							<i class="fa fa-bars" aria-hidden="true"></i>
						</span>
						<span class="drawer-button-opened">
							<i class="fa fa-times" aria-hidden="true"></i>
						</span>
					</span>
				</a>
			</div>
			</div>
		</div>
	</header>
	<div class="header-spacer scaffold-u-block" id="top"></div>

