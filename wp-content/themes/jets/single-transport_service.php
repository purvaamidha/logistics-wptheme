<?php
/**
 * The Template for displaying all single posts
 *
 * @package WpOpal
 * @subpackage Jets
 * @since Jets 1.0
 */

$jets_page_layouts = apply_filters( 'jets_fnc_get_service_sidebar_configs', null );
get_header( apply_filters( 'jets_fnc_get_header_layout', null ) );

?>
<?php do_action( 'jets_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters( 'jets_template_main_content_class',  'container' ); ?>">
	<div class="row">
		<?php if( isset($jets_page_layouts['sidebars']) && !empty($jets_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
		<div id="main-content" class="main-content col-sm-12 <?php echo esc_attr($jets_page_layouts['main']['class']); ?>">

			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();
							 echo Opaltransport_Template_Loader::get_template_part( 'content-single-service' );
						endwhile;
					?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>	

	</div>	
</section>
<?php
get_footer();
