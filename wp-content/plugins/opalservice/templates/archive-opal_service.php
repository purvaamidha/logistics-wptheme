	<?php
/**
 * The template for displaying Category pages
 *
 * @link http://www.wpopal.com/theme/crewtransport/
 *
 * @package WpOpal
 * @subpackage Crewservice
 * @since Crewservice 1.0
 */

get_header();


$column = opalservice_get_option('column_service') ? opalservice_get_option('column_service') : 3;
$colclass = floor(12/$column); 
$showmode = opalservice_get_option('service_view') ? opalservice_get_option('service_view') : "grid"; 
//test
?>
<section id="main-container" class="container">
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
		<?php  opalservice_pagination(); ?>
		<?php else : ?>
			<?php echo Opalservice_Template_Loader::get_template_part( 'content-data-none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar( 'content' ); ?>
</section>
<?php
get_footer();

