<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WpOpal
 * @subpackage Jets
 * @since Jets 1.0
 */

$jets_page_layouts = apply_filters( 'jets_fnc_get_page_sidebar_configs', null );

get_header( apply_filters( 'jets_fnc_get_header_layout', null ) );
?>
<?php do_action( 'jets_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters('jets_template_main_content_class','container');?> inner">
	<div class="row">
		<?php if( isset($jets_page_layouts['sidebars']) && !empty($jets_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>	
		<div id="main-content" class="main-content col-xs-12 <?php echo esc_attr($jets_page_layouts['main']['class']); ?>">
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							// Include the page content template.
							get_template_part( 'content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						endwhile;
					?>

				</div><!-- #content -->
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
			
		</div><!-- #main-content -->
		
	</div>	
</section>
<?php
get_footer();