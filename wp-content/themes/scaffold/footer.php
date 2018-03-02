
	<footer class="scaffold-u-block footer-main">
		<div class="page-wrap">
			<div class="scaffold-u-block footer-cols">
				<?php
					for ($i = 1; $i <= SCAFFOLD_FOOTER_COLUMNS; $i++) {
						$footer_col_id = "scaffold_footer_$i";
						if (is_active_sidebar($footer_col_id)) {
				?>
				<div class="footer-col col-<?php echo $i; ?>"><?php dynamic_sidebar($footer_col_id); ?></div>
				<?php
						}
					}
				?>
			</div>
			<div class="scaffold-u-block footer-copyright">
				<?php dynamic_sidebar("scaffold_copyright"); ?>
			</div>
		</div>
	</footer>

	<a href="#top" class="scaffold-back-to-top" id="scaffold_to_top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>


<?php wp_footer(); ?>
</body>
</html>