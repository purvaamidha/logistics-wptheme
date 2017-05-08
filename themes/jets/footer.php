<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WpOpal
 * @subpackage Jets
 * @since Jets 1.0
 */
?>
		</section><!-- #main -->
		<?php do_action( 'jets_template_main_after' ); ?>
		<?php do_action( 'jets_template_footer_before' ); ?>
		<footer id="opal-footer" class="opal-footer" role="contentinfo">				
				<div class="inner">
					<?php echo jets_display_footer_content(); ?>

					<?php get_sidebar( 'mass-footer-body' );  ?>	
									
				</div>
				<div class="opal-copyright clearfix">
					<div class="container">
						<a href="#" class="scrollup"><span class="fa fa-long-arrow-up"></span></a>
						<?php do_action( 'jets_fnc_credits' ); ?>
						<?php 
							jets_display_footer_copyright();
						?>
					</div>
				</div>
		</footer><!-- #colophon -->	
		<?php do_action( 'jets_template_footer_after' ); ?>
		<?php get_sidebar( 'offcanvas' );  ?>
	</div>
</div>
	<!-- #page -->

<?php wp_footer(); ?>
</body>
</html>