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

$jets_page_layouts = apply_filters( 'jets_fnc_get_woocommerce_sidebar_configs', null );

get_header( apply_filters( 'jets_fnc_get_header_layout', null ) );

if( is_singular('product') ) {
 $bgimage = jets_fnc_theme_options( 'woocommerce-single-breadcrumb' ); 
 $style = array();
 if( $bgimage  ){ 
  $style[] = 'background-image:url(\''. $bgimage .'\')';
 }
 $estyle = !empty($style)? 'style="'.implode(";", $style).'"':"";
}
if ( !isset($estyle) || !$estyle ) {
 $bgimage = jets_fnc_theme_options( 'breadcrumb-bg' ); 
 $style = array();
 if( $bgimage  ){ 
  $style[] = 'background-image:url(\''. $bgimage .'\')';
 }
 $estyle = !empty($style)? 'style="'.implode(";", $style).'"':"";
}
?>

<div id="opal-breadscrumb" <?php echo isset($estyle) ? $estyle : ''; ?>>
  <?php do_action( 'jets_woo_template_main_before' ); ?>
</div>
<section id="main-container" class="<?php echo apply_filters('jets_template_woocommerce_main_container_class','container');?>">
	
	<div class="row">
		
		<?php if( isset($jets_page_layouts['sidebars']) && !empty($jets_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>

		<div id="main-content" class="main-content col-xs-12 <?php echo esc_attr($jets_page_layouts['main']['class']); ?>">
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

					 <?php  jets_fnc_woocommerce_content(); ?>

				</div><!-- #content -->
			</div><!-- #primary -->


			<?php    get_sidebar( 'content' ); ?>
		</div><!-- #main-content -->

	</div>	
</section>
<?php

get_footer();
