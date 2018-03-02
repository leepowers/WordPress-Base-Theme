<?php get_header(); ?>

<div class="scaffold-u-block scaffold-MainContent">
	<div class="scaffold-u-wrap is-default">
		<?php
		if (have_posts()) {
			while (have_posts()) {
				the_post();
			?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php
				get_template_part("content", get_post_format());
			}
		} else {
			get_template_part("content", "none");
		}
		?>
	</div>
</div>

<?php get_footer();