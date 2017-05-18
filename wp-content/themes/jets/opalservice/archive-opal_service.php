	<?php
/**
 * The template for displaying Category pages
 *
 * @link http://www.wpopal.com/theme/jets/
 *
 * @package WpOpal
 * @subpackage Crewservice
 * @since Crewservice 1.0
 */

$jets_page_layouts = apply_filters( 'jets_fnc_get_archive_service_sidebar_configs', null );

get_header( apply_filters( 'jets_fnc_get_header_layout', null ) );


$column = opalservice_get_option('column_service') ? opalservice_get_option('column_service') : 3;
$colclass = floor(12/$column); 
$showmode = opalservice_get_option('service_view') ? opalservice_get_option('service_view') : "grid"; 
//test
?>
<?php do_action( 'jets_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters('jets_template_main_container_class','container');?> inner <?php echo jets_fnc_theme_options('blog-archive-layout') ; ?>">
	<div class="row">

		<?php if( isset($jets_page_layouts['sidebars']) && !empty($jets_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
		
		<div id="main-content" class="main-content  col-sm-12 <?php echo esc_attr($jets_page_layouts['main']['class']); ?>">
			<div id="primary" class="content-area">
			 	<div id="content" class="site-content" role="main">
			 				<?php if ( have_posts() ) : ?>

								<div class="service-archive-services">
									<div class="row">
									<?php $cnt=0; while ( have_posts() ) : the_post();
											$cls = '';

											if( $cnt++%$column==0 ){
												$cls .= ' first-child';
											}
											if ($showmode == "grid") : ?>
											<div class="col-lg-<?php echo esc_attr($colclass); ?> col-md-<?php echo esc_attr($colclass); ?> col-sm-<?php echo esc_attr($colclass); ?> <?php echo esc_attr($cls); ?>">
												<?php echo Opalservice_Template_Loader::get_template_part( 'content-service-grid', array('number' => $cnt) ); ?>
											</div>
											<?php else: ?>
												<div class="col-md-12">
											   <?php echo Opalservice_Template_Loader::get_template_part( 'content-service-list' ); ?>
											   </div>
											<?php endif; ?>
										<?php endwhile; ?>
									</div>
								</div>
								<?php  jets_fnc_paging_nav(); ?>
							<?php else : ?>
								<?php echo Opalservice_Template_Loader::get_template_part( 'content-data-none' ); ?>
							<?php endif; ?>

					 
				</div><!-- #content -->
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
		</div><!-- #main-content -->
	</div>	
</section>
<?php
get_footer();
 
 